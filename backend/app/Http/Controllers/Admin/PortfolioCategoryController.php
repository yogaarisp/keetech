<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::all();
        return view('admin.portfolio_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('portfolio_categories', 'public');
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->input('image_url');
        }

        PortfolioCategory::create($validated);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Kategori Portofolio berhasil ditambahkan.');
    }

    public function edit(PortfolioCategory $portfolioCategory)
    {
        return view('admin.portfolio_categories.edit', compact('portfolioCategory'));
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name,' . $portfolioCategory->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('portfolio_categories', 'public');
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->input('image_url');
        }

        $portfolioCategory->update($validated);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Kategori Portofolio berhasil diperbarui.');
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        if ($portfolioCategory->portfolios()->count() > 0) {
            return back()->withErrors('Tidak dapat menghapus kategori yang sedang digunakan oleh proyek.');
        }
        
        $portfolioCategory->delete();
        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Kategori Portofolio berhasil dihapus.');
    }
}
