<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create([
            'first_name' => 'Bethany',
            'last_name' => 'Armitage',
            'email' => 'bethany@senses.co.uk',
            'password' => Hash::make('password'),
            'type' => 'edit',
        ]);
        User::factory()->create([
            'email' => 'edit@test.co.uk',
            'type' => 'edit',
            'password' => Hash::make('iamedit'),
        ]);
        User::factory()->create([
            'email' => 'view@test.co.uk',
            'type' => 'view',
            'password' => Hash::make('iamview'),
        ]);
        User::factory()->create([
            'email' => 'restricted@test.co.uk',
            'type' => 'restricted',
            'password' => Hash::make('iamtest'),
        ]);
        User::factory()->count(50)->create();
    }
}
