<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Sign Up') }} | The Editorial Scholar</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&amp;family=Inter:wght@400;500;600;700&amp;family=Public+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
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
        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #f7fafc;
            color: #181c1e;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .bg-editorial-gradient {
            background: linear-gradient(135deg, #002045 0%, #1a365d 100%);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-surface">
<header class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md h-20 flex justify-between items-center px-8 max-w-full">
<a href="{{ url('/') }}" class="text-2xl font-serif italic text-blue-900 dark:text-blue-100">The Editorial Scholar</a>
<div class="hidden md:flex gap-8 items-center">
<span class="text-slate-500 font-medium text-sm font-label">{{ __('Institutional Access') }}</span>
<span class="material-symbols-outlined text-blue-900" aria-hidden="true">help_outline</span>
</div>
</header>
<main class="flex-grow flex items-center justify-center pt-24 pb-12 px-6">
<div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-12 gap-0 overflow-hidden rounded-xl shadow-2xl shadow-on-surface/5 bg-surface-container-lowest">
<div class="hidden md:flex md:col-span-5 bg-editorial-gradient p-12 flex-col justify-between relative overflow-hidden">
<div class="relative z-10">
<h2 class="font-headline text-4xl text-on-primary font-light leading-tight mb-6">{{ __('Advancing the global corpus of knowledge.') }}</h2>
<p class="text-on-primary-container font-body text-lg leading-relaxed opacity-90">{{ __('Join a prestigious network of peer reviewers and academic authors across all scientific disciplines.') }}</p>
</div>
<div class="relative z-10 mt-12">
<div class="flex flex-col gap-4">
<div class="flex items-center gap-3 text-on-primary/80">
<span class="material-symbols-outlined text-sm" aria-hidden="true">verified</span>
<span class="text-xs font-label uppercase tracking-widest">{{ __('Double-Blind Review') }}</span>
</div>
<div class="flex items-center gap-3 text-on-primary/80">
<span class="material-symbols-outlined text-sm" aria-hidden="true">article</span>
<span class="text-xs font-label uppercase tracking-widest">{{ __('Open Access Publishing') }}</span>
</div>
</div>
</div>
<div class="absolute inset-0 opacity-10 pointer-events-none">
<svg height="100%" preserveAspectRatio="none" viewBox="0 0 100 100" width="100%">
<path d="M0 100 C 20 0 50 0 100 100" fill="transparent" stroke="white" stroke-width="0.1"></path>
<path d="M0 80 C 30 20 60 20 100 80" fill="transparent" stroke="white" stroke-width="0.1"></path>
<path d="M0 60 C 40 40 70 40 100 60" fill="transparent" stroke="white" stroke-width="0.1"></path>
</svg>
</div>
</div>
<div class="md:col-span-7 p-8 md:p-16 bg-surface-container-lowest">
<div class="mb-10">
<h1 class="font-headline text-3xl text-primary mb-2">{{ __('Create your scholarly profile') }}</h1>
<p class="text-secondary font-body text-sm">{{ __('Please provide your institutional credentials to begin the submission process.') }}</p>
</div>
<form class="space-y-6" method="POST" action="{{ route('register') }}">
@csrf
<div class="grid grid-cols-1 gap-6">
<div class="space-y-1.5">
<label class="block text-[10px] font-label font-semibold uppercase tracking-wider text-secondary" for="name">{{ __('Full Name') }}</label>
<input class="w-full bg-surface-container-low border-none rounded-lg py-3 px-4 text-on-surface placeholder:text-outline-variant focus:ring-2 focus:ring-primary/20 transition-all font-body @error('name') ring-2 ring-error @enderror" id="name" name="name" placeholder="Dr. Julian Sterling" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"/>
@error('name')
    <p class="text-sm text-error font-body">{{ $message }}</p>
@enderror
</div>
<div class="space-y-1.5">
<label class="block text-[10px] font-label font-semibold uppercase tracking-wider text-secondary" for="email">{{ __('Institutional Email') }}</label>
<input class="w-full bg-surface-container-low border-none rounded-lg py-3 px-4 text-on-surface placeholder:text-outline-variant focus:ring-2 focus:ring-primary/20 transition-all font-body @error('email') ring-2 ring-error @enderror" id="email" name="email" placeholder="j.sterling@university.edu" type="email" value="{{ old('email') }}" required autocomplete="username"/>
@error('email')
    <p class="text-sm text-error font-body">{{ $message }}</p>
@enderror
</div>
<div class="space-y-1.5">
<label class="block text-[10px] font-label font-semibold uppercase tracking-wider text-secondary" for="field_of_study">{{ __('Academic Discipline') }}</label>
<select class="w-full bg-surface-container-low border-none rounded-lg py-3 px-4 text-on-surface focus:ring-2 focus:ring-primary/20 transition-all font-body appearance-none bg-[length:1.25rem] bg-[right_1rem_center] bg-no-repeat pr-10 @error('field_of_study') ring-2 ring-error @enderror" id="field_of_study" name="field_of_study" required style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%2343474e%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%222%22 d=%22M19 9l-7 7-7-7%22/%3E%3C/svg%3E')">
<option value="" disabled @selected(old('field_of_study') === null || old('field_of_study') === ''))>{{ __('Select your field of study') }}</option>
@foreach (\App\Enums\FieldOfStudy::cases() as $field)
    <option value="{{ $field->value }}" @selected(old('field_of_study') === $field->value)>{{ $field->label() }}</option>
