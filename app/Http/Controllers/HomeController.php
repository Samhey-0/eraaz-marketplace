<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display the homepage with featured products and categories.
     */
    public function index()
    {
        $products = Cache::remember('home.products', 600, function () {
            return Product::where('is_active', true)
                ->with(['category', 'vendor'])
                ->latest()
                ->take(8)
                ->get();
        });

        $categories = Cache::remember('home.categories', 600, function () {
            return Category::where('is_active', true)
                ->withCount('products')
                ->get();
        });

        return view('welcome', compact('products', 'categories'));
    }

    /**
     * Get the cache tags for the request.
     */
    public function cacheTags()
    {
        return ['products', 'categories'];
    }
}
