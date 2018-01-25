<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index() {
        $data = Slider::select('id', 'image')->get();
        return response()->json($data, 200);
    }
}
