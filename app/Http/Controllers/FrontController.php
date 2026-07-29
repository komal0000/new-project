<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function login()
    {
        return view('front.login.index');
    }

    public function about()
    {
        return view('front.aboutus.index');
    }

    public function articleSingle($article_id)
    {

        return view('front.article.single.index', compact('article_id'));
    }

    public function policy()
    {
        return view('front.policy.index');
    }

    public function contact(Request $request)
    {
        if ($request->getMethod() == 'POST') {

        } else {

            return view('front.contact.index');
        }
    }

    public function register(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('front.register.index');
        } else {
            $request->validate([
                'name' => 'required|string',
                'country' => 'required|string',
                'affiliation' => 'required|string',
                'agree' => 'accepted',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = 1;
            $user->save();

            $client = new Client();
            $client->user_id = $user->id;
            $client->name = $request->name;
            $client->country = $request->country;
            $client->affiliation = $request->affiliation;
            $client->save();

            Auth::user($user);

            return redirect()->route('front.login')->with('success', 'Successfully Registered');
        }
    }

    public function submission()
    {
        return view('front.guidelines.index');
    }

    public function archiveIssue()
    {
        return view('front.issue.archive.index');
    }

    public function bookSingle($book_id)
    {
        return view('front.issue.archive.single.index', compact('book_id'));
    }

    public function team()
    {

        return view('front.team.index');
    }

    public function message($slug)
    {
        $filename = str_replace('-', '_', $slug);

        return view('front.message.index', compact('filename'));

    }
}
