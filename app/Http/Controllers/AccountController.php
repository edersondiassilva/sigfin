<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Account;
use Request;
use App\Http\Requests\AccountsRequest;

class AccountController extends Controller
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
        $accounts = Account::where('user_id', Auth::id())
            ->get();
        
        return view('account.index')->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountsRequest $request)
    {
        $account = $request->all();
        $account['user_id'] = Auth::id();
        $account = Account::create($account);
        
        session()->flash('message', 'Conta cadastrada com sucesso!');
        return redirect()->action('AccountController@edit', ['a'=>$account['id']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);
        
        if(empty($account)) {
            return "Conta não encontrada";
        }
        
        return view('account.edit')->with('a', $account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountsRequest $request)
    {
        $request = (Request::all());
        $account = Account::find($request['id']);
        
        $account->bank = $request['bank'];
        $account->agency = $request['agency'];
        $account->number = $request['number'];
        $account->city = $request['city'];
        $account->state = $request['state'];
        $account->save();
        
        session()->flash('message', 'Conta alterada com sucesso!');
        return redirect()->action('AccountController@edit', ['a'=>$account['id']]);
    }
}
