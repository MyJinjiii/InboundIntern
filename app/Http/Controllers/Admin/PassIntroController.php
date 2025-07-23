<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_info;
use App\Models\UserInfo;

class PassIntroController extends Controller
{
    public function index(){
        $user_info = UserInfo::join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
        ->leftJoin('user_results', 'user_infos.id', '=', 'user_results.info_id')
        ->where('user_infos.scholarship', 1) // Apply the scholarship filter
        ->where('user_results.interview_result', 1)
        ->orderBy('user_infos.id', 'asc')
        ->select('user_infos.*', 'user_statuses.*', 'user_results.*')  // Select necessary fields
        ->paginate(5); // Paginate the results
    return view('admin.pansumpad', compact('user_info'));
}
}
