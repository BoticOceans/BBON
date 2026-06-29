<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | B.BON</title>
    <style>
        :root {
            --red: #ff1e1e;
            --ink: #111827;
            --muted: #647084;
            --line: #d8dee8;
            --bg: #eef2f6;
            --panel: #ffffff;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        a { color: inherit; text-decoration: none; }
        .shell { min-height: 100vh; }
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .wrap {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
        }
        .topbar-inner {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 900;
            letter-spacing: 0.08em;
        }
        .brand-mark {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            background: var(--red);
            color: #fff;
        }
        .nav {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }
        .nav a,
        .nav button,
        .btn {
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            padding: 11px 14px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
        }
        .nav a.active,
        .btn-red {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }
        main { padding: 34px 0 60px; }
        body.admin-auth-page main {
            padding: 42px 0 70px;
        }
        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 18px;
            margin-bottom: 22px;
        }
        h1 {
            margin: 0;
            font-size: 30px;
            line-height: 1.05;
            text-transform: uppercase;
        }
        .sub {
            margin: 8px 0 0;
            color: var(--muted);
        }
        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
        }
        .panel-pad { padding: 22px; }
        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }
        .stat {
            background: #fff;
            border: 1px solid var(--line);
            padding: 20px;
        }
        .stat strong {
            display: block;
            font-size: 34px;
            line-height: 1;
        }
        .stat span {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            padding: 14px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f7f9fb;
            color: #536075;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        tr:last-child td { border-bottom: 0; }
        .muted { color: var(--muted); }
        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .badge {
            display: inline-flex;
            padding: 5px 8px;
            border: 1px solid var(--line);
            background: #f8fafc;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .badge-on {
            border-color: #b7e2c5;
            background: #effaf2;
            color: #166534;
        }
        .badge-off {
            border-color: #f1c0c0;
            background: #fff1f1;
            color: #991b1b;
        }
        label {
            display: block;
            margin-bottom: 7px;
            color: #4b5565;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            padding: 12px;
            font: inherit;
        }
        textarea { min-height: 110px; resize: vertical; }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }
        .field { margin-bottom: 16px; }
        .check-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 28px;
        }
        .check-row input { width: auto; }
        .alert {
            padding: 14px 16px;
            border: 1px solid var(--line);
            background: #fff;
            margin-bottom: 18px;
        }
        .alert-ok { border-color: #b7e2c5; background: #effaf2; }
        .alert-error { border-color: #f1c0c0; background: #fff1f1; }
        .thumb {
            width: 76px;
            height: 58px;
            object-fit: cover;
            border: 1px solid var(--line);
            background: #f7f9fb;
        }
        .pagination { margin-top: 18px; }
        .auth-layout {
            min-height: calc(100vh - 190px);
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(360px, 460px);
            align-items: center;
            gap: 54px;
        }
        .auth-copy {
            max-width: 620px;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--red);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }
        .eyebrow::before {
            content: "";
            width: 36px;
            height: 2px;
            background: var(--red);
        }
        .auth-copy h1 {
            margin-top: 18px;
            font-size: clamp(42px, 6vw, 76px);
            max-width: 620px;
        }
        .auth-copy p {
            max-width: 560px;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.65;
        }
        .auth-points {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 28px;
        }
        .auth-points span {
            border: 1px solid var(--line);
            background: #fff;
            padding: 10px 12px;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .auth-card {
            background: #fff;
            border: 1px solid var(--line);
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
            padding: 34px;
        }
        .login-mark {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
            font-weight: 900;
            letter-spacing: 0.08em;
        }
        .login-mark span {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            background: var(--red);
            color: #fff;
        }
        .auth-card h2 {
            margin: 0;
            font-size: 28px;
            line-height: 1.1;
            text-transform: uppercase;
        }
        .auth-card form {
            margin-top: 26px;
        }
        .auth-submit {
            width: 100%;
            padding: 14px 16px;
        }
        @media (max-width: 800px) {
            .topbar-inner,
            .page-head { align-items: flex-start; flex-direction: column; }
            .stats,
            .grid-2,
            .grid-3 { grid-template-columns: 1fr; }
            .auth-layout { grid-template-columns: 1fr; gap: 28px; }
            .auth-copy h1 { font-size: 42px; }
            .auth-card { padding: 24px; }
            table { min-width: 720px; }
            .table-wrap { overflow-x: auto; }
        }
    </style>
</head>
<body class="@yield('body_class')">
    <div class="shell">
        <header class="topbar">
            <div class="wrap topbar-inner">
                <a href="{{ route('admin.dashboard') }}" class="brand">
                    <span class="brand-mark">B</span>
                    <span>B.BON Admin</span>
                </a>
                <nav class="nav">
                    @if (session('admin_authenticated') === true)
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('admin.product-categories.index') }}" class="{{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}">Categories</a>
                        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
                        <a href="{{ route('home') }}" target="_blank" rel="noreferrer">View Site</a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    @endif
                </nav>
            </div>
        </header>

        <main>
            <div class="wrap">
                @if (session('status'))
                    <div class="alert alert-ok">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Please fix the following:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
