<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_info; 
use App\Models\user_status; 
use App\Models\user_result;
use App\Models\UserInfo;

class ManageNonScholarshipController extends Controller
{
    public function index() {
        $user_info = UserInfo::join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
            ->leftJoin('user_results', 'user_infos.id', '=', 'user_results.info_id')
            ->where('user_infos.scholarship', 0) // Apply the scholarship filter
            ->orderBy('user_infos.id', 'asc')
            ->select('user_infos.*', 'user_statuses.*', 'user_results.*')  // Select necessary fields
            ->paginate(5); // Paginate the results
    
        return view('admin.nonscholarship', compact('user_info'));
    }
}
