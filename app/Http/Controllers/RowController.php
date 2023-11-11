<?php

namespace App\Http\Controllers;

use App\Models\Row;
use Illuminate\Http\Request;

class RowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Row::all();
        return $rows;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'lesson_id'=> 'required',
        ]);
        $row = Row::create($data);

        return $row;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Row  $row
     * @return \Illuminate\Http\Response
     */
    public function show(Row $row)
    {
        return $row;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Row  $row
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Row $row)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Row  $row
     * @return \Illuminate\Http\Response
     */
    public function destroy(Row $row)
    {
        //
    }
}
