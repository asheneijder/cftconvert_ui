<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\account_params;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    //
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
            $this->f_cft002($get_id, $mode);
        }
        if ($email->storeAs($destinationPath, $email->getClientOriginalName())) {
            $full_path2 = 'uploads/' . "CFT003.dat";
            $content_email = Storage::get($full_path2);
            $store_request['email'] = $content_email;
            $this->f_cft002($get_id, $mode);
        }
        if ($address->storeAs($destinationPath, $address->getClientOriginalName())) {
            $full_path3 = 'uploads/' . "CFT006.dat";
            $content_address = Storage::get($full_path3);
            $store_request['address'] = $content_address;
            $this->f_cft002($get_id, $mode);
        }

        $store_request = collect($store_request);
        Company::create($store_request->all());

        return redirect()->route('companies.index')->with('success', 'Your data has been successfully save');
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

    /**
     * Below are the processed checkpoints
     */

    public function f_cft002($get_id, $mode)
    {
        $combinetodat_2 = "";
        $charcount_cft002 = 88;
        // $_getcft002 = Company::select('name')->get();
        $_getcft002 = Company::find($get_id)->get(['name']);
        foreach ($_getcft002 as $k => $v) {
            $_getcft002 = $v->name;
            /**Get String Length in Files**/
            $_getcft002 = rtrim($_getcft002);
            $_charcft002 = strlen($_getcft002) / $charcount_cft002;
            $x = 0;
            $a = 0;
            while ($x <= $_charcft002) {
                /**substring the data**/
                $unit_substring = substr($_getcft002, $a, $charcount_cft002);
                $account_substring = substr($unit_substring, 1, 9);
                /**Check with the pnb parameter account table**/
                if (account_params::where('account_no', $account_substring)->count() > 0) {
                    //   "PNB ACCOUNT ->" . $account_substring . "\n";
                    $combinetodat_2 .= $unit_substring;
                    // if ($_charcft002 == $_charcft002) {
                    //     $combinetodat_2 .= substr($_getcft002, -45);
                    // }
                } else {
                    // echo "NOT PNB ACCOUNT ->" . $account_substring . "\n";
                }
                /**add loop and position pointer**/
                $x++;
                $a = $a + $charcount_cft002;
            }
            $combinetodat_2 .= substr($_getcft002, -45);
        }
        /**Result**/
        $fileName = 'CFT002.dat';
        $fileStorePath = storage_path('app/cft/' . $fileName);
        File::put($fileStorePath, $combinetodat_2);
        $this->f_cft003($get_id);
    }
    public function f_cft003($get_id, $mode)
    {
        $combinetodat_3 = "";
        $charcount_cft003 = 88;
        // $_getcft003 = Company::select('email')->get();
        $_getcft003 = Company::find($get_id)->get(['email']);
        foreach ($_getcft003 as $k => $v) {
            $_getcft003 = $v->email;
            /**Get String Length in Files**/
            $_getcft003 = rtrim($_getcft003);
            $_charcft003 = strlen($_getcft003) / $charcount_cft003;
            $x = 0;
            $a = 0;
            while ($x <= $_charcft003) {
                /**substring the data**/
                $unit_substring = substr($_getcft003, $a, $charcount_cft003);
                $account_substring = substr($unit_substring, 1, 9);
                /**Check with the pnb parameter account table**/
                if (account_params::where('account_no', $account_substring)->count() > 0) {
                    // echo "PNB ACCOUNT ->" . $account_substring . "\n";
                    $combinetodat_3 .= $unit_substring;
                    // if ($_charcft003 == $_charcft003) {
                    //     $combinetodat_3 .= substr($_getcft003, -45);
                    // }
                } else {
                    // echo "NOT PNB ACCOUNT ->" . $account_substring . "\n";
                }
                /**add loop and position pointer**/
                $x++;
                $a = $a + $charcount_cft003;
            }
            $combinetodat_3 .= substr($_getcft003, -45);
        }

        /**Result**/
        $fileName = 'CFT003.dat';
        $fileStorePath = storage_path('app/cft/' . $fileName);
        File::put($fileStorePath, $combinetodat_3);
        $this->f_cft006($get_id);
    }
    public function f_cft006($get_id, $mode)
    {
        $combinetodat_6 = "";
        $charcount_cft006 = 70;
        // $_getcft006 = Company::select('address')->get();
        $_getcft006 = Company::find($get_id)->get(['address']);
        foreach ($_getcft006 as $k => $v) {
            $_getcft006 = $v->address;
            /**Get String Length in Files**/
            $_getcft006 = rtrim($_getcft006);
            $_charcft006 = strlen($_getcft006) / $charcount_cft006;
            $x = 0;
            $a = 0;
            while ($x <= $_charcft006) {
                /**substring the data**/
                $unit_substring = substr($_getcft006, $a, $charcount_cft006);
                $account_substring = substr($unit_substring, 16, 9);
                /**Check with the pnb parameter account table**/
                if (account_params::where('account_no', $account_substring)->count() > 0) {
                    // echo "PNB ACCOUNT ->" . $account_substring . "\n";
                    $combinetodat_6 .= $unit_substring;
                    // if ($_charcft006 == $_charcft006) {
                    //     $combinetodat_6 .= substr($_getcft006, -45);
                    // }
                } else {
                    // echo "NOT PNB ACCOUNT ->" . $account_substring . "\n";
                }
                /**add loop and position pointer**/
                $x++;
                $a = $a + $charcount_cft006;
            }
            $combinetodat_6 .= substr($_getcft006, -45);
        }

        /**Result**/
        // echo ($combinetodat_6);
        // $fileName = Carbon::now('Asia/Kuala_Lumpur')->isoFormat('DDMMYYYYHHmm') . '-CFT006.DAT';
        $fileName = 'CFT006.dat';
        $fileStorePath = storage_path('app/cft/' . $fileName);
        File::put($fileStorePath, $combinetodat_6);
    }
    public function send_mail()
    {
        // Email the attachment below:
        $data["email_to"] = ['ashraf_azmi@artrustees.com.my'];
        // $data["email_to"] = ['ramzulazmi@artrustees.com.my'];
        // $data["email_cc"] = [''];
        // $data["email_bcc"] = [''];
        $data["title"] = "CFT files has been converted - " . Carbon::now('Asia/Kuala_Lumpur')->isoFormat('DD/MM/YYYY - HH:mm');

        $files = [
            storage_path('app/cft/CFT002.dat'),
            storage_path('app/cft/CFT003.dat'),
            storage_path('app/cft/CFT006.dat'),
        ];

        Mail::send('emails.tes_general_mailbody', $data, function ($message) use ($data, $files) {
            $message->to($data["email_to"])
                // ->cc($data["email_cc"])
                // ->bcc($data["email_bcc"])
                ->subject($data["title"]);

            foreach ($files as $file) {
                $message->attach($file);
            }
        });

        echo ('--Mail succesfully sent!--');

        File::delete(storage_path('app/cft/CFT002.dat'));
        File::delete(storage_path('app/cft/CFT003.dat'));
        File::delete(storage_path('app/cft/CFT006.dat'));

        echo ('--Successfully delete--');
    }
}
