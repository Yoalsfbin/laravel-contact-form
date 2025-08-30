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
        $keyword        = $request->input('keyword');
        $from_date      = $request->input('from_date');
        $to_date        = $request->input('to_date');
        $sort_column    = $request->input('sort_column', 'created_at');
        $sort_direction = $request->input('sort_direction', 'desc');

        $allowedColumns = ['name', 'email', 'subject', 'message', 'created_at'];

        $contacts = Contact::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhere('subject', 'like', "%{$keyword}%")
                        ->orWhere('message', 'like', "%{$keyword}%");
                });
            })
            ->when($from_date, fn($query) => $query->whereDate('created_at', '>=', $from_date))
            ->when($to_date, fn($query) => $query->whereDate('created_at', '<=', $to_date))
            ->when(in_array($sort_column, $allowedColumns), function ($query) use ($sort_column, $sort_direction) {
                $query->orderBy($sort_column, $sort_direction)
                    ->orderBy('name', 'asc');
            }, function ($query) {
                $query->orderBy('created_at', 'desc')
                    ->orderBy('name', 'asc');
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.contacts.index', compact(
            'contacts',
            'keyword',
            'from_date',
            'to_date',
            'sort_column',
            'sort_direction'
        ));
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
