<?php
namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = [
            'Samsung',
            'Apple',
            'Xiaomi',
            'Baseus',
            'Anker',
            'Ugreen',
            'JBL',
            'Sony',
        ];
        return [
            'name' => $this->faker->randomElement($brands),
            'logo' => null,
        ];
    }
}
