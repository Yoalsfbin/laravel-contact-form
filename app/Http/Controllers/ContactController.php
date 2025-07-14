<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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