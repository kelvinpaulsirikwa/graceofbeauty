<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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

        $categories = [
            ['category_id' => 1, 'category_name' => 'Hairs'],
            ['category_id' => 2, 'category_name' => 'Hair Oil'],
            ['category_id' => 3, 'category_name' => 'Spectalces'],
            ['category_id' => 4, 'category_name' => 'Bracelets'],
        ];

        foreach ($categories as $categoryData) {
            $existing = Category::find($categoryData['category_id']);
            
            if ($existing) {
                $existing->update([
                    'category_name' => $categoryData['category_name'],
                    'created_by' => $user->id,
                ]);
            } else {
                DB::table('categories')->insert([
                    'category_id' => $categoryData['category_id'],
                    'category_name' => $categoryData['category_name'],
                    'created_by' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Categories seeded successfully.');
    }
}
