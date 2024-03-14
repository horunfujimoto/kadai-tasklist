@extends('layouts.app')

@section('content')

<!-- ここからページ毎のコンテンツを書く -->

    <div class="prose ml-4">
        <h2>タスク一覧</h2>
    </div>
    
    @if(isset($tasks))
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {{-- タスク作成ページへのリンク --}}
    <a class="btn btn-primary" href="{{ route('tasks.create') }}">新規タスクの投稿</a>
        
<!-- ここまで -->

@endsection