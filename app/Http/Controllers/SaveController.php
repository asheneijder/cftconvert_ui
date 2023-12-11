<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempCompany;
use App\Models\account_params;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SaveController extends Controller
{
    public function save()
    {
        $this->f_cft002();
        $this->f_cft003();
        $this->f_cft006();
        $this->send_mail();
        TempCompany::truncate();
        return ("saved");
    }

    public function f_cft002()
    {
        $get_id = 1;
        $combinetodat_2 = "";
        $charcount_cft002 = 88;
        $_getcft002 = TempCompany::find($get_id)->get(['name']);
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
                    $combinetodat_2 .= $unit_substring;
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
    }
    public function f_cft003()
    {
        $get_id = 1;
        $combinetodat_3 = "";
        $charcount_cft003 = 88;
        $_getcft003 = TempCompany::find($get_id)->get(['email']);
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
                    $combinetodat_3 .= $unit_substring;
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
    }
    public function f_cft006()
    {
        $get_id = 1;
        $combinetodat_6 = "";
        $charcount_cft006 = 70;
        $_getcft006 = TempCompany::find($get_id)->get(['address']);
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
                    $combinetodat_6 .= $unit_substring;
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
        File::delete(storage_path('app/uploads/CFT002.dat'));
        File::delete(storage_path('app/uploads/CFT003.dat'));
        File::delete(storage_path('app/uploads/CFT006.dat'));

        echo ('--Successfully delete--');
    }
}
