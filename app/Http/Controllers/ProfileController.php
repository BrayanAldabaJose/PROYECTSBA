<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Importación del modelo User

class ProfileController extends Controller
{


    public function show()
    {
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_photo_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_photo_path')) {
            $profilePhotoPath = $request->file('profile_photo_path')->store('profile-photos', 'public');
            $validatedData['profile_photo_path'] = $profilePhotoPath;
        }

        $user->update($validatedData);
        dd($validatedData);
        return redirect()->route('profile.show')->with('success', 'Perfil actualizado exitosamente.');
    }

    public function updatePasswordView()
    {
        return view('admin.profile.update-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Contraseña actualizada exitosamente.');
    }
}
