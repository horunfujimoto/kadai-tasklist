@if (Auth::check())
    <ul tabindex="0" class="menu lg:block lg:menu-horizontal">
        {{-- ログアウトへのリンク --}}
        <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
    </ul>
@else
    <ul tabindex="0" class="menu lg:block lg:menu-horizontal">
        {{-- ユーザ登録ページへのリンク --}}
        <li><a class="link link-hover" href="{{ route('register') }}">サインイン</a></li>
        {{-- ログインページへのリンク --}}
        <li><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
    </ul>
@endif