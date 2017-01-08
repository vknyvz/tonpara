<?php
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
  public function authorize() {
    return true;
  }
  
  public function rules()
  {
    switch($this->method()) {
      default:
        break;
      case 'GET':
      case 'DELETE':
        return [];
        break;
      case 'POST':
        return $rules = [
          'name' => 'required|',
          'email' => 'required|email|unique:users',
          'group_id' => 'required',
          'password' => 'required|min:6',
        ];
        break;
      case 'PUT':
      case 'PATCH':
        $rules = [
          'name' => 'required|',
          'email' => 'required|email|unique:users,email,' . $this->id,
          'group_id' => 'required',
        ];
        
        if($this->password) {
          $rules['password'] = 'required|min:6';
        }
        
        return $rules;
        break;
    }
  }
  
  public function messages()
  {
    return [
      'name.*' => 'Bir kullanıcı ismi girilmeli.',
      'email.required' => 'E-posta yanlış veya boş bırakıldı.',
      'email.email' => 'E-posta yanlış veya boş bırakıldı.',
      'email.unique' => 'Bu E-posta zaten sistemde kayıtlı.',
      'group_id.*' => 'Bir kullanıcı grubu seçilmelidir.',
      'password.*' => 'Şifre en düşük 6 haneli olmalıdır.'
    ];
  }
}