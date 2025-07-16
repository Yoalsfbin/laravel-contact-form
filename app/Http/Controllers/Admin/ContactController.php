<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function replyForm($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.reply', compact('contact'));
    }

    public function sendReply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'reply_message' => 'required|string',
        ]);

        // ここでメール送信処理など
        Mail::raw($request->reply_message, function ($message) use ($contact) {
            $message->to($contact->email)
                    ->subject('お問い合わせへの返信');
        });

        return redirect()->route('admin.contacts.index')->with('success', '返信を送信しました。');
    }
    
}
