<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            "username"=>"admin",
            "password"=>bcrypt("admin")
        ]);
        $profile = Profile::factory()->make();
        $profile->profileable_id = $admin->id;
        $profile->profileable_type = Admin::class;
        $profile->save();

    }
}
