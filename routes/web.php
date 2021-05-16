<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersList;
use App\Models\Recommend;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    /*$all_categories = array();
    for($i = 12; $i < 20; $i++){
        $all_categories[$i] = 0;
    }
    $item1 = new ProductItem([12,14,15], $all_categories);
    $item2 = new ProductItem([13], $all_categories);
    $item3 = new ProductItem([12,13,14,15,19], $all_categories);

    $test = array($item1, $item2, $item3);
    $user = new UserItem($test, $all_categories);

    $idf_obj = new IDFVector($all_categories);
    //dd($user->item_vector);
    $recommendations = $idf_obj->recommend($user->item_vector);
    //dd($recommendations);
    arsort($recommendations);
    dd($recommendations);*/


    /*$raw_data = array(
        "1" => array("id" => 1, "categories" => [12,   14,15]),
        "2" => array("id" => 2, "categories" => [13]),
        "3" => array("id" => 4, "categories" => [12,      15,19]),
    );
    $rec = new Recommend($raw_data);
    $test = $rec->recommend(5);
    dd($test);*/

   // dd(array_slice($recommendations,0 ,10));
    return view('welcome');
});

Route::resources([
    'users' => UsersList::class,
    //'posts' => PostController::class,
]);
