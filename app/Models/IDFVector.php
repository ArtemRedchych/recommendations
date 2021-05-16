<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductItem;

class IDFVector extends Model
{
    public array $idf_vector;
    public array $all_products_items;
    public array $recommendations;
    public function __construct(array & $categories){

        /*$item1 = new ProductItem([12,   14,15], $categories);
        $item2 = new ProductItem([   13], $categories);
        $item3 = new ProductItem([12,13,14,15,19], $categories);
        $item4 = new ProductItem([12,      15,19], $categories);
        $item5 = new ProductItem([12,13,14,15,19], $categories);

        $this->all_products_items = array("1" => $item1, "2" => $item2, "3" => $item3,  "4" =>$item4,  "5" => $item5);*/
        $this->setAllProdsItems($categories);

        $products_amount = count($this->all_products_items);

        //DF vector
        $category_to_product = array();

        // set the DF vector
        foreach ($categories as $cat_key => $cat_value) {
            $tmp_count = 0;
            foreach ($this->all_products_items as $prod_key => $prod_item) {
                $tmp_count += $prod_item->item_vector[$cat_key] > 0 ? 1 : 0;
            }

            $category_to_product[$cat_key] = $tmp_count;
        }

        //calculate IDF vector
        $this->idf_vector = array();

        foreach ($category_to_product as $key => $value) {
            if($value){
                $this->idf_vector[$key] = log($products_amount / $value);
            }else{
                $this->idf_vector[$key] = 0;
            }
        }

    }

    public function recommend(array $user_item){
        //  $key => $value, key - product_id, value - score
        $this->recommendations = array();

        foreach ($this->all_products_items as $prod_key => $prod_item) {
           // $input = array($user_item, $this->idf_vector, $prod_item->item_vector);
            $prediction = $this->dotProduct($user_item, $this->idf_vector, $prod_item->item_vector);
            $this->recommendations[$prod_key] = $prediction;
        }

        return $this->recommendations;
    }

    private function dotProduct(array $user_item, array $idf_vector, $prod_item_vector){
        $dot_prod = 0;
        foreach ($user_item as $category => $value) {
            $dot_prod += $value * $idf_vector[$category] * $prod_item_vector[$category];
        }

        return $dot_prod;
    }

    public function getProductcategories(int $id){
        return $this->all_products_items[$id]->categories_list;
    }

    private function setAllProdsItems(array & $categories){
        $products_std = DB::select('SELECT id FROM products ORDER BY id ASC');

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
            while(count($categories_queue)){
                $current_cat_id = end($categories_queue);
                array_pop($categories_queue);
                //find current category parent category
                $parent_categories = DB::select("
                    SELECT cat.subcategory FROM category AS cat WHERE cat.id = ?
                
                ",[$current_cat_id]);
                
                foreach($parent_categories as $par_cats){
                    //current category doesn't have parent category OR it alreaty is in the list
                    if($par_cats->subcategory == 0 || array_key_exists($par_cats->subcategory, $prod_categories)){
                        continue;
                    }

                    $prod_categories[$par_cats->subcategory] = $par_cats->subcategory;
                    array_push($categories_queue, $prod_cat->subcategory);
                }

                
            }
            
            $this->all_products_items[$product->id] =  new ProductItem($prod_categories, $categories);
            
        }

    }
}
