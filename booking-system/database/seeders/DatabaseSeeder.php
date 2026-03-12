<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // સાચી રીત: સીધું User મોડલ વાપરો, factory() નહીં.
        User::updateOrCreate(
            ['email' => 'ayushgabani24@gmail.com'], // આ ચેક કરશે કે આ ઈમેઈલ પહેલેથી છે કે નહીં
            [
                'name' => 'Ayush Gabani',
                'password' => Hash::make('password'), // પાસવર્ડ સુરક્ષિત રીતે સેવ કરવા માટે
            ]
        );
    }
}