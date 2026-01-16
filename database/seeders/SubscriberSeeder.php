<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\Website;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscribers = Subscriber::factory()->count(100)->create();

        $faker = Factory::create();

        foreach ($subscribers as $subscriber) {
            $websiteIds = Website::inRandomOrder()->limit(
                $faker->numberBetween(1, 4)
            )->pluck('id')->toArray();

            foreach ($websiteIds as $websiteId) {
                Subscription::firstOrCreate([
                    'subscriber_id' => $subscriber->id,
                    'website_id' => $websiteId
                ]);
            }
        }
    }
}
