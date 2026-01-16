<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $websites = [
            [
                'name' => 'Laravel Daily',
                'slug' => 'laravel-daily',
                'email' => 'news@laraveldaily.com'
            ],
            [
                'name' => 'PHP Weekly',
                'slug' => 'php-weekly',
                'email' => 'tips@phpweekly.com'
            ],
            [
                'name' => 'DevOps Digest',
                'slug' => 'devops-digest',
                'email' => 'info@devopsdigest.com'
            ],
            [
                'name' => 'API Demo',
                'slug' => 'api-demo',
                'email' => 'hello@apidemo.com'
            ]
        ];

        foreach ($websites as $websiteData) {
            Website::firstOrCreate(
                ['slug' => $websiteData['slug']],
                $websiteData
            );
        }
    }
}
