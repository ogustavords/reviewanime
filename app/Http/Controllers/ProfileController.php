<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // mostra o perfil do usuário
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // edita perfil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // atualiza perfil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email'));

        return redirect()->route('perfil.show')->with('success', 'Perfil atualizado com sucesso!');
    }
}
