<?php

namespace App\Http\Controllers;

use App\Models\Ulp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UlpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataulp = Ulp::all();

        return view('ulp.input', compact('dataulp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Ulp;

        $model->nama_ulp = $request->nama_ulp;
        $model->jumlah_ulp = $request->jumlah_ulp;
        $model->target1_ulp = $request->target1_ulp; //target untuk SAIDI
        $model->target2_ulp = $request->target2_ulp; //target untuk SAIFI
        $model->save();

        return redirect('/ulp')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ulp  $ulp
     * @return \Illuminate\Http\Response
     */
    public function show(Ulp $ulp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ulp  $ulp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataulp = Ulp::find($id);

        return view('ulp.edit', compact('dataulp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ulp  $ulp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataulp = Ulp::find($id);

        $dataulp->nama_ulp = $request->nama_ulp;
        $dataulp->jumlah_ulp = $request->jumlah_ulp;
        $dataulp->update();

        return redirect('/ulp')->with('status', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ulp  $ulp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Ulp::find($id);
        $model->delete();

        return redirect('/ulp')->with('success', 'Data berhasil dihapus!');
    }
}
