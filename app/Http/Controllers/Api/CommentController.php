<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index($id) {

    }

    /**
     * @param Request $request
     */
    public function store(Request $request) {

        $comment = new Comment();
        $comment->id_product = $request->product_id;
        $comment->id_user = $request->user_id;
        $comment->content = $request->get('content');
        if($comment->save())
            return response()->json(['result' => true], 200);
        return response()->json(['result' => false], 422);
    }
}
