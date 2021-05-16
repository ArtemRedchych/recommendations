<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    public array $item_vector;
    private array $all_categories;
    public array $categories_list;
    private int $cat_amount;

    public function __construct(array $categories, array & $all_categories){
        $this->categories_list = $categories;
        $this->item_vector = array();
        $this->cat_amount  = count($categories);
        $this->createVector($categories);
        $this->normalizeVector();
        $this->item_vector = $this->item_vector + $all_categories;
        ksort($this->item_vector);
        //dd($this->item_vector);
    }

    private function createVector(array $categories){
        foreach($categories as $key => $category){
            $this->item_vector[$category] = 1;
        }
    }

    private function normalizeVector(){
        foreach ($this->item_vector as $key => $value) {
            $this->item_vector[$key] = $value / sqrt($this->cat_amount);
        }
    }
}
