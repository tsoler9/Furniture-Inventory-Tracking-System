<?php

use App\Models\Employee;
use App\Models\Product;

beforeEach(function () {
    $this->employee = Employee::factory()->create();
});

test('authenticated employees can view the products list', function () {
    $response = $this->actingAs($this->employee)->get('/products');

    $response->assertStatus(200);
});

test('guests cannot view the products list', function () {
    $response = $this->get('/products');

    $response->assertRedirect('/login');
});

test('a product can be created with valid data', function () {
    $response = $this->actingAs($this->employee)->post('/products', [
        'name' => 'Oak Dining Chair',
        'sku' => 'CHR-1001',
        'category' => 'Chairs',
        'unit_price' => 2499.00,
        'quantity_on_hand' => 20,
        'reorder_level' => 5,
        'status' => 'active',
    ]);

    $response->assertRedirect('/products');
    $this->assertDatabaseHas('products', ['sku' => 'CHR-1001']);
});

test('a product requires a unique sku', function () {
    Product::factory()->create(['sku' => 'DUPLICATE-1']);

    $response = $this->actingAs($this->employee)->post('/products', [
        'name' => 'Another Chair',
        'sku' => 'DUPLICATE-1',
        'unit_price' => 100,
        'quantity_on_hand' => 5,
        'reorder_level' => 1,
        'status' => 'active',
    ]);

    $response->assertSessionHasErrors('sku');
});

test('deleting a product soft deletes it instead of removing it permanently', function () {
    $product = Product::factory()->create();

    $this->actingAs($this->employee)->delete("/products/{$product->id}");

    $this->assertSoftDeleted('products', ['id' => $product->id]);
});
