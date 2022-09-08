<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Client;
use App\Models\Estimation;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(PostRequest $request)
    {
        $data = $request->validated();

        $client_id = $this->createClient($data['login']);
        Post::insert([
            'heading' => $data['heading'],
            'content' => $data['content'],
            'author_ip' => $data['author_ip'],
            'client_id' => $client_id,
        ]);

        return response()->json([
            'status' => true
        ]);

    }

    public function averagePost(int $post)
    {
        $post = Post::withAvg('estimations', 'like')
            ->orderByDesc('estimations_avg_like')
            ->get()->take($post);
        dd($post);

    }

    private function createClient($login)
    {
        $client = Client::where('login', '=', $login)->first();
        if ($client == false) {
            return Client::insertGetId([
                'login' => $login,
            ]);
        }
        return $client->id;
    }

}
