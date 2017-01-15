<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables; 
use App\Http\Requests\User\Request;
use App\Models\User\{User, Group, UserUsersRelation};
use Html;

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
        $create->groups()->sync([$data['group_id']]);
        return redirect()->route('user.index');
      }
    }
  
    return view('user.edit', ['row' => $user]);
  }
  
  public function update(Request $request, User $user)
  {
    if ($request->isMethod('put')) {
      $data = $request->all();
      $update = $user->update($data);
      if ($update) {
        $user->groups()->sync([$data['group_id']]);
        return redirect()->route('user.index');
      }
    }
  
    return view('user.edit', ['row' => $user]);
  }
  
  public function bindUser($user_id, $admin_id) {
    $model = new UserUsersRelation;
    $model->admin_id = $admin_id;
    $model->user_id = $user_id;
    $model->save();
    
    return back();
  }
  
  public function unbindUser($id) {
    (new UserUsersRelation)->find($id)->delete();
    return back();
  }
  
  public function data()
  {
    $rows = User::select('users.created_at', 'users.name', 'users.email', 'title', 'users.id')
              ->group()
              ->orderBy('users.id')
              ->get();
    
    return Datatables::of($rows)
      ->editColumn('name', function ($r) {
        return Html::linkRoute('user.update', $r->name, [$r]);
      })
      ->editColumn('group', function ($r) {
        return $r->title ?? '-';
      })
      ->addColumn('created_at', function ($r) {
        return $r->created_at->format('d-m-Y G:i');
      })
      ->addColumn('action', function ($r) {
        return view('user.partials._options', ['row' => $r]);
      })
      ->make(true);
  }
}
