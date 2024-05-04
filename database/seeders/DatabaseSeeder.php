<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Settings::create(
          ['website_name' => 'Hospital maangement',]
        );
        Hospital::create([
            'hospital_name' => 'Hospital 1',
            'address' => 'jordan',
            'country' => 'jordan',
            'state' => 'jordan',
            'city' => 'jordan city',
            'zip' => '123',
            'image' => ''
        ]);
        User::create([
           'name' => 'Administrator',
           'email' => 'admin@admin.com',
           'user_type' => User::ADMIN,
           'password' => bcrypt('admin')
        ]);
        User::create([
            'name' => 'Hospital',
            'email' => 'hospital@mail.com',
            'user_type' => User::HOSPITAL,
            'hospital_id' => 1,
            'password' => bcrypt('hospital')
        ]);
        User::create([
           'name' => 'Doctor',
           'email' => 'doctor@mail.com',
           'user_type' => User::DOCTOR,
            'hospital_id' => 1,
           'password' => bcrypt('doctor')
        ]);
        User::create([
           'name' => 'Pharmacy Admin',
           'email' => 'pharmacy@mail.com',
           'user_type' => User::PHARMACY,
            'hospital_id' => 1,
           'password' => bcrypt('pharmacy')
        ]);
        User::create([
            'name' => 'User',   // Patient
            'email' => 'user@user.com',
            'user_type' => User::PATIENT,
            'hospital_id' => 1,
            'password' => bcrypt('user')
        ]);
    }
}
