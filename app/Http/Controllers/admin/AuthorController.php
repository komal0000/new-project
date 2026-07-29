<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index()
    {
        return view('admin.author.index');
    }

    public function list()
    {
        $authors = DB::table('authors')->get(['name', 'link', 'designation', 'organization', 'id']);

        return response()->json($authors);
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.author.add');
        } else {
            $author = new Author();
            $author->name = $request->name;
            $author->link = $request->link ?? '';
            $author->designation = $request->designation ?? '';
            $author->organization = $request->organization ?? '';
            $author->save();
            if ($request->filled('json')) {
                return response()->json($author);
            } else {

                return redirect()->back()->with('success', 'successfully added');
            }
        }
    }

    public function edit(Request $request, $author_id)
    {
        $author = Author::where('id', $author_id)->first();
        if ($request->getMethod() == 'GET') {
            return view('admin.author.edit', compact('author'));
        } else {
            $author->name = $request->name;
            $author->link = $request->link ?? '';
            $author->designation = $request->designation ?? '';
            $author->organization = $request->organization ?? '';
            $author->save();
        }
        $c = new BookController();
        $c->render();

        return redirect()->back()->with('success', 'successfully updated');
    }

    public function del($author_id)
    {
        Author::where('id', $author_id)->delete();
        $c = new BookController();
        $c->render();

        return redirect()->back()->with('success', 'successfully deleted');
    }
}
