<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
  
        public function index(){
            return view('auth.selection');
        }


    public function create(): View
    {
        return view('auth.register');
    }

  public function Advisor_create(): View
    {
        return view('advisor.Register_advisor');
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:5'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'title' => $request->title,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'user_type'=> 'user',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('index', absolute: false));
    }
    public function advisor_store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $advisor = User::create([
            'title' => $request->title,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'user_type'=> 'advisor',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($advisor));

        Auth::login($advisor);

        return redirect(route('Advisor.index', absolute: false));
    }
}
