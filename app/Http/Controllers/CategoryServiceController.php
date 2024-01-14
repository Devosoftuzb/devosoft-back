<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio_Category;
use Illuminate\Http\Request;

class CategoryServiceController extends Controller
{
    public function index(Category $category) {
        return $category->services()->get();
    }

    public function show(Portfolio_Category $portfolio_category) {
        return $portfolio_category->portfolios()->get();
    }
}
