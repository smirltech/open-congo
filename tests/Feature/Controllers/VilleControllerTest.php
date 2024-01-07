<?php

use App\Http\Controllers\VilleController;
use App\Http\Requests\StoreVilleRequest;
use App\Http\Requests\UpdateVilleRequest;
use App\Models\Ville;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

uses(RefreshDatabase::class);

it('can get all villes', function () {
    Ville::factory()->create(['nom' => 'Ville 1']);
    Ville::factory()->create(['nom' => 'Ville 2']);

    $response = $this->get('/api/villes');

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertJsonFragment(['nom' => 'Ville 1'])
        ->assertJsonFragment(['nom' => 'Ville 2']);
});

it('can filter villes by nom', function () {
    Ville::factory()->create(['nom' => 'Ville 1']);
    Ville::factory()->create(['nom' => 'Ville 2']);

    $response = $this->get('/api/villes?nom=Ville 1');

    $response->assertStatus(200)
        ->assertJsonCount(1)
        ->assertJsonFragment(['nom' => 'Ville 1']);
});

it('can paginate villes', function () {
    Ville::factory()->count(10)->create();

    $response = $this->get('/api/villes?page=2');

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonStructure(['data', 'links', 'meta']);
});

it('can sort villes', function () {
    Ville::factory()->create(['nom' => 'Ville 2']);
    Ville::factory()->create(['nom' => 'Ville 1']);

    $response = $this->get('/api/villes?sort_by=desc');

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertSeeInOrder(['Ville 2', 'Ville 1']);
});

it('can store a ville', function () {
    $requestData = ['nom' => 'New Ville'];

    $response = $this->post('/api/villes', $requestData);

    $response->assertStatus(201);
});

it('can show a ville', function () {
    $ville = Ville::factory()->create();

    $response = $this->get('/api/villes/' . $ville->id);

    $response->assertStatus(200)
        ->assertJsonFragment(['nom' => $ville->nom]);
});

it('can update a ville', function () {
    $ville = Ville::factory()->create();
    $requestData = ['nom' => 'Updated Ville'];

    $response = $this->put('/api/villes/' . $ville->id, $requestData);

    $response->assertStatus(200);

    $this->assertDatabaseHas('villes', [
        'id' => $ville->id,
        'nom' => 'Updated Ville'
    ]);
});

it('can delete a ville', function () {
    $ville = Ville::factory()->create();

    $response = $this->delete('/api/villes/' . $ville->id);

    $response->assertStatus(200);

    $this->assertDeleted($ville);
});
