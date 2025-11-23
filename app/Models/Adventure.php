<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Adventure extends Model
{

    //

        protected $table = "aventure"  ;
        protected $fillable = [
        'title',
        'destination',
        'details',
        'images',
        'user_id'
        ];

         public function user(){
            return $this->belongsTo(User::class) ;
        }
}
