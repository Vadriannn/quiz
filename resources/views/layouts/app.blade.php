<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>@yield('title', 'Adminator')</title>
        <script>
            !(function () {
                try {
                    var t = localStorage.getItem("dash26-theme"),
                        e = window.matchMedia(
                            "(prefers-color-scheme: dark)",
                        ).matches;
                    document.documentElement.setAttribute(
                        "data-theme",
                        t || (e ? "dark" : "light"),
                    );
                } catch (t) {
                    document.documentElement.setAttribute(
                        "data-theme",
                        "light",
                    );
                }
            })();
        </script>
        <script defer="defer" src="{{ asset('adminator/runtime.js') }}"></script>
        <script defer="defer" src="{{ asset('adminator/vendor-fullcalendar.js') }}"></script>
        <script defer="defer" src="{{ asset('adminator/vendor-chartjs.js') }}"></script>
        <script defer="defer" src="{{ asset('adminator/vendors.js') }}"></script>
        <script defer="defer" src="{{ asset('adminator/2026.js') }}"></script>
        <link href="{{ asset('adminator/style.css') }}" rel="stylesheet" />
    </head>
    <body 
        data-active="@yield('active_page', 'dashboard')" 
        data-crumbs="@yield('breadcrumbs', 'Workspace | Dashboard')"
        data-user-name="{{ Auth::check() ? Auth::user()->nama : 'Guest' }}"
        data-user-role="{{ Auth::check() ? (Auth::user()->isAdmin() ? 'Admin' : 'User Biasa') : 'Guest' }}"
        data-user-role-raw="{{ Auth::check() ? strtolower(Auth::user()->Role) : 'guest' }}"
        data-user-email="{{ Auth::check() ? Auth::user()->email : '' }}"
        data-logout-url="{{ route('logout') }}"
        data-csrf="{{ csrf_token() }}"
    >
        <div class="shell">
            <div data-shell-sidebar></div>
            <div class="main">
                <div data-shell-topbar></div>
                <main class="content">
                    @yield('content')
                </main>
                <div data-shell-footer></div>
            </div>
        </div>
    </body>
</html>
