<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetYear;
use App\Models\edit;
use App\Models\TbCoverimg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $current = Carbon::now();
      

        $edit = BudgetYear::latest()->first();
        $cover = TbCoverimg::orderBy('id')->paginate(5);
        $currentYear = Carbon::now()->year;

      
        if ($edit) {
            $roundNumber = explode('/', $edit->year)[0];
            
        } else {
            $roundNumber = '0';
        }
        return view('admin.setting', compact('edit', 'cover', 'currentYear','roundNumber','current'));
    }

    public function cover(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/FileManagement/cover', $fileName, 'public');




            $data['image'] = $fileName;
            $data['is_active'] = '1';

            $cover = TbCoverimg::create($data);
            return redirect()->route('setting')->with('success', 'File uploaded successfully.');
        } else {
            return redirect()->route('setting')->with('error', 'File upload failed.');
        }
    }







    public function destroy($id)
    {
        $cover = TbCoverimg::findOrFail($id);


        if ($cover->image) {
            Storage::disk('public')->delete('uploads/FileManagement/cover/' . $cover->image);
        }

        $cover->delete();

        return redirect()->back()->with('success', 'Cover deleted successfully');
    }

    public function updateRegisStatus(Request $request, $id)
    {
      
        $request->validate([
            'edit' => 'required|boolean',
        ]);

        $edit = BudgetYear::findOrFail($id);
        $edit->regis_status = $request->input('edit');
        $edit->save();

        return redirect()->back()->with('success', 'Registration status updated successfully.');
    }
    public function updateEditStatus(Request $request, $id)
    {
        $request->validate([
            'edit' => 'required|boolean',
        ]);

        $edit = BudgetYear::findOrFail($id);
        $edit->edit_status = $request->input('edit');
        $edit->save();

        return redirect()->back()->with('success', 'Edit status updated successfully.');
    }

    // อัปเดตสถานะการยืนยัน
    public function updateConfirmStatus(Request $request, $id)
    {
        $request->validate([
            'edit' => 'required|boolean',
        ]);

        $edit = BudgetYear::findOrFail($id);
        $edit->confirm_status = $request->input('edit');
        $edit->save();

        return redirect()->back()->with('success', 'Confirm status updated successfully.');
    }

    public function updatedateend(Request $request, $id)
    {
        // Validate the request if needed
        $request->validate([
            'edit' => 'required|in:0',
        ]);

      
        DB::table('budget_years')
            ->where('id', $id)
            ->update(['date_end' => Carbon::now()]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Round ended successfully.');
    }

    public function round(Request $request)
    {
        $data = $request->validate([
            'year' => 'required',
            'round' => 'required',
            'date_start' => 'required',
        ]);

        $record = new BudgetYear();
        $record->year = $data['round'] . '/' . $data['year']; 
        $record->date_start = $data['date_start'];
        $record->date_end = '9999-12-31';
        $record->regis_status= '1';
        $record->edit_status= '1';
        $record->confirm_status='1' ;

        $record->save();


        return redirect()->back()->with('success_edit', 'Record updated successfully.');
    }
}
