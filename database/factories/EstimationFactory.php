<?php

namespace Database\Factories;

use App\Models\Estimation;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estimation>
 */
class EstimationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Estimation::class;

    public function definition()
    {
        $like = mt_rand(1,5);
        return [
            'like' => $like,
            'post_id' => Post::get()->random()->id,
        ];
    }
}
