<?php

namespace App\Http\Controllers;

use App\Reward;
use App\Royalty;
use App\User;

class ApiHomeworkController extends Controller
{

    public function checkString($str, $check)
    {
        return \Str::contains($str, $check);
    }

    public function index()
    {
        $user = User::find(auth()->user()->id);
        $homework = $user->homework;

        $rewards = Reward::get();
        $result = collect();

        foreach ($rewards as $reward) {

            //default
            $reward->status = 'locked';
            $source = $reward->source;
            $arr = explode('_', $source);
            $end = end($arr);

            if ($this->checkString($source, 'complete_book')) {

                if (($end == 1 && $homework->complete_book >= 1) ||
                    ($end == 5 && $homework->complete_book >= 5) ||
                    ($end == 10 && $homework->complete_book >= 10) ||
                    ($end == 30 && $homework->complete_book >= 30)
                ) {
                    $reward->status = 'claimable';
                }

            } else if ($this->checkString($source, 'complete_heir') &&
                $homework->complete_heirs_series >= 1) {
                $reward->status = 'claimable';
            } else if ($this->checkString($source, 'share_to_social') &&
                $homework->share_to_social_media >= 1) {
                $reward->status = 'claimable';
            } else if ($this->checkString($source, 'buy_purple_gems')) {
                if (($end == 5 && $homework->bought_purple_gem >= 5) ||
                    ($end == 10 && $homework->bought_purple_gem >= 10) ||
                    ($end == 30 && $homework->bought_purple_gem >= 25)
                ) {
                    $reward->status = 'claimable';
                }
            } else if ($this->checkString($source, 'complete_spin_off')) {
                if (($end == 3 && $homework->complete_spin_off >= 3) ||
                    ($end == 5 && $homework->complete_spin_off >= 5) ||
                    ($end == 10 && $homework->complete_spin_off >= 10) ||
                    ($end == 20 && $homework->complete_spin_off >= 20)
                ) {
                    $reward->status = 'claimable';
                }
            } else if ($this->checkString($source, 'log_on')) {
                if (($end == 7 && $homework->log_on_days >= 7) ||
                    ($end == 14 && $homework->log_on_days >= 14) ||
                    ($end == 30 && $homework->log_on_days >= 30) ||
                    ($end == 60 && $homework->log_on_days >= 60)
                ) {
                    $reward->status = 'claimable';
                }
            } else if ($this->checkString($source, 'participate_author_event')) {
                if (($end == 1 && $homework->participate_author_event >= 1) ||
                    ($end == 2 && $homework->participate_author_event >= 2) ||
                    ($end == 3 && $homework->participate_author_event >= 3)
                ) {
                    $reward->status = 'claimable';
                }
            } else if ($this->checkString($source, 'participate_bru') &&
                $homework->participate_bru_event >= 1) {
                $reward->status = 'claimable';
            } else if ($this->checkString($source, 'rate_book') &&
                $homework->rate_book >= 1) {
                $reward->status = 'claimable';
            } else if ($this->checkString($source, 'review_book') &&
                $homework->review_book >= 1) {
                $reward->status = 'claimable';
            } else if ($this->checkString($source, 'verify') &&
                $homework->verify_account >= 1) {
                $reward->status = 'claimable';
            } else if ($this->checkString($source, 'invite_friend') &&
                $homework->invite_friend >= 1) {
                $reward->status = 'claimable';
            } else if ($this->checkString($source, 'upgrade_account') &&
                $homework->upgrade_account >= 1) {
                $reward->status = 'claimable';
            } else if ($this->checkString($source, 'provide_mobile_number') &&
                $homework->provide_mobile_number >= 1) {
                $reward->status = 'claimable';
            }

            //check if the user claimed the reward
            if ($user->rewards()->find($reward->id)) {
                $reward->status = 'claimed';
            }

            $result->push($reward);

        }

        return response([
            'rewards' => $result,
            'result' => 200,
        ], 200);

    }

    public function claimReward()
    {
        $data = request()->validate([
            'reward_id' => 'required',
        ]);

        $user = User::find(auth()->user()->id);

        if ($user->rewards()->where('id', $data['reward_id'])->count()) {
            return response([
                'is_claimed' => true,
                'new_balance' => $user->royalties,
                'result' => 200,
            ], 200);
        }

        $royalty = Royalty::where('user_id', $user->id)->first();

        $reward = Reward::find($data['reward_id']);
        $prize = $reward->prize;
        $qty = $reward->qty;
        $qty = $user->vip ? $qty * 2 : $qty;

        //add to royalties
        if ($prize == 'hall_pass') {
            $royalty->update(['hall_pass' => $royalty->hall_pass + $qty]);
        } else if ($prize == 'white_gem') {
            $royalty->update(['white_crystal' => $royalty->white_crystal + $qty]);
        } else if ($prize == 'spin_off') {
            $royalty->update(['spin_off' => $royalty->spin_off + $qty]);
        } else if ($prize == 'room_item') {
            $royalty->update(['free_item' => $royalty->free_item + $qty]);
        } else if ($prize == 'art_scene') {
            $royalty->update(['free_art_scene' => $royalty->free_art_scene + $qty]);
        }

        $user->rewards()->attach($data['reward_id']);

        return response([
            'new_balance' => $user->royalties,
            'result' => 200,
            'is_claimed' => false,
            'qty' => $qty,
            'prize' => $prize,
        ], 200);
    }
}
