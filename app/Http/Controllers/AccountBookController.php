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
        $this->middleware('userStatus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d', time());
        $loan = Auth::user()->accountBooks()->selectRaw('sum(amount) as amount')->where('type', 'Loan')->where('created_at', '>', $date)->first();
        $returned = Auth::user()->accountBooks()->selectRaw('sum(amount) as amount')->where('type', 'Returned')->where('created_at', '>', $date)->first();

        $dates = Auth::user()->accountBooks()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $account_books = Auth::user()->accountBooks()->latest()->get();
        return view('dashboard.roznamcha.account-book.index', [
            'dates' => $dates ,'account_books' => $account_books, 'loan' => $loan, 'returned' => $returned
        ]);
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
                    'type'                      =>      $request->get('amount_type'),
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
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $record = AccountBook::find($s_id);
            return view('dashboard.roznamcha.account-book.edit', ['record' => $record]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountBook  $accountBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'amount'            =>      'required|numeric|min:0',
                'type'              =>      'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $updated = AccountBook::find($s_id)->update([
                    'amount'            =>      $request->get('amount'),
                    'type'              =>      $request->get('type')
                ]);
                if ($updated) {
                    return redirect()->route('accountBook.show', $id)->with('success', 'Account book updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating account book.');
                }

            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountBook  $accountBook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $deleted = AccountBook::destroy($s_id);
            if ($deleted) {
                return redirect()->route('accountBook.index')->with('success', 'Account book deleted successfully.');
            } else {
                return redirect()->route('accountBook.show', $id)->with('error', 'An error occured while deleting account book.');
            }
        }
    }
}
