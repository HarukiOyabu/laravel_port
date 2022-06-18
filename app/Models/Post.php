<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    
    protected $fillable=['user_id','place_id','comment','title','image','image2','description'];

    public function user(){
        return $this->belongsTo(User::class);
    }




    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    public function likedUsers(){
        return $this->belongsToMany('App\Models\User','likes');
    }
    public function isLikedBy($my_user){
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($my_user->id);
        return $result;
      }

    public function place(){
        return $this->belongsTo(Place::class);
    }
}
