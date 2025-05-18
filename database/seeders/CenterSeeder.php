<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    public function run()
    {
        $defaultHours = [
            'Monday' => ['open' => '08:00', 'close' => '18:00'],
            'Tuesday' => ['open' => '08:00', 'close' => '18:00'],
            'Wednesday' => ['open' => '08:00', 'close' => '18:00'],
            'Thursday' => ['open' => '08:00', 'close' => '18:00'],
            'Friday' => ['open' => '08:00', 'close' => '18:00'],
            'Saturday' => ['open' => '09:00', 'close' => '16:00'],
            'Sunday' => ['open' => '09:00', 'close' => '14:00']
        ];

        $centers = [
            [
                'name' => 'Central Blood Bank',
                'address' => '123 Main Street',
                'city' => 'Casablanca',
                'phone' => '0522-123456',
                'email' => 'central@bloodbank.com',
                'latitude' => 33.5731,
                'longitude' => -7.5898,
                'is_active' => true,
                'operating_hours' => $defaultHours,
                'available_blood_types' => ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'],
                'description' => 'Main blood donation center in Casablanca with modern facilities and experienced staff.',
                'website' => 'https://centralbloodbank.ma',
                'emergency_contact' => '0522-999999'
            ],
            [
                'name' => 'Regional Blood Center',
                'address' => '456 Avenue Mohammed V',
                'city' => 'Rabat',
                'phone' => '0537-789012',
                'email' => 'rabat@bloodbank.com',
                'latitude' => 34.0209,
                'longitude' => -6.8416,
                'is_active' => true,
                'operating_hours' => $defaultHours,
                'available_blood_types' => ['A+', 'B+', 'O+', 'O-', 'AB+'],
                'description' => 'Regional center serving the Rabat-Salé-Kénitra area with specialized blood processing facilities.',
                'website' => 'https://rabatbloodcenter.ma',
                'emergency_contact' => '0537-999999'
            ],
            [
                'name' => 'City Blood Donation Center',
                'address' => '789 Hassan II Boulevard',
                'city' => 'Marrakech',
                'phone' => '0524-345678',
                'email' => 'marrakech@bloodbank.com',
                'latitude' => 31.6295,
                'longitude' => -7.9811,
                'is_active' => true,
                'operating_hours' => $defaultHours,
                'available_blood_types' => ['A+', 'A-', 'O+', 'O-'],
                'description' => 'Modern blood donation facility in Marrakech offering comfortable donation environment.',
                'website' => 'https://marrakechblood.ma',
                'emergency_contact' => '0524-999999'
            ],
        ];

        foreach ($centers as $center) {
            Center::create($center);
        }
    }
} 