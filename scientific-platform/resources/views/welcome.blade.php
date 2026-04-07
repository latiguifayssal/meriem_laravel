<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>The Editorial Scholar</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&amp;family=Public+Sans:wght@300;400;500;600&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "secondary-fixed-dim": "#bcc7dd",
              "tertiary-fixed": "#ffddba",
              "surface-container-lowest": "#ffffff",
              "surface-container-low": "#f1f4f6",
              "inverse-on-surface": "#eef1f3",
              "on-error-container": "#93000a",
              "surface-bright": "#f7fafc",
              "on-primary-container": "#86a0cd",
              "on-tertiary-fixed-variant": "#633f0f",
              "primary": "#002045",
              "on-tertiary-container": "#c6955e",
              "tertiary-fixed-dim": "#f2bc82",
              "secondary-fixed": "#d8e3fa",
              "on-error": "#ffffff",
              "on-secondary-fixed-variant": "#3c475a",
              "on-primary": "#ffffff",
              "surface-dim": "#d7dadc",
              "on-background": "#181c1e",
              "surface": "#f7fafc",
              "inverse-surface": "#2d3133",
              "tertiary": "#321b00",
              "primary-fixed": "#d6e3ff",
              "secondary-container": "#d5e0f7",
              "on-tertiary-fixed": "#2b1700",
              "on-surface-variant": "#43474e",
              "error": "#ba1a1a",
              "surface-container": "#ebeef0",
              "on-secondary": "#ffffff",
              "on-primary-fixed-variant": "#2d476f",
              "background": "#f7fafc",
              "primary-container": "#1a365d",
              "outline": "#74777f",
              "on-surface": "#181c1e",
              "surface-tint": "#455f88",
              "on-primary-fixed": "#001b3c",
              "error-container": "#ffdad6",
              "primary-fixed-dim": "#adc7f7",
              "surface-container-high": "#e5e9eb",
              "on-tertiary": "#ffffff",
              "secondary": "#545f72",
              "on-secondary-fixed": "#111c2c",
              "outline-variant": "#c4c6cf",
              "inverse-primary": "#adc7f7",
              "on-secondary-container": "#586377",
              "tertiary-container": "#4f2e00",
              "surface-variant": "#e0e3e5",
              "surface-container-highest": "#e0e3e5"
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
      body { font-family: 'Public Sans', sans-serif; }
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }
    </style>
</head>
<body class="bg-surface text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md">
<div class="flex justify-between items-center px-8 py-4 w-full max-w-screen-2xl mx-auto">
<div class="text-2xl font-serif italic text-blue-900">The Editorial Scholar</div>
<!-- Desktop: jump to published list -->
<div class="hidden md:flex items-center">
<a class="text-blue-900 font-bold border-b-2 border-blue-900 font-serif font-medium tracking-tight ease-in-out duration-300" href="#published-research">{{ __('Browse') }}</a>
</div>
<div class="flex items-center space-x-6">
@auth
    <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center bg-primary text-on-primary px-6 py-2.5 rounded-md font-label text-sm font-semibold tracking-wide hover:opacity-90 transition-opacity">
        {{ __('Dashboard') }}
    </a>
@else
    @if (\Illuminate\Support\Facades\Route::has('login'))
    <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-primary text-on-primary px-6 py-2.5 rounded-md font-label text-sm font-semibold tracking-wide hover:opacity-90 transition-opacity">
        {{ __('Sign In') }}
    </a>
    @endif
@endauth
</div>
</div>
</nav>
<main class="pt-24">
<!-- Hero Section -->
<section class="relative min-h-[819px] flex items-center px-8 max-w-7xl mx-auto mb-24">
<div class="grid md:grid-cols-12 gap-12 items-center w-full">
<div class="md:col-span-7 space-y-10">
<div class="inline-block px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full font-label text-[10px] uppercase tracking-[0.2em] font-bold">
                        Established 1894 • Open Access
                    </div>
<h1 class="font-headline text-5xl md:text-7xl text-primary leading-[1.1] tracking-tight">
                        Where rigorous science <br/><span class="italic text-on-primary-container">meets editorial craft.</span>
