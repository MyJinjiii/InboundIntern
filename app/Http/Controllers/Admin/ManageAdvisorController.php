<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchList;
use App\Models\User; // Correctly import the User model
use Illuminate\Http\Request;

class ManageAdvisorController extends Controller
{
    public function index()
{
    $advisors = User::where('user_type', 'advisor')
                    ->orderBy('id', 'asc')
                    ->paginate(10);

    // เพื่อให้ได้รายการวิจัยของแต่ละ advisor ให้ใช้ foreach เพื่อ loop ผ่าน $advisors
    foreach ($advisors as $advisor) {
        // ดึงข้อมูล ResearchList โดยใช้ where เพื่อเลือกเฉพาะ advisor_id ที่ตรงกับ $advisor->id
        $research_list = ResearchList::where('advisor_id', $advisor->id)
                                    ->orderBy('id', 'asc')
                                    ->paginate(10);

        // เพิ่ม $research_list เป็น property ของ $advisor
        $advisor->research_list = $research_list;
    }
    return view('admin.advisor', compact('advisors'));
}

}
