<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Category;

class CategoryController extends Controller
{

    public function list()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title', 'id')->all();
        return view('admin.category.list', compact('categories', 'allCategories'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('GET')) {
            $parentCategories = Category::where('parent_id', '=', 0)->get();
            return view('admin.category.add', compact('parentCategories'));
        } else {
            $input = $request->all();
            $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
            Category::create($input);
            return back()->with('success', 'New Category added successfully.');
        }
    }
}
