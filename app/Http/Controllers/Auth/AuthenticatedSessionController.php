<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\user_info;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\BudgetYear;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();
    $user = $request->user();

    if ($user->user_type == 'superadmin') {
        return redirect()->intended(route('superadmintest', absolute: false));
    } elseif ($user->user_type == 'admin') {
        return redirect()->intended(route('admin.dashboard', absolute: false));
    } elseif ($user->user_type == 'advisor') {
        return redirect()->intended(route('Advisor.index', absolute: false));
    } elseif ($user->user_type == 'user') {
        // ตรวจสอบว่าผู้ใช้มีข้อมูลในฐานข้อมูลหรือไม่
        $userDataExists = UserInfo::where('user_id', $user->id)->first();
        if ($userDataExists) {
            // ตรวจสอบปีงบประมาณปัจจุบัน
            $currentDate = Carbon::now();
        
            $currentBudgetYear = BudgetYear::where('date_start', '<=', $currentDate)
                ->where('date_end', '>=', $currentDate)
                ->orderBy('id', 'desc')
                ->first();
            
            if ($currentBudgetYear) {
                if ($currentBudgetYear->date_end != '9999-12-31' && $userDataExists->created_at->between($currentBudgetYear->date_start, $currentBudgetYear->date_end)) {
                    return redirect()->intended(route('user.status', ['id' => $userDataExists->id], absolute: false))->with('success', 'You already registered for the current fiscal year!');
                } else {
                    return redirect()->intended(route('index', absolute: false))->with('error', 'No data for the current fiscal year.');
                }
            } else {
                return redirect()->intended(route('index', absolute: false))->with('error', 'No current budget year found.');
            }
        } else {
            // Redirect to index if no data exists
            return redirect()->intended(route('index', absolute: false));
        }
    //  } elseif ($user->user_type == 'user') {
    //         // ตรวจสอบว่าผู้ใช้มีข้อมูลในฐานข้อมูลหรือไม่
    //         $userDataExists = UserInfo::where('user_id', $user->id)->first();
            
    //         if ($userDataExists) {
    //             // ตรวจสอบปีงบประมาณปัจจุบัน
    //             $currentDate = Carbon::now();
        
    //             // ปีถัดไป
    //             $nextYearDate = $currentDate->copy()->addYear();
        
    //             // ตรวจสอบ BudgetYear ของปีถัดไป
    //             $nextBudgetYear = BudgetYear::where('date_start', '<=', $nextYearDate)
    //                 ->where('date_end', '>=', $nextYearDate)
    //                 ->first();
        
    //             // ถ้ามีข้อมูลในปีงบประมาณปัจจุบัน
    //             if ($nextBudgetYear && $userDataExists->created_at->between($nextBudgetYear->date_start, $nextBudgetYear->date_end)) {
    //                 return redirect()->intended(route('user.status', ['id' => $userDataExists->id], absolute: false))->with('success', 'You already registered for the next fiscal year!!');
    //             } else {
    //                 return redirect()->intended(route('index', absolute: false))->with('error', 'No data for the next fiscal year.');
    //             }
    //         } else {
    //             // Redirect to index if no data exists
    //             return redirect()->intended(route('index', absolute: false));
    //         }
        }
        
    
    
    return redirect()->intended(route('login', absolute: false));
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('');
    }
}
