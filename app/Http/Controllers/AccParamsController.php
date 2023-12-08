<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\account_params;
use Illuminate\Support\Carbon;

class AccParamsController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = account_params::orderBy('created_at', 'desc')->paginate(5);
        return view('account_parameter.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account_parameter.create');
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
            'account_no' => 'required',
            'institution' => 'required',
            'remarks' => 'nullable',
        ]);

        account_params::create($request->post());

        return redirect()->route('accountparams.index')->with('success', 'Your data has been successfully save');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(account_params $company)
    {
        return view('account_parameter.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(account_params $company)
    {
        return view('account_parameter.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, account_params $company)
    {
        $request->validate([
            'account_no' => 'nullable',
            'institution' => 'nullable',
            'remarks' => 'nullable',
        ]);

        $company->fill($request->post())->save();

        return redirect()->route('accountparams.index')->with('success', 'Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(account_params $company)
    {
        $company->delete();
        return redirect()->route('accountparams.index')->with('success', 'Deleted');
    }

    // public function search()
    // {
    //     $search_text = $_GET['query'];
    //     $companies = account_params::where('account_no', 'LIKE', '%'.$search_text.'%')->get();
        
    //       return view('account_parameter.search', compact('companies'));
    // }

}
