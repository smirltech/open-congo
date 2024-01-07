<?php

use App\Models\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

uses(RefreshDatabase::class);

test('index method returns a collection of provinces', function () {
    Province::factory()->create(['nom' => 'Province A']);
    Province::factory()->create(['nom' => 'Province B']);

    $response = $this->get('/api/provinces');

    $response->assertOk();
    $response->assertJsonFragment(['nom' => 'Province A']);
    $response->assertJsonFragment(['nom' => 'Province B']);
});

test('index method can filter provinces by name', function () {
    Province::factory()->create(['nom' => 'Province A']);
    Province::factory()->create(['nom' => 'Province B']);

    $response = $this->get('/api/provinces?nom=Province A');

    $response->assertOk();
    $response->assertJsonFragment(['nom' => 'Province A']);
    $response->assertJsonMissing(['nom' => 'Province B']);
});

test('index method can sort provinces by name in ascending order', function () {
    Province::factory()->create(['nom' => 'Province C']);
    Province::factory()->create(['nom' => 'Province B']);
    Province::factory()->create(['nom' => 'Province A']);

    $response = $this->get('/api/provinces?sort_by=asc');

    $response->assertOk();
    $response->assertJsonPath('data.0.nom', 'Province A');
    $response->assertJsonPath('data.1.nom', 'Province B');
    $response->assertJsonPath('data.2.nom', 'Province C');
});

test('index method can sort provinces by name in descending order', function () {
    Province::factory()->create(['nom' => 'Province C']);
    Province::factory()->create(['nom' => 'Province B']);
    Province::factory()->create(['nom' => 'Province A']);

    $response = $this->get('/api/provinces?sort_by=desc');

    $response->assertOk();
    $response->assertJsonPath('data.0.nom', 'Province C');
    $response->assertJsonPath('data.1.nom', 'Province B');
    $response->assertJsonPath('data.2.nom', 'Province A');
});

test('index method can paginate provinces', function () {
    Province::factory()->count(10)->create();

    $response = $this->get('/api/provinces?per_page=5');

    $response->assertOk();
    $response->assertJsonCount(5, 'data');
});

test('store method creates a new province', function () {
    $provinceData = [
        'nom' => 'Province A',
        // Add other required data if any
    ];

    $response = $this->postJson('/api/provinces', $provinceData);

    $response->assertCreated();
    $response->assertJsonFragment(['nom' => 'Province A']);
});

test('show method returns a specific province', function () {
    $province = Province::factory()->create();

    $response = $this->getJson('/api/provinces/' . $province->id);

    $response->assertOk();
    $response->assertJsonFragment(['nom' => $province->nom]);
});

test('update method updates a province', function () {
    $province = Province::factory()->create();

    $updatedData = [
        'nom' => 'Updated Province',
        // Add other data to update if any
    ];

    $response = $this->patchJson('/api/provinces/' . $province->id, $updatedData);

    $response->assertOk();
    $response->assertJsonFragment(['nom' => 'Updated Province']);
});

test('destroy method deletes a province', function () {
    $province = Province::factory()->create();

    $response = $this->deleteJson('/api/provinces/' . $province->id);

    $response->assertNoContent();
});

