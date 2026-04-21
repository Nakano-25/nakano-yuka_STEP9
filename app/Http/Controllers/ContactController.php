<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function form()
    {
        return view('contact.form');
    }

    public function send(ContactRequest $request)
    {
        $data = $request->validated();

        try {
            Mail::to(env('ADMIN_EMAIL'))->send(new ContactMail($data));
        } catch (\Exception $e) {
            Log::error('メール送信エラー: ' . $e->getMessage());

            return back()->with('error', 'メール送信に失敗しました。後でもう一度お試しください。')->withInput();
        }

        return redirect()->route('products.index')
            ->with('success', 'お問い合わせを送信しました。');
    }
}