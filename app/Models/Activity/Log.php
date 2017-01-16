<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use Html;

class Log extends Model
{
  protected $table = 'activity_logs';  
  
  protected $fillable = [
    'activity', 'created_by', 'payload',
  ];
  
  public function message() {
    switch($this->activity) {
      case 'user_register':
        $model = json_decode($this->payload);
        $message = sprintf('<span class="label label-sm label-danger">%s</span> <span class="label label-sm label-default">%s</span> isimli kullanıcıyı kayıt etti.', $this->created_by_name, $model->name);
        break;
      case 'user_loggedin':
        $message = sprintf('<span class="label label-sm label-danger">%s</span> giriş yaptı.', $this->created_by_name);
        break;
      case 'user_bind':
        $model = json_decode($this->payload);
        $message = sprintf('<span class="label label-sm label-danger">%s</span> <span class="label label-sm label-default">%s</span> isimli kullanıcıyı <span class="label label-sm label-default">%s</span>\'a atadı.', $this->created_by_name, User::find($model->user_id)->name, User::find($model->admin_id)->name);
        break;
      case 'user_unbind':
        $model = json_decode($this->payload);
        $message = sprintf('<span class="label label-sm label-danger">%s</span> <span class="label label-sm label-default">%s</span> isimli kullanıcıyı <span class="label label-sm label-default">%s</span>\'in kontrolünden çıkardı.', $this->created_by_name, User::find($model->user_id)->name, User::find($model->admin_id)->name);
        break;
      case 'user_updated':
        $model = json_decode($this->payload);
        $message = sprintf('<span class="label label-sm label-danger">%s</span> <span class="label label-sm label-default">%s</span> isimli kullanıcıyı düzenledi.', $this->created_by_name, $model->name);
        break;
    }
    
    return $message;   
  }
  
  public static function getSystemLogs() {
    return static::select(['users.name as created_by_name', 'activity_logs.activity', 'activity_logs.created_at', 'activity_logs.payload'])
                  ->join('users', 'users.id', '=', 'activity_logs.created_by')
                  ->orderBy('created_at', 'DESC')
                  ->get();
  }
}