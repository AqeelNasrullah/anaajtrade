<?php

use App\FillingStation;
use App\OilCompany;
use App\OilRecord;
use App\Profile;
use App\User;
use App\WheatRecord;
use App\WheatStock;
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
        // $this->call(UserSeeder::class);
        // factory(Profile::class, 50)->create();
        // factory(User::class, 20)->create();
        // $users = User::all();
        // Profile::all()->each(function($profile) use ($users) {
        //     $profile->manyUsers()->attach(
        //         $users->random(rand(1, $users->count()))->pluck('id')->toArray()
        //     );
        // });
        // factory(OilCompany::class, 10)->create();
        // factory(FillingStation::class, 40)->create();
        // FillingStation::all()->each(function($station) use ($users) {
        //     $station->manyUsers()->attach(
        //         $users->random(rand(1, $users->count()))->pluck('id')->toArray()
        //     );
        // });
        // factory(OilRecord::class, 250)->create();
        // factory(WheatStock::class, 100)->create();
        factory(WheatRecord::class, 300)->create();
    }
}
