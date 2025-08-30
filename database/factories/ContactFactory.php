<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'お問い合わせ',
            'email' => 'sample@example.com',
            'subject' => 'サンプルのお問い合わせ',
            'message' => 'これはサンプルのお問い合わせです。',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
