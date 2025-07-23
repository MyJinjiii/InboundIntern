<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetYear;
use App\Models\ResearchList;
use Illuminate\Http\Request;
use App\Models\user_info;
use App\Models\user_status;
use App\Models\user_result;
use App\Models\user_loa;
use App\Models\UserInfo;
use App\Models\UserLoa;
use App\Models\UserResult;
use App\Models\UserStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 

class ManageScholarshipController extends Controller
{
    public function index() {
        $current = Carbon::now();

        $budgetYear = BudgetYear::orderBy('id', 'desc')
            ->first();

        // $dateStart = $budgetYear ? $budgetYear->date_start : Carbon::now()->startOfYear(); // กำหนดค่าเริ่มต้นเป็นวันที่เริ่มต้นของปีนี้

        $research_list = ResearchList::orderBy('id', 'desc')
            ->where('approve', 1)
            ->where('year_id', $budgetYear->id)
            ->get();
    
        if ($research_list) {
            $user_info = DB::table('user_infos')
                ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
                ->leftJoin('user_loas', 'user_infos.id', '=', 'user_loas.info_id')
                ->leftJoin('user_results', 'user_infos.id', '=', 'user_results.info_id')
                ->whereIn('user_statuses.status', ['in progression', 'pass', 'not pass'])
                ->where('user_infos.scholarship', 1) // ใช้ตัวกรองทุนการศึกษา
                ->whereIn('user_infos.topic_id', values: $research_list->pluck('id'))
                ->orderBy('user_infos.id', 'asc')
                ->select('user_infos.*', 'user_statuses.*', 'user_results.*', 'user_loas.LAO_file', 'user_loas.info_id as loas_info_id')
                ->paginate(5);
            return view('admin.scholarship', compact('user_info'));
        } else {
            // ถ้าไม่พบข้อมูลปีงบประมาณปัจจุบัน
            return redirect()->back()->with('error', 'ไม่พบปีงบประมาณปัจจุบัน');
        }
        // $currentDate = Carbon::now();
        // $nextYearDate = $currentDate->copy()->addYear();
        
        // // ดึงข้อมูลปีงบประมาณสำหรับปีถัดไป
        // $nextBudgetYear = BudgetYear::where('date_start', '<=', $nextYearDate)
        //     ->where('date_end', '>=', $nextYearDate)
        //     ->first();
    
        // if ($nextBudgetYear) {
        //     $startOfNextYear = Carbon::create($nextBudgetYear->date_start);
        //     $endOfNextYear = Carbon::create($nextBudgetYear->date_end)->endOfDay();
            
        //     $user_info = DB::table('user_infos')
        //         ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
        //         ->leftJoin('user_loas', 'user_infos.id', '=', 'user_loas.info_id')
        //         ->leftJoin('user_results', 'user_infos.id', '=', 'user_results.info_id')
        //         ->where('user_statuses.status', 'active')
        //         ->where('user_infos.scholarship', 1) // ใช้ตัวกรองทุนการศึกษา
        //         ->whereBetween('user_infos.created_at', [$startOfNextYear, $endOfNextYear])
        //         ->orderBy('user_infos.id', 'asc')
        //         ->select('user_infos.*', 'user_statuses.*', 'user_results.*', 'user_loas.LAO_file', 'user_loas.info_id as loas_info_id')
        //         ->paginate(5);
            
        //     return view('admin.scholarship', compact('user_info'));
        // } else {
        //     // ถ้าไม่พบข้อมูลปีงบประมาณปีถัดไป
        //     return redirect()->back()->with('error', 'ไม่พบปีงบประมาณปีถัดไป');
        // }
    }
    
