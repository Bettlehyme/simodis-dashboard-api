<?php

namespace App\Http\Controllers;

use App\Models\Masterdata;
use Illuminate\Http\Request;
use App\Imports\MasterdataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class MasterdataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Masterdata::all();
        return view('data.masterdata', compact('datas'));
    }

    public function importExcel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $namafile = rand() . $file->getClientOriginalName();

        // upload ke folder file_dataMentah didalam folder public
        $file->move('DataMentah', $namafile);

        // import data
        Excel::import(new MasterdataImport, public_path('/DataMentah/' . $namafile));

        // alihkan halaman kembali
        return back()->withStatus('Excel file imported successfully');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masterdata  $masterdata
     * @return \Illuminate\Http\Response
     */
    public function show(Masterdata $masterdata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masterdata  $masterdata
     * @return \Illuminate\Http\Response
     */
    public function edit(Masterdata $masterdata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masterdata  $masterdata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masterdata $masterdata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masterdata  $masterdata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masterdata $masterdata)
    {
        //
    }

    public function truncate()
    {
        $truncate = DB::table('masterdata')->truncate();

        return back()->with('success', 'Tabel berhasil dibersihkan!');
    }
}
