<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $first_name = $this->faker->firstName();
        return [
            'first_name'    => $first_name,
            'last_name'     => $this->faker->lastName(),
            'login'         => $first_name,
            'password'      => Hash::make('qwerty'),
            'role_id'       => Role::where('slug', 'user')->first()->id,
        ];
    }
}
