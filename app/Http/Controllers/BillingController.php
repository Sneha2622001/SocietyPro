<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceBill;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $bills = Auth::user()->maintenanceBills()->latest()->get();
        return view('bills.index', compact('bills'));
    }

}