<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Project;
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
        User::factory(10)->create()->each(function ($user) {
            Company::factory(rand(1, 3))->create(['user_id' => $user->id])->each(function ($company) {
                Project::factory(rand(4, 6))->create(['company_id' => $company->id]);
            });
        });
    }
}