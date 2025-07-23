<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetYear;
use App\Models\ResearchList;
use Illuminate\Http\Request;
use App\Models\UserInfo;

class AlluserController extends Controller
{
  public function index(){

    $budgetYear = BudgetYear::orderBy('id', 'desc')
    ->first();
    $research_list = ResearchList::orderBy('id', 'desc')
    ->where('approve', 1)
    ->where('year_id', $budgetYear->id)
    ->get();

    $user_info['user_info'] = UserInfo::join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
    ->leftJoin('user_results', 'user_infos.id', '=', 'user_results.info_id')
    ->orderBy('user_infos.id', 'asc')
    ->select('user_infos.*','user_statuses.*','user_results.*')  // Add any fields from user_statuses that you need
    ->whereIn('user_infos.topic_id', values: $research_list->pluck('id'))
    ->paginate(5);    
    return view('admin.useredit', $user_info);
}
}
