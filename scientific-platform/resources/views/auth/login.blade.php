<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ __('Sign In') }} - The Editorial Scholar</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&amp;family=Inter:wght@100..900&amp;family=Public+Sans:wght@100..900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "background": "#f7fafc",
              "on-primary-fixed-variant": "#2d476f",
              "surface-container": "#ebeef0",
              "on-secondary": "#ffffff",
              "error": "#ba1a1a",
              "error-container": "#ffdad6",
              "on-primary-fixed": "#001b3c",
              "surface-tint": "#455f88",
              "primary-container": "#1a365d",
              "outline": "#74777f",
              "on-surface": "#181c1e",
              "on-secondary-fixed": "#111c2c",
              "secondary": "#545f72",
              "surface-container-high": "#e5e9eb",
              "on-tertiary": "#ffffff",
              "primary-fixed-dim": "#adc7f7",
              "surface-container-highest": "#e0e3e5",
              "surface-variant": "#e0e3e5",
              "tertiary-container": "#4f2e00",
              "on-secondary-container": "#586377",
              "outline-variant": "#c4c6cf",
              "inverse-primary": "#adc7f7",
              "surface-bright": "#f7fafc",
              "on-error-container": "#93000a",
              "surface-container-low": "#f1f4f6",
              "inverse-on-surface": "#eef1f3",
              "tertiary-fixed": "#ffddba",
              "surface-container-lowest": "#ffffff",
              "secondary-fixed-dim": "#bcc7dd",
              "on-tertiary-fixed-variant": "#633f0f",
              "on-primary-container": "#86a0cd",
              "on-secondary-fixed-variant": "#3c475a",
              "on-primary": "#ffffff",
              "on-error": "#ffffff",
              "tertiary-fixed-dim": "#f2bc82",
              "secondary-fixed": "#d8e3fa",
              "on-tertiary-container": "#c6955e",
              "primary": "#002045",
              "on-tertiary-fixed": "#2b1700",
              "on-surface-variant": "#43474e",
              "secondary-container": "#d5e0f7",
              "tertiary": "#321b00",
              "primary-fixed": "#d6e3ff",
              "surface": "#f7fafc",
              "inverse-surface": "#2d3133",
              "on-background": "#181c1e",
              "surface-dim": "#d7dadc"
            },
            fontFamily: {
              "headline": ["Newsreader", "serif"],
              "body": ["Public Sans", "sans-serif"],
              "label": ["Inter", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem"},
          },
        },
      }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #f7fafc;
        }
    </style>
</head>
<body class="bg-surface text-on-surface flex flex-col min-h-screen">
<main class="flex-grow flex items-center justify-center px-6 py-24 relative overflow-hidden">
<div class="absolute top-0 right-0 w-1/3 h-full opacity-5 pointer-events-none transform translate-x-1/4">
<div class="w-full h-full bg-primary-container blur-[120px] rounded-full"></div>
</div>
<div class="w-full max-w-md relative z-10">
<div class="text-center mb-12">
<a href="{{ url('/') }}" class="block">
<h1 class="text-4xl font-headline italic text-primary tracking-tight">The Editorial Scholar</h1>
</a>
<p class="mt-4 font-label text-xs uppercase tracking-widest text-secondary">{{ __('Advancing Academic Discourse') }}</p>
</div>
<div class="bg-surface-container-lowest p-10 rounded-xl shadow-[0_40px_60px_-15px_rgba(24,28,30,0.06)] ring-1 ring-outline-variant/15">
<header class="mb-8">
<h2 class="text-2xl font-headline text-on-surface">{{ __('Welcome Back') }}</h2>
<p class="text-sm text-secondary font-body mt-2">{{ __('Access your manuscripts and reviews.') }}</p>
</header>

@if (session('status'))
    <p class="mb-4 text-sm text-secondary font-body">{{ session('status') }}</p>
@endif

<form class="space-y-6" method="POST" action="{{ route('login') }}">
@csrf
<!-- Email Field -->
<div class="space-y-2">
<label class="font-label text-[0.7rem] uppercase tracking-wider text-secondary" for="email">{{ __('Institutional Email') }}</label>
<input class="w-full px-4 py-3 bg-surface-container-low border-0 rounded-md focus:ring-2 focus:ring-primary-fixed-dim text-on-surface font-body placeholder:text-outline/50 transition-all duration-200 @error('email') ring-2 ring-error @enderror" id="email" name="email" placeholder="scholar@university.edu" required type="email" value="{{ old('email') }}" autocomplete="username" autofocus/>
@error('email')
    <p class="text-sm text-error font-body">{{ $message }}</p>
