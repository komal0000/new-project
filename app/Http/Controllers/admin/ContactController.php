<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::first();
        $contactSetting = Setting::where('type', Setting::TYPE_CONTACT)->first();

        if ($request->isMethod('get')) {
            return view('admin.setting.contact.index', compact('contact', 'contactSetting'));
        } else {
            if ($contact == null) {
                $contact = new Contact();
            }
            $contact->name = $request->input('cname');
            $contact->address = $request->input('address');
            $contact->phone = $request->input('phone');
            $contact->po_box = $request->input('po_box');
            $contact->email = $request->input('email');
            $contact->save();

            if ($contactSetting == null) {
                $contactSetting = new Setting();
                $contactSetting->type = Setting::TYPE_CONTACT;
            }
            $contactSetting->data = $request->input('contact_info');
            $contactSetting->save();

            $this->render();
        }
    }

    public function render()
    {
        $contact = Contact::first();
        $contactSetting = Setting::where('type', Setting::TYPE_CONTACT)->first();
        file_put_contents(resource_path('views/front/cache/contact.blade.php'), view('admin.templete.contact', compact('contact', 'contactSetting'))->render());
        file_put_contents(resource_path('views/front/cache/contact_footer.blade.php'), view('admin.templete.contact_footer', compact('contact'))->render());
    }
}
