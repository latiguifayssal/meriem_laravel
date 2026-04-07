<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Newsreader:ital,wght@0,400;0,600;0,700;1,400&family=Public+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'tertiary-fixed-dim': '#f2bc82',
                        'surface-container-highest': '#e0e3e5',
                        'background': '#f7fafc',
                        'primary-fixed-dim': '#adc7f7',
                        'primary-fixed': '#d6e3ff',
                        'surface-dim': '#d7dadc',
                        'on-secondary-fixed': '#111c2c',
                        'on-primary-fixed': '#001b3c',
                        'inverse-on-surface': '#eef1f3',
                        'surface-container-high': '#e5e9eb',
                        'tertiary-fixed': '#ffddba',
                        'secondary': '#545f72',
                        'on-tertiary-fixed': '#2b1700',
                        'on-primary-container': '#86a0cd',
                        'surface-bright': '#f7fafc',
                        'on-surface-variant': '#43474e',
                        'inverse-primary': '#adc7f7',
                        'primary-container': '#1a365d',
                        'on-tertiary-container': '#c6955e',
                        'on-secondary-fixed-variant': '#3c475a',
                        'on-tertiary': '#ffffff',
                        'on-error-container': '#93000a',
                        'secondary-fixed-dim': '#bcc7dd',
                        'on-secondary': '#ffffff',
                        'tertiary': '#321b00',
                        'on-surface': '#181c1e',
                        'on-secondary-container': '#586377',
                        'outline': '#74777f',
                        'on-tertiary-fixed-variant': '#633f0f',
                        'tertiary-container': '#4f2e00',
                        'outline-variant': '#c4c6cf',
                        'on-primary-fixed-variant': '#2d476f',
                        'surface-container': '#ebeef0',
                        'secondary-container': '#d5e0f7',
                        'surface-container-lowest': '#ffffff',
                        'error': '#ba1a1a',
                        'surface-container-low': '#f1f4f6',
                        'error-container': '#ffdad6',
                        'inverse-surface': '#2d3133',
                        'on-background': '#181c1e',
                        'on-primary': '#ffffff',
                        'secondary-fixed': '#d8e3fa',
                        'on-error': '#ffffff',
                        'surface': '#f7fafc',
                        'primary': '#002045',
                        'surface-variant': '#e0e3e5',
                        'surface-tint': '#455f88',
                    },
                    borderRadius: {
                        DEFAULT: '0.125rem',
                        lg: '0.25rem',
                        xl: '0.5rem',
                        full: '0.75rem',
                    },
                    fontFamily: {
                        headline: ['Newsreader', 'serif'],
                        body: ['Public Sans', 'sans-serif'],
                        label: ['Inter', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-header { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
    @stack('styles')
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-fixed selection:text-on-primary-fixed antialiased">
@php
    $u = auth()->user();
    $manuscriptsUrl = $u->isAdmin()
        ? route('admin.documents.index')
        : ($u->isAuthor() ? route('author.documents.index') : route('reviewer.documents.index'));
    $peerReviewUrl = $u->isReviewer() ? route('reviewer.documents.index') : $manuscriptsUrl;
    $avatarUrl = 'https://ui-avatars.com/api/?name=' . rawurlencode($u->name) . '&background=1a365d&color=fff&size=128';
    $reviewerUser = $u->isReviewer();
    $manuscriptsNavActive = request()->routeIs('admin.documents.*', 'author.documents.*')
        || (request()->routeIs('reviewer.documents.*') && ! $reviewerUser);
    $peerReviewNavActive = $reviewerUser && request()->routeIs('reviewer.*');
@endphp

<header class="fixed top-0 z-50 flex w-full items-center justify-between gap-3 border-b border-outline-variant/10 bg-white/80 px-4 py-3 shadow-sm backdrop-blur-md sm:px-8">
    <div class="flex min-w-0 flex-1 items-center gap-3 sm:gap-6">
        <a href="{{ route('dashboard') }}" class="font-headline shrink-0 text-lg italic text-blue-900 sm:text-2xl">{{ config('app.name', 'Scholar Portal') }}</a>
        {{-- Mobile only: sidebar is hidden below md --}}
        <nav class="flex min-w-0 items-center gap-2 overflow-x-auto md:hidden">
            <a href="{{ route('dashboard') }}"
               class="font-label whitespace-nowrap text-xs font-medium {{ request()->routeIs('dashboard') ? 'text-blue-900' : 'text-slate-500' }}">
                {{ __('Dashboard') }}
            </a>
            <span class="text-slate-300" aria-hidden="true">|</span>
            <a href="{{ $manuscriptsUrl }}"
               class="font-label whitespace-nowrap text-xs font-medium {{ $manuscriptsNavActive ? 'text-blue-900' : 'text-slate-500' }}">
                {{ __('Manuscripts') }}
            </a>
            @if($u->isAuthor())
                <span class="text-slate-300" aria-hidden="true">|</span>
                <a href="{{ route('author.documents.create') }}"
                   class="font-label whitespace-nowrap text-xs font-medium {{ request()->routeIs('author.documents.create') ? 'text-blue-900' : 'text-slate-500' }}">
                    {{ __('Submit') }}
                </a>
            @endif
            @if($u->isAdmin())
                <span class="text-slate-300" aria-hidden="true">|</span>
                <a href="{{ route('admin.dashboard') }}"
                   class="font-label whitespace-nowrap text-xs font-medium {{ request()->routeIs('admin.dashboard') ? 'text-blue-900' : 'text-slate-500' }}">
                    {{ __('Reports') }}
                </a>
            @endif
            @if($reviewerUser)
                <span class="text-slate-300" aria-hidden="true">|</span>
                <a href="{{ $peerReviewUrl }}"
                   class="font-label whitespace-nowrap text-xs font-medium {{ $peerReviewNavActive ? 'text-blue-900' : 'text-slate-500' }}">
                    {{ __('Peer Review') }}
                </a>
            @endif
        </nav>
    </div>
    <div class="flex shrink-0 items-center gap-2 sm:gap-4">
        <form action="{{ $manuscriptsUrl }}" method="get" class="relative hidden lg:block">
            <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
            <input type="search" name="q" value="{{ request('q') }}"
                   class="w-52 rounded-full border-none bg-surface-container py-1.5 pl-10 pr-4 text-sm ring-1 ring-outline-variant/20 focus:ring-2 focus:ring-primary/20 xl:w-64"
                   placeholder="{{ __('Search manuscripts…') }}"/>
        </form>
        <a href="{{ route('profile.edit') }}" class="rounded-full p-2 text-slate-500 transition-colors hover:bg-slate-50" title="{{ __('Settings') }}">
            <span class="material-symbols-outlined">settings</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="shrink-0 rounded-full focus:outline-none focus:ring-2 focus:ring-primary/30" title="{{ __('Profile') }}">
            <img src="{{ $avatarUrl }}" alt="" width="32" height="32" class="h-8 w-8 rounded-full border border-outline-variant/30 object-cover"/>
        </a>
    </div>
</header>

<div class="flex min-h-screen pt-[60px]">
    <aside class="sticky top-[60px] hidden h-[calc(100vh-60px)] w-64 flex-col space-y-2 border-r border-slate-200/20 bg-slate-50 p-4 md:flex">
        <div class="mb-8 px-2">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">school</span>
                </div>
                <div>
                    <h2 class="font-label text-lg font-bold text-blue-900">{{ __('Scholar Portal') }}</h2>
                    <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">{{ __('Academic management') }}</p>
                </div>
            </div>
        </div>
        <nav class="flex flex-1 flex-col space-y-1">
            <a href="{{ route('dashboard') }}"
               class="font-label flex items-center gap-3 rounded-lg px-3 py-2 text-[11px] font-semibold uppercase tracking-wider {{ request()->routeIs('dashboard') ? 'bg-white text-blue-900 shadow-sm' : 'text-slate-500 transition-all hover:bg-slate-200/50 hover:text-blue-700' }}">
                <span class="material-symbols-outlined text-lg">dashboard</span>
                <span>{{ __('Dashboard') }}</span>
            </a>
            <a href="{{ $manuscriptsUrl }}"
               class="font-label flex items-center gap-3 rounded-lg px-3 py-2 text-[11px] font-semibold uppercase tracking-wider {{ $manuscriptsNavActive ? 'bg-white text-blue-900 shadow-sm' : 'text-slate-500 transition-all hover:bg-slate-200/50 hover:text-blue-700' }}">
                <span class="material-symbols-outlined text-lg">description</span>
                <span>{{ __('Manuscripts') }}</span>
            </a>
            @if($reviewerUser)
                <a href="{{ $peerReviewUrl }}"
                   class="font-label flex items-center gap-3 rounded-lg px-3 py-2 text-[11px] font-semibold uppercase tracking-wider {{ $peerReviewNavActive ? 'bg-white text-blue-900 shadow-sm' : 'text-slate-500 transition-all hover:bg-slate-200/50 hover:text-blue-700' }}">
                    <span class="material-symbols-outlined text-lg">rate_review</span>
                    <span>{{ __('Peer Review') }}</span>
                </a>
            @endif
            @if($u->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                   class="font-label flex items-center gap-3 rounded-lg px-3 py-2 text-[11px] font-semibold uppercase tracking-wider {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-900 shadow-sm' : 'text-slate-500 transition-all hover:bg-slate-200/50 hover:text-blue-700' }}">
                    <span class="material-symbols-outlined text-lg">analytics</span>
                    <span>{{ __('Reports') }}</span>
                </a>
            @endif
        </nav>
        <div class="space-y-4 border-t border-slate-200/30 pt-4">
            @if($u->isAuthor())
                <a href="{{ route('author.documents.create') }}"
                   class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-primary to-primary-container py-3 text-sm font-bold text-white shadow-lg shadow-primary/10">
                    <span class="material-symbols-outlined text-sm">add</span>
                    {{ __('Submit manuscript') }}
                </a>
            @endif
            <div class="space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="font-label flex w-full items-center gap-3 rounded-lg px-3 py-2 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500 transition-all hover:text-blue-700">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        <span>{{ __('Sign out') }}</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="flex-1 overflow-x-hidden p-6 sm:p-8 lg:p-12">
        @isset($header)
            <div class="mb-8 max-w-6xl">{{ $header }}</div>
        @endisset
        {{ $slot }}
    </main>
</div>
@stack('scripts')
</body>
</html>
