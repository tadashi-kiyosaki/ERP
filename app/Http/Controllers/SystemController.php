<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    //
    public function setup() {
        return view('system.setup');
    }
    public function otherActions() {
        return view('system.oactions');
    }
    public function communication() {
        return view('system.communication');
    }
    public function reports() {
        return view('system.reports');
    }
}
