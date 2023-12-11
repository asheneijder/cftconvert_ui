<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Parametrization extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(5);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name=$request->file("cft002");
        $email=$request->file("cft003");
        $address=$request->file("cft006");

        $destinationPath = "uploads";

        $request->validate([
            'cft002' => 'required',
            'cft003' => 'required',
            'cft006' => 'required',
        ]);

        $store_request = array();
        if ($name->storeAs($destinationPath, $name->getClientOriginalName())) {
            $full_path1 = 'uploads/' . "CFT002.dat";
            $content_name = Storage::get($full_path1);
            $store_request['name'] = $content_name;
        }
        if ($email->storeAs($destinationPath, $email->getClientOriginalName())) {
            $full_path2 = 'uploads/' . "CFT003.dat";
            $content_email = Storage::get($full_path2);
            $store_request['email'] = $content_email;
        }
        if ($address->storeAs($destinationPath, $address->getClientOriginalName())) {
            $full_path3 = 'uploads/' . "CFT006.dat";
            $content_address = Storage::get($full_path3);
            $store_request['address'] = $content_address;
        }

        $store_request = collect($store_request);
        Company::create($store_request->all());
        TempCompany::create($store_request->all());
        $result_save = app('App\Http\Controllers\SaveController')->save();
        return redirect()->route('companies.index')->with('success', 'Your data has been successfully save. Please wait for the email');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'address' => 'nullable',
        ]);

        $company->fill($request->post())->save();

        $get_id = $company->id;
        $this->f_cft002($get_id);
        $this->send_mail();

        return redirect()->route('companies.index')->with('success', 'Please check your email for the processed CFT files');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'CFT data has been deleted successfully');
    }

}
