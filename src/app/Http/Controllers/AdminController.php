<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Response;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query()->with('category');

// 名前検索
        $keyword = $request->input('keyword');
        if ($keyword) {
        $like = "%{$keyword}%";
        $query->where(function($q) use ($like) {
        $q->where('first_name', 'like', $like)
            ->orWhere('last_name', 'like', $like)
            ->orWhereRaw("REPLACE(CONCAT(first_name, last_name), ' ', '') LIKE ?", [$like])
            ->orWhereRaw("REPLACE(CONCAT(first_name, last_name), '　', '') LIKE ?", [$like]);
    });
}


        // 性別
        $gender = $request->input('gender');
        $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];

        if (!empty($gender)) {
        if (isset($genderMap[$gender])) {
        $query->where('gender', $genderMap[$gender]);
    }
}






if ($request->filled('category_id')) {
    $query->where('category_id', $request->category_id);
}


        // 日付
        $date = $request->input('date');
        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $contacts = $query->paginate(7)->withQueryString();
        $categories = Category::all(); // ← ここで取得

        return view('admin', compact('contacts', 'categories')); // ← ここで渡す
    }





    // 詳細ページ（モーダル用）
    public function modal($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact_modal', compact('contact'));
    }

    // CSVエクスポート
    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->keyword}%")
                ->orWhere('last_name', 'like', "%{$request->keyword}%")
                ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('type')) {
            $query->where('category_id', $request->type);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            '-Disposition' => 'attachment; filename=contacts.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '内容'];

        $callback = function() use ($contacts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->first_name.' '.$contact->last_name,
                    $contact->gender_text,
                    $contact->email,
                    $contact->category->content ?? '未分類',
                    $contact->message
                ]);
            }

            fclose($file);
        };


        return Response::stream($callback, 200, $headers);
    }
        public function destroy($id)
    {
            $contact = Contact::findOrFail($id);
            $contact->delete();

        return redirect()->route('admin')->with('success', 'お問い合わせを削除しました。');
}


}
