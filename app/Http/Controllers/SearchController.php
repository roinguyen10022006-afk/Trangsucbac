<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function ajaxSearch(Request $request)
    {
        $keyword = trim($request->input('keyword'));
        
        if (empty($keyword)) {
            return response()->json([]);
        }

        $products = Product::where('name', 'LIKE', "%{$keyword}%")
            ->latest()
            ->take(5)
            ->get(['id', 'name', 'price', 'image']);

        return response()->json($products);
    }
}