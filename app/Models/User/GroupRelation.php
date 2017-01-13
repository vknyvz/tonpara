<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupRelation extends Model
{
  protected $table = 'user_group_rel';

  public $timestamps = false;
  
  public static function getUsersByGroups($group_key = 'user') {
    return static::select('users.id', 'user_group.title as group_title', 'users.name', 'users.email')
                    ->join('users', 'users.id', '=', 'user_group_rel.user_id')    
                    ->join('user_group', 'user_group.id', '=', 'user_group_rel.group_id')
                    ->where('user_group.key', $group_key)
                    //->whereNotIn('users.id', [DB::raw('select id from user_users_rel')])
                    ->get();
  }  
}