<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegistrationSuccessPageTest extends TestCase
{
    /**
     * Тест доступности страницы о успешной регистрации
     *
     * @return void
     */
    public function testShowingForGuests()
    {
        $response = $this->get('/registration-success');

        $response->assertStatus(200);
        $response->assertSeeText('Поздравляем! Вы успешно зарегистрировались.');
    }
}
