<?php

namespace App\Http\Controllers;

use App\Models\BudgetYear;
use App\Models\edit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\UserResult;
use App\Models\UserStatus;
use Carbon\Carbon;

class scholarshipController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'tel' => 'required',
            'level_of_studies' => 'required',
            'year_of_study' => 'required',
            'study_program' => 'required',
            'faculty' => 'required',
            'university' => 'required',
            'country' => 'required',
            'program_focus' => 'nullable',
            'topic' => 'nullable',
            'advisor' => 'nullable',
            'internship_duration' => 'required',
            'start_date' => 'required|date',
            'cv_file' => 'required|mimes:pdf|max:2048',
            'motivation_file' => 'required|mimes:pdf|max:2048',
            'passport_file' => 'nullable|mimes:pdf|max:2048',
            'transcript_file' => 'required|mimes:pdf|max:2048',
            'topic_id' => 'required'

        ]);
        $durationParts = explode(' ', $data['internship_duration']);
        $durationMonths = (int)$durationParts[0];

        
        $startDate = Carbon::parse($data['start_date']);
        $endingDate = $startDate->addMonths($durationMonths);
        $data['ending_date'] = $endingDate->toDateString();



        $data['scholarship'] =  '1';
        $data['user_id'] = auth()->id();
        $filePaths = [];

        $fileTypes = ['cv_file' => 'cv', 'motivation_file' => 'motivation', 'passport_file' => 'passport', 'transcript_file' => 'transcript'];

        foreach ($fileTypes as $fileField => $disk) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $fileName =  auth()->id() . '_' . $file->getClientOriginalName(); // ใช้ชื่อไฟล์เดิม
                $filePath = $file->storeAs('', $fileName, $disk);
                $filePaths[$fileField] = $filePath;
            }
        }

        // เพิ่มพาธของไฟล์ที่อัพโหลดเข้าไปใน $data
        foreach ($filePaths as $field => $path) {
            $data[$field] = $path;
        }
        // สร้างข้อมูลใหม่ในโมเดล Registration และบันทึกลงในฐานข้อมูล
        $registration = UserInfo::create($data);
        if ($registration) {
            $user_status = UserStatus::create([
                'info_id' => $registration->id,
                'personal_status' => '0',
                'education_status' => '0',
                'cv_status' => '0',
                'motivation_status' => '0',
                'passport_status' => '0',
                'transcript_status' => '0',
                'admin_accept_name' => '',
                'status' => 'in progression',
            ]);
            if ($user_status) {
                $user_result = UserResult::firstOrCreate(
                    ['status_id' => $user_status->id],
                    [
                        'info_id' => $user_status->info_id,
                        'user_id' => $registration->user_id,
                        'interview_right' => '0',
                        'interview_result' => '0',
                        'confirm_right' => '0',
                    ]
                );
                if ($user_result) {
                    return redirect()->route('user.status', ['id' => $registration->id])->with('success', 'Register Success!!');
                } else {
                    return redirect()->route('user.status', ['id' => $registration->id])->with('error', 'Register error!!');
                }
            }
        }
    }
    public function show($id)
    {
       
    
        $user = UserInfo::where('id', $id)->first();
        if ($user->user_id != auth()->user()->id) {
            return redirect()->back();
        }
        
        


        $userInfoAndStatus['user_info'] = DB::table('user_infos')
            ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
            ->join('user_results', 'user_infos.id', '=', 'user_results.info_id')
            ->join('research_lists', 'user_infos.topic_id', '=', 'research_lists.id')
            ->join('users', 'research_lists.advisor_id', '=', 'users.id') // Join with users table
            ->select(
                'user_infos.*',
                'user_statuses.*',
                'user_results.*',
                'users.email as advisor_email'
            )
            ->where('user_infos.id', $id)
            ->first();
        $edit = BudgetYear::orderBy('id', 'desc')
            ->first();
        $loa['loa'] = DB::table('user_infos')
            ->join('user_loas', 'user_infos.id', '=', 'user_loas.info_id')
            ->select('user_infos.*', 'user_loas.*')
            ->where('user_infos.id', $id)
            ->first();
        // dd($edit,$loa,$userInfoAndStatus,$find);
        return view('user.status', compact('userInfoAndStatus', 'edit', 'loa'));
    }
}
