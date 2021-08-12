<?php

namespace App\Http\Controllers;

use App\Event;
use App\Question;
use App\Royalty;
use App\User;
use App\Winner;
use Illuminate\Http\Request;

class ApiEventController extends Controller
{
    public function index()
    {
        $events = Event::get();
        return response([
            'events' => $events,
            'result' => 200,
        ], 200);
    }

    public function show($id)
    {
        $event = Event::find($id);
        $game = $event->game;

        //data
        $questions = null;
        $puzzle = null;
        $numberOfTry = 0;

        // if quiz game
        if ($event->type == 'Quiz Game') {
            $questions = $game->questions()->inRandomOrder()->get();
            foreach ($questions as $question) {
                $question->array_answer = $question->array_answer;
            }
        } else if ($event->type == 'Puzzle Game') {
            $puzzle = $event->game->art;
        } else if ($event->type == 'Slots Machine') {
            $numberOfTry = $game->slot->number_of_tries;
        }

        return response([
            'event' => $event,
            'game' => $game,
            'questions' => $questions,
            'puzzle' => $puzzle,
            'number_of_tries' => $numberOfTry - User::find(auth()->user()->id)->spins()->where('game_id', $game->id)->count(),
            'spinable' => $this->getSpinnable($event->id),
            'result' => 200,
        ], 200);
    }

    public function checkAnswer()
    {
        $data = request()->validate([
            'event_id' => 'required',
            'ids' => 'required',
            'score' => 'required',
        ]);
        $event = Event::find(request()->event_id);
        $user = User::find(auth()->user()->id);

        $ids = explode(',', $data['ids']);
        $perfect = false; //fix me up
        $prizes = [];

        $royalty = Royalty::where('user_id', auth()->user()->id)->first();
        for ($i = 0; $i < $data['score']; $i++) {
            $q = Question::find($ids[$i]);
            if ($q->prize == 'Hall passes') {
                $newval = (int) $royalty->hall_pass + (int) $q->qty;
                $royalty->update(['hall_pass' => $newval]);
                array_push($prizes, $q->qty . " hall pass(es)");
            } else if ($q->prize == 'White Crystal') {
                $newval = (int) $royalty->white_crystal + (int) $q->qty;
                $royalty->update(['white_crystal' => $newval]);
                array_push($prizes, $q->qty . " white crystal(s)");
            } else {
                //if art scene
            }
        }

        if ($data['score'] == count($ids)) {
            Winner::create([
                'event_id' => $data['event_id'],
                'user_id' => auth()->user()->id,
                'prize' => 'Jackpot',
            ]);
            $perfect = true;
        }

        $user->logs()->create([
            'content' => 'I just won ' . implode(', ', $prizes) . ' from ' . $event->name . ' by ' . $event->hosted_by . '. I’ll keep pushing for more!',
        ]);

        return response([
            'new_balance' => User::find(auth()->user()->id)->royalties,
            'result' => 200,
            'perfect' => $perfect,
            'prizes' => $prizes,
        ], 200);

    }

    public function deductCost()
    {
        $data = request()->validate([
            'event_id' => 'required',
        ]);
        $event = Event::find($data['event_id']);
        $status = false;
        $cbal = Royalty::where('user_id', auth()->user()->id)->first();

        $user = User::find(auth()->user()->id);
        $user->homework->update([
            'participate_author_event' => $user->homework->participate_author_event + 1,
        ]);

        if ($event->gem == 'purple') {
            if ((int) $event->cost <= (int) $cbal->purple_crystal) {
                $newbal = (int) $cbal->purple_crystal - (int) $event->cost;
                $cbal->update(['purple_crystal' => $newbal]);
                $status = true;
            }
        } else {
            if ((int) $event->cost <= (int) $cbal->white_crystal) {
                $newbal = (int) $cbal->white_crystal - (int) $event->cost;
                $cbal->update(['white_crystal' => $newbal]);
                $status = true;
            }
        }

        return response([
            'status' => $status,
            'new_balance' => $cbal,
            'result' => 200,
        ], 200);
    }

    public function deductCostNow($id, $bet, $uid)
    {
        $event = Event::find($id);
        $cbal = Royalty::where('user_id', $uid)->first();
        $user = User::find($uid);

        $user->homework->update([
            'participate_author_event' => $user->homework->participate_author_event + 1,
        ]);

        if ($event->gem == 'purple') {
            if ((int) $event->cost <= (int) $cbal->purple_crystal) {
                $newbal = (int) $cbal->purple_crystal - ((int) $event->cost * (int) $bet);
                $cbal->update(['purple_crystal' => $newbal]);
            }
        } else {
            if ((int) $event->cost <= (int) $cbal->white_crystal) {
                $newbal = (int) $cbal->white_crystal - ((int) $event->cost * (int) $bet);
                $cbal->update(['white_crystal' => $newbal]);
            }
        }
    }

