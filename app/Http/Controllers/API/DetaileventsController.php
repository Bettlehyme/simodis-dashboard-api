<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Detailevent;
use App\Http\Resources\DetaileventsResouce;
use Illuminate\Http\Request;

class DetaileventsController extends Controller
{
    public function index()
    {
        $data = Detailevent::latest()->get();
        return response()->json([DetaileventsResouce::collection($data), 'Program Fetch']);
    }
}
