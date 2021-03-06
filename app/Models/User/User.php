<?php

namespace App\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User\GroupRelation;
use DB;
use App\Models\Activity\Log;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
      'name', 'email', 'password'
    ];

    protected $hidden = [
      'password', 'remember_token',
    ];
    
    public static function boot() {
      static::created(function ($model) {
        Log::create(['activity' => 'user_register', 'created_by' => user()->id, 'payload' => $model->toJson()]);
      });
      
      static::updated(function ($model) {
        Log::create(['activity' => 'user_updated', 'created_by' => user()->id, 'payload' => $model->toJson()]);
      });
    
      parent::boot();
    }
    
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
    
    public function getAdminsUsers($id) {
      return static::select(['user_users_rel.id as user_users_rel_id', 'users.id', 'users.name'])
                   ->join('user_users_rel', 'user_users_rel.user_id', '=', 'users.id')
                   ->where('user_users_rel.admin_id', $id)
                   ->get();
    }
}
