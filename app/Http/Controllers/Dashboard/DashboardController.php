<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function list_operations()
    {
        $operations = Operation::with('type')
                                ->with('numeraries')
                                ->whereDate('operation_date',Carbon::today())
                                ->select('id','amount','typeoperation_id','operation_date')
  //                              \DB::raw('SUM(amount) as total'))
//                                ->groupBy('operation_date','id')
                                ->orderBy('id','asc')
                                ->get();

        $response = [
            'data' => $operations,
        ];
        return response()->json($response, 200);                    
    }

    public function periode_operations(Request $request, $periode)
    {
        $operations = Operation::with('type')
                                ->with('numeraries')
                                ->whereDate('operation_date',Carbon::parse($periode))
                                ->select('id','amount','typeoperation_id','operation_date')
                                ->orderBy('id','asc')
                                ->get();
        $response = [
            'data' => $operations,
        ];
        return response()->json($response, 200);                    
    }


}
