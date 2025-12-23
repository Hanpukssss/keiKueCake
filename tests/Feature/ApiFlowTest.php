<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

function getJwtToken(): string
{
    $user = User::factory()->create([
        'password' => 'password',
        'role' => 'admin',
    ]);

    $response = postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk();

    return $response->json('access_token');
}

test('user bisa registrasi dan mendapatkan token', function () {
    $response = $this->postJson('/api/auth/register', [
        'name' => 'Tester',
        'email' => 'tester@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertOk()
        ->assertJsonStructure(['access_token', 'token_type', 'expires_in', 'user']);
});

test('produk CRUD lewat API dengan JWT', function () {
    $token = getJwtToken();

    $create = $this->withToken($token)->postJson('/api/products', [
        'name' => 'Kue Lapis Legit',
        'price' => 25000,
        'stock' => 10,
        'description' => 'Kue lapis legit enak',
    ]);
    $create->assertCreated();
    $uuid = $create->json('uuid');

    $this->withToken($token)->getJson('/api/products')
        ->assertOk()
        ->assertJsonFragment(['uuid' => $uuid]);

    $this->withToken($token)->putJson("/api/products/{$uuid}", [
        'stock' => 15,
    ])->assertOk()
      ->assertJsonFragment(['stock' => 15]);

    $this->withToken($token)->deleteJson("/api/products/{$uuid}")
        ->assertOk()
        ->assertJsonFragment(['message' => 'Produk dihapus']);
});

test('membuat transaksi mengurangi stok produk', function () {
    $token = getJwtToken();
    $product = Product::factory()->create(['stock' => 5, 'price' => 10000]);

    $create = $this->withToken($token)->postJson('/api/transactions', [
        'product_uuid' => $product->uuid,
        'qty' => 2,
    ]);

    $create->assertCreated()
        ->assertJsonFragment(['qty' => 2])
        ->assertJsonPath('total_price', 20000);

    $product->refresh();
    expect($product->stock)->toBe(3);
});
