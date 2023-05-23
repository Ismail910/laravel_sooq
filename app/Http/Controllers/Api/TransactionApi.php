<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Models\{Transaction, User};
class TransactionApi extends Controller
{
    use GeneralTrait;

    public function get_all_transactions()
    {
        $transactions = Transaction::all();
        return $this->returnData("transactions", $transactions, "All transactions");
    }

    public function get_user_transactions($user_id = 0)
    {
        if (!$user_id || !(User::where('id', $user_id)->count())) {
            return $this->returnError('404', 'User not found');
        }

        $user = User::findOrFail($user_id);
        $transactions = Transaction::where('wallet_id', $user->wallet_id)->get();
        return $this->returnData("transactions", $transactions, "All user transactions");
    }
}
