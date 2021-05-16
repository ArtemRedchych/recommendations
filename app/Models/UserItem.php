<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
    public array $item_vector;

    public function __construct(array & $product_items, array & $categories){
        $this->item_vector = array();
       // dd($categories);
        foreach ($categories as $cat_key => $categorie) {
            $tmp_sum = 0;
            foreach ($product_items as $prod_key => $prod_item) {
            // dd($prod_value);
                $tmp_sum += $prod_item->item_vector[$cat_key];
                //var_dump($prod_item->item_vector[$cat_key]);
            }

            $this->item_vector[$cat_key] = $tmp_sum;
        }

       // dd($this->item_vector);
       // for(int $i = )
    }
}
