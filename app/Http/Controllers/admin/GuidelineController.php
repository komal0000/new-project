<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Guideline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuidelineController extends Controller
{
    public function index()
    {
        return view('admin.guideline.index');
    }

    public function list()
    {
        $guidelines = DB::table('guidelines')->get(['id', 'title']);

        return response()->json($guidelines);
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.guideline.add');
        } else {
            $guideline = new Guideline();
            $guideline->title = $request->title;
            $guideline->description = $request->description;
            $guideline->save();
            self::cache();

            return redirect()->back()->with('success', 'successfully added');
        }

    }

    public function edit(Request $request, $guideline_id)
    {
        $guideline = Guideline::where('id', $guideline_id)->first();
        if ($request->getMethod() == 'GET') {
            return view('admin.guideline.edit', compact('guideline'));
        } else {
            $guideline->title = $request->title;
            $guideline->description = $request->description;
            $guideline->save();
            self::cache();

            return redirect()->back()->with('success', 'successfully updated');
        }

    }

    public function del($guideline_id)
    {
        Guideline::where('id', $guideline_id)->delete();
        self::cache();

        return redirect()->back()->with('success', 'successfully updated');
    }

    public static function cache()
    {
        $guidelines = Guideline::get();
        file_put_contents(resource_path('views/front/cache/guidelines.blade.php'), view('admin.templete.guidelines', compact('guidelines'))->render());

    }
}
