<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

      public function showAdminRegistrationForm()
    {
        return view('usuario.create_admin');
    } 
    
      public function showUserView()
    {
        return view('dashboard.prueba');
    }  

    public function createAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::defaults()],
        ]);

        $admin = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return response()->json(['message' => 'Administrador creado correctamente', 'user' => $admin], 201);
    }

    /**
     * Crear un usuario normal.
     */
    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        return response()->json(['message' => 'Usuario creado correctamente', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                
                $user = Auth::user();
                
                return match($user->role) {
                    'admin' => redirect()->intended(route('/dashboard')),
                    'user' => redirect()->intended(route('/user_view')),
                    default => redirect('/home'),
                };
            }

            return back()->withErrors([
                'email' => 'Credenciales incorrectas o usuario no existe.',
            ])->onlyInput('email');

        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Ocurrió un error durante el login.',
            ])->onlyInput('email');
        }
    }

}