@enderror
</div>
<!-- Password Field -->
<div class="space-y-2">
<div class="flex justify-between items-end">
<label class="font-label text-[0.7rem] uppercase tracking-wider text-secondary" for="password">{{ __('Password') }}</label>
@if (Route::has('password.request'))
<a class="text-[0.75rem] font-label text-primary hover:underline underline-offset-4 transition-all" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
@endif
</div>
<input class="w-full px-4 py-3 bg-surface-container-low border-0 rounded-md focus:ring-2 focus:ring-primary-fixed-dim text-on-surface font-body placeholder:text-outline/50 transition-all duration-200 @error('password') ring-2 ring-error @enderror" id="password" name="password" placeholder="••••••••" required type="password" autocomplete="current-password"/>
@error('password')
    <p class="text-sm text-error font-body">{{ $message }}</p>
@enderror
</div>
<!-- Remember Me -->
<div class="flex items-center space-x-3">
<input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary-fixed-dim" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}/>
<label class="text-sm text-on-surface-variant font-body select-none" for="remember">{{ __('Stay signed in for 30 days') }}</label>
</div>
<!-- Primary Action: Submit -->
<button class="w-full py-4 bg-gradient-to-r from-primary to-primary-container text-on-primary font-label text-sm uppercase tracking-widest rounded-md hover:opacity-90 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-primary/10" type="submit">
                        {{ __('Sign In') }}
                    </button>
</form>
<!-- Divider -->
<div class="relative my-10">
<div class="absolute inset-0 flex items-center">
<div class="w-full border-t border-outline-variant/20"></div>
</div>
<div class="relative flex justify-center">
<span class="bg-surface-container-lowest px-4 text-xs font-label text-outline/60 uppercase tracking-widest">{{ __('or') }}</span>
</div>
</div>
<!-- Secondary Action -->
@if (Route::has('register'))
<div class="text-center">
<p class="text-sm text-secondary font-body">{{ __('New to the journal?') }}</p>
<a href="{{ route('register') }}" class="mt-4 inline-flex w-full justify-center items-center py-3 border border-outline-variant/30 text-primary font-label text-xs uppercase tracking-widest rounded-md hover:bg-surface-container-low transition-colors duration-200">
                        {{ __('Create an account') }}
                    </a>
</div>
@endif
</div>
<!-- Focus Mode Meta info -->
<div class="mt-12 flex items-center justify-center gap-6 opacity-60 flex-wrap">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-sm">lock</span>
<span class="text-[10px] font-label uppercase tracking-widest">{{ __('Secure Access') }}</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-sm">verified</span>
<span class="text-[10px] font-label uppercase tracking-widest">{{ __('Institutional Single Sign-on') }}</span>
</div>
</div>
</div>
</main>
<footer class="w-full border-t border-slate-200/15 flex flex-col md:flex-row justify-between items-center px-12 py-10 gap-6 bg-slate-50">
<div class="text-slate-400 font-sans text-xs tracking-wide uppercase">
            © {{ date('Y') }} The Editorial Scholar. {{ __('All rights reserved.') }}
        </div>
<nav class="flex flex-wrap justify-center gap-8">
<a class="text-slate-400 font-sans text-xs tracking-wide uppercase hover:text-blue-600 underline underline-offset-4 transition-all duration-300" href="#">{{ __('Privacy Policy') }}</a>
<a class="text-slate-400 font-sans text-xs tracking-wide uppercase hover:text-blue-600 underline underline-offset-4 transition-all duration-300" href="#">{{ __('Terms of Service') }}</a>
<a class="text-slate-400 font-sans text-xs tracking-wide uppercase hover:text-blue-600 underline underline-offset-4 transition-all duration-300" href="#">{{ __('Institutional Access') }}</a>
<a class="text-slate-400 font-sans text-xs tracking-wide uppercase hover:text-blue-600 underline underline-offset-4 transition-all duration-300" href="#">{{ __('Contact Support') }}</a>
</nav>
</footer>
</body>
</html>
