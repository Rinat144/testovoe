<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostipResource;
use App\Http\Resources\PostResource;
use App\Models\Client;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostController extends Controller
{
    public function create(PostRequest $request): JsonResponse
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


    public function averagePost(int $post): ResourceCollection
    {
        $post = Post::withAvg('estimations', 'like')
            ->orderByDesc('estimations_avg_like')
            ->get()->take($post);

        return PostResource::collection($post);
    }

    public function listIp(): ResourceCollection
    {
        $author_ip = Post::with(['client'])->select('author_ip', 'client_id')->orderBy('author_ip')
            ->get();

        return PostipResource::collection($author_ip);

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
