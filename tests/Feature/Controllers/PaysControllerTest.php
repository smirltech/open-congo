<?php

use App\Models\Pays;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

uses(RefreshDatabase::class);

test('index method returns a collection of pays', function () {
    Pays::factory()->create(['nom' => 'Pays A']);
    Pays::factory()->create(['nom' => 'Pays B']);

    $response = $this->get('/api/pays');

    $response->assertOk();
    $response->assertJsonFragment(['nom' => 'Pays A']);
    $response->assertJsonFragment(['nom' => 'Pays B']);
});

test('index method can filter pays by name', function () {
    Pays::factory()->create(['nom' => 'Pays A']);
    Pays::factory()->create(['nom' => 'Pays B']);

    $response = $this->get('/api/pays?nom=Pays A');

    $response->assertOk();
    $response->assertJsonFragment(['nom' => 'Pays A']);
    $response->assertJsonMissing(['nom' => 'Pays B']);
});

test('index method can sort pays by name in ascending order', function () {
    Pays::factory()->create(['nom' => 'Pays C']);
    Pays::factory()->create(['nom' => 'Pays B']);
    Pays::factory()->create(['nom' => 'Pays A']);

    $response = $this->get('/api/pays?sort_by=asc');

    $response->assertOk();
    $response->assertJsonPath('data.0.nom', 'Pays A');
    $response->assertJsonPath('data.1.nom', 'Pays B');
    $response->assertJsonPath('data.2.nom', 'Pays C');
});

test('index method can sort pays by name in descending order', function () {
    Pays::factory()->create(['nom' => 'Pays C']);
    Pays::factory()->create(['nom' => 'Pays B']);
    Pays::factory()->create(['nom' => 'Pays A']);

    $response = $this->get('/api/pays?sort_by=desc');

    $response->assertOk();
    $response->assertJsonPath('data.0.nom', 'Pays C');
    $response->assertJsonPath('data.1.nom', 'Pays B');
    $response->assertJsonPath('data.2.nom', 'Pays A');
});

test('index method can paginate pays', function () {
    Pays::factory()->count(10)->create();

    $response = $this->get('/api/pays?per_page=5');

    $response->assertOk();
    $response->assertJsonCount(5, 'data');
});

test('store method creates a new pays', function () {
    $paysData = [
        'nom' => 'Pays A',
        // Add other required data if any
    ];

    $response = $this->postJson('/api/pays', $paysData);

    $response->assertCreated();
    $response->assertJsonFragment(['nom' => 'Pays A']);
});

test('show method returns a specific pays', function () {
    $pays = Pays::factory()->create();

    $response = $this->getJson('/api/pays/' . $pays->id);

    $response->assertOk();
    $response->assertJsonFragment(['nom' => $pays->nom]);
});

test('update method updates a pays', function () {
    $pays = Pays::factory()->create();

    $updatedData = [
        'nom' => 'Updated Pays',
        // Add other data to update if any
    ];

    $response = $this->patchJson('/api/pays/' . $pays->id, $updatedData);

    $response->assertOk();
    $response->assertJsonFragment(['nom' => 'Updated Pays']);
});

test('destroy method deletes a pays', function () {
    $pays = Pays::factory()->create();

    $response = $this->deleteJson('/api/pays/' . $pays->id);

    $response->assertNoContent();
});

