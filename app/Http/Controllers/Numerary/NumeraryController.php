<?php

namespace App\Http\Controllers\Numerary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Numerary;

class NumeraryController extends Controller
{
    public function add_numeraries($operation, $hv_note, $hc_note, $hv_coin, $hc_coin, $hv_cent, $hc_cent)
    {        
        if(!is_null($hv_note))
        {
            for ($i = 0; $i < count($hv_note); $i++) 
            {
                if($hv_note[$i]!=null)
                {
                    $numerary = Numerary::where('value',$hv_note[$i])
                                            ->where('type','banknote')
                                            ->first();                        
                    if(!$numerary)
                    {
                        $response = [
                            'success' => 'false',
                            'errors' => $errors = [
                                'errors' =>__('Type de monnaie n\'exsite pas!'),
                            ],
                        ];
                        return response()->json($response, 400);                                                            
                    }
                    $operation->numeraries()->attach([$numerary->id =>  
                    [
                        'qte' => $hc_note[$i]
                    ]]);                            
                                            
                }
            }
        }
        if(!is_null($hv_coin))
        {
            for ($i = 0; $i < count($hv_coin); $i++) 
            {
                if($hv_coin[$i]!=null)
                {
                    $numerary = Numerary::where('value',$hv_coin[$i])
                                            ->where('type','coin')
                                            ->first();                        
                    if(!$numerary)
                    {
                        $response = [
                            'success' => 'false',
                            'errors' => $errors = [
                                'errors' =>__('Type pièce n\'exsite pas!'),
                            ],
                        ];
                        return response()->json($response, 400);                                                            
                    }
                    $operation->numeraries()->attach([$numerary->id =>  
                    [
                        'qte' => $hc_coin[$i]
                    ]]);                            
                }
            }
        }
        if(!is_null($hv_cent))
        {
            for ($i = 0; $i < count($hv_cent); $i++) 
            {
                if($hv_cent[$i]!=null)
                {
                    $numerary = Numerary::where('value',$hv_cent[$i])
                                            ->where('type','cent')
                                            ->first();                        
                    if(!$numerary)
                    {
                        $response = [
                            'success' => 'false',
                            'errors' => $errors = [
                                'errors' =>__('Type centime n\'exsite pas!'),
                            ],
                        ];
                        return response()->json($response, 400);                                                            
                    }
                    $operation->numeraries()->attach([$numerary->id =>  
                    [
                        'qte' => $hc_cent[$i]
                    ]]);                            
                }
            }
        }    
        return $operation->id;
    }
    
}
