<?php

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
        // $this->call(UsersTableSeeder::class);
        factory(App\Contact::class, 20)->create();
        $this->call(LabelsTableSeeder::class);
        factory(App\Phone::class, 30)->create();
    }
}
