<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackOfficeController extends Controller
{
    //
    public function entities() {
        return view('backoffice.entities');
    }
    public function accounting() {
        return view('backoffice.accounting');
    }
    public function mpesa() {
        return view('backoffice.mpesa');
    }
    public function financialReports() {
        return view('backoffice.freports');
    }
    public function otherReports() {
        return view('backoffice.oreports');
    }
}
