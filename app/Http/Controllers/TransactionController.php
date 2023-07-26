<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Opérations de Juillet 2023 - Mes comptes',
            'transactions' => Transaction::where('date_transaction', 'like', '2023-07-%')
                ->orderBy('date_transaction', 'desc')
                ->get(),
            'total' => Transaction::sum('amount'),
        ];
        return view('accounts', $data);
    }

    /**
     * Show the form for creating a new Transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Ajouter une opération',
        ];
        return view('form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);
        $transaction = new Transaction;
        $transaction->name = $request->name;
        $transaction->amount = $request->amount;
        $transaction->date_transaction = $request->date_transaction;
        $transaction->save();
        return redirect('form')->with('status', 'Transaction ajoutée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->route('index')->with('error', 'Transaction not found.');
        }

        $transaction->delete();

        return redirect()->route('index')->with('success', 'Transaction deleted successfully.');
    }
}
