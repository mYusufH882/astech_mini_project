<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaction = new Transaction();
        if ($request->ajax()) {
            $trans = $transaction->with(['typeItem', 'categoryItem'])->orderBy('created_at', 'DESC')->get();

            $data = [
                'trans' => $trans,
                'countIncome' => $transaction->getTransactions(1, 'total'),
                'countExpense' => $transaction->getTransactions(2, 'total'),
                'chartIn' => $transaction->getTransactions(1, 'chart'),
                'chartEx' => $transaction->getTransactions(2, 'chart'),
            ];

            return response()->json($data);
        }

        $types = Type::get();

        return view('welcome', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'id_type' => $request->type_id,
            'id_category' => $request->category_id,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date
        ];

        Transaction::create($data);
        Alert::success('success', 'Transaction was successfully created.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactions = Transaction::find($id);
        $transactions->delete();

        if ($transactions) {
            Alert::success('success', 'Item deleted successfully');
        }
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