    public function update(Request $request, $id) {
        // Validate the request data
        $data = $request->validate([
            'cv_status' => 'nullable|boolean',
            'study_record_status' => 'nullable|boolean',
            'motivation_letter_status' => 'nullable|boolean',
            'main_passport_page_status' => 'nullable|boolean',
        ]);
    
        // Fetch user_status and related user_info
        $user_status = UserStatus::join('user_infos', 'user_statuses.info_id', '=', 'user_infos.id')
            ->where('user_infos.id', $id)
            ->select('user_infos.*', 'user_statuses.*')
            ->first();
    
        if ($user_status) {
            // Update user_status fields conditionally
            if ($request->has('cv_status') && $user_status->cv_status != 1) {
                $user_status->cv_status = $data['cv_status'];
            }
    
            if ($request->has('motivation_letter_status') && $user_status->motivation_status != 1) {
                $user_status->motivation_status = $data['motivation_letter_status'];
            }
    
            if ($request->has('main_passport_page_status') && $user_status->passport_status != 1) {
                $user_status->passport_status = $data['main_passport_page_status'];
            }
    
            if ($request->has('study_record_status') && $user_status->transcript_status != 1) {
                $user_status->transcript_status = $data['study_record_status'];
            }
            $user_status->admin_accept_name = auth()->user()->name;
            $user_status->save();
    
            // Check if all statuses are 1 and create user_result if necessary
            if (
                $user_status->cv_status == 1 &&
                $user_status->motivation_status == 1 &&
                $user_status->passport_status == 1 &&
                $user_status->transcript_status == 1
            ) {
                // Check if user_result already exists
                $user_result = UserResult::where('status_id', $user_status->id)->first();
                if ($user_result) {
                    $user_result->interview_right = 1;
                } else {
                    $user_result = new UserResult();
                    $user_result->status_id = $user_status->id;
                    $user_result->interview_right = 1;
                }
                $user_result->save();
            }
    
            return redirect()->back()->with('success', 'User status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'User status not found.');
        }
    }
    
    
    

public function interview_result(Request $request, $info_id){
    $data = $request->validate([
        'interview_result' => 'required',
    ]);
    $user_result = UserResult::join('user_infos', 'user_results.info_id', '=', 'user_infos.id')
        ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
        ->select('user_results.*', 'user_infos.*', 'user_statuses.*')
        ->where('user_results.id', $info_id)
        ->first();
    if($user_result){
        $user_result->interview_result = $request->interview_result;
        $user_result->save();
        if($request->interview_result == 1){
               // Update other users in the same research topic to be 2 (didn't pass)
               UserResult::join('user_infos', 'user_results.info_id', '=', 'user_infos.id')
               ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
               ->where('user_infos.topic_id', $user_result->topic_id)
               ->where('user_results.id', '!=', $user_result->id)
               ->update([
                'user_results.interview_result' => 2,
                'user_statuses.status' => 'not pass'
            ]);
            return redirect()->back()->with('success', "pass");
        }
        else{
            return redirect()->back()->with('error', "Didnt pass");

        }
    }
 else {
    return redirect()->back()->with('error', 'User status not found.');
}


}


public function LOA(Request $request, $info_id)
{
    // Validate the request data, ensuring the 'loa' file is required and has the correct file type and size
    $validatedData = $request->validate([
        'loa' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);
    $info_id = intval($info_id);
    // Store the new file in the specified directory and get its path
    if ($request->hasFile('loa')) {
        $file = $request->file('loa');
        $fileName =  $info_id . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads\loa', $fileName, 'public');
    } else {
        return redirect()->back()->withErrors('No file uploaded.');
    }

    // Retrieve user-related data from the database
    $userResult = UserInfo::join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
        ->join('user_results', 'user_infos.id', '=', 'user_results.info_id')
        ->orderBy('user_infos.id', 'asc')
        ->select('user_results.*', 'user_infos.*', 'user_statuses.*')
        ->where('user_infos.id', $info_id)
        ->first();

    // Check if user result exists
    if (!$userResult) {
        return redirect()->back()->withErrors('User information not found.');
    }

    // Create a new LOA record in the database
    UserLoa::create([
        'status_id' => $userResult->status_id,
        'user_id' => $userResult->user_id,
        'info_id' => $userResult->info_id,
        'result_id' => $userResult->id,
        'LAO_file' => $path,
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Final announcement updated successfully.');
}

public function comment(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'comment' => 'required|string|max:255',
    ]);

    // Find the UserStatus entry by ID
    $comment = UserStatus::find($id);

    // Check if the UserStatus entry exists
    if ($comment) {
        // Update the UserStatus entry with the validated data
        $comment->update($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Comment updated successfully.');
    } else {
        // Redirect back with an error message if the entry is not found
        return redirect()->back()->with('error', 'Comment not found.');
    }
}


}



// //
// ->orderBy('user_infos.id', 'asc')
// ->select('user_infos.*')  // เลือกเฉพาะฟิลด์จากตาราง user_infos (อาจเพิ่มฟิลด์จาก user_statuses ถ้าต้องการ)
// ->paginate(5);
// return view('admin.pansumpad', $user_info);