<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = DB::table('submissions')
            ->join('clients', 'clients.user_id', '=', 'submissions.user_id')
            ->join('files', 'files.id', '=', 'submissions.file_id')
            ->select(
                'submissions.id',
                'submissions.user_id as uid',
                'submissions.title as t',
                'submissions.status as s',
                'submissions.description as d',
                'submissions.file_id as f',
                'submissions.created_at as c',
                'submissions.updated_at as u',
                'clients.name as n',
                'clients.affiliation as a',
                'files.path as p',
            )
            ->get();

        return view('admin.submission.index', compact('submissions'));
    }

    public function list()
    {
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.submission.add');
        } else {
            $submission = new Submission();
            // $submission->user_id = $request->user_id;
            $submission->title = $request->title;
            $submission->description = $request->description;
            $submission->file = $request->file('file')->store('', 'sub');
            $submission->status = $request->status;
            $submission->save();
        }

        return redirect()->back()->with('success', 'successfully added');
    }

    public function edit(Request $request)
    {
        Submission::where('id', $request->id)->update(['status' => $request->status]);
    }

    // public function del($sub_id)
    // {
    //     Submission::where('id', $sub_id)->delete();
    //     return redirect()->back()->with('success', 'successfully deleted');
    // }
}
