@if (Auth::check())
    <ul class="menu lg:block lg:menu-horizontal">
        {{-- ログアウトへのリンク --}}
        <a class="link link-hover " href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a>
@else
    <ul class="menu lg:block lg:menu-horizontal">
        {{-- ユーザ登録ページへのリンク --}}
        <a class="link link-hover mr-4" href="{{ route('register') }}">サインイン</a>
        {{-- ログインページへのリンク --}}
        <a class="link link-hover" href="{{ route('login') }}">ログイン</a>
    </ul>
@endif