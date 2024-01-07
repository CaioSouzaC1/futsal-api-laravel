<?php

namespace App\Observers;

use App\Models\Game;
use App\Models\Team;

class GameObserver
{

    private function calculateTeamPoints(Game $game, String $type)
    {

        $home_team = Team::find($game->home_team_id);
        $visitor_team = Team::find($game->visitor_team_id);

        if ($game->home_team_goals == $game->visitor_team_goals) {

            if ($type === "created") {
                $home_team->increment("points", 1);
                $visitor_team->increment("points", 1);
            }

            if ($type === "deleted") {
                $home_team->decrement("points", 1);
                $visitor_team->decrement("points", 1);
            }
        }

        if ($game->home_team_goals > $game->visitor_team_goals) {
            if ($type === "created") {
                $home_team->increment("points", 3);
            }

            if ($type === "deleted") {
                $home_team->decrement("points", 3);
            }
        }

        if ($game->visitor_team_goals > $game->home_team_goals) {
            if ($type === "created") {
                $visitor_team->increment("points", 3);
            }

            if ($type === "deleted") {
                $visitor_team->decrement("points", 3);
            }
        }

        if ($type === "created") {
            $home_team->increment("scored_goals", $game->home_team_goals);
            $home_team->increment("conceded_goals", $game->visitor_team_goals);

            $visitor_team->increment("scored_goals", $game->visitor_team_goals);
            $visitor_team->increment("conceded_goals", $game->home_team_goals);
        }

        if ($type === "deleted") {
            $home_team->decrement("scored_goals", $game->home_team_goals);
            $home_team->decrement("conceded_goals", $game->visitor_team_goals);

            $visitor_team->decrement("scored_goals", $game->visitor_team_goals);
            $visitor_team->decrement("conceded_goals", $game->home_team_goals);
        }
    }

    /**
     * Handle the Game "created" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function created(Game $game)
    {
        $this->calculateTeamPoints($game, "created");
    }

    /**
     * Handle the Game "updated" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function updated(Game $game)
    {
        $old_game = new Game($game->getOriginal());
        $this->calculateTeamPoints($old_game, "deleted");
        $this->calculateTeamPoints($game, "created");
    }

    /**
     * Handle the Game "deleted" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function deleted(Game $game)
    {
        $this->calculateTeamPoints($game, "deleted");
    }

    /**
     * Handle the Game "restored" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function restored(Game $game)
    {
        //
    }

    /**
     * Handle the Game "force deleted" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function forceDeleted(Game $game)
    {
        //
    }
}
