<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caisse;
use App\Models\TypeOperation;
use App\Models\Operation;
use App\Models\Numerary;
use DB;
use App\Http\Controllers\Numerary\NumeraryController;
use App\Http\Requests\OperationRequest;
use Carbon\Carbon;

class OperationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $typeopeartions = TypeOperation::where('status','active')
                                        ->get();
        $numeraries = Numerary::all();
        $operation = [];

        return view('caisse.caisse',compact('typeopeartions','operation','numeraries'));
    }

    public function view(Request $request, $id)
    {
        if($request->ajax())
        { 
            $operation = Operation::with('numeraries')
                                ->with('type')
                                ->where('id',$id)
                                ->get();
            $response = [
                'operation' => $operation,
            ];
            return response()->json($response, 200);                    
        }else{
            return '<h3 class="page-title">Request incorect !</h3>';
        }    
    }

    public function save_operation($request, $operation)
    {
        $operation->operation_date = date("Y-m-d H:i:s", strtotime($request->date_operation.' '.substr(Carbon::now(),-8)));
        $operation->amount = $request->total_operation;
        $operation->comment = $request->comment;
        $operation->typeoperation_id = $request->type_opeartion;
        $operation->caisseday_id = $request->caisse;
        $operation->save();

        return $operation;
    }

    public function edit(OperationRequest $request)
    {
        try {
            DB::beginTransaction();

            $operation = Operation::findOrFail($request->operation);

            $this->save_operation($request, $operation);

            if($request->get('hv_note')!='' || $request->get('hv_coin')!='' || $request->get('hv_cent')!='') 
            {
                $hv_note = json_decode($request->get('hv_note'));
                $hc_note = json_decode($request->get('hc_note'));
                $hv_coin = json_decode($request->get('hv_coin'));
                $hc_coin = json_decode($request->get('hc_coin'));
                $hv_cent = json_decode($request->get('hv_cent'));
                $hc_cent = json_decode($request->get('hc_cent'));

                $operation->numeraries()->detach();  
                $numeraryController = new NumeraryController();
                $operation= $numeraryController->add_numeraries($operation, $hv_note, $hc_note, $hv_coin, $hc_coin, $hv_cent, $hc_cent);
            }

            DB::commit();
            $response = [
                'caisse' => $request->caisse,
                'message' => __('Opération validée!')
            ];                        
            return response()->json($response, 200);

        }
            catch(\Exception $e){
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);            
        }

    }

    public function store(OperationRequest $request)
    {
        try {
            DB::beginTransaction();

            $operation = new Operation();
            $this->save_operation($request, $operation);

            if($request->get('hv_note')!='' || $request->get('hv_coin')!='' || $request->get('hv_cent')!='') 
            {
                $hv_note = json_decode($request->get('hv_note'));
                $hc_note = json_decode($request->get('hc_note'));
                $hv_coin = json_decode($request->get('hv_coin'));
                $hc_coin = json_decode($request->get('hc_coin'));
                $hv_cent = json_decode($request->get('hv_cent'));
                $hc_cent = json_decode($request->get('hc_cent'));

                $numeraryController = new NumeraryController();
                $operation= $numeraryController->add_numeraries($operation, $hv_note, $hc_note, $hv_coin, $hc_coin, $hv_cent, $hc_cent);
            }

            DB::commit();
            $response = [
                'caisse' => $request->caisse,
                'message' => __('Opération validée!')
            ];                        
            return response()->json($response, 200);

        }
            catch(\Exception $e){
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);            
        }
    }

    public function delete(Request $request, $id)
    {
        $operation = Operation::findOrFail($id);

        $operation->delete();
        $operation->numeraries()->detach();  

        $response = [
            'message' => __('Opération supprimée!')
        ];                        
        return response()->json($response, 200);
    }

}
