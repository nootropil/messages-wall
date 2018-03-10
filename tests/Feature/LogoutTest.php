<?php

namespace Tests\Feature;

use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * Тест переадресации гостей
     *
     * @return void
     */
    public function testRedirectionOfGuests()
    {
        $response = $this->post('/logout');
        $response->assertRedirect('/');
    }
}
