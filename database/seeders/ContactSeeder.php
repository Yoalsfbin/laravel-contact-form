<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 30;

        foreach (range(1, $count) as $i) {
            Contact::factory()->create([
                'name'    => "送付者{$i}",
                'email'   => "sample{$i}@example.com",
                'subject' => "これはサンプルのお問い合わせ{$i}の件名です",
                'message' => "これはサンプルのお問い合わせ{$i}の内容です。",
            ]);
        }
    }
}
