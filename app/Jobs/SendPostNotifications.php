<?php

namespace App\Jobs;

use App\Mail\NewPostNotification;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendPostNotifications implements ShouldQueue
{
    use Queueable;

    public $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscribers = Subscription::where('website_id', $this->post->website_id)
            ->with('subscribers')
            ->pluck('subscriber_id')
            ->toArray();

        // Process in chunks
        Subscriber::whereIn('id', $subscribers)
            ->chunkById(100, function ($users) {
                foreach ($users as $subscriber) {
                    Mail::to($subscriber->email)->queue(new NewPostNotification($this->post));
                }
            });

        // $this->post->update(['sent' => true, 'sent_at' => now()]);
    }
}
