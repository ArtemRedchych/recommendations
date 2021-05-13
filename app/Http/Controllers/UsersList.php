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
        //$users = new stdClass; 
        $users = array();
        for($i = 0; $i < 10; $i++){
            $user = new \stdClass(); 
            $user->custommer_id = $i+1;
            $user->order = 2*$i+1;
            $users[] = $user;
        }*/
        
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
        //2920
        $products_std = DB::select("
        SELECT p.id, p.title, p.author FROM order_processes AS op

        LEFT JOIN order_histories as oh ON oh.number_order = op.number_order
        LEFT JOIN products AS p ON p.id = oh.id_products
        WHERE op.id_customers = ?

        GROUP BY p.id
        "
        ,[$id]);

        //lets get categories
        $products_arr = array();
        foreach($products_std as $product){
            $prod_categories = array();
            $categories_queue = array();
            $prod_categories_std = DB::select("
                SELECT cat.id, cat.subcategory FROM product_category AS pc
                LEFT JOIN category AS cat ON cat.id =  pc.id_category

                WHERE id_products = ?;
            
            
            ", [$product->id]);
            foreach($prod_categories_std as $prod_cat){
                $prod_categories[$prod_cat->id] = $prod_cat->id;
                array_push($categories_queue, $prod_cat->id);
            }
            //for each category find parent ant add to the list
            var_dump("Before");
            var_dump($categories_queue);
            while(count($categories_queue)){
                var_dump("Inside WHILE");
                var_dump($categories_queue);
                var_dump("current_cat_id = ". $current_cat_id);
                $current_cat_id = end($categories_queue);

                //find current category parent category
                $parent_categories = DB::select("
                    SELECT cat.subcategory FROM category AS cat WHERE cat.id = ?
                
                ",[$current_cat_id]);
                
                foreach($parent_categories as $par_cats){
                    //current category doesn't have parent category OR it alreaty is in the list
                    if($par_cats->subcategory == 0 || array_key_exists($par_cats->subcategory, $prod_categories)){
                        var_dump("already in array " . $par_cats->subcategory);
                        var_dump($prod_categories);
                        continue;
                    }

                    $prod_categories[$par_cats->subcategory] = $par_cats->subcategory;
                    array_push($categories_queue, $prod_cat->subcategory);
                }

                array_pop($categories_queue);
            }
            $products_arr[] = array(
                "id" => $product->id,
                "title" => $product->title,
                "author" => $product->author,
                "categories" => $prod_categories
            );

            
        }

        var_dump($products_arr);

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
