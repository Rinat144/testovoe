<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition()
    {
        $author_ip = mt_rand(1,4) . '.' . mt_rand(1,4) . '.' . mt_rand(1,4). '.' . mt_rand(1,4);
        return [
            'heading' => $this->faker->name,
            'content' => $this->faker->text(),
            'author_ip' => $author_ip,
            'client_id' => Client::get()->random()->id,
        ];
    }
}
