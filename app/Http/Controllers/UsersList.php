<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UsersList extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::select("
        SELECT test.custommer_id, test.order FROM
        (
            SELECT 
                cus.id as custommer_id
                ,COUNT(op.number_order) as order
    
            FROM custommers as cus

            LEFT JOIN order_processes as op ON  cus.id = op.id_customers
            
            WHERE cus.id != 46213

            GROUP BY cus.id
        ) AS test

        ORDER BY test.order DESC
        LIMIT 10;

        "
        );
        /*dd($users);
        $users = array(
            array('custommer_id' => 1, "order" => 12),
            array('custommer_id' => 2, "order" => 32),
            array('custommer_id' => 3, "order" => 1),
            array('custommer_id' => 4, "order" => 55),
            array('custommer_id' => 5, "order" => 22),
            array('custommer_id' => 6, "order" => 33),
        );*/
        //var_dump($users);
       // $users = "dasdasda";
        return view('users_list')->with('users', $users);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('user_detail')->with('user_id', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}