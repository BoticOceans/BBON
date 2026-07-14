<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | B.BON</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #ff1e1e;
            --red-dark: #d91616;
            --red-light: #ff4747;
            --ink: #161a22;
            --muted: #6b7385;
            --line: #e7e9f0;
            --bg: #f1f3f9;
            --panel: #ffffff;
            --sidebar-bg: #0b0d11;
            --sidebar-bg-2: #14171d;
            --sidebar-line: rgba(255, 255, 255, 0.08);
            --sidebar-text: #9aa1b0;
            --sidebar-text-active: #ffffff;
            --sidebar-w: 264px;
            --topbar-h: 70px;
            --radius: 14px;
            --radius-sm: 9px;
            --shadow-xs: 0 1px 2px rgba(16, 24, 40, 0.05);
            --shadow-sm: 0 2px 8px rgba(16, 24, 40, 0.06), 0 1px 2px rgba(16, 24, 40, 0.05);
            --shadow-md: 0 8px 24px rgba(16, 24, 40, 0.08), 0 2px 6px rgba(16, 24, 40, 0.04);
            --shadow-lg: 0 24px 60px rgba(16, 24, 40, 0.14);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            background-image: radial-gradient(circle at 12% 0%, rgba(255, 30, 30, 0.05), transparent 40%);
            color: var(--ink);
            font-family: "Inter", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
        }
        a { color: inherit; text-decoration: none; }
        svg { display: block; }
        ::selection { background: rgba(255, 30, 30, 0.18); }

        /* ---------- Shell: sidebar + topbar ---------- */
        .admin-shell { min-height: 100vh; }
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: linear-gradient(185deg, var(--sidebar-bg-2) 0%, var(--sidebar-bg) 55%);
            border-right: 1px solid var(--sidebar-line);
            display: flex;
            flex-direction: column;
            z-index: 40;
            transition: transform 0.25s ease;
            box-shadow: var(--shadow-lg);
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            height: var(--topbar-h);
            padding: 0 22px;
            border-bottom: 1px solid var(--sidebar-line);
            flex-shrink: 0;
        }
        .sidebar-brand .mark {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--red-light), var(--red-dark));
            color: #fff;
            font-weight: 900;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(255, 30, 30, 0.35);
        }
        .sidebar-brand strong {
            color: #fff;
            font-weight: 800;
            letter-spacing: 0.04em;
            font-size: 15px;
            text-transform: uppercase;
        }
        .sidebar-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 22px 16px;
        }
        .nav-section-label {
            color: #565d6b;
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0 10px;
            margin: 0 0 10px;
        }
        .sidebar-nav { display: flex; flex-direction: column; gap: 3px; margin-bottom: 22px; }
        .nav-group { margin: 0; }
        .nav-section-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            background: none;
            border: 0;
            padding: 0 10px;
            margin: 0 0 10px;
            cursor: pointer;
        }
        .nav-section-toggle .nav-section-label { margin: 0; padding: 0; }
        .nav-section-toggle .chevron {
            width: 14px;
            height: 14px;
            color: #565d6b;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }
        .nav-group.is-collapsed .chevron { transform: rotate(-90deg); }
        .nav-group.is-collapsed .sidebar-nav { display: none; }
        .nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            color: var(--sidebar-text);
            font-size: 13.5px;
            font-weight: 600;
            border-radius: var(--radius-sm);
            transition: background 0.15s ease, color 0.15s ease, transform 0.15s ease;
        }
        .nav-link svg { width: 18px; height: 18px; flex-shrink: 0; opacity: 0.85; transition: opacity 0.15s ease; }
        .nav-link:hover { background: rgba(255, 255, 255, 0.07); color: var(--sidebar-text-active); }
        .nav-link:hover svg { opacity: 1; }
        .nav-link.active {
            background: linear-gradient(135deg, var(--red-light), var(--red-dark));
            color: #fff;
            box-shadow: 0 6px 16px rgba(255, 30, 30, 0.3);
        }
        .nav-link.active svg { opacity: 1; }
        .sidebar-footer {
            padding: 16px 14px 20px;
            border-top: 1px solid var(--sidebar-line);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .sidebar-footer form { margin: 0; }
        .sidebar-footer .nav-link { width: 100%; background: none; border: 0; cursor: pointer; text-align: left; font: inherit; }

        .admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-topbar {
            height: var(--topbar-h);
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
            box-shadow: 0 1px 0 rgba(16, 24, 40, 0.02), 0 4px 16px rgba(16, 24, 40, 0.03);
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 20;
            flex-shrink: 0;
        }
        .sidebar-toggle {
            display: none;
            border: 0;
            background: none;
            cursor: pointer;
            padding: 6px;
            color: var(--ink);
        }
        .topbar-search {
            flex: 1;
            max-width: 360px;
            position: relative;
        }
        .topbar-search svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #9aa1ad;
        }
        .topbar-search input {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--bg);
            border-radius: var(--radius-sm);
            padding: 9px 12px 9px 36px;
            font: inherit;
            color: var(--ink);
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }
        .topbar-search input:focus {
            outline: none;
            background: #fff;
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(255, 30, 30, 0.1);
        }
        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .icon-btn {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            color: var(--muted);
            transition: background 0.15s ease, color 0.15s ease, transform 0.15s ease;
        }
        .icon-btn:hover { background: var(--bg); color: var(--ink); transform: translateY(-1px); }
        .icon-btn svg { width: 18px; height: 18px; }
        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 14px;
            border-left: 1px solid var(--line);
        }
        .admin-user .avatar {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--red-light), var(--red-dark));
            color: #fff;
            font-weight: 800;
            font-size: 14px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(255, 30, 30, 0.3);
        }
        .admin-user .who { line-height: 1.25; }
        .admin-user .who strong { display: block; font-size: 13px; }
        .admin-user .who span { display: block; font-size: 11.5px; color: var(--muted); }

        .admin-content { padding: 28px 30px 60px; flex: 1; }
        body.admin-auth-page .admin-content { padding: 0; }

        /* ---------- Page head ---------- */
        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 18px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }
        h1 {
            margin: 0;
            font-size: 25px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .sub { margin: 6px 0 0; color: var(--muted); }

        /* ---------- Panels / cards ---------- */
        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
        }
        .panel-pad { padding: 24px; }

        /* ---------- Stat cards ---------- */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 26px;
        }
        .stat {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            padding: 22px;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat::before {
            content: "";
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            background: linear-gradient(90deg, var(--stat-accent, var(--red)), transparent);
            opacity: 0.9;
        }
        .stat:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .stat-icon {
            display: grid;
            place-items: center;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            flex-shrink: 0;
            box-shadow: 0 6px 16px -6px var(--stat-glow, transparent);
        }
        .stat-icon svg { width: 21px; height: 21px; }
        .stat-icon.icon-purple { background: linear-gradient(135deg, #ede4ff, #dcc9ff); color: #7c3aed; --stat-glow: rgba(124, 58, 237, 0.45); }
        .stat-icon.icon-orange { background: linear-gradient(135deg, #ffe7d6, #ffd0ac); color: #ea580c; --stat-glow: rgba(234, 88, 12, 0.4); }
        .stat-icon.icon-green { background: linear-gradient(135deg, #d7f7e3, #b3edc9); color: #15803d; --stat-glow: rgba(21, 128, 61, 0.4); }
        .stat-icon.icon-blue { background: linear-gradient(135deg, #dce9ff, #bcd6ff); color: #1d4ed8; --stat-glow: rgba(29, 78, 216, 0.4); }
        .stat:has(.icon-purple) { --stat-accent: #7c3aed; }
        .stat:has(.icon-orange) { --stat-accent: #ea580c; }
        .stat:has(.icon-green) { --stat-accent: #15803d; }
        .stat:has(.icon-blue) { --stat-accent: #1d4ed8; }
        .stat strong {
            display: block;
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
            margin-top: 16px;
            letter-spacing: -0.02em;
        }
        .stat span.label {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            font-size: 12.5px;
            font-weight: 600;
        }

        /* ---------- Tables ---------- */
        table { width: 100%; border-collapse: collapse; }
        th, td {
            padding: 15px 18px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f8f9fc;
            color: #6b7385;
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        th:first-child { border-top-left-radius: var(--radius); }
        th:last-child { border-top-right-radius: var(--radius); }
        tbody tr { transition: background 0.12s ease; }
        tbody tr:hover { background: #fbfbfe; }
        tr:last-child td { border-bottom: 0; }
        .muted { color: var(--muted); }

        /* ---------- Buttons ---------- */
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .actions form { margin: 0; }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            padding: 9px 15px;
            font-size: 12.5px;
            font-weight: 700;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, transform 0.15s ease, background 0.15s ease;
            box-shadow: var(--shadow-xs);
        }
        .btn:hover { border-color: #c7cdd9; transform: translateY(-1px); box-shadow: var(--shadow-sm); }
        .btn:active { transform: translateY(0); }
        .btn-red {
            background: linear-gradient(135deg, var(--red-light), var(--red-dark));
            border-color: var(--red-dark);
            color: #fff;
            box-shadow: 0 6px 16px -4px rgba(255, 30, 30, 0.45);
        }
        .btn-red:hover { background: linear-gradient(135deg, var(--red), var(--red-dark)); border-color: var(--red-dark); box-shadow: 0 8px 20px -4px rgba(255, 30, 30, 0.55); }

        /* ---------- Badges ---------- */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px 4px 8px;
            border-radius: 999px;
            background: #f1f3f7;
            color: #4b5565;
            font-size: 11px;
            font-weight: 700;
        }
        .badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
        }
        .badge-on { background: #ddf6e8; color: #15803d; }
        .badge-off { background: #fde3e3; color: #b91c1c; }
        .badge-status-pending { background: #f1f3f7; color: #4b5565; }
        .badge-status-confirmed { background: #dbeafe; color: #1d4ed8; }
        .badge-status-in_production { background: #ffe9dc; color: #c2410c; }
        .badge-status-ready { background: #eee5fd; color: #6d28d9; }
        .badge-status-dispatched { background: #cffafe; color: #0e7490; }
        .badge-status-delivered { background: #ddf6e8; color: #15803d; }
        .badge-status-cancelled { background: #fde3e3; color: #b91c1c; }

        /* ---------- Forms ---------- */
        label {
            display: block;
            margin-bottom: 7px;
            color: #4b5565;
            font-size: 12px;
            font-weight: 700;
        }
        input, select, textarea {
            width: 100%;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            font: inherit;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(255, 30, 30, 0.12);
        }
        input:hover, select:hover, textarea:hover { border-color: #ccd1dc; }
        textarea { min-height: 110px; resize: vertical; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; }
        .field { margin-bottom: 16px; }
        .check-row { display: flex; align-items: center; gap: 10px; padding-top: 28px; }
        .check-row input { width: auto; }

        /* ---------- Alerts ---------- */
        .alert {
            padding: 14px 16px;
            border: 1px solid var(--line);
            border-radius: var(--radius);
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
            border-radius: 6px;
            background: #f7f9fb;
        }
        .pagination { margin-top: 18px; }
        .order-item-wrap { margin-bottom: 16px; }
        .hp-section { margin-bottom: 18px; }
        .hp-section-title { margin: 0 0 18px; font-size: 17px; font-weight: 800; }
        .hp-divider { border: 0; border-top: 1px solid var(--line); margin: 22px 0; }
        .block-group-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .block-item {
            background: var(--bg);
            border: 1px solid var(--line);
            border-radius: var(--radius-sm);
            padding: 14px;
            margin-bottom: 10px;
        }
        .block-item-row { display: flex; align-items: end; gap: 10px; }
        .block-item-remove { flex-shrink: 0; }
        .order-item-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
        }
        .order-item-title { font-size: 15px; }
        .remove-item-btn { color: #b91c1c; border-color: #f1c0c0; }
        .remove-item-btn:hover { background: #fff1f1; border-color: #f1c0c0; }
        .size-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(64px, 1fr));
            gap: 8px;
        }
        .size-cell { display: flex; flex-direction: column; gap: 4px; }
        .size-cell-label {
            font-size: 10.5px;
            font-weight: 700;
            color: var(--muted);
            text-align: center;
        }
        .size-qty-input { padding: 8px 6px; text-align: center; }
        .item-total-line { margin: 10px 0 0; font-size: 12.5px; }
        .item-total-line strong { color: var(--ink); }
        .pager {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }
        .pager-info { font-size: 12.5px; }
        .pager-links { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        .pager-btn { min-width: 38px; justify-content: center; }
        .pager-btn.is-current { background: linear-gradient(135deg, var(--red-light), var(--red-dark)); border-color: var(--red-dark); color: #fff; cursor: default; }
        .pager-btn.is-disabled { color: #c3c8d2; cursor: not-allowed; box-shadow: none; }
        .pager-btn.is-disabled:hover { border-color: var(--line); transform: none; box-shadow: none; }
        .pager-dots { padding: 0 4px; color: var(--muted); }

        /* ---------- Auth page (no sidebar) ---------- */
        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(360px, 460px);
            align-items: center;
            gap: 54px;
            max-width: 1360px;
            margin: 0 auto;
            padding: 0 6vw;
            background-image: radial-gradient(circle at 85% 15%, rgba(255, 30, 30, 0.07), transparent 45%);
        }
        .auth-copy { max-width: 620px; }
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
        .eyebrow::before { content: ""; width: 36px; height: 2px; background: var(--red); }
        .auth-copy h1 {
            margin-top: 18px;
            font-size: clamp(38px, 5vw, 60px);
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -0.01em;
            max-width: 620px;
        }
        .auth-copy p { max-width: 560px; color: var(--muted); font-size: 17px; line-height: 1.65; }
        .auth-points { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 28px; }
        .auth-points span {
            border: 1px solid var(--line);
            background: #fff;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            box-shadow: var(--shadow-xs);
        }
        .auth-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            padding: 38px;
        }
        .login-mark { display: inline-flex; align-items: center; gap: 12px; margin-bottom: 28px; font-weight: 900; letter-spacing: 0.06em; }
        .login-mark span {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--red-light), var(--red-dark));
            color: #fff;
            border-radius: 11px;
            box-shadow: 0 6px 16px rgba(255, 30, 30, 0.35);
        }
        .auth-card h2 { margin: 0; font-size: 24px; font-weight: 800; }
        .auth-card form { margin-top: 26px; }
        .auth-submit { width: 100%; justify-content: center; padding: 12px 16px; }

        @media (max-width: 1080px) {
            :root { --sidebar-w: 240px; }
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 860px) {
            .admin-sidebar { transform: translateX(-100%); box-shadow: 0 0 0 100vmax rgba(15, 23, 42, 0); }
            body.sidebar-open .admin-sidebar { transform: translateX(0); box-shadow: 24px 0 60px rgba(15, 23, 42, 0.25); }
            .admin-main { margin-left: 0; }
            .sidebar-toggle { display: inline-grid; place-items: center; }
            .topbar-search { display: none; }
            .admin-user .who { display: none; }
            .page-head { align-items: flex-start; flex-direction: column; }
            .stats, .grid-2, .grid-3 { grid-template-columns: 1fr; }
            .auth-shell { grid-template-columns: 1fr; gap: 28px; padding: 40px 20px; }
            .auth-card { padding: 24px; }
            table { min-width: 720px; }
            .table-wrap { overflow-x: auto; }
        }

        /* Mobile sidebar backdrop */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            z-index: 30;
        }
        body.sidebar-open .sidebar-backdrop { display: block; }
    </style>
</head>
@php
    $bodyClass = trim($__env->yieldContent('body_class'));
    $isAuthPage = $bodyClass === 'admin-auth-page';
@endphp
<body class="{{ $bodyClass }}">
    @if ($isAuthPage)
        <div class="auth-shell">
            @yield('content')
        </div>
    @else
        <div class="admin-shell">
            <div class="sidebar-backdrop" onclick="document.body.classList.remove('sidebar-open')"></div>
            <aside class="admin-sidebar">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                    <span class="mark">B</span>
                    <strong>B.BON Admin</strong>
                </a>
                <div class="sidebar-scroll">
                    <div class="nav-section-label">Menu</div>
                    <nav class="sidebar-nav">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"></rect><rect x="14" y="3" width="7" height="5" rx="1"></rect><rect x="14" y="12" width="7" height="9" rx="1"></rect><rect x="3" y="16" width="7" height="5" rx="1"></rect></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.homepage.edit') }}" class="nav-link {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Homepage
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1"></rect><path d="M9 13h6"></path><path d="M9 17h6"></path></svg>
                            Orders
                        </a>
                        <a href="{{ route('admin.contact-submissions.index') }}" class="nav-link {{ request()->routeIs('admin.contact-submissions.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            Enquiries
                        </a>
                        <a href="{{ route('admin.product-categories.index') }}" class="nav-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path></svg>
                            Categories
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 .55.45 1 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"></path></svg>
                            Products
                        </a>
                        <a href="{{ route('admin.gallery-items.index') }}" class="nav-link {{ request()->routeIs('admin.gallery-items.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"></path></svg>
                            Gallery
                        </a>
                    </nav>

                    @php
                        $mastersActive = request()->routeIs([
                            'admin.order-types.*',
                            'admin.collars.*',
                            'admin.fabrics.*',
                            'admin.colours.*',
                            'admin.patches.*',
                            'admin.sizes.*',
                        ]);
                    @endphp
                    <div class="nav-group" data-nav-group="masters" data-force-open="{{ $mastersActive ? '1' : '0' }}">
                        <button type="button" class="nav-section-toggle" onclick="toggleNavGroup(this)" aria-expanded="true">
                            <span class="nav-section-label">Masters</span>
                            <svg class="chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <nav class="sidebar-nav">
                        <a href="{{ route('admin.order-types.index') }}" class="nav-link {{ request()->routeIs('admin.order-types.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 2 7l10 5 10-5-10-5Z"></path><path d="m2 17 10 5 10-5"></path><path d="m2 12 10 5 10-5"></path></svg>
                            Order Types
                        </a>
                        <a href="{{ route('admin.collars.index') }}" class="nav-link {{ request()->routeIs('admin.collars.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 3 6 3 6-3"></path><path d="M6 3v5l6 4 6-4V3"></path><path d="M6 8 3 21h18L18 8"></path></svg>
                            Collars
                        </a>
                        <a href="{{ route('admin.fabrics.index') }}" class="nav-link {{ request()->routeIs('admin.fabrics.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 2 8 4.5v9L12 20l-8-4.5v-9L12 2Z"></path><path d="M12 22V12"></path><path d="m4 6.5 8 4.5 8-4.5"></path></svg>
                            Fabrics
                        </a>
                        <a href="{{ route('admin.colours.index') }}" class="nav-link {{ request()->routeIs('admin.colours.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="13.5" cy="6.5" r=".5"></circle><circle cx="17.5" cy="10.5" r=".5"></circle><circle cx="8.5" cy="7.5" r=".5"></circle><circle cx="6.5" cy="12.5" r=".5"></circle><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"></path></svg>
                            Colours
                        </a>
                        <a href="{{ route('admin.patches.index') }}" class="nav-link {{ request()->routeIs('admin.patches.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"></rect><path d="m9 12 2 2 4-4"></path></svg>
                            Patches
                        </a>
                        <a href="{{ route('admin.sizes.index') }}" class="nav-link {{ request()->routeIs('admin.sizes.*') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"></path><path d="m14.5 12.5 2-2"></path><path d="m11.5 9.5 2-2"></path><path d="m8.5 6.5 2-2"></path><path d="m17.5 15.5 2-2"></path></svg>
                            Sizes
                        </a>
                        </nav>
                    </div>
                </div>
                <div class="sidebar-footer">
                    <a href="{{ route('home') }}" target="_blank" rel="noreferrer" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
                        View Site
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <div class="admin-main">
                <header class="admin-topbar">
                    <button type="button" class="sidebar-toggle" onclick="document.body.classList.toggle('sidebar-open')" aria-label="Toggle menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="18" x2="20" y2="18"></line></svg>
                    </button>
                    <div class="topbar-search">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" placeholder="Search..." disabled>
                    </div>
                    <div class="topbar-right">
                        <a class="icon-btn" href="{{ route('home') }}" target="_blank" rel="noreferrer" title="View site">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
                        </a>
                        <div class="admin-user">
                            <div class="avatar">B</div>
                            <div class="who">
                                <strong>Admin</strong>
                                <span>B.BON Sports Wear</span>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="admin-content">
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
                </main>
            </div>
        </div>

        <script>
            function toggleNavGroup(button) {
                var group = button.closest('.nav-group');
                var collapsed = group.classList.toggle('is-collapsed');
                button.setAttribute('aria-expanded', collapsed ? 'false' : 'true');
                localStorage.setItem('bbon-admin-nav-' + group.dataset.navGroup, collapsed ? '1' : '0');
            }

            document.querySelectorAll('.nav-group').forEach(function (group) {
                if (group.dataset.forceOpen === '1') {
                    return;
                }
                var stored = localStorage.getItem('bbon-admin-nav-' + group.dataset.navGroup);
                if (stored === '1') {
                    group.classList.add('is-collapsed');
                    var toggle = group.querySelector('.nav-section-toggle');
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        </script>
    @endif
</body>
</html>
