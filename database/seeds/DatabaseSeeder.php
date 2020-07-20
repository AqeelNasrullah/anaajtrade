<?php

use App\AccountBook;
use App\FertilizerRecord;
use App\FertilizerStock;
use App\FertilizerTrader;
use App\FillingStation;
use App\OilCompany;
use App\OilRecord;
use App\Other;
use App\Profile;
use App\RiceRecord;
use App\RiceStock;
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
        // factory(Profile::class, 100)->create();
        // factory(User::class, 20)->create();
        // $users = User::all();
        // Profile::all()->each(function($profile) use ($users) {
        //     $profile->manyUsers()->attach(
        //         $users->random()
        //     );
        // });
        // factory(OilCompany::class, 50)->create();
        // factory(FillingStation::class, 500)->create();
        // FillingStation::all()->each(function($station) use ($users) {
        //     $station->manyUsers()->attach(
        //         $users->random(rand(1, $users->count()))->pluck('id')->toArray()
        //     );
        // });
        // factory(OilRecord::class, 2500)->create();
        // factory(WheatStock::class, 1000)->create();
        // factory(WheatRecord::class, 3000)->create();
        // factory(RiceStock::class, 1000)->create();
        // factory(RiceRecord::class, 3000)->create();
        // factory(AccountBook::class, 5000)->create();
        // factory(Other::class, 5000)->create();
        // factory(FertilizerTrader::class, 500)->create();
        // FertilizerTrader::all()->each(function($trader) use ($users) {
        //     $trader->manyUsers()->attach(
        //         $users->random(rand(1, $users->count()))->pluck('id')->toArray()
        //     );
        // });
        // factory(FertilizerStock::class, 2000)->create();
        factory(FertilizerRecord::class, 2000)->create();
    }
}
