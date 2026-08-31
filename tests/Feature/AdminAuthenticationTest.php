<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    public function test_guest_cannot_open_admin_pages(): void
    {
        foreach (['/about', '/blog', '/form'] as $uri) {
            $this->get($uri)->assertRedirect('/login');
        }
    }

    public function test_guest_cannot_submit_admin_actions(): void
    {
        $this->post('/insert')->assertRedirect('/login');
        $this->put('/update/1')->assertRedirect('/login');
        $this->delete('/delete/1')->assertRedirect('/login');
        $this->delete('/chang/1')->assertRedirect('/login');
    }
}
