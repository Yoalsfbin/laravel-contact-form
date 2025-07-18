<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactExportController extends Controller
{
    /**
     * csv出力画面表示
     *
     * @return void
     */
    public function show()
    {
        return view('admin.contacts.export');
    }

    /**
     * お問い合わせcsv出力処理
     *
     * @param Request $request
     * @return StreamedResponse
     */
    public function export(Request $request): StreamedResponse
    {
        $query = Contact::query();

        $sort_column    = $request->input('sort_column', 'created_at'); // デフォルト: 送信日時
        $sort_direction = $request->input('sort_direction', 'desc');    // デフォルト: 降順

        $allowedColumns = ['name', 'email', 'subject', 'message', 'created_at'];

        if ($request->filled('name')) {
            $query->Where('name', 'like', "%{$request->name}%");
        }

        if ($request->filled('email')) {
            $query->Where('email', 'like', "%{$request->email}%");
        }

        if ($request->filled('subject')) {
            $query->Where('subject', 'like', "%{$request->subject}%");
        }

        if ($request->filled('message')) {
            $query->Where('message', 'like', "%{$request->message}%");
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $contacts = $query->when(in_array($sort_column, $allowedColumns), function ($query) use ($sort_column, $sort_direction) {
                $query->orderBy($sort_column, $sort_direction);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })->get();
        

          $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            // BOM を追加（Excel対策）
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($handle, ['名前', 'メール', '件名', 'メッセージ', '送信日時']);
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->name,
                    $contact->email,
                    $contact->subject,
                    $contact->message,
                    $contact->created_at->format('Y-m-d H:i'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}

