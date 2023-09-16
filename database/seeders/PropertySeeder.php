<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array_map('str_getcsv', file(storage_path('app/public/data.csv')));

        foreach ($data as $row) {
            DB::table('properties')->insert([
                'name' => $row[0],
                'price' => floatval($row[1]), // Convert to float
                'bedrooms' => intval($row[2]), // Convert to integer
                'bathrooms' => intval($row[3]), // Convert to integer
                'storeys' => intval($row[4]),   // Convert to integer
                'garages' => intval($row[5]),   // Convert to integer
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
