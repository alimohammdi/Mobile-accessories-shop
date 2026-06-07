<?php
namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(3, true),
            'uni_code'    => strtoupper($this->faker->unique()->bothify('PRD-####-??')),
            'price'       => $this->faker->numberBetween(50000, 5000000),
            'discount'    => $this->faker->randomElement([0, 5, 10, 15, 20]),
            'stock'       => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->paragraph(),
            'image_1'     => $this->faker->text(50),
            'image_2'     => null,
            'image_3'     => null,
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id'    => Brand::inRandomOrder()->first()->id,
            'is_active'   => $this->faker->boolean(80),
        ];
    }
}
