<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Userモデルを忘れずに

class AuthController extends Controller
{
    // 登録フォームを表示
    public function showRegisterForm()
    {
        return view('register'); // resources/views/register.blade.php
    }

    // 登録処理
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレスを入力してください',
            'email.unique' => 'このメールアドレスはすでに登録されています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('login')->with('success', '登録が完了しました！');
    }
    // ログインフォーム
public function showLoginForm()
{
    return view('auth.login');
}

// ログイン処理
public function login(Request $request)
{
    $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min'      => 'パスワードは8文字以上で入力してください',
        ]);


    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin'); // ログイン成功後
    }

    return back()->withErrors([
        'email' => 'メールアドレスまたはパスワードが正しくありません',
    ])->withInput();
}

// ログアウト
public function logout(Request $request)
{
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}

}

