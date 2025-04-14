<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceProvider extends Controller
{
    /**
     * Check the current active subscription of a given user.
     *
     * This function checks if the authenticated user has an active subscription.
     * If a subscription is found but has passed its `date_limit`, the subscription
     * status will be updated to 'expired' and the function will return false.
     * 
     * @param string $userId The UUID of the user whose subscription is being checked.
     * 
     * @return \App\Models\Subscription|false Returns the active Subscription model if valid, or false if no valid subscription exists.
     */
    public static function subscriptionCheck($userId)
    {
        if (!Auth::check()) return false;

        $subscription = Subscription::where('user_id', $userId)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')->first();

        if (!$subscription) return false;

        if (
            $subscription->status === 'active' && 
            Carbon::now()->gt($subscription->date_limit)
        ) {
            $subscription->update([
                'status' => 'expired'
            ]);
            return false;
        }

        return $subscription;
    }

    /**
     * Get leaderboard data for likes or downloads
     *
     * @param string $start Start date for the leaderboard
     * @param string $end End date for the leaderboard
     * @param string $type Type of leaderboard ('likes' or 'downloads')
     * 
     * @return array Formatted leaderboard data
     */
    public static function getLeaderboardData(string $start, string $end, string $type)
    {
        if (in_array($type, ['likes', 'downloads'])) {

            // CTE (Common Table Expression) "ranked_contents" untuk menandai rank_number dan total_uploads
            $cte = 
                "SELECT
                    c.id AS content_id,
                    c.id_user,
                    c.name AS content_name,
                    c.photo,
                    c.{$type},
                    ROW_NUMBER() OVER (PARTITION BY c.id_user ORDER BY c.{$type} DESC) AS rank_number,
                    COUNT(*) OVER (PARTITION BY c.id_user) AS total_uploads
                FROM contents c
                WHERE c.created_at BETWEEN '{$start}' AND '{$end}'";

            $subQuery = DB::table(DB::raw("({$cte}) as rc"))
                ->select(
                    'id_user',
                    DB::raw("SUM({$type}) AS total")
                )
                ->where('rc.rank_number', '<=', 3)
                ->where('rc.total_uploads', '>=', 3)
                ->groupBy('id_user');

            $leaderboardRaw = DB::table(DB::raw("({$cte}) as rc"))
                ->joinSub($subQuery, 'sum', function ($join) {
                    $join->on('rc.id_user', '=', 'sum.id_user');
                })
                ->join('users', 'rc.id_user', '=', 'users.id')
                ->leftjoin('subscriptions', 'rc.id_user', '=', 'subscriptions.user_id')
                ->select(
                    'users.id AS user_id',
                    'users.name AS username',
                    'users.email AS email',
                    'users.photo AS photo_profile',
                    'subscriptions.id',
                    'subscriptions.status',
                    'subscriptions.date_limit',
                    'sum.total',
                    "rc.{$type} AS subtotal",
                    'rc.rank_number',
                    'rc.content_id',
                    'rc.content_name',
                    'rc.photo',
                )
                ->where('rc.rank_number', '<=', 3)
                ->where('rc.total_uploads', '>=', 3)
                ->where('subscriptions.status', 'active')
                ->whereRaw('subscriptions.id IS NOT NULL')
                ->whereRaw('NOW() < subscriptions.date_limit')
                ->orderBy('sum.total', 'desc')
                ->limit(30)
                ->get();

            $formatedLeaderboard = $leaderboardRaw->groupBy('user_id')
                ->map(fn($rows) => [
                    'id' => $rows->first()->user_id,
                    'name' => $rows->first()->username,
                    'email' => $rows->first()->email,
                    'photo' => $rows->first()->photo_profile,
                    'total' => $rows->first()->total,
                    'top_contents' => $rows->map(fn($row) => [
                        'rank_number' => $row->rank_number,
                        'content_id' => $row->content_id,
                        'subtotal' => $row->subtotal,
                        'name' => $row->content_name,
                        'photo' => $row->photo,
                    ])->sortBy('rn')->values(),
                ])
                ->values()
                ->sortByDesc('total')
                ->take(10)
                ->all();

            return $formatedLeaderboard;
        }

        return [];
    }
    /**
     * Format a number into a shorter version using suffixes like k, M, B.
     *
     * Examples:
     * - 986       => "986"
     * - 1000      => "1k"
     * - 1234      => "1.2k"
     * - 15000     => "15k"
     * - 1050000   => "1.1M"
     *
     * @param int|float $number The number to format.
     * @return string The formatted number with appropriate suffix.
     */
    public static function formatShortNumber(int $number)
    {
        if ($number < 1000) {
            return $number;
        } elseif ($number < 1000000) {
            return number_format($number / 1000, ($number % 1000 > 99) ? 1 : 0) . 'k';
        } elseif ($number < 1000000000) {
            return number_format($number / 1000000, 1) . 'M';
        } else {
            return number_format($number / 1000000000, 1) . 'B';
        }
    }
}
