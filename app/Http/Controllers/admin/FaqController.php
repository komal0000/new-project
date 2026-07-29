<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::get();

        return view('admin.faq.index', compact('faqs'));
    }

    public function add(Request $request)
    {
        $faq = new Faq();
        $faq->title = $request->input('title');
        $faq->answer = $request->input('answer');
        $faq->save();
        $this->render();

        return redirect()->back()->with('message', 'Faq added successfully');

    }

    public function edit(Request $request, $faq_id)
    {
        $faq = Faq::where('id', $faq_id)->first();
        $faq->title = $request->input('title');
        $faq->answer = $request->input('answer');
        $faq->save();
        $this->render();

        return redirect()->back()->with('message', 'Faq updated successfully');

        // return redirect()->back()->with('success','successfully updated');

    }

    public function del($faq_id)
    {
        Faq::where('id', $faq_id)->delete();
        $this->render();

        return redirect()->back()->with('success', 'successfully deleted');
    }

    public function render()
    {
        $faqs = Faq::all();
        file_put_contents(resource_path('views/front/cache/faq.blade.php'), view('admin.templete.faq', compact('faqs'))->render());

    }
}
