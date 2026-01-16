<?php

namespace App\Console\Commands;

use App\Jobs\SendPostNotifications;
use App\Models\Post;
use Illuminate\Console\Command;

class WebsitesNotifySubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websites:notify-subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all websites and send all new posts to subscribers which haven\'t been sent yet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Search all the unsent posts...');

        $unsentPosts = Post::where('sent', false)->with('website')->cursor();

        $processed = 0;
        foreach ($unsentPosts as $post) {
            SendPostNotifications::dispatch($post);
            $this->info("Queued notifications for: '{$post->title}' → {$post->website->name}");
            $processed++;
        }

        $this->newLine();
        if ($processed > 0) {
            $this->info("Success! Queued notifications for {$processed} new posts.");
        } else {
            $this->info("No new posts found. All websites up to date!");
        }

        return self::SUCCESS;
    }
}
