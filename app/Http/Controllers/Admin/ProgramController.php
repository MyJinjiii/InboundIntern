<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\budget_year;
use App\Models\BudgetYear;
use App\Models\research_comment;
use Illuminate\Http\Request;
use App\Models\research_list;
use App\Models\ResearchList;
use Carbon\Carbon;

class ProgramController extends Controller
{
    public function index()
    {
        $research_list = ResearchList::orderBy('id', 'asc')
        ->where('approve',1)
        ->paginate(10);     
           return view('admin.allprogram', compact('research_list'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'division' => 'required',
            'program' => 'required',
            'prof_name' => 'required',
            'short' => 'required',
            'topic' => 'required',
            'support' => 'required',
            'details' => 'required',
        ]);

        $currentDate = Carbon::now();
        $budgetYear = BudgetYear::where('date_start', '<=', $currentDate)
            ->where('date_end', '>=', $currentDate)
            ->first();
        
        if ($budgetYear) {
            $data['advisor_id'] = auth()->id();
            $data['year_id'] = $budgetYear->id;
            $data['approve'] = 1;
        } else {
            return redirect()->route('allprogram')->with('error', 'Could not determine the budget year.');
        }

        $research = ResearchList::create($data);

        if ($research) {
            return redirect()->route('allprogram')->with('success', 'Success');
        } else {
            return redirect()->route('allprogram')->with('error', 'Error');
        }
    }

    public function updateapprove(Request $request, $id){
        $program = ResearchList::find($id);
        $data = $request->validate([
            'approve' => 'required', 
        ]);
        $program->approve = $request->input('approve');
        $program->save();
        return redirect()->back()->with('success', 'Research updated successfully.');
    }

    public function updatenotapprove(Request $request, $id) {
        $program = ResearchList::findOrFail($id); // ใช้ findOrFail เพื่อเพิ่มความปลอดภัย
        $data = $request->validate([
            'approve' => 'required',
            'comment' => 'required'
        ]);
    
        // สร้างบันทึกในตาราง research_comment
        research_comment::create([
            'research_id' => $program->id,
            'comment' => $request->comment
        ]);
    
        // อัพเดทค่าการอนุมัติในตาราง ResearchList
        $program->approve = $request->input('approve');
        $program->save();
    
        return redirect()->back()->with('success', 'Research updated successfully.');
    }
    
    public function destroy($id)
    {
        // ลบข้อมูลใน research_comments ก่อน
        research_comment::where('research_id', $id)->delete();
    
        // ลบข้อมูลใน research_lists
        $research = ResearchList::findOrFail($id);
        $research->delete();
        
        return redirect()->back()->with('success', 'Program deleted successfully');
    }
    
    

    public function approve(){
        $research_list = ResearchList::orderBy('id', 'asc')
        ->where('approve',0)
        ->paginate(5);
        return view('admin.approve', compact('research_list'));
    }

}
