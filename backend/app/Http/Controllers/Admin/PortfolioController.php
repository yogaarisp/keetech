<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::ordered()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = \App\Models\PortfolioCategory::all();
        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'client_name' => 'nullable|string|max:255',
            'project_url' => 'nullable|url|max:255',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('portfolios', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Proyek portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = \App\Models\PortfolioCategory::all();
        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'client_name' => 'nullable|string|max:255',
            'project_url' => 'nullable|url|max:255',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image_file')) {
            // Delete old file if exists in storage
            if ($portfolio->image && \Storage::disk('public')->exists($portfolio->image)) {
                \Storage::disk('public')->delete($portfolio->image);
            }
            $path = $request->file('image_file')->store('portfolios', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Proyek portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Proyek portofolio berhasil dihapus.');
    }
}
