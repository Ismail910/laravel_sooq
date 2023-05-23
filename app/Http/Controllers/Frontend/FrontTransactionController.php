<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontTransactionController extends Controller
{
    public function __construct()
    {
        // Code
    }

    /**
     * Show the form to choose user to dispaly all his transactions
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $city = City::where('id', $user->city_id)->first();
            $country = Country::where('id', $city->country_id)->first();
            $currency = Currency::where('id', $country->currency_id)->first()?->name ?? '';
    
            $transactions = Transaction::where('wallet_id', $user->wallet_id)->orderBy('created_at', 'desc')->take(30)->get();
            $num_of_transactions = Transaction::where('wallet_id', $user->wallet_id)->count();
    
            return view('front.transactions.index', compact('user', 'transactions', 'num_of_transactions', 'currency'));
        } catch (\Exception $ex) {
            flash()->error('لا يمكن الذهاب لهذه الصفحة الا بعد تسجيل الدخول');
            return redirect()->route('home');
        }
    }

    /**
     * Get more transactions from database
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMoreTransactions(Request $request)
    {
        $user = Auth::user();
        $transactions = Transaction::where('wallet_id', $user->wallet_id)->where('id', '<', $request->last_id)->orderBy('created_at', 'desc')->take(10)->get();

        foreach ($transactions as &$transaction) {
            $transaction->date = Carbon::parse($transaction->created_at)->format("l, d M Y, H:i");
        }

        return response()->json([
            'transactions' => $transactions
        ]);
    }
}