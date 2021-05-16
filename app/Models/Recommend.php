<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductItem;
use App\Models\UserItem;
use App\Models\IDFVector;

class Recommend extends Model
{
    public array $user_products_items;
    public array $all_categories;
    private $idf_obj;

    public function __construct(array & $user_products_raw ){
        $this->setCategories();
        $this->setUserProducts($user_products_raw);

    }

    private function setUserProducts(array & $user_products_raw){
        $this->user_products_items = array();
        foreach ($user_products_raw as $key => $product) {
           // dd($product);
            $this->user_products_items[$product['id']] = new ProductItem($product['categories'], $this->all_categories);
        }
    }

    private function setCategories(){
        /*$this->all_categories = array();
        for($i = 12; $i < 20; $i++){
            $this->all_categories[$i] = 0;
        }*/
        $all_cats_raw = DB::select('SELECT id FROM category ORDER BY id ASC;');

        foreach ($all_cats_raw as $key => $category) {
            $this->all_categories[$category->id] = 0;
        }
    }

    public function recommend(int $limit){
        $user  = new UserItem($this->user_products_items, $this->all_categories);

        $this->idf_obj = new IDFVector($this->all_categories);

        $recommendations = $this->idf_obj->recommend($user->item_vector);
        arsort($recommendations);
        //dd($recommendations);
        $result = $this->filter($recommendations, $limit);
        return $result;
    }

    private function filter(array & $recommendations, $limit){
        $result = array();
        $counter = 0;
        foreach ($recommendations as $key => $value) {
            if(array_key_exists($key,  $this->user_products_items)){
                continue;
            }else if($counter > $limit){
                break;
            }
            $result[$key] = $value;
            $counter++;
        }

        return $result;
    }

    public function getProductCategories(int $id){
        return $this->idf_obj->getProductcategories($id);
    }
}
