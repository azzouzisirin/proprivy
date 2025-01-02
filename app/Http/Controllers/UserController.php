<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function manageUsers(Request $request)
    {
        // Logique pour gérer les utilisateurs, par exemple, afficher ou modifier les utilisateurs
        return response()->json(['message' => 'Gestion des utilisateurs']);
    }
}
