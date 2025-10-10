<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;


class ContactController extends Controller
{
    // 入力画面
    public function create()
    {
        $inputs = [];
        return view('index');
    }

    // 確認画面
    public function confirm(Request $request)
    {

        $validated = $request->validate([
            'last_name'  => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender'     => 'required|in:男性,女性,その他',
            'email'      => 'required|email',
            'tel1'       => 'required|string|max:4',
            'tel2'       => 'required|string|max:4',
            'tel3'       => 'required|string|max:4',
            'address'    => 'required|string|max:255',
            'building'   => 'nullable|string|max:255',
            'category'   => 'required|string',
            'message'    => 'required|string|max:120',
        ]);

        $inputs = $validated;

        $categoryId = \App\Models\Category::where('content', $inputs['category'])->value('id');
        $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
        $genderValue = $genderMap[$inputs['gender']];

        return view('confirm', compact('inputs', 'categoryId', 'genderValue'));
    }

    // 送信処理
    public function send(Request $request)
    {
        $data = $request->all();

        // 電話番号をまとめる
        $tel = ($data['tel1'] ?? '') . ($data['tel2'] ?? '') . ($data['tel3'] ?? '');

        // カテゴリ文字列をDBのidに変換
        $categoryMap = [
            'order'   => '商品の お届けについて',
            'product' => '商品の交換について',
            'support' => '商品トラブル',
            'other'   => 'その他',
        ];

        $categoryContent = $categoryMap[$data['category']] ?? null;

        $categoryId = $categoryContent
            ? \App\Models\Category::where('content', $categoryContent)->value('id')
            : null;

        // 存在しなければエラー
        if (!$categoryId) {
            return back()->withErrors(['category' => '選択されたカテゴリーは存在しません'])->withInput();
        }
        $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
        $genderValue = $genderMap[$data['gender']];

        // DB保存
        // DB保存
        Contact::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'gender' => $genderValue,
            'email' => $data['email'],
            'tel' => $tel, 'address' => $data['address'],
            'building' => $data['building'] ?? null,
            'category_id' => $categoryId,
            'message' => $data['message'],
            ]);


        // サンクスページにリダイレクト
        return redirect()->route('contact.thanks');

        // サンクスページにリダイレクト
        return redirect()->route('contact.thanks');
    }

    // サンクス画面
    public function thanksView()
    {
        return view('thanks');
    }



}
