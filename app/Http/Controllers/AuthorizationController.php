<?php

namespace App\Http\Controllers;

use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AuthorizationConfirmation;

class AuthorizationController extends Controller
{
    public function index()
    {
        $authorization = Authorization::firstOrCreate(['user_id' => Auth::id()]);
        return view('authorizations.index', compact('authorization'));
    }

    public function update(Request $request)
    {
        $authorization = Authorization::where('user_id', Auth::id())->first();
        $authorization->update([
            'is_authorized' => $request->has('is_authorized'),
            'authorized_at' => $request->has('is_authorized') ? now() : null,
        ]);
    
        if ($request->has('is_authorized')) {
            $ownerName = Auth::user()->name;
            Auth::user()->notify(new AuthorizationConfirmation($ownerName));
        }
    
        return redirect()->back()->with('success', 'Authorization updated successfully!');
    }
    
}
