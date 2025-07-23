<?php

namespace App\Http\Controllers\Advisor;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\budget_year;
use App\Models\BudgetYear;
use App\Models\research_comment;
use App\Models\research_list;
use App\Models\ResearchList;
use App\Models\user_info;
use App\Models\UserInfo;
use App\Models\UserResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvisorController extends Controller
{
    public function index()
    {

         $current = Carbon::now(); // ปีปัจจุบัน
        
    $research_list = ResearchList::join('budget_years', 'research_lists.year_id', '=', 'budget_years.id')
        ->where('research_lists.advisor_id', auth()->id())
        ->where('budget_years.date_start', '<>',$current) 
        ->where('budget_years.date_end', '=', '9999-12-31')
        ->orderBy('research_lists.id', 'desc')
        ->select('research_lists.*') // ระบุว่าต้องการข้อมูลจาก research_lists
        ->distinct()
        ->paginate(5);
        $comments = [];
        foreach ($research_list as $research) {
            $comments[$research->id] = research_comment::where('research_id', $research->id)
                ->orderBy('id', 'desc')
                ->first();  
        }
        return view('Advisor.index_advisor', compact('research_list', 'comments'));
    }
    


    public function create()
    {
        return view("Advisor.form_advisor");
    }
    public function store(Request $request)
    {
        $messages = [
            'division.required' => 'กรุณากรอก division',
            'program.required' => 'กรุณากรอก program',
            'prof_name.required' => 'กรุณากรอก prof name',
            'short.required' => 'กรุณากรอก short',
            'topic.required' => 'กรุณากรอก topic',
        ];

        $data = $request->validate([
            'division' => 'required',
            'program' => 'required',
            'prof_name' => 'required',
            'short' => 'required',
            'topic' => 'required',
            'support' => 'nullable',
            'details' => 'nullable',
        ], $messages);

        $currentDate = Carbon::now();
        $budgetYear = BudgetYear::where('date_start', '<=', $currentDate)
            ->where('date_end', '>=', $currentDate)
            ->first();


        if ($budgetYear) {
            $data['advisor_id'] = auth()->id();
            $data['year_id'] = $budgetYear->id;
            $data['approve'] = 0;
        } else {
            return redirect()->route('Advisor.index')->with('error', 'Could not determine the budget year.');
        }

        $research = ResearchList::create($data);
        if ($research) {
            return redirect()->route('Advisor.index')->with('success', 'success แล้วรอ admin approve ');
        } else {
            return redirect()->route('Advisor.form')->with('error', 'error');
        }
    }

    public function show()
    {
        $current = Carbon::now();

        $budgetYear = BudgetYear::orderBy('id', 'desc')
            ->first();

        // $dateStart = $budgetYear ? $budgetYear->date_start : Carbon::now()->startOfYear(); // กำหนดค่าเริ่มต้นเป็นวันที่เริ่มต้นของปีนี้

        $research_list = ResearchList::orderBy('id', 'desc')
            ->where('approve', 1)
            ->where('year_id', $budgetYear->id)
            ->get();
            $topic = ResearchList::where('advisor_id', auth()->id())
            ->orderBy('id','desc')
            ->first(); // ค้นหา topic ที่มี advisor_id เท่ากับ id ของผู้ใช้ที่ล็อกอินอยู่

           

        if ($research_list) {
            $user_info_Advisor = DB::table('user_infos')
                ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
                ->leftJoin('user_results', 'user_infos.id', '=', 'user_results.info_id')
                ->whereIn('user_statuses.status', ['in progression','pass','not pass'])
                ->where('user_infos.scholarship', 1) // ใช้ตัวกรองทุนการศึกษา
                ->where('user_infos.topic_id', $topic->id) // กรองข้อมูลโดยใช้ topic_id
                ->whereIn('user_infos.topic_id', $research_list->pluck('id')) // ตรวจสอบว่า topic_id อยู่ในรายการการวิจัย
                ->orderBy('user_infos.id', 'asc')
                ->select('user_infos.*', 'user_statuses.*', 'user_results.*')
                ->paginate(5);

            $budget = BudgetYear::orderBy('id', 'desc')
                ->first();

            return view('advisor.scholarship_advisor', compact('user_info_Advisor', 'budget'));
        } else {
            return redirect()->route('Advisor.index')->with('error', 'ไม่พบข้อมูลที่ตรงกับเงื่อนไข'); // ถ้าไม่พบ topic ที่เกี่ยวข้องกับผู้ใช้ที่ล็อกอินอยู่
        }
    }

    public function updateprogram(Request $request, $id)
    {
        $research = ResearchList::findOrFail($id);
        $research->division = $request->input('division');
        $research->program = $request->input('program');
        $research->prof_name = $request->input('prof_name');
        $research->short = $request->input('short');
        $research->topic = $request->input('topic');
        $research->support = $request->input('support');
        $research->details = $request->input('details');
        $research->approve = 0;
        $research->save();
        return redirect()->back()->with('success', 'Program updated successfully');
    }

    public function update(Request $request, $info_id)
    {



        $data = $request->validate([
            'interview_result' => 'required',
        ]);

        // Find user result
        $user_result = UserResult::join('user_infos', 'user_results.info_id', '=', 'user_infos.id')
            ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
            ->select('user_results.*', 'user_infos.*', 'user_statuses.*')
            ->where('user_results.id', $info_id)
            ->first();

        if ($user_result) {
            // Update interview result
            $user_result->interview_result = $request->interview_result;
            $user_result->save();

            // Update other users in the same research topic
            if ($request->interview_result == 1) {
                UserResult::join('user_infos', 'user_results.info_id', '=', 'user_infos.id')
                    ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
                    ->where('user_infos.topic_id', $user_result->topic_id)
                    ->where('user_results.id', '!=', $user_result->id)
                    ->update([
                        'user_results.interview_result' => 2,
                        'user_statuses.status' => 'not pass'
                    ]);

                return redirect()->back()->with('success', 'Pass');
            } else {
                return redirect()->back()->with('error', "Did not pass");
            }
        } else {
            return redirect()->back()->with('error', 'User status not found.');
        }
    }
}
