<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLogin()
    {
        return view('pages.samples.login');
    }

    // Traite la connexion
    public function login(Request $request)
    {
        // Validation des champs avec gestion d'erreurs distinctes
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ], [
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse e-mail valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
        ]);

        $credentials = $request->only('email', 'password');

        // Vérifier si l'utilisateur existe
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Aucun compte trouvé avec cette adresse e-mail.'])->withInput();
        }

        // Vérifier le mot de passe
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => 'Le mot de passe est incorrect.'])->withInput();
        }

        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('index');
            } else {
                return redirect()->route('ventes.create');
            }
        }

        return back()->withErrors(['email' => 'Erreur lors de la connexion.'])->withInput();
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
