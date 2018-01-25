<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $parent_id = $request->parent_id;
        $data = Category::select(['id', 'name', 'id_parent', 'status'])->where('id_parent', $parent_id)->get();
        return response()->json($data, 200);
    }
}
