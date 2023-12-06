<?php

namespace App\Http\Controllers\redirection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class divert extends Controller
{
    public function redirectordivert(Request $request){
        $url_in ='http://172.16.202.170:443/companies';

        return redirect()->away($url_in);

        // echo "<script>window.open('".$url_in."', '_blank')</script>";
        // echo '<script> window.setTimeout("window.close()", 1000); </script>';

    }
}
