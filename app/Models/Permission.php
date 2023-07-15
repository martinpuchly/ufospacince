<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'key', 'main_name', 'route', 'link_in_admin_menu'];
    public $timestamps = false;
    public static $permissions;


    public function groups(): BelongsToMany{
        return $this->belongsToMany(Group::class);
     }

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }



     public static function orderedPerm($permissions=null): Array
     {
         if(!$permissions){
            $permissions = (new static)->all();
         }
         
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
