<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\RankService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Rank;
use Database\Seeders\RankSeeder;

class RankControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from ranks');

        $this->app->make(RankService::class);
    }

    public function testCreateSuccess()
    {
        $rank_name = 'RANK_NAME_TEST';
        $payload = [
            'name' => $rank_name,
            'description' => 'RANK_DESCRIPTION_TEST'
        ];

        $response = $this->post('/ranks', $payload);
        var_dump($response->content());
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas(Rank::class, ['name' => $rank_name]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(RankSeeder::class);

        $payload = [
            'name' => 'pengatur',
            'description' => 'pengatur'
        ];

        $response = $this->post('/ranks', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name has already been taken.']);
    }

    public function testCreateMandatoryError()
    {
        $payload = [];

        $response = $this->post('/ranks', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name field is required.']);
    }

}
