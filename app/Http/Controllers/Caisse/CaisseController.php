<?php

namespace App\Http\Controllers\Caisse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaisseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

}
