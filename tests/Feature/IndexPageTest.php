<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexPageTest extends TestCase
{
    /**
     * Тест доступности главной страницы для гостей
     *
     * @return void
     */
    public function testShowingForGuests()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<li class=active><a href="/">Главная</a></li>');
    }
}
