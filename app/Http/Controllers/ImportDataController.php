<?php

namespace App\Http\Controllers;

use App\Customer;
use App\ImportData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Customer::truncate();
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('imports.import_data');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Excel::import(new ImportData, $request->file('excel_file'));

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImportData  $importData
     * @return \Illuminate\Http\Response
     */
    public function show(ImportData $importData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImportData  $importData
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportData $importData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImportData  $importData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportData $importData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImportData  $importData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportData $importData)
    {
        //
    }
}
