<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class MailTemplateController extends Controller
{
    public function show(string $template , Contact $contact): Response
    {
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $template)) {
            abort(400, 'Invalid template name');
        }

        $viewName = "mail_templates.$template";

        if (!View::exists($viewName)) {
            abort(404, 'Template not found');
        }

        // ここで contact を渡して Blade をレンダリング
        $html = view($viewName, ['contact' => $contact])->render();

        return response($html);
    }
}
