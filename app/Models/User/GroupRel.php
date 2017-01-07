<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class GroupRelation extends Model
{
  protected $table = 'user_group_rel';

  public $timestamps = false;
}