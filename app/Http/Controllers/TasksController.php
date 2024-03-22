<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Models\User; // 追加

use Illuminate\Support\Facades\Auth; // 追加

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        // タスク一覧を取得
        $tasks = Task::all();
        // タスク一覧ビューでそれを表示
        return view('tasks.index',[
            'tasks' => $tasks,
        ]);
    }
    
    public function create()
    {
        // ユーザーがログインしている場合のみユーザー情報を取得
        if(Auth::check()) {
            $users = User::all(); // ユーザー情報を取得
            $task = new Task;
        
            return view('tasks.create', [
                'task' => $task,
                'users' => $users, // ユーザー情報をビューに渡す
            ]);
        } else {
            // ログインしていない場合は何らかのエラー処理を行うか、ログインページにリダイレクトするなどの処理を行う
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }
    }

    public function store(Request $request)
    {
        // バリデーション：requiredかつmax:10以下であること
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required',
        ]);
        
        // タスクを作成
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = Auth::id(); // ログインユーザーのIDを設定
        $task->save();
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }


    // getでtasks/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // idの値で投稿を検索して取得
        $task = \App\Models\Task::findOrFail($id);
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿編集可能
        if (\Auth::id() === $task->user_id) {
            // idの値でタスクを検索して取得
            // findOrFail:レコードが存在しない時に404エラーを出す
            $task = Task::findOrFail($id);
            // タスク詳細ビューでそれを表示
            return view('tasks.show', [
                'task' => $task,
            ]);
        }
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // getでtasks/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値で投稿を検索して取得
        $task = \App\Models\Task::findOrFail($id);
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿編集可能
        if (\Auth::id() === $task->user_id) {
            // idの値でタスクを検索して取得
            $task = Task::findOrFail($id);
            // タスク編集ビューでそれを表示
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // putまたはpatchでtasks/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // バリデーション：requiredかつmax:10以下であること
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required',
        ]);
        
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        // タスクを更新
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // deleteでtasks/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $task = \App\Models\Task::findOrFail($id);
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿削除可能
        if (\Auth::id() === $task->user_id) {
            // idの値でタスクを検索して取得
            $task = Task::findOrFail($id);
            // タスクを削除
            $task->delete();
            // トップページへリダイレクトさせる
            return redirect('/');
        }
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }
}