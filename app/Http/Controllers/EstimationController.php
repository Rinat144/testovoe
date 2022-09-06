<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstimationRequest;
use App\Models\Estimation;
use Illuminate\Http\Request;

class EstimationController extends Controller
{
    public function like(EstimationRequest $request)
    {
        $data = $request->validated();

        Estimation::insert([
           'like' => $data['like'],
           'post_id' => $data['post_id'],
        ]);

        $likeAvg = Estimation::where('post_id','=', $data['post_id'])->avg('like');

        return response()->json([
           'LikeAVG' => $likeAvg,
        ]);
    }
}
