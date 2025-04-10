<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MaintenanceBill;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'monthly'); // default to monthly
    
        switch ($type) {
            case 'yearly':
                $selectPeriod = DB::raw("DATE_FORMAT(created_at, '%Y') as period");
                break;
            case 'quarterly':
                $selectPeriod = DB::raw("CONCAT(YEAR(created_at), '-Q', QUARTER(created_at)) as period");
                break;
            default:
                $selectPeriod = DB::raw("DATE_FORMAT(created_at, '%Y-%m') as period");
        }
        
    
        // Maintenance Income
        $maintenanceIncome = MaintenanceBill::where('status', 'paid')
        ->select($selectPeriod, DB::raw('SUM(amount) as total'))
        ->groupBy('period')
        ->pluck('total', 'period');

        // Facility Booking Income
        $bookingIncome = Booking::where('payment_status', 'paid')
        ->select($selectPeriod, DB::raw('SUM(amount) as total'))
        ->groupBy('period')
        ->pluck('total', 'period');

    
        return view('reports.index', compact('type', 'maintenanceIncome', 'bookingIncome'));
    }
}
