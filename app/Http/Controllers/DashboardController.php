<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User; 

class DashboardController extends Controller
{
  public function index() {
    $count = [
      'staff' => DB::table('staff')->count(),
      'regions' => DB::table('regions')->count(),
      'districts' => DB::table('districts')->count(),
      'ipcLeaders' => User::ipcLeaders()->count(),
      'facilities' => DB::table('facilities')->count(),
    ];
    return view('cms.dashboard', compact('count'));
  }
}
