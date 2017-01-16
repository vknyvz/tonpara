<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity\Log;

class UserUsersRelation extends Model
{
  protected $table = 'user_users_rel';  
  
  public $timestamps = false;
  
  public static function boot() {
    static::created(function ($model) {
      Log::create(['activity' => 'user_bind', 'created_by' => user()->id, 'payload' => $model->toJson()]);
    });
  
    static::deleted(function ($model) {
      Log::create(['activity' => 'user_unbind', 'created_by' => user()->id, 'payload' => $model->toJson()]);
    });

    parent::boot();
  }  
}