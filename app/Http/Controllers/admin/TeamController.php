<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function index()
    {
        return view('admin.team.index');
    }

    public function list()
    {
        $teams = DB::table('teams')->get(['id', 'title']);

        return response()->json($teams);
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.team.add');
        } else {
            $team = new Team();
            $team->title = $request->title;
            $team->desc = $request->desc;
            $team->save();
            self::render();

            return redirect()->back()->with('success', 'Succesfully Added');
        }
    }

    public function edit(Request $request, $team_id)
    {
        $team = Team::where('id', $team_id)->first();
        // dd($team);
        if ($request->getMethod() == 'GET') {
            return view('admin.team.edit', compact('team'));
        } else {
            $team->title = $request->title;
            $team->desc = $request->desc;
            $team->save();
        }
        self::render();

        return redirect()->back()->with('success', 'Succesfully updated');
    }

    public function del($team_id)
    {
        TeamMember::where('team_id', $team_id)->delete();
        Team::where('id', $team_id)->delete();
        self::render();

        return redirect()->back()->with('success', 'Succesfully deleted');
    }

    public static function render()
    {
        $teams = Team::all();
        file_put_contents(resource_path('views/front/cache/team.blade.php'), view('admin.templete.team', compact('teams'))->render());
    }
}
