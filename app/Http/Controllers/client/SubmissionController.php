<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = DB::table('submissions')->where('canceled', 0)->where('user_id', Auth::id())->get(['id', 'title', 'status', 'description', 'file_id']);

        return view('client.submission.index', compact('submissions'));
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('client.submission.add');
        } else {

            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            ]);

            $file = new File();
            $file->path = $request->file('file')->store('', 'sub');
            $file->user_id = Auth::id();
            $file->save();

            $submission = new Submission();
            $submission->title = $request->title;
            $submission->description = $request->description;
            $submission->file = '';
            $submission->file_id = $file->id;
            $submission->status = 0;
            $submission->user_id = Auth::id();
            $submission->save();
        }

        return redirect()->back()->with('success', 'successfully added');
    }

    public function edit(Request $request, $id)
    {
        $submission = Submission::where('id', $id)->first();
        if ($submission == null) {
            abort(404);
        }
        if ($request->getMethod() == 'GET') {
            return view('client.submission.edit', compact('submission'));
        } else {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'file' => 'file|mimes:pdf',
            ]);

            $submission->title = $request->title;
            $submission->description = $request->description;

            if ($request->hasFile('file')) {
                $file = File::where('id', $submission->file_id)->first();
                if ($file == null) {
                    $file = new File();
                    $file->user_id = Auth::id();
                }
                $file->path = $request->file('file')->store('', 'sub');
                $file->save();
                $submission->file_id = $file->id;
            }
            $submission->save();
        }

        return redirect()->back()->with('success', 'successfully updated');
    }

    public function del($id)
    {
        $submission = Submission::where('id', $id)->where('canceled', 0)->first();
        if ($submission == null) {
            abort(404);
        }
        if ($submission->status > 2) {
            return redirect()->route('client.submission.index')->with('error', 'The document  '.submissionStatusMsg()[$submission->status].' and cannot be delete.');

        }
        Submission::where('id', $id)->update(['canceled' => 1]);

        return redirect()->route('client.submission.index')->with('success', 'successfully deleted');
    }
}
