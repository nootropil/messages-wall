<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegistrationPageTest extends TestCase
{
    /**
     * Тест доступности страницы регистрации для гостей
     *
     * @return void
     */
    public function testShowingForGuests()
    {
        $response = $this->get('/registration');

        $response->assertStatus(200);
        $response->assertSee('<li class=active><a href="/registration">Регистрация</a></li>');
        $response->assertSee('</form>');
    }
}
