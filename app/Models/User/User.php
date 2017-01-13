<?php

namespace App\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User\GroupRelation;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
      'name', 'email', 'password'
    ];

    protected $hidden = [
      'password', 'remember_token',
    ];
    
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
    
    public function group() {
      return $this->hasOne('\App\Models\User\GroupRelation', 'user_id');
    }
    
    public function users() {
      return $this->hasMany('App\Models\User\UserUsersRelation', 'admin_id')
                ->join('users', 'users.id', '=', 'user_users_rel.user_id');
    }
    
    public function getAdminUsers() {
      return static::with(['users'])->find($this->id);
    }
}
