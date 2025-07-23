<?php

namespace App\Http\Controllers;

use App\Models\BudgetYear;
use App\Models\Edit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\user_info;
use App\Models\ResearchList;
use App\Models\user_result;
use App\Models\UserInfo;
use App\Models\UserResult;
use App\Models\UserStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();

        $budgetYear = BudgetYear::orderBy('id', 'desc')
            ->first();

        // $dateStart = $budgetYear ? $budgetYear->date_start : Carbon::now()->startOfYear(); // กำหนดค่าเริ่มต้นเป็นวันที่เริ่มต้นของปีนี้

        $research_list = ResearchList::orderBy('id', 'asc')
            ->where('approve', 1)
            ->where('year_id', $budgetYear->id)
            ->paginate(20);

        return view('user.index', compact('research_list', 'budgetYear'));
    }





    public function form($topic_id, $id)
    {
        $currentDate = Carbon::now();

        // ดึงปีงบประมาณล่าสุด
        $budgetYear = BudgetYear::orderBy('id', 'desc')->first();

        // ตรวจสอบว่า $budgetYear ถูกดึงออกมาหรือไม่
        if (!$budgetYear) {
            return redirect()->route('index')->with('error', 'Budget year not found.');
        }

        // ดึงรายการการวิจัยที่ได้รับการอนุมัติและตรงกับปีงบประมาณ
        $research_list = ResearchList::where('approve', 1)
            ->where('year_id', $budgetYear->id)
            ->where('id', $topic_id)
            ->orderBy('id', 'desc')
            ->first();
        $research_list_id = $research_list->id;
        // ตรวจสอบว่า $research_list มีข้อมูลหรือไม่
        if ($research_list) {
            // ดึงข้อมูลผู้ใช้ที่ตรงกับหัวข้อการวิจัย
            $user_info = UserInfo::where('user_id', $id)
                ->where('topic_id', $research_list_id)
                ->first();

            // แสดงข้อมูลของ $user_info เพื่อตรวจสอบ

            if ($user_info) {
                return redirect()->route('user.status', ['id' => $user_info->id])->with('success', 'Registered !!!');
            } 
        } 

        $research = ResearchList::where('id', $topic_id)->first();
        if ($research) {
            return view('user.form', compact('research_list'));
        } else {
            return redirect()->route('index')->with('error', 'Topic not found.');
        }
    }

    public function nonform()
    {
        return view('user.form');
    }

    public function person_update(Request $request, $id)
    {
        $data_for_update = $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'tel' => 'required',
        ]);

        $user_info = UserInfo::find($id);

        if ($user_info) {
            $user_info->update($data_for_update);
            return redirect()->route('user.status', ['id' => $id])->with('success', 'อัปเดตข้อมูลผู้ใช้เรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
        }
    }

    public function edu_update(Request $request, $id)
    {
        $data_for_update = $request->validate([
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
            'ending_date' => 'required|date',
        ]);

        $user_info = UserInfo::find($id);

        if ($user_info) {
            $user_info->update($data_for_update);

            return redirect()->route('user.status', ['id' => $id])->with('success', 'อัปเดตข้อมูลผู้ใช้เรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
        }
    }
    public function file_update(Request $request, $id)
    {
        // Validate the request data, ensuring each file is required and has the correct file type
        $data_for_update = $request->validate([
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'transcript_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'motivation_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'passport_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Find the user information in the database
        $user_info = UserInfo::find($id);

        if ($user_info) {
            // Define the directory for file storage based on file type
            $directories = [
                'cv_file' => 'uploads/cv',
                'transcript_file' => 'uploads/transcript',
                'motivation_file' => 'uploads/motivation',
                'passport_file' => 'uploads/passport',
            ];

            // Handle each file upload
            $updated_files = [];

            foreach ($data_for_update as $field => $file) {
                if ($request->hasFile($field)) {
                    // Delete the old file if it exists
                    if (!empty($user_info->$field) && Storage::exists('public/' . $directories[$field] . '/' . $user_info->$field)) {
                        Storage::delete('public/' . $directories[$field] . '/' . $user_info->$field);
                    }

                    // Get the original file name
                    $originalName = $request->file($field)->getClientOriginalName();
                    $fileName = $user_info->user_id . '_' . $originalName;

                    // Store the new file in the specified directory with its original name and get its path
                    $directory = $directories[$field];
                    $request->file($field)->storeAs($directory, $fileName, 'public');

                    // Update the user info with the new file name
                    $user_info->$field = $fileName;
                    $updated_files[$field] = $fileName;
                }
            }

            // Save the updated user info
            $user_info->save();

            // Redirect with a success message
            return redirect()->route('user.status', ['id' => $id])->with('success', 'อัปเดตข้อมูลผู้ใช้เรียบร้อยแล้ว');
        } else {
            // Redirect back with an error message if the user info was not found
            return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
        }
    }





    public function confirm_right(Request $request, $id)
    {
        $data_for_update = $request->validate([
            'confirm_right' => 'required',
        ]);

        $user_result = UserResult::join('user_infos', 'user_results.info_id', '=', 'user_infos.id')
            ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
            ->select('user_results.*', 'user_infos.*', 'user_statuses.*')
            ->where('user_results.id', $id)
            ->orderBy('user_results.id', 'desc') // ระบุชัดเจนว่าใช้ id จากตาราง user_results
            ->first();

        if ($user_result) {
            $user_result->confirm_right = $request->confirm_right;
            $user_result->save();

            if ($request->confirm_right == 1) {
                $updated = UserStatus::where('info_id', $user_result->info_id)
                    ->update(['status' => 'pass']);

                if ($updated) {
                    return redirect()->back()->with('success', 'ผ่าน');
                } else {
                    return redirect()->back()->with('error', 'ไม่สามารถอัปเดตสถานะได้');
                }
            } else {
                return redirect()->back()->with('error', 'ไม่ผ่าน');
            }
        } else {
            return redirect()->back()->with('error', 'User status not found.');
        }
    }
    public function change(){
        return view('/user/change');
    }
    
    public function updateName(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
    ]);

    $user = Auth::user();
    $user->name = $request->input('name');
    $user->surname = $request->input('lastname');
    $user->save();

    return redirect()->back()->with('success', 'Name and Lastname updated successfully.');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:8|confirmed', // ยืนยันรหัสผ่าน
    ]);

    $user = Auth::user();
    $user->password = bcrypt($request->input('password')); // เข้ารหัสผ่านใหม่
$user->save();
    return redirect()->back()->with('success', 'Password updated successfully.');
}

}
