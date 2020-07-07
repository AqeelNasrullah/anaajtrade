<?php

namespace App\Http\Controllers;

use App\AccountBook;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountBookController extends Controller
{
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
        $dates = Auth::user()->accountBooks()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $account_books = Auth::user()->accountBooks()->latest()->get();
        return view('dashboard.roznamcha.account-book.index', ['dates' => $dates ,'account_books' => $account_books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $profile = Profile::find($s_id);
            return view('dashboard.roznamcha.account-book.create', ['profile' => $profile]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if ($id) {
            $rules = [
                'amount'            =>      'required|numeric',
                'amount_type'       =>      'required'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $added = Auth::user()->accountBooks()->create([
                    'amount'                    =>      $request->get('amount'),
                    'type'               =>      $request->get('amount_type'),
                    'profile_id'                =>      $s_id
                ]);

                if ($added) {
                    return redirect()->route('accountBook.index')->with('success', 'Account Book added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding account book.');
                }

            }


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccountBook  $accountBook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $record = AccountBook::find($s_id);
            return view('dashboard.roznamcha.account-book.show', ['record' => $record]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccountBook  $accountBook
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
     * @param  \App\AccountBook  $accountBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountBook $accountBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountBook  $accountBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountBook $accountBook)
    {
        //
    }
}
