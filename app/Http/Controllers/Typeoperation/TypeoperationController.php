<?php

namespace App\Http\Controllers\Typeoperation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeOperation;
use App\Http\Requests\TypeoperationRequest;

class TypeoperationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('typeoperation.typeoperation');
    }

    public function list_type_operations()
    {
        $typeoperations = TypeOperation::all();

        $response = [
            'data' => $typeoperations,
        ];

        return response()->json($response, 200);                    
    }

    public function save_type_operation($request, $typeoperation)
    {
        $typeoperation->title = $request->title;
        $typeoperation->action = $request->action;
        $typeoperation->save();

        return $typeoperation;
    }

    public function add(TypeoperationRequest $request)
    {
        try {    	
            $typeoperation = new Typeoperation();
            $this->save_type_operation($request, $typeoperation);

            $response = [
                'message' => __('Opération validée!')
            ];                        
            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $success = false;
            $message = $ex->getMessage();

        }
    }

    public function edit(TypeoperationRequest $request)
    {
        try {    	
            $typeoperation = Typeoperation::findOrFail($request->type_id);
            $this->save_type_operation($request, $typeoperation);

            $response = [
                'message' => __('Opération validée!')
            ];                        
            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $success = false;
            $message = $ex->getMessage();

        }
    }

    public function delete(Request $request, $id)
    {
        $typeoperation = TypeOperation::findOrFail($id);

        $typeoperation->delete();

        $response = [
            'message' => __('Type d\'Opération supprimée!')
        ];                        
        return response()->json($response, 200);
    }

}