@endforeach
</select>
@error('field_of_study')
    <p class="text-sm text-error font-body">{{ $message }}</p>
@enderror
</div>
<div class="space-y-1.5">
<label class="block text-[10px] font-label font-semibold uppercase tracking-wider text-secondary" for="password">{{ __('Password') }}</label>
<div class="relative">
<input class="w-full bg-surface-container-low border-none rounded-lg py-3 px-4 pr-12 text-on-surface placeholder:text-outline-variant focus:ring-2 focus:ring-primary/20 transition-all font-body @error('password') ring-2 ring-error @enderror" id="password" name="password" placeholder="••••••••••••" type="password" required autocomplete="new-password"/>
<button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline cursor-pointer text-xl p-0 bg-transparent border-0" aria-label="{{ __('Toggle password visibility') }}" onclick="document.getElementById('password').type = document.getElementById('password').type === 'password' ? 'text' : 'password'">
<span class="material-symbols-outlined text-xl" id="password-visibility-icon">visibility</span>
</button>
</div>
@error('password')
    <p class="text-sm text-error font-body">{{ $message }}</p>
@enderror
</div>
<div class="space-y-1.5">
<label class="block text-[10px] font-label font-semibold uppercase tracking-wider text-secondary" for="password_confirmation">{{ __('Confirm Password') }}</label>
<input class="w-full bg-surface-container-low border-none rounded-lg py-3 px-4 text-on-surface placeholder:text-outline-variant focus:ring-2 focus:ring-primary/20 transition-all font-body @error('password_confirmation') ring-2 ring-error @enderror" id="password_confirmation" name="password_confirmation" placeholder="••••••••••••" type="password" required autocomplete="new-password"/>
@error('password_confirmation')
    <p class="text-sm text-error font-body">{{ $message }}</p>
@enderror
</div>
</div>
<div class="pt-4">
<button class="w-full bg-editorial-gradient text-on-primary font-label font-semibold py-4 rounded-lg shadow-lg hover:opacity-90 transition-opacity active:scale-[0.99] transform" type="submit">
                            {{ __('Create Account') }}
                        </button>
</div>
<div class="text-center pt-8 border-t border-outline-variant/15">
<p class="text-sm font-body text-secondary">
                            {{ __('Already have an account?') }}
                            <a class="text-primary font-semibold hover:underline underline-offset-4 ml-1" href="{{ route('login') }}">{{ __('Sign In') }}</a>
</p>
</div>
</form>
</div>
</div>
</main>
<footer class="w-full border-t border-slate-200/15 dark:border-slate-800/15 bg-slate-50 dark:bg-slate-950 flex flex-col md:flex-row justify-between items-center px-12 py-10 gap-6">
<div class="text-xs font-sans tracking-wide uppercase text-slate-400 dark:text-slate-600">
            © {{ date('Y') }} The Editorial Scholar. {{ __('All rights reserved.') }}
        </div>
</footer>
</body>
</html>
