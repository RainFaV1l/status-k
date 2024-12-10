<?php

namespace Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\Post\Models\PostCategory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Post\Models\Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'image' => $this->faker->image(),
            'description' => $this->faker->paragraph(10),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'post_category_id' => PostCategory::query()->inRandomOrder()->value('id'),
            'is_published' => $this->faker->numberBetween(0, 1),
            'anons' => $this->faker->date(),
        ];
    }
}

