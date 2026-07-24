<?php

namespace Database\Seeders;

use App\Models\{Employee, InventoryTransaction, Product, TransactionType};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{Artisan, Hash};

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('migrate:fresh --seed');

        Employee::create([
            'name' => 'System Admin',
            'email' => 'admin@furniture.test',
            'password' => Hash::make('password'),
            'position' => 'Inventory Manager',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $products = Product::factory(10)->create(['quantity_on_hand' => 0]);
        $employees = Employee::factory(5)->create();

        // Fixed, meaningful transaction types instead of random duplicates
        $types = collect(['Stock In', 'Stock Out', 'Adjustment', 'Transfer', 'Return'])
            ->map(fn ($name) => TransactionType::factory()->create(['name' => $name, 'description' => "{$name} transaction"]));

        foreach (range(1, 30) as $i) {
            $transaction = InventoryTransaction::create([
                'product_id' => $products->random()->id,
                'employee_id' => $employees->random()->id,
                'transaction_type_id' => $types->random()->id,
                'quantity' => fake()->numberBetween(1, 20),
                'transaction_date' => fake()->dateTimeBetween('-30 days', 'now'),
                'reference_no' => strtoupper(fake()->bothify('REF-####')),
                'remarks' => fake()->optional()->sentence(),
            ]);

            $transaction->applyStockChange();
        }
    }
}
