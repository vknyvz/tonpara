<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables; 
use App\User;
use App\Http\Requests\User\Request;

class UserController extends Controller
{
  public function __construct()
  {
  }
  
  public function index()
  {
    return view('user.index');
  }
  
  public function create(Request $request, User $user)
  {
    if($request->isMethod('post')) {
      $data = $request->all();
      $create = $user->create($data);
      if ($create) {
        Session::flash('success', 'User Saved.');
        return redirect()->route('user.index');
      }
    }
  
    return view('user.edit', ['row' => $user]);
  }
  
  public function data()
  {
    $rows = User::query();
    
    return Datatables::of($rows)
      ->addColumn('created_at', function ($r) {
        return $r->created_at->format('d-m-Y G:i');
      })
      ->addColumn('action', function ($r) {
        return view('user.partials._options', ['row' => $r]);
      })
      ->make(true);
  }
}