    public function bet()
    {

        $data = request()->validate([
            'event_id' => 'required',
            'bet' => 'required',
            'level_prize' => 'required',
        ]);

        $user = User::find(auth()->user()->id);

        $event = Event::find($data['event_id']);
        $game = $event->game;
        $royalty = $user->royalties;

        //deduct now
        $this->deductCostNow($data['event_id'], $data['bet'], auth()->user()->id);

        //deduct spins
        $user->spins()->create([
            'game_id' => $game->id,
        ]);

        if ($data['level_prize'] == "1" || $data['level_prize'] == 1) {
            $p = (int) $data['bet'] * 3;
            $cbal = (int) $royalty->purple_crystal;
            $royalty->update(['purple_crystal' => $cbal + $p]);
        } else if ($data['level_prize'] == "2" || $data['level_prize'] == 2) {
            $p = (int) $data['bet'] * 2; // hall passes
            $q = (int) $data['bet'] * 1; //white gem
            $chall = (int) $royalty->hall_pass;
            $cwhite = (int) $royalty->white_crystal;
            $royalty->update(['white_crystal' => $cwhite + $q, 'hall_pass' => $chall + $p]);
        } else if ($data['level_prize'] == "3" || $data['level_prize'] == 3) {
            $q = (int) $data['bet'] * 1; //white gem
            $cwhite = (int) $royalty->white_crystal;
            $royalty->update(['white_crystal' => $cwhite + $q]);
        } else if ($data['level_prize'] == "4" || $data['level_prize'] == 4) {
            $p = (int) $data['bet'] * 2; // hall passess
            $chall = (int) $royalty->hall_pass;
            $royalty->update(['hall_pass' => $chall + $p]);
        }

        $game->counter = $game->counter + 1;
        //deduct spin
        $game->save();

        return response([
            'new_balance' => User::find(auth()->user()->id)->royalties,
            'amount' => 0,
            'result' => 200,
            'number_of_tries' => $game->slot->number_of_tries - User::find(auth()->user()->id)->spins()->where('game_id', $game->id)->count(),
        ], 200);
    }

    public function getSpinnable($id)
    {

        $event = Event::find($id);
        $game = $event->game;
        $user = User::find(auth()->user()->id);
        $cbal = Royalty::where('user_id', $user->id)->first();

        $user->spins()->create([
            'game_id' => $game->id,
        ]);

        $newp = 0;
        $neww = 0;
        $newh = 0;

        if ($user->spins()->where('game_id', $game->id)->count() >= 3000) {
            $newp = (int) $cbal->purple_crystal - 3;
        } else if ($user->spins()->where('game_id', $game->id)->count() >= 900) {
            $newp = (int) $cbal->purple_crystal - 2;
        } else if ($user->spins()->where('game_id', $game->id)->count() >= 450) {
            $newp = (int) $cbal->purple_crystal - 1;
        }

        if ($user->spins()->where('game_id', $game->id)->count() >= 270) {
            $neww = (int) $cbal->white_crystal - 3;
        } else if ($user->spins()->where('game_id', $game->id)->count() >= 180) {
            $neww = (int) $cbal->white_crystal - 2;
        } else if ($user->spins()->where('game_id', $game->id)->count() >= 120) {
            $neww = (int) $cbal->white_crystal - 1;
        }

        if ($user->spins()->where('game_id', $game->id)->count() >= 300) {
            $newh = (int) $cbal->hall_pass - 5;
        } else if ($user->spins()->where('game_id', $game->id)->count() >= 150) {
            $newh = (int) $cbal->hall_pass - 3;
        } else if ($user->spins()->where('game_id', $game->id)->count() >= 90) {
            $newh = (int) $cbal->hall_pass - 2;
        } else if (true) {
            $newh = (int) $cbal->hall_pass - 1;
        }

        if ($newh < 0 || $newp < 0 || $neww < 0) {
            return false;
        }
        $cbal->save();

        return true;

    }

