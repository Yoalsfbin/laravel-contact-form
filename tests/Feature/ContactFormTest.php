<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 正常にお問い合わせを送信できる()
    {
        $response = $this->post('/contact', [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'subject' => 'テスト件名',
            'message' => 'これはテストメッセージです。',
        ]);

        $response->assertRedirect(route('contact.thanks'));
        $this->assertDatabaseHas('contacts', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function バリデーションエラーになる()
    {
        $response = $this->from('/contact')->post('/contact', [
            'name' => '',
            'email' => '不正なメール',
            'subject' => '',
            'message' => '',
        ]);

        $response->assertRedirect('/contact');
        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
        $this->assertDatabaseCount('contacts', 0);
    }
}
