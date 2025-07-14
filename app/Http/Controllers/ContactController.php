<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactReceivedMail;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.form');
    }

    public function submit(ContactRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            Contact::create($validated);

            DB::commit();

            // 自動返信メール送信
            Mail::to($validated['email'])->send(new ContactReceivedMail($validated));
            
            return redirect()->route('contact.thanks');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('お問い合わせ登録エラー', ['error' => $e->getMessage()]);
            return back()->withErrors('送信に失敗しました。もう一度お試しください。');
        }
    }

    public function thanks() 
    {
        return view('contact.thanks');
    }
}