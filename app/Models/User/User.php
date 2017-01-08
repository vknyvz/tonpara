<?php

namespace App\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User\GroupRelation;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
      'name', 'email', 'password'
    ];

    protected $hidden = [
      'password', 'remember_token',
    ];
    
   /* public static function boot() {
      $rel = new GroupRelation;
      static::saving(function ($model) use($rel) {
        if($model->group_id) {
          $rel::where('user_id', $model->id)
              ->where('group_id', '!=', $model->group_id)
              ->delete();
        }
      });
      
      parent::boot();
    }*/
    
    public function setPasswordAttribute($password)
    {
      if($password) {
        $this->attributes['password'] = bcrypt($password);
      }
    }
    
    public function scopeGroup($query) {
      return $query->leftjoin('user_group_rel', 'user_group_rel.user_id', '=', 'users.id')
                   ->leftjoin('user_group', 'user_group.id', '=', 'user_group_rel.group_id');
    }
    
    public function groups() {
      return $this->belongsToMany('\App\Models\User\Group', 'user_group_rel', 'user_id', 'group_id');
    }
}
