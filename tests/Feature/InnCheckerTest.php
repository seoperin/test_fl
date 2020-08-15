<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InnCheckerTest extends TestCase
{
    public function test_is_inn_isset()
    {
        $response = $this->call('POST', '/checkInn', []);

        $response->assertSessionHasErrors('inn');

        $response->assertStatus(302);

        $response->assertRedirect(route('home'));
    }

    public function test_is_inn_empty()
    {
        $response = $this->call('POST', '/checkInn', [
            'inn' => ''
        ]);

        $response->assertSessionHasErrors('inn');

        $response->assertStatus(302);

        $response->assertRedirect(route('home'));
    }

    public function test_is_inn_incorrect()
    {
        $response = $this->call('POST', '/checkInn', [
            'inn' => '12345'
        ]);

        $response->assertSessionHasErrors('inn');

        $response->assertStatus(302);

        $response->assertRedirect(route('home'));
    }

    public function test_is_inn_correct_and_not_freelancer()
    {
        Http::fake(function () {
            return Http::response([
                "status" => false,
                "message" => "182908990423 не является плательщиком налога на профессиональный доход"
            ], 200);
        });

        $response = $this->call('POST', '/checkInn', [
            'inn' => '182908990423'
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertSessionHas('success', false);

        $response->assertStatus(302);

        $response->assertRedirect(route('home'));
    }

    public function test_is_inn_correct_and_freelancer()
    {
        Http::fake(function () {
            return Http::response([
                "status" => true,
                "message" => "182908990423 является плательщиком налога на профессиональный доход"
            ], 200);
        });

        $response = $this->call('POST', '/checkInn', [
            'inn' => '182908990423'
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertSessionHas('success', true);

        $response->assertStatus(302);

        $response->assertRedirect(route('home'));
    }
}
