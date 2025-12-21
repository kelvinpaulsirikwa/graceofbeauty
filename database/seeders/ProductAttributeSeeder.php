<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the admin user
        $user = User::where('email', 'kelvinandersonpaulo@gmail.com')->first();
        
        if (!$user) {
            $this->command->error('Admin user not found. Please run UserSeeder first.');
            return;
        }

        $attributes = [
            ['id' => 1, 'name' => 'Color'],
            ['id' => 2, 'name' => 'Size'],
            ['id' => 3, 'name' => 'Material'],
            ['id' => 4, 'name' => 'Frame size'],
            ['id' => 5, 'name' => 'Frame Type'],
            ['id' => 6, 'name' => 'Volume'],
            ['id' => 7, 'name' => 'Texture'],
            ['id' => 8, 'name' => 'Length'],
        ];

        foreach ($attributes as $attributeData) {
            $existing = ProductAttribute::find($attributeData['id']);
            
            if ($existing) {
                $existing->update([
                    'name' => $attributeData['name'],
                    'posted_by' => $user->id,
                ]);
            } else {
                DB::table('product_attributes')->insert([
                    'id' => $attributeData['id'],
                    'name' => $attributeData['name'],
                    'posted_by' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Product attributes seeded successfully.');
    }
}
