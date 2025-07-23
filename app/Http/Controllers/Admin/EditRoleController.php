<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EditRoleController extends Controller
{
    public function index()
    {
        $user = User::all(); 
        return view('admin.editrole', compact('user')); 
    }
    public function updateUserType(Request $request, $id)
{
    $user = User::find($id); // ดึงข้อมูล User ตาม ID ที่ส่งมาใน URL
    if (!$user) {
        return redirect()->back()->with('error', 'User not found!');
    }

    $userTypes = $request->input('user_type'); // รับข้อมูล user_types จากฟอร์ม

   
        $userToUpdate = User::find($user->id);
        if ($userToUpdate) {
            $userToUpdate->user_type = $userTypes; // อัปเดตประเภทผู้ใช้งาน
            $userToUpdate->save();
        }
    

    return redirect()->back()->with('success', 'User types updated successfully!');
}
public function deleteUser($id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }

    $user->delete();

    return redirect()->back()->with('success', 'User deleted successfully');
}

}
