<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $groups = Product::select('group')->distinct()->pluck('group');
        $query = Product::query();
        if ($request->has('group') && $request->group != 'all') {
            $query->where('group', $request->group);
        }
        $products = $query->orderBy('created_at', 'desc')->take(4)->get();
        return view('home', compact('groups', 'products'));
    }
}