</h1>
<p class="font-body text-xl text-on-surface-variant max-w-xl leading-relaxed">
                        The Editorial Scholar provides a prestigious platform for groundbreaking research, ensuring every manuscript receives deep critical analysis from the world's leading academic minds.
                    </p>
<div class="flex flex-wrap gap-6 pt-4">
@auth
    @if (auth()->user()->isAuthor())
        <a href="{{ route('author.documents.create') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-primary to-primary-container text-on-primary px-8 py-4 rounded-md font-label text-sm font-bold tracking-widest uppercase hover:opacity-90 transition-all">
                            {{ __('Submit Manuscript') }}
                        </a>
    @else
        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-primary to-primary-container text-on-primary px-8 py-4 rounded-md font-label text-sm font-bold tracking-widest uppercase hover:opacity-90 transition-all">
                            {{ __('Submit Manuscript') }}
                        </a>
    @endif
@else
    @if (\Illuminate\Support\Facades\Route::has('register'))
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-primary to-primary-container text-on-primary px-8 py-4 rounded-md font-label text-sm font-bold tracking-widest uppercase hover:opacity-90 transition-all">
                            {{ __('Submit Manuscript') }}
                        </a>
    @else
        <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-primary to-primary-container text-on-primary px-8 py-4 rounded-md font-label text-sm font-bold tracking-widest uppercase hover:opacity-90 transition-all">
                            {{ __('Submit Manuscript') }}
                        </a>
    @endif
@endauth
</div>
</div>
<div class="md:col-span-5 relative">
<div class="aspect-[4/5] bg-surface-container-low rounded-xl overflow-hidden shadow-2xl rotate-3 transform hover:rotate-0 transition-transform duration-700">
<img alt="A high-end minimal scientific journal cover" class="w-full h-full object-cover grayscale contrast-125 opacity-90" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA13cji66HUcIy_o-c7N-FfFwQrr6EaUKYpYx91SQSDkjQSw7aGl8zK72O4lQBNGE-H8X2fW3dlv4WqMP7mH5R7iSdeNRjhwV7Tit35t7BeFPjf6CeeheJu4Iv3srGcXe9rWvLwf2e5rLMJI2e1vUM4c6tC2b98gs_LgZyl7AiY5udtcJho_AfXZRHhM83CZurAZQkOX86zgm570dkq0yaj9cN_ZXd5BR4yrSmSzlMRvt-pu3tWeHIFMr9-IzAiYFJVy1sekjJiTVkw"/>
</div>
<div class="absolute -bottom-8 -left-8 bg-surface-container-lowest p-8 shadow-xl max-w-xs rounded-lg border border-outline-variant/10">
<span class="material-symbols-outlined text-primary-container mb-4" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
<p class="font-headline italic text-lg text-primary">"The Digital Curator for modern discovery."</p>
<p class="font-label text-[10px] uppercase tracking-widest text-secondary mt-2">— Nature Insights Review</p>
</div>
</div>
</div>
</section>
<!-- Values Bento Section -->
<section class="bg-surface-container-low py-32 px-8">
<div class="max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
<div class="max-w-2xl">
<h2 class="font-headline text-4xl text-primary mb-6">Our Editorial Philosophy</h2>
<p class="font-body text-lg text-on-surface-variant">We treat every submission as a potential milestone in human knowledge, applying a "No-Line" visual clarity to all data analysis.</p>
</div>
<div class="font-label text-xs uppercase tracking-widest text-secondary font-bold border-b border-primary/20 pb-2">
                        Scroll to explore published works
                    </div>
