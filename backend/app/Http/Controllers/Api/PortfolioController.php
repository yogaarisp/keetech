<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')->active()->ordered()->get();
        
        $portfolios->transform(function ($item) {
            $item->category_name = $item->category ? $item->category->name : 'Uncategorized';
            return $item;
        });

        return response()->json(['data' => $portfolios]);
    }
}
