<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AccountUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('account.edit', compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
        $user = User::findOrFail(Auth::id());

        $user->update($request->validated());

        return redirect()->route('mypage')
            ->with('success', 'アカウント情報を更新しました');
    }
}
