<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserUsersRelation extends Model
{
  protected $table = 'user_users_rel';  
  
  public $timestamps = false;
  
  public function getByAdmin() {
    
  }
}