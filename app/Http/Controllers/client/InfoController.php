<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InfoController extends Controller
{
    public function password(Request $request)
    {
        if (isGet()) {
            return view('client.profile.password');
        } else {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            // Check if the current password matches
            if (! Hash::check($request->current_password, Auth::user()->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user = Auth::user();
            $user->password = bcrypt($request->new_password);
            $user->save();

            return back()->with('success', 'Password changed successfully');

        }
    }

    public function index(Request $request)
    {

        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->first();
        if ($request->getMethod() == 'GET') {
            return view('client.profile.index', compact('client', 'user'));
        } else {
            $request->validate([
                'password' => 'required|min:6',
                'name' => 'required|string|max:255',
            ]);

            $user->name = $request->name;
            $user->save();

            $client->name = $request->name;
            $client->country = $request->country;
            $client->affiliation = $request->affiliation;
            $client->save();

            return redirect()->back()->with('success', 'successfully updated');
        }
    }
}
