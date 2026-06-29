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
    $price    = $this->faker->numberBetween(50000, 5000000);
    $hasDisc  = $this->faker->boolean(60); // 60% احتمال تخفیف
    $oldPrice = $hasDisc ? (int)($price / (1 - $this->faker->randomElement([10,15,20,25,30]) / 100)) : null;
    $name     = $this->faker->words(3, true);

    return [
        // ── فیلدهای قدیمی (آپدیت شده) ──
        'name'              => $name,
        'uni_code'          => strtoupper($this->faker->unique()->bothify('PRD-####-??')),
        'description'       => $this->faker->paragraphs(3, true),
        'price'             => $price,
        'old_price'         => $oldPrice,
        'discount'          => $hasDisc ? $this->faker->randomElement([10, 15, 20, 25, 30]) : 0,
        'stock'             => $this->faker->numberBetween(0, 100),
        'image_1'           => 'https://picsum.photos/seed/' . $this->faker->word() . '/400/400',
        'image_2'           => $this->faker->boolean(70) ? 'https://picsum.photos/seed/' . $this->faker->word() . '/400/400' : null,
        'image_3'           => $this->faker->boolean(40) ? 'https://picsum.photos/seed/' . $this->faker->word() . '/400/400' : null,
        'category_id'       => Category::inRandomOrder()->first()->id,
        'brand_id'          => Brand::inRandomOrder()->first()->id,
        'is_active'         => $this->faker->boolean(80),

        // ── فیلدهای جدید ──
        'fast_delivery'     => $this->faker->boolean(30),
        'rating'            => $this->faker->randomFloat(1, 2.5, 5.0),
        'reviews_count'     => $this->faker->numberBetween(0, 500),
        'sales_count'       => $this->faker->numberBetween(0, 2000)
    ];
}
// محصول ناموجود
public function outOfStock(): static
{
    return $this->state(['stock' => 0]);
}

// محصول تخفیف‌دار
public function onSale(): static
{
    $discount = $this->faker->randomElement([10, 20, 30]);
    return $this->state(function (array $attributes) use ($discount) {
        return [
            'old_price' => $attributes['price'],
            'price'     => (int)($attributes['price'] * (1 - $discount / 100)),
            'discount'  => $discount,
        ];
    });
}

// محصول پرفروش
public function bestseller(): static
{
    return $this->state([
        'sales_count' => $this->faker->numberBetween(500, 5000),
        'rating'      => $this->faker->randomFloat(1, 4.0, 5.0),
    ]);
}

// محصول جدید
public function newArrival(): static
{
    return $this->state([
        'created_at' => now()->subDays(rand(1, 7)),
        'discount'   => 0,
        'old_price'  => null,
    ]);
}
}
