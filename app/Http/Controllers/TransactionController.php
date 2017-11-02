<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Account;
use Request;
use App\Http\Requests\TransactionsRequest;
use Carbon\Carbon;
use DateTime;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setToStringFormat('d/m/Y');
        
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('realization_date', 'desc')
            ->get();
        
        return view('transaction.index')->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = DB::table('accounts')->where('user_id', Auth::id())->pluck('number','id');
        $types = array('Entrada'=>'Entrada', 'Saída'=>'Saída');
        $status = array('Aprovada'=>'Aprovada', 'Cancelada'=>'Cancelada', 'Em análise'=>'Em análise', 'Em análise'=>'Em análise');
        $operations = array('Depósito'=>'Depósito', 'Saque'=>'Saque', 'Transferência'=>'Transferência', 'Outros'=>'Outros');
        
        return view('transaction.create', compact('accounts'))
            ->with('types', $types)->with('status', $status)->with('operations', $operations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionsRequest $request)
    {
        $transaction = $request->all();
        $transaction['user_id'] = Auth::id();
        $transaction['prevision_date'] = implode('-',array_reverse(explode('/', $transaction['prevision_date'])));
        $transaction['realization_date'] = implode('-',array_reverse(explode('/', $transaction['realization_date'])));
        $transaction = Transaction::create($transaction);
        
        session()->flash('message', 'Transação cadastrada com sucesso!');
        return redirect()->action('TransactionController@edit', ['t'=>$transaction['id']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accounts = Account::pluck('number','id');
        
        $types = array('Entrada'=>'Entrada', 'Saída'=>'Saída');
        $status = array('Aprovada'=>'Aprovada', 'Cancelada'=>'Cancelada', 'Em análise'=>'Em análise', 'Em análise'=>'Em análise');
        $operations = array('Depósito'=>'Depósito', 'Saque'=>'Saque', 'Transferência'=>'Transferência', 'Outros'=>'Outros');
        
        $transaction = Transaction::find($id);
        $prevision_date = $transaction->prevision_date->format('d/m/Y');
        $realization_date = $transaction->realization_date->format('d/m/Y');
        
        return view('transaction.edit', compact('accounts'))
            ->with('t', $transaction)
            ->with('prevision_date', $prevision_date)
            ->with('realization_date', $realization_date)
            ->with('types', $types)
            ->with('status', $status)
            ->with('operations', $operations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionsRequest $request)
    {
        $request = (Request::all());
        $transaction = Transaction::find($request['id']);
        
        $request['prevision_date'] = implode('-',array_reverse(explode('/', $request['prevision_date'])));
        $request['realization_date'] = implode('-',array_reverse(explode('/', $request['realization_date'])));
        
        $transaction->type = $request['type'];
        $transaction->status = $request['status'];
        $transaction->operation = $request['operation'];
        $transaction->value = $request['value'];
        $transaction->prevision_date = $request['prevision_date'];
        $transaction->realization_date = $request['realization_date'];
        $transaction->save();
        
        session()->flash('message', 'Transação alterada com sucesso!');
        return redirect()->action('TransactionController@edit', ['t'=>$transaction['id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formextract()
    {
        $accounts = DB::table('accounts')->where('user_id', Auth::id())->pluck('number','id');
        
        return view('transaction.formextract', compact('accounts'));
    }

    /**
     * Get the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getextract(Request $request)
    {
        $request = (Request::all());
        
        $request['initial_date'] = implode('-',array_reverse(explode('/', $request['initial_date'])));
        $request['final_date'] = implode('-',array_reverse(explode('/', $request['final_date'])));
        
        $request['initial_date'] = preg_replace('/[^0-9]/', '', $request['initial_date']);
        $request['final_date'] = preg_replace('/[^0-9]/', '', $request['final_date']);
        
        $filter = $request['initial_date'] . $request['final_date'] . $request['account_id'];

        return redirect()->action('TransactionController@showextract', ['filter'=>$filter]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showextract($filter)
    {
        Carbon::setToStringFormat('d/m/Y');
        
        $initial_date = substr($filter, 0, 8);
        $final_date = substr($filter, 8, 8);
        $account_id = substr($filter, 16);
        $initial_date = date('Y-m-d H:i:s', strtotime($initial_date));
        $final_date = date('Y-m-d H:i:s', strtotime($final_date));
        
        $transactions = Transaction::where('user_id', Auth::id())
            ->where('account_id', $account_id)
            ->where('realization_date', '>=', $initial_date)
            ->where('realization_date', '<=', $final_date)
            ->orderBy('realization_date', 'desc')
            ->get();
        
        return view('transaction.showextract')->with('transactions', $transactions);
    }
}