    public function spin()
    {
        $data = request()->validate([
            'qty' => 'required',
            'prize' => 'required',
            'event_id' => 'required',
        ]);

        // //deduct now
        // $this->deductCostNow($data['event_id'], 1, auth()->user()->id);

        $event = Event::find($data['event_id']);
        $game = $event->game;
        $user = User::find(auth()->user()->id);

        $user->homework->update([
            'participate_author_event' => $user->homework->participate_author_event + 1,
        ]);

        $cbal = Royalty::where('user_id', $user->id)->first();

        $user->spins()->create([
            'game_id' => $game->id,
        ]);

        $flag = $this->getSpinnable($event->id);

        if ($data['prize'] == 'hall pass') {
            $newHall = (int) $cbal->hall_pass + (int) $data['qty'];
            $cbal->update(['hall_pass' => $newHall]);
        } else if ($data['prize'] == 'white crystal') {
            $newHall = (int) $cbal->white_crystal + (int) $data['qty'];
            $cbal->update(['white_crystal' => $newHall]);
        } else if ($data['prize'] == 'purple crystal') {
            $newHall = (int) $cbal->purple_crystal + (int) $data['qty'];
            $cbal->update(['purple_crystal' => $newHall]);
        }

        return response([
            'new_balance' => User::find(auth()->user()->id)->royalties,
            'amount' => 0,
            'current_spin' => User::find(auth()->user()->id)->spins()->where('game_id', $game->id)->count(),
            'spinable' => $flag,
            'result' => 200,
        ], 200);
    }

    public function solve()
    {
        $data = request()->validate([
            'sec' => 'required',
            'event_id' => 'required',
        ]);

        $event = Event::find($data['event_id']);
        $game = $event->game;
        $art = $game->art;
        $user = User::find(auth()->user()->id);

        $cbal = Royalty::where('user_id', auth()->user()->id)->first();

        // $this->deductCostNow($data['event_id'], 1, auth()->user()->id);

        $user->box->arts()->attach($art->id);
        $qty = 0;
        $prize = "";

        if ($data['sec'] <= 45) {
            //must be dynamic
            $qty = 10;
            $prize = "purple_crystal";

            if ($prize == "hall_pass") {
                $cbal->update(['hall_pass' => $cbal->hall_pass + $qty]);
            } else if ($prize == "white_crystal") {
                $cbal->update(['white_crystal' => $cbal->white_crystal + $qty]);
            } else if ($prize == "purple_crystal") {
                $cbal->update(['purple_crystal' => $cbal->purple_crystal + $qty]);
            } else if ($prize == "silver_ticket") {
                $cbal->update(['silver_ticket' => $cbal->silver_ticket + $qty]);
            }

        } else if ($data['sec'] <= 90) {
            //must be dynamic
            $qty = 5;
            $prize = "purple_crystal";

            if ($prize == "hall_pass") {
                $cbal->update(['hall_pass' => $cbal->hall_pass + $qty]);
            } else if ($prize == "white_crystal") {
                $cbal->update(['white_crystal' => $cbal->white_crystal + $qty]);
            } else if ($prize == "purple_crystal") {
                $cbal->update(['purple_crystal' => $cbal->purple_crystal + $qty]);
            } else if ($prize == "silver_ticket") {
                $cbal->update(['silver_ticket' => $cbal->silver_ticket + $qty]);
            }

        } else if ($data['sec'] <= 120) {
            //must be dynamic
            $qty = 5;
            $prize = "hall_pass";

            if ($prize == "hall_pass") {
                $cbal->update(['hall_pass' => $cbal->hall_pass + $qty]);
            } else if ($prize == "white_crystal") {
                $cbal->update(['white_crystal' => $cbal->white_crystal + $qty]);
            } else if ($prize == "purple_crystal") {
                $cbal->update(['purple_crystal' => $cbal->purple_crystal + $qty]);
            } else if ($prize == "silver_ticket") {
                $cbal->update(['silver_ticket' => $cbal->silver_ticket + $qty]);
            }

        } else {
            //must be dynamic
            $qty = 1;
            $prize = "hall_pass";

            if ($prize == "hall_pass") {
                $cbal->update(['hall_pass' => $cbal->hall_pass + $qty]);
            } else if ($prize == "white_crystal") {
                $cbal->update(['white_crystal' => $cbal->white_crystal + $qty]);
            } else if ($prize == "purple_crystal") {
                $cbal->update(['purple_crystal' => $cbal->purple_crystal + $qty]);
            } else if ($prize == "silver_ticket") {
                $cbal->update(['silver_ticket' => $cbal->silver_ticket + $qty]);
            }

        }
        $str_prices = explode('_', $prize);
        $user->logs()->create([
            'content' => 'I just won ' . $qty . ' ' . implode(' ', $str_prices) . ' from ' . $event->name . ' by ' . $event->hosted_by . '. I’ll keep pushing for more!',
        ]);

        return response([
            'new_balance' => User::find(auth()->user()->id)->royalties,
            'result' => 200,
            'qty' => $qty,
            'prize' => $prize,
        ], 200);

    }

}
