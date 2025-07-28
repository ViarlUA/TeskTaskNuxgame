<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $token
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $expires_at
 * @property \Illuminate\Support\Carbon|null $deactivated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken whereDeactivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccessToken whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAccessToken {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property bool $is_win
 * @property int $score
 * @property string $winnings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory whereIsWin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameHistory whereWinnings($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperGameHistory {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $username
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccessToken> $accessTokens
 * @property-read int|null $access_tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GameHistory> $gameHistories
 * @property-read int|null $game_histories_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

