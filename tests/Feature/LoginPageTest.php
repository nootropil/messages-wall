<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /**
     * Тест доступности страницы авторизации  для гостей
     *
     * @return void
     */
    public function testShowingForGuests()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('<li class=active><a href="/login">Авторизация</a></li>');
        $response->assertSee('</form>');
    }
}
