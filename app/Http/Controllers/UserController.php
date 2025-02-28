<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function create()
    {
        return view('users.register');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'prefixname' => 'nullable|string|max:10',
            'avatar' => 'nullable|string',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'prefixname' => $request->prefixname,
            'avatar' => $request->avatar ?? 'default-avatar.png',
        ]);

        return redirect()->route('users.index', $user->id)->with('success', 'User registered successfully');
    }

   
    public function index()
    {
        $users = User::with('details')->get()->map(function ($user) {
            $formattedDetails = $user->details->pluck('value', 'key')->toArray();

            return [
                'id' => $user->id,
                'avatar' => $user->avatar,
                'email' => $user->email,
                'phone' => $user->phone,
                'birthdate' => $user->birthdate,
                'gender' => $user->gender,
                'details' => $formattedDetails,
            ];
        });
        return view('users.index', compact('users'));
    }
}
