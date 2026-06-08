<?php
namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'  => fake()->firstName(),
            'last_name'   => fake()->lastName(),
            'email'       => fake()->unique()->safeEmail(),
            'password'    => static::$password ??= Hash::make('password'),
            'phone'       => fake()->phoneNumber(),
            'province'    => fake()->city(),
            'city'        => fake()->city(),
            'address'     => fake()->address(),
            'postal_code' => fake()->postcode(),
            'is_active'   => fake()->boolean(),

        ];

    }
}
