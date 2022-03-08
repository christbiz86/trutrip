<?php

namespace Tests\Feature;

use App\Models\Travel;
use App\Models\User;
use Tests\TestCase;

class TravelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessfulGetTravelList(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->json('GET', '/api/travel');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'origin',
                    'destination',
                    'start_date',
                    'end_date',
                    'type',
                    'users_id',
                    'description',
                ],
            ]
        ]);
    }

    public function testSuccessfulCreateTravel(){
        $user = User::factory()->create();
        $data = [
            "title"         => "test title",
            "origin"        => "jakarta",
            "destination"   => "surabaya",
            "start_date"    => "2022-12-10",
            "end_date"      => "2022-12-18",
            "type"          => "personal",
            "users_id"      => $user->id,
            "description"   => "test description travel"
        ];
        $response = $this->actingAs($user)
            ->json('POST', 'api/travel', $data, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
                "data" => [
                    'id',
                    'title',
                    'origin',
                    'destination',
                    'start_date',
                    'end_date',
                    'type',
                    'users_id',
                    'description',
                ]
            ]);
    }

    public function testSuccessfulUpdateTravel(){
        $user = User::factory()->create();
        $travel = Travel::factory()->create();

        $data = [
            "title"         => "test title update",
            "origin"        => "jakarta",
            "destination"   => "surabaya",
            "start_date"    => "2022-12-10",
            "end_date"      => "2022-12-18",
            "type"          => "personal",
            "users_id"      => $user->id,
            "description"   => "test description travel"
        ];
        $response = $this->actingAs($user)
            ->json('PUT', 'api/travel/'.$travel->id, $data, ['Accept' => 'application/json']);
        $response->assertJsonStructure([
            "data"
        ]);
    }

    public function testSuccessfulDeleteTravel(){
        $user = User::factory()->create();
        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)
            ->json('DELETE', 'api/travel/'.$travel->id);
        $response->assertJsonStructure([
            "message"
        ]);
    }

}
