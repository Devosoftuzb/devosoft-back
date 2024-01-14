<?php

namespace App\Http\Controllers;

use App\Models\Portfolio_Category;
use Illuminate\Http\Request;

class CategoryPortfolioController extends Controller
{
    public function getProjectsByCategory(Portfolio_Category $portfolio_category)
    {
        return $portfolio_category->portfolios()->get();
    }
}
