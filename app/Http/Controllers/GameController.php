<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameHistoryResource;
use App\Service\Game\GameService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GameController extends Controller
{
    public function __construct(
        private readonly GameService $gameService
    )
    {
    }
    
    /**
     * @throws \Random\RandomException
     */
    public function play(Request $request): GameHistoryResource
    {
        return GameHistoryResource::make(
            $this->gameService->play($request->user())
        );
    }
    
    public function index(Request $request): AnonymousResourceCollection
    {
        return GameHistoryResource::collection(
            $this->gameService->getHistory($request->user())
        );
    }
}
