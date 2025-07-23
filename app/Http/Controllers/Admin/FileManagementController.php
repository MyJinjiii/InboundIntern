<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tb_coverIMG;
use App\Models\full_ann;
use App\Models\final_ann;
use App\Models\FinalAnns;
use App\Models\FullAnns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagementController extends Controller
{
    public function index()
    {
        $full_ann = FullAnns::first();
        $final = FinalAnns::first();
      
        return view('admin.announcement', compact('full_ann', 'final'));
    }





    public function full_ann(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        // Delete the old file if it exists
        $existingFullAnn = FullAnns::first();
        if ($existingFullAnn) {
            Storage::delete('uploads/FileManagement\full_announcement' . $existingFullAnn->file);
            $existingFullAnn->delete();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/FileManagement\full_announcement', $fileName, 'public');

            // บันทึกข้อมูลลงในฐานข้อมูล
            $data['file'] = $fileName;
            $fullAnn = FullAnns::create($data);
        }

        return redirect()->route('ann')->with('success', 'อัพเดทประกาศทั้งหมดเรียบร้อยแล้ว');
    }




    public function final_ann(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $existingFullAnn = FinalAnns::first();
        if ($existingFullAnn) {
            Storage::delete('uploads/FileManagement/final_announcement' . $existingFullAnn->file);
            $existingFullAnn->delete();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/FileManagement/final_announcement', $fileName, 'public');


            $data['file'] = $fileName;
            $fullAnn = FinalAnns::create($data);
        }

        return redirect()->route('ann')->with('success', 'อัพเดทประกาศทั้งหมดเรียบร้อยแล้ว');
    }
    public function full_ann_delete($id)
    {
        $full_ann = FullAnns::findOrFail($id);
    
        // ลบไฟล์จาก storage
        Storage::disk('public')->delete('uploads/FileManagement/full_announcement/' . $full_ann->file);
    
        // ลบข้อมูลจากฐานข้อมูล
        $full_ann->delete();
    
        return redirect()->back()->with('success', 'Data has been deleted successfully.');
    }
    
    public function final_ann_delete($id)
    {
        $final = FinalAnns::findOrFail($id);
    
        // ลบไฟล์จาก storage
        Storage::disk('public')->delete('uploads/FileManagement/final_announcement/' . $final->file);
    
        // ลบข้อมูลจากฐานข้อมูล
        $final->delete();
    
        return redirect()->back()->with('success', 'Data has been deleted successfully.');
    }
}
