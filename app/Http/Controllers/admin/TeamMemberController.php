<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamMemberController extends Controller
{
    public function index($team_id)
    {
        $team = Team::where('id', $team_id)->first();

        return view('admin.team_member.index', compact('team'));
    }

    public function list($team_id)
    {
        $team_members = DB::table('team_members')
            ->where('team_id', $team_id)
            ->select('id', 'name', 'email', 'designation', 'address', 'phone', 'team_id')
            ->get();

        return response()->json($team_members);
    }

    public function add(Request $request, $team_id)
    {
        $team = Team::where('id', $team_id)->first();
        if ($request->getMethod() == 'GET') {
            return view('admin.team_member.add', compact('team'));
        } else {
            $team_member = new TeamMember();
            $team_member->team_id = $team->id;
            $team_member->name = $request->name;
            $team_member->team_designation = $request->team_designation;
            $team_member->designation = $request->designation;
            $team_member->organization = $request->organization;
            $team_member->address = $request->address;
            $team_member->detail = $request->detail;
            $team_member->phone = $request->phone;
            $team_member->email = $request->email;
            $team_member->save();
            TeamController::render();

            return redirect()->back()->with('success', 'successfully added');
        }
    }

    public function edit(Request $request, $team_id, $team_member_id)
    {
        $team = Team::where('id', $team_id)->first();
        $team_member = TeamMember::where('id', $team_member_id)->first();
        if ($request->getMethod() == 'GET') {
            return view('admin.team_member.edit', compact('team_member', 'team'));
        } else {
            $team_member->team_id = $team->id;
            $team_member->name = $request->name;
            $team_member->team_designation = $request->team_designation;
            $team_member->designation = $request->designation;
            $team_member->organization = $request->organization;
            $team_member->address = $request->address;
            $team_member->detail = $request->detail;
            $team_member->phone = $request->phone;
            $team_member->email = $request->email;
            $team_member->save();
            TeamController::render();

            return redirect()->back()->with('success', 'successfully updated');
        }
    }

    public function del($team_member_id)
    {
        TeamMember::where('id', $team_member_id)->delete();
        TeamController::render();

        return redirect()->back()->with('success', 'successfully deleted');
    }
}
