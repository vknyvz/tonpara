<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables; 
use App\User;

class UserController extends Controller
{
  public function __construct()
  {
  }
  
  public function index()
  {
      return view('user.index');
  }
  
  public function data()
  {
    $rows = User::query();
    
    return Datatables::of($rows)->make(true);
  }
}
