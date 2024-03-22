<header class="mb-4">
    <nav class="navbar bg-neutral text-neutral-content">
        {{-- トップページへのリンク --}}
        <div class="flex-1">
            <h1><a class="btn btn-ghost normal-case text-xl" href="/">tasklist</a></h1>
        </div>
        
        <div class="flex-1">
            @if (Auth::check())
                {{ Auth::user()->name ."がログイン中"}}
            @endif
        </div>
        

        <div class="flex-none">
            <ul class="menu lg:block lg:menu-horizontal">
                {{-- task作成ページへのリンク --}}
                <li><a class="link link-hover mr-4" href="{{ route('tasks.create') }}">新規タスクの投稿</a></li>
            </ul>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                    @include('commons.link_items')
            </form>
        </div>
    </nav>
</header>