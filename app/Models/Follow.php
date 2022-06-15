<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'follow_id'];

    

    public function follows(){
        return $this->hasMany('App\Follow');
    }
 
    public function follow_users(){
      return $this->belongsToMany('App\User', 'follows', 'user_id', 'follow_id');
    }
 
    public function followers(){
      return $this->belongsToMany('App\User', 'follows', 'follow_id', 'user_id');
    }

    public function isFollowing($user){
        $result = $this->follow_users->pluck('id')->contains($user->id);
        return $result;
      }
}
