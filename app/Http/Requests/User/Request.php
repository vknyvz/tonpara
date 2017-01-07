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
    if ($this->method() == "POST" || $this->method() == "PUT") {
      return $rules = [
        'name' => 'required|',
        'email' => 'required|email',
        'group_id' => 'required',
      ];
    } else {
      return [];
    }
  }
}