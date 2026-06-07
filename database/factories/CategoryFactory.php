<?php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'قاب موبایل',
            'شارژر',
            'هندزفری',
            'پاوربانک',
            'کابل',
            'محافظ صفحه',
            'هولدر',
            'اسپیکر',
        ];
        return [
            'name'        => $this->faker->randomElement($categories),
            'description' => $this->faker->sentence(),
            'image'       => null,

        ];
    }
}
