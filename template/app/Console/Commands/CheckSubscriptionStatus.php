<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;

class CheckSubscriptionStatus extends Command
{
    protected $signature = 'subscription:check';
    protected $description = 'Check and update user subscriptions';

    public function handle()
    {
        $now = Carbon::now();

        $subscriptions = Subscription::where('status', 'active')->where('date_limit', '<', $now)->get();

        foreach ($subscriptions as $subscription) {
            $user = User::find($subscription->user_id);
            if ($user) {
                $user->update(['free_limit' => 15]);
                $subscription->update(['status' => 'expired']);
            }
        }

        $this->info('Subscription check completed.');
    }
}
