<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Client;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
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

    public function listIp(): JsonResponse
    {
        $posts = Post::Join('clients', 'client_id', '=', 'clients.id')
            ->select('author_ip', 'login')
            ->orderByDesc('author_ip')
            ->get();

        $groups = [];
        foreach ($posts as $post) {
            $groups[$post->author_ip]['login'][] = $post->login;
        }

        /*      $grouped = $posts->mapToGroups(function ($item) {
                  return [$item['author_ip'] => $item['login']];
              });*/
        return response()->json([
            $groups
        ]);
    }

    public function averagePost(int $post): ResourceCollection
    {
        $post = Post::withAvg('estimations', 'like')
            ->orderByDesc('estimations_avg_like')
            ->get()->take($post);

        return PostResource::collection($post);
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
