<?php

use App\Http\Controllers\CommuneController;
use App\Http\Requests\StoreCommuneRequest;
use App\Http\Requests\UpdateCommuneRequest;
use App\Models\Commune;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

uses(RefreshDatabase::class);

it('can get all communes', function () {
    Commune::factory()->create(['nom' => 'Commune 1']);
    Commune::factory()->create(['nom' => 'Commune 2']);

    $response = $this->get('/api/communes');

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertJsonFragment(['nom' => 'Commune 1'])
        ->assertJsonFragment(['nom' => 'Commune 2']);
});

it('can filter communes by nom', function () {
    Commune::factory()->create(['nom' => 'Commune 1']);
    Commune::factory()->create(['nom' => 'Commune 2']);

    $response = $this->get('/api/communes?nom=Commune 1');

    $response->assertStatus(200)
        ->assertJsonCount(1)
        ->assertJsonFragment(['nom' => 'Commune 1']);
});

it('can paginate communes', function () {
    Commune::factory()->count(10)->create();

    $response = $this->get('/api/communes?page=2');

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonStructure(['data', 'links', 'meta']);
});

it('can sort communes', function () {
    Commune::factory()->create(['nom' => 'Commune 2']);
    Commune::factory()->create(['nom' => 'Commune 1']);

    $response = $this->get('/api/communes?sort_by=desc');

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertSeeInOrder(['Commune 2', 'Commune 1']);
});

it('can store a commune', function () {
    $requestData = ['nom' => 'New Commune'];

    $response = $this->post('/api/communes', $requestData);

    $response->assertStatus(201);
});

it('can show a commune', function () {
    $commune = Commune::factory()->create();

    $response = $this->get('/api/communes/' . $commune->id);

    $response->assertStatus(200)
        ->assertJsonFragment(['nom' => $commune->nom]);
});

it('can update a commune', function () {
    $commune = Commune::factory()->create();
    $requestData = ['nom' => 'Updated Commune'];

    $response = $this->put('/api/communes/' . $commune->id, $requestData);

    $response->assertStatus(200);

    $this->assertDatabaseHas('communes', [
        'id' => $commune->id,
        'nom' => 'Updated Commune'
    ]);
});

it('can delete a commune', function () {
    $commune = Commune::factory()->create();

    $response = $this->delete('/api/communes/' . $commune->id);

    $response->assertStatus(200);

    $this->assertDeleted($commune);
});
