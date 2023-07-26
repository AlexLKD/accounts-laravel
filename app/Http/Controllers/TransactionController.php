<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // var_dump(Transaction::find(37)->categorie);
        // exit;
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
            'categories' => Categorie::all(),
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
        $request->validate([
            'name' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);
        $transaction = new Transaction;
        $transaction->name = $request->name;
        $transaction->amount = $request->amount;
        $transaction->date_transaction = $request->date_transaction;

        $categories = Categorie::find($request->input('category'));
        $categories->transactions()->save($transaction);

        $transaction->save();

        return Redirect::route('form')->with('success', 'Transaction ajoutée');
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
        // $transaction = Transaction::find($id);
        $data = [
            'title' => 'Modifier une opération',
            'transaction' => Transaction::find($id),
            'categories' => Categorie::all(),
        ];
        return view('form', $data);
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
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->route('index')->with('error', 'Transaction not found.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date_transaction' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        $transaction->name = $validatedData['name'];
        $transaction->date_transaction = $validatedData['date_transaction'];
        $transaction->amount = $validatedData['amount'];

        $categories = Categorie::find($request->input('category'));
        $categories->transactions()->save($transaction);

        $transaction->save();

        return redirect()->route('index')->with('success', 'Transaction mise à jour');
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
            return redirect()->route('index')->with('error', 'Erreur lors de la suppression.');
        }

        $transaction->delete();

        return redirect()->route('index')->with('success', 'La transaction a bien été supprimée.');
    }

    /**
     * Show history of validated transactions
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $data = [
            'title' => '',
            'transactions' => Transaction::where('done', true)->get(),
        ];
        return view('accounts', $data);
    }
}
