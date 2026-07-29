<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BoardMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardMessageController extends Controller
{
    //

    public function index()
    {
        $messages = DB::table('board_messages')->get(['id', 'image', 'title']);

        return view('admin.message.index', compact('messages'));
    }

    public function add(Request $request)
    {
        if (isGet()) {
            return view('admin.message.add');

        } else {
            $message = new BoardMessage();
            $message->title = $request->title;
            $message->slug = $this->getSlug('board_messages', $request->title, null);

            $message->desc = $request->desc;
            $message->image = $request->image->store('uploads\image');
            $message->save();
            $this->render();

            return redirect()->back()->with('success', 'Message Added Successfully');
        }
    }

    public function edit(Request $request, $id)
    {
        $message = BoardMessage::where('id', $id)->first();
        if (isGet()) {
            return view('admin.message.edit', compact('message'));

        } else {
            $message->title = $request->title;
            $message->slug = $this->getSlug('board_messages', $request->title, $message->id);
            $message->desc = $request->desc;
            if ($request->hasFile('image')) {
                $message->image = $request->image->store('uploads\image');
            }
            $message->save();
            $this->render();

            return redirect()->back()->with('success', 'Message Updated Successfully');
        }
    }

    public function del(Request $request, $id)
    {
        BoardMessage::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Message Deleted Successfully');

    }

    public function getSlug($table, $text, $id)
    {
        $increment = 1;
        $slug = str($text)->slug();
        $originalSlug = $slug;
        if ($id == null) {
            while (DB::table($table)->where('slug', $slug)->count() > 0) {
                $slug .= $originalSlug.'-'.$increment;
                $increment += 1;
            }
        } else {
            while (DB::table($table)->where('id', '<>', $id)->where('slug', $slug)->count() > 0) {
                $slug .= $slug.'-'.$increment;
                $increment += 1;
            }
        }

        return $slug;

    }

    public function render()
    {
        $messages = DB::table('board_messages')->get();
        file_put_contents(resource_path('views/front/cache/more.blade.php'), view('admin.templete.message.more', compact('messages'))->render());
        foreach ($messages as $key => $message) {
            $filename = str_replace('-', '_', $message->slug);
            file_put_contents(resource_path('views/front/cache/message_'.$filename.'.blade.php'), view('admin.templete.message.single', compact('message'))->render());
            file_put_contents(resource_path('views/front/cache/message_title_'.$filename.'.blade.php'), view('admin.templete.message.title', compact('message'))->render());
        }

    }
}
