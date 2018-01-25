<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function indexProductByCategoryId(Request $request)
    {
        $id = $request->category_id;
        $limit = $request->limit;
        // dem co con cap 1
        $cate_count1 = Category::where('id_parent', $id)->where('status', 1)->count();
        if ($cate_count1 != 0) {
            $cate_id_arr = Category::select('id')->where(['id_parent' => $id, 'status' => 1])->get()->toArray();
            // dem co con cap 2
            $cate_count2 = Category::select('id')->whereIn('id_parent', $cate_id_arr)->where('status', 1)->count();
            if($cate_count2 != 0) {
                $cate_id_arr = Category::select('id')->whereIn('id_parent', $cate_id_arr)->where('status', 1)->get()->toArray();
            }
            $data = Product::with('images')->select(['id', 'name', 'price', 'promotion', 'content'])->whereIn('id_cate', $cate_id_arr)->where('status', 1)->limit($limit)->get();

        } else {
            $data = Product::with('images')->select(['id', 'name', 'price', 'promotion', 'content'])->where(['id_cate' => $id, 'status' => 1])->limit($limit)->get();
        }
        return response()->json($data, 200);
    }

    public function indexProductPopular() {
        $data = Product::with('images')->select(['id', 'name', 'price', 'promotion', 'content'])->orderBy('view', 'desc')->limit(12)->get();
        return response()->json($data, 200);
    }
    public function indexProductSales() {
        $data = Product::with('images')->select(['id', 'name', 'price', 'promotion', 'content'])->orderBy('count_sell', 'desc')->limit(8)->get();
        return response()->json($data, 200);
    }
    public function indexProductRandom() {
        $data = Product::with('images')->select(['id', 'name', 'price', 'promotion', 'content'])->orderBy(DB::raw('RAND()'))->limit(16)->get();
        return response()->json($data, 200);
    }
    public function indexProductPromotion() {
        $data = Product::with('images')->select(['id', 'name', 'price', 'promotion', 'content'])->where('promotion', '!=', NULL)->orderBy('updated_at', 'desc')->limit(16)->get();
        return response()->json($data, 200);
    }
    public function indexProduct($id) {
        $data = Product::with(['images', 'comments' => function ($query) {
            $query->select(['id_product','comments.id', 'content', 'comments.created_at', 'name', 'id_user', 'comments.created_at'])->join('users', 'users.id', 'id_user');
        }])->where('id', $id)->get();
        return response()->json($data, 200);
    }
    public function indexProductByKeyword(Request $request) {
        $keyword = $request->keyword;
        $limit = $request->limit;
        $data = Product::with('images')->select(['id', 'name', 'price', 'promotion', 'content'])->where('name', 'like', "%$keyword%")->where('status', 1)->limit($limit)->get();
        return response()->json($data, 200);
    }
}
