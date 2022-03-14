<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(30)->create()->each(function($user) {
            $profile = Profile::factory()->make();
            $profile->profileable_id = $user->id;
            $profile->profileable_type = User::class;
            $profile->save();
        });
    }
}
