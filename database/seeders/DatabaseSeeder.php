<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 3 أدمن
        for ($i = 1; $i <= 3; $i++) {
            User::firstOrCreate(
                ['email' => "admin{$i}@app25.com"],
                [
                    'name' => "Admin {$i}",
                    'address' => "Admin Address {$i}",
                    'map_link' => null,
                    'phone' => "10000000{$i}",
                    'health_unit' => "HQ {$i}",
                    'role' => 'admin',
                    'password' => Hash::make('123456789'),
                ]
            );
        }

        // 3 مستخدم عادي
        for ($i = 1; $i <= 3; $i++) {
            User::firstOrCreate(
                ['email' => "user{$i}@app25.com"],
                [
                    'name' => "User {$i}",
                    'address' => "User Address {$i}",
                    'map_link' => null,
                    'phone' => "20000000{$i}",
                    'health_unit' => "HU {$i}",
                    'role' => 'user',
                    'password' => Hash::make('123456789'),
                ]
            );
        }

        // 3 موصل طلبات
        for ($i = 1; $i <= 3; $i++) {
            User::firstOrCreate(
                ['email' => "delivery{$i}@app25.com"],
                [
                    'name' => "Delivery {$i}",
                    'address' => "Delivery Address {$i}",
                    'map_link' => null,
                    'phone' => "30000000{$i}",
                    'health_unit' => "HU {$i}",
                    'role' => 'delivery',
                    'password' => Hash::make('123456789'),
                ]
            );
        }

        // 3 حساب موقوف
        for ($i = 1; $i <= 3; $i++) {
            User::firstOrCreate(
                ['email' => "suspended{$i}@app25.com"],
                [
                    'name' => "Suspended {$i}",
                    'address' => "Suspended Address {$i}",
                    'map_link' => null,
                    'phone' => "40000000{$i}",
                    'health_unit' => "HU {$i}",
                    'role' => 'suspended',
                    'password' => Hash::make('suspended123456'),
                ]
            );
        }
    }
}
