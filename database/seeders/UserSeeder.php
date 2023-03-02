<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //1
          $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@yopmail.com',
            'password' => Hash::make('123456'),
        ]);

        $country = Country::create([
            'name' => 'India',
        ]);

        $company1 = $user->company()->create([
            'name' => 'TCS',
        ]);

        $company1->country()->associate($country)->save();

        $company2 = $user->company()->create([
            'name' => 'Reliance',
        ]);

        $company2->country()->associate($country)->save();

        //2
        $user = User::create([
            'name' => 'User',
            'email' => 'user@yopmail.com',
            'password' => Hash::make('123456'),
        ]);

        $country = Country::create([
            'name' => 'USA',
        ]);

        $company1 = $user->company()->create([
            'name' => 'Wipro',
        ]);

        $company1->country()->associate($country)->save();

        $company2 = $user->company()->create([
            'name' => 'Accenture',
        ]);

        $company2->country()->associate($country)->save();

        //3
        $user = User::create([
            'name' => 'John',
            'email' => 'john@yopmail.com',
            'password' => Hash::make('123456'),
        ]);

        $country = Country::create([
            'name' => 'US',
        ]);

        $company1 = $user->company()->create([
            'name' => 'Adani',
        ]);

        $company1->country()->associate($country)->save();

        $company2 = $user->company()->create([
            'name' => 'Echo',
        ]);

        $company2->country()->associate($country)->save();

        //4
        $user = User::create([
            'name' => 'Emma',
            'email' => 'emma@yopmail.com',
            'password' => Hash::make('123456'),
        ]);

        $country = Country::create([
            'name' => 'Canada',
        ]);

        $company1 = $user->company()->create([
            'name' => 'Matrix',
        ]);

        $company1->country()->associate($country)->save();

        $company2 = $user->company()->create([
            'name' => 'BMW',
        ]);

        $company2->country()->associate($country)->save();

        //5
        $user = User::create([
            'name' => 'Leena',
            'email' => 'leena@yopmail.com',
            'password' => Hash::make('123456'),
        ]);

        $country = Country::create([
            'name' => 'Australia',
        ]);

        $company1 = $user->company()->create([
            'name' => 'ITC',
        ]);

        $company1->country()->associate($country)->save();

        $company2 = $user->company()->create([
            'name' => 'Amazon',
        ]);

        $company2->country()->associate($country)->save();
    }
}
