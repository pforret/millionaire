<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __invoke(Request $request){
        return view('currency.show', );

    }
}
