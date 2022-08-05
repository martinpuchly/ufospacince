<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;



    public function groups(){
        return $this->belongsToMany(Group::class);
     }

    public function users(){
        return $this->belongsToMany(User::class);
    }



     public static function orderedPerm()
     {
         $permissions = (new static)->all();
         $permissions_order = [];
         $cur_name_permission = "";
 
         foreach ($permissions as $permissions_item) {
             if ($cur_name_permission != $permissions_item['main_name']) {
                 $cur_name_permission = $permissions_item['main_name'];
             }
             $permissions_order[$cur_name_permission][] = $permissions_item;
         }
         return $permissions_order;
     }


}
