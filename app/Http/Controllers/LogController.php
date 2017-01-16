<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity\Log;

class LogController extends Controller
{
  public function __construct()
  {
  }
  
  public function index()
  {
    return view('log.index', ['logs' => Log::getSystemLogs()]);
  }
}
