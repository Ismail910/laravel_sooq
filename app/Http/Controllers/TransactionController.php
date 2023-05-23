<?php

namespace App\Http\Controllers;

use App\Helpers\MainHelper;
use App\Http\Requests\TransactionsRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Transaction::class);
    }

    /**
     * Show the form to choose user to dispaly all his transactions
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Transaction::class);

        $users = User::where("power", "USER")->get();
        return view('admin.transactions.index', compact('users'));
    }

    /**
     * Show all user transactions
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function showUserTransactions(Request $request, $user_id = 0)
    {
        $this->authorize('viewAny', Transaction::class);

        if (!($request->user_id) || !(User::where('id', $request->user_id)->count())) {
            if (!isset($_GET['user_id']) || !(User::where('id', $_GET['user_id'])->count())) {
                flash()->success('المستخدم غير موجود', 'عملية فاشلة');
                return redirect()->back();
            }
        }

        $users = User::where("power", "USER")->get();
        $user = User::findOrFail($request->user_id ?? $_GET['user_id']);
        $transactions = Transaction::where('wallet_id', $user->wallet_id)->paginate(30);

        return view('admin.transactions.index', compact('users', 'user', 'transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Transaction::class);

        $users = User::where("power", "USER")->get();
        return view('admin.transactions.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\TransactionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionsRequest $request)
    {
        $this->authorize('create', Transaction::class);

        try {
            DB::beginTransaction();

            $transaction_id = uniqid();
            while (Transaction::where("transaction_id", $transaction_id)->count()) {
                $transaction_id = uniqid();
            }

            $user = User::find($request->user_id);
            Transaction::create([
                "transaction_id" => $transaction_id,
                "wallet_id" => $user->wallet_id,
                "amount" => $request->amount,
                "type" => "manual"
            ]);

            $city = City::where('id', $user->city_id)->first();
            $country = Country::where('id', $city->country_id)->first();
            $currency = Currency::where('id', $country->currency_id)->first()?->name ?? '';

            DB::commit();
            if ($request->amount > 0) {
                flash()->success('تم إضافة الرصيد بمجاح', 'عملية ناجحة');
                $message = 'تم إضافة' . abs($request->amount) . $currency . 'إلي رصيد حسابك';
            } else {
                flash()->success('تم خصم الرصيد بنجاح', 'عملية ناجحة');
                $message = 'تم خصم' . abs($request->amount) . $currency . 'من رصيد حسابك';
            }

            // Send user notification
            MainHelper::notify_user([
                'message' => $message,
                'user_id' => $user->id,
            ]);

            return redirect()->route('admin.transactions.create');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }
}
