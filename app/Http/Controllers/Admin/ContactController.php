<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * お問い合わせ一覧画面表示
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $keyword = $request->input('keyword');

        $contacts = Contact::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('subject', 'like', "%{$keyword}%")
                    ->orWhere('message', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.contacts.index', compact('contacts', 'keyword'));
    }


    /**
     * お問い合わせ返信画面表示
     *
     * @param int $id
     * @return View
     */
    public function replyForm(int $id): View
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.reply', compact('contact'));
    }

    /**
     * お問い合わせ返信処理
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function sendReply(Request $request, int $id): RedirectResponse
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
