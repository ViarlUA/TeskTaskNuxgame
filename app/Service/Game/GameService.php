<?php

namespace App\Service\Game;

use App\Models\GameHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GameService
{
    /**
     * @throws \Random\RandomException
     */
    public function play(User $user): GameHistory
    {
        $game = new GameHistory();
        
        $game->user_id = $user->id;
        
        $score       = random_int(1, 1000);
        $game->score = $score;
        
        if ($score % 2 === 0) {
            $game->is_win   = true;
            $game->winnings = $this->calcWinnings($score);
        } else {
            $game->is_win = false;
        }
        
        $game->save();
        
        return $game;
    }
    
    private function calcWinnings(int $score): float
    {
        return round(
            match (true) {
                $score > 900 => $score * 0.7,
                $score > 600 => $score * 0.5,
                $score > 300 => $score * 0.3,
                default      => $score * 0.1
            },
            2
        );
    }
    
    public function getHistory(User $user): Collection
    {
        return $user->gameHistories()
            ->latest()
            ->limit(3)
            ->get();
    }
}