</div>
<div class="grid md:grid-cols-3 gap-8">
<!-- Value Card 1 -->
<div class="bg-surface-container-lowest p-10 rounded-xl space-y-6 hover:translate-y-[-4px] transition-transform duration-300">
<span class="material-symbols-outlined text-primary text-3xl">verified_user</span>
<h3 class="font-headline text-2xl text-primary">Unbiased Review</h3>
<p class="font-body text-on-surface-variant leading-relaxed">Double-blind peer review process powered by our global network of over 14,000 active senior editors.</p>
</div>
<!-- Value Card 2 -->
<div class="bg-primary text-on-primary p-10 rounded-xl space-y-6 hover:translate-y-[-4px] transition-transform duration-300">
<span class="material-symbols-outlined text-primary-fixed text-3xl">bolt</span>
<h3 class="font-headline text-2xl">Rapid Dissemination</h3>
<p class="text-on-primary/80 font-body leading-relaxed">From submission to first decision in an average of 18 days, maintaining scholarly integrity without the wait.</p>
</div>
<!-- Value Card 3 -->
<div class="bg-surface-container-lowest p-10 rounded-xl space-y-6 hover:translate-y-[-4px] transition-transform duration-300">
<span class="material-symbols-outlined text-primary text-3xl">visibility</span>
<h3 class="font-headline text-2xl text-primary">Global Impact</h3>
<p class="font-body text-on-surface-variant leading-relaxed">Open access indexing in all major scientific databases, ensuring your work reaches every corner of the globe.</p>
</div>
</div>
</div>
</section>
<!-- Latest Published Research -->
<section id="published-research" class="scroll-mt-28 py-32 px-8 max-w-7xl mx-auto">
<div class="mb-20 text-center">
<span class="font-label text-xs uppercase tracking-[0.3em] text-secondary">In Circulation Now</span>
<h2 class="font-headline text-5xl text-primary mt-4">Latest Published Research</h2>
</div>
@php
    $pubIcons = ['description', 'biotech', 'eco', 'psychology', 'menu_book', 'globe'];
@endphp
<div class="space-y-1 w-full">
@forelse ($publishedDocuments as $document)
<article class="group relative py-12 px-4 hover:bg-surface-container-low transition-colors duration-500 flex flex-col md:flex-row gap-8 items-start">
<div class="w-16 h-16 bg-surface-container flex items-center justify-center rounded-lg group-hover:bg-primary transition-colors">
<span class="material-symbols-outlined text-primary group-hover:text-white">{{ $pubIcons[$loop->index % count($pubIcons)] }}</span>
</div>
<div class="flex-1 space-y-4">
<div class="flex items-center gap-4">
<span class="font-label text-[10px] text-secondary font-bold tracking-widest uppercase">{{ __('Published') }}</span>
<span class="text-outline-variant">•</span>
<time class="font-label text-[10px] text-secondary font-bold tracking-widest uppercase" datetime="{{ $document->published_at?->toIso8601String() }}">{{ $document->published_at?->format('M Y') }}</time>
</div>
<h3 class="font-headline text-3xl text-primary group-hover:text-on-primary-fixed-variant transition-colors">
<a href="{{ route('published.show', $document) }}" class="focus:outline-none focus:ring-2 focus:ring-primary rounded-sm">{{ $document->title }}</a>
                        </h3>
<p class="font-body text-on-surface-variant max-w-3xl leading-relaxed">
                            {{ \Illuminate\Support\Str::limit(strip_tags($document->abstract), 260) }}
                        </p>
<div class="flex items-center gap-6 pt-2">
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-sm">person</span>
</div>
<span class="font-label text-xs text-primary font-semibold">{{ $document->user->name }}</span>
</div>
</div>
</div>
<div class="md:self-center">
<a href="{{ route('published.show', $document) }}" class="inline-flex material-symbols-outlined text-primary-container p-4 border border-outline-variant/30 rounded-full hover:bg-primary hover:text-white transition-all no-underline" aria-label="{{ __('Read more') }}">
                            arrow_forward
                        </a>
</div>
<div class="absolute bottom-0 left-4 right-4 h-px bg-outline-variant/10"></div>
</article>
@empty
<p class="font-body text-center text-on-surface-variant py-16 max-w-xl mx-auto">{{ __('Published works will appear here once the editorial team releases them.') }}</p>
@endforelse
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full py-12 border-t border-slate-100 bg-white">
<div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center gap-8">
<div class="space-y-2">
<div class="font-serif italic text-lg text-primary">The Editorial Scholar</div>
<p class="font-sans text-sm tracking-normal text-slate-500">© {{ date('Y') }} The Editorial Scholar. Peer-reviewed excellence.</p>
</div>
</div>
</footer>
</body>
</html>
