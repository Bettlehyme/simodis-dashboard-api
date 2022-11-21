<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Detailevent;
use App\Http\Resources\DetaileventsResouce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetaileventsController extends Controller
{
    public function index()
    {
        $data = Detailevent::all()->groupBy('ulp', true);
        return response()->json(['detailevents'=>$data, 200]);
    }
    public function dataHarian(){
        
        $data = Detailevent::whereMonth('tgl_padam','02')->get();

        return response()->json(['detailevents'=>$data, 200]);
    }
}
