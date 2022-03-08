<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            "confirm_password" => "demo12345"
        ];
        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertJsonStructure([
                "data" => [
                    'token',
                    'name'
                ]
            ]);
    }

    public function testSuccessfulLogin(){
        $userData = [
            "email" => "doe@example.com",
            "password" => "demo12345"
        ];
        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
            ->assertJsonStructure([
                "data" => [
                    'token',
                    'name'
                ]
            ]);
    }

}
