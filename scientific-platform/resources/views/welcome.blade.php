<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ __('The Editorial Scholar') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,400;0,600;0,700;1,400&amp;family=Public+Sans:wght@300;400;500;600;700&amp;family=Inter:wght@400;500;600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary-container': '#002045',
                        'tertiary-fixed': '#ffdbcb',
                        'on-tertiary-fixed': '#341100',
                        'error-container': '#ffdad6',
                        'tertiary-fixed-dim': '#ffb692',
                        'surface-container-highest': '#e1e3e4',
                        'on-tertiary-fixed-variant': '#6c391e',
                        'on-tertiary-container': '#b97858',
                        'surface-container': '#edeeef',
                        'surface-tint': '#465f87',
                        error: '#ba1a1a',
                        'on-background': '#191c1d',
                        'on-error': '#ffffff',
                        tertiary: '#160400',
                        secondary: '#51606f',
                        'surface-dim': '#d9dadb',
                        'on-secondary-fixed-variant': '#394857',
                        outline: '#74777f',
                        'on-primary-fixed-variant': '#2e476e',
                        primary: '#00091b',
                        'on-surface-variant': '#44474e',
                        'surface-container-low': '#f3f4f5',
                        'surface-container-high': '#e7e8e9',
                        'on-surface': '#191c1d',
                        'inverse-primary': '#aec7f5',
                        background: '#f8f9fa',
                        'outline-variant': '#c4c6cf',
                        'surface-container-lowest': '#ffffff',
                        'tertiary-container': '#3c1400',
                        'secondary-fixed': '#d4e4f6',
                        'inverse-on-surface': '#f0f1f2',
                        'on-primary': '#ffffff',
                        surface: '#f8f9fa',
                        'on-tertiary': '#ffffff',
                        'primary-fixed': '#d6e3ff',
                        'on-primary-fixed': '#001b3c',
                        'secondary-fixed-dim': '#b9c8da',
                        'surface-variant': '#e1e3e4',
                        'surface-bright': '#f8f9fa',
                        'on-error-container': '#93000a',
                        'on-secondary-container': '#576675',
                        'on-secondary': '#ffffff',
                        'on-secondary-fixed': '#0d1d2a',
                        'on-primary-container': '#7089b3',
                        'inverse-surface': '#2e3132',
                        'secondary-container': '#d4e4f6',
                        'primary-fixed-dim': '#aec7f5',
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
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .serif-italic { font-family: 'Newsreader', serif; font-style: italic; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(16px);
        }
        .primary-gradient {
            background: linear-gradient(135deg, #00091b 0%, #002045 100%);
        }
        .ambient-shadow { box-shadow: 0 12px 40px rgba(0, 32, 69, 0.06); }
        .clip-path-slant {
            clip-path: polygon(18% 0, 100% 0, 100% 100%, 0% 100%);
        }
    </style>
</head>
<body class="bg-background text-on-background font-body selection:bg-primary-fixed selection:text-on-primary-fixed">
<nav class="bg-[#f8f9fa] dark:bg-[#00091B] sticky top-0 z-50 flex justify-between items-center w-full px-8 py-4 max-w-screen-2xl mx-auto">
    <div class="flex items-center gap-12">
        <a class="text-2xl font-serif italic text-[#00091B] dark:text-white" href="{{ url('/') }}">{{ __('The Editorial Scholar') }}</a>
        <div class="hidden md:flex gap-8 items-center">
            <a class="text-[#44474e] dark:text-[#c4c6cf] hover:text-[#00091B] transition-colors duration-300" href="#published-research">{{ __('Browse Published Work') }}</a>
        </div>
    </div>
    <div class="flex items-center gap-6">
        @auth
            <a class="text-[#44474e] dark:text-[#c4c6cf] hover:text-[#00091B] transition-colors duration-300" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        @else
            @if (\Illuminate\Support\Facades\Route::has('login'))
                <a class="text-[#44474e] dark:text-[#c4c6cf] hover:text-[#00091B] transition-colors duration-300" href="{{ route('login') }}">{{ __('Sign In') }}</a>
            @endif
            @if (\Illuminate\Support\Facades\Route::has('register'))
                <a class="bg-primary text-on-primary px-5 py-2 rounded-lg font-medium hover:bg-primary-container transition-all active:scale-[0.99] duration-150" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        @endauth
    </div>
</nav>
<main>
    <section class="relative min-h-[870px] flex items-center overflow-hidden bg-surface">
        <div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-primary-container clip-path-slant"></div>
        </div>
        <div class="container mx-auto px-8 relative z-10 grid lg:grid-cols-12 gap-16 items-center">
            <div class="lg:col-span-7">
                <span class="inline-block mb-6 px-4 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed text-sm font-label tracking-widest uppercase">{{ __('Global Research Repository') }}</span>
                <h1 class="font-headline text-6xl lg:text-8xl text-primary leading-tight mb-8">{{ __('Elevating Scholarly') }} <br/><span class="serif-italic">{{ __('Excellence.') }}</span></h1>
                <p class="text-on-surface-variant text-xl max-w-2xl mb-10 leading-relaxed">
                    {{ __('A high-fidelity editorial ecosystem for the modern academic. Bridging the gap between rapid dissemination and authoritative peer-reviewed integrity.') }}
                </p>
                <div class="flex flex-wrap gap-6">
                    <a class="primary-gradient text-on-primary px-8 py-4 rounded-lg font-semibold flex items-center gap-3 hover:opacity-90 transition-all active:scale-[0.98]" href="#published-research">
                        {{ __('Browse Published Work') }}
                        <span class="material-symbols-outlined text-sm">arrow_downward</span>
                    </a>
                    @auth
                        @if (auth()->user()->isAuthor())
                            <a class="border border-outline text-primary px-8 py-4 rounded-lg font-semibold hover:bg-surface-container-high transition-all active:scale-[0.98]" href="{{ route('author.documents.create') }}">
                                {{ __('Submit Manuscript') }}
                            </a>
                        @else
                            <a class="border border-outline text-primary px-8 py-4 rounded-lg font-semibold hover:bg-surface-container-high transition-all active:scale-[0.98]" href="{{ route('dashboard') }}">
                                {{ __('Submit Manuscript') }}
                            </a>
                        @endif
                    @else
                        @if (\Illuminate\Support\Facades\Route::has('register'))
                            <a class="border border-outline text-primary px-8 py-4 rounded-lg font-semibold hover:bg-surface-container-high transition-all active:scale-[0.98]" href="{{ route('register') }}">
                                {{ __('Submit Manuscript') }}
                            </a>
                        @elseif (\Illuminate\Support\Facades\Route::has('login'))
                            <a class="border border-outline text-primary px-8 py-4 rounded-lg font-semibold hover:bg-surface-container-high transition-all active:scale-[0.98]" href="{{ route('login') }}">
                                {{ __('Submit Manuscript') }}
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="lg:col-span-5 hidden lg:block">
                <div class="relative">
                    <div class="absolute -top-12 -left-12 w-24 h-24 bg-tertiary-fixed-dim rounded-full mix-blend-multiply opacity-50"></div>
                    <img class="rounded-xl ambient-shadow w-full aspect-[4/5] object-cover relative z-10" alt="" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrhhcIqvVb1xhqNtxeYlgxpZonK7lt1S96mQUH2dDCFLjqATkJtjen3LxT_Cp_9CawXKc4QyMXLF4D6Y7lzxBfeDTltdZg1TNS3fJsEYyEC8HYCQUo1Kcd7rtKHmAIHtUbHogm6l4ldNEa9PVuR9qELm08IfAjAwbh1EKloZjC1E0IMsGMhUmvJMBk5aMgMq93L1qb7bB5VioXhNjddXIHXCsf4E_d_QQFY4YTt6feiBwXji5LzA1E-Zvpggu5bwiEI8ljFehehDas"/>
                    <div class="absolute -bottom-8 -right-8 glass-panel p-6 rounded-xl ambient-shadow z-20 max-w-xs border border-white/20">
                        <p class="font-headline text-lg italic text-primary">{{ __('“The Digital Curator transforms raw data into prestigious journal features.”') }}</p>
                        <div class="mt-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-fixed"></div>
                            <span class="text-xs font-label text-secondary uppercase tracking-tighter">{{ __('Editorial Board') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-surface-container-low">
        <div class="container mx-auto px-8">
            <div class="max-w-3xl mb-20">
                <h2 class="font-headline text-4xl text-primary mb-6">{{ __('The Scholarly Pipeline') }}</h2>
                <p class="text-on-surface-variant text-lg">{{ __('Our streamlined workflow ensures rigorous quality control while maintaining the pace of contemporary research discovery.') }}</p>
            </div>
            <div class="grid md:grid-cols-4 gap-4">
                <div class="bg-surface-container-lowest p-8 rounded-xl border-l-4 border-primary ambient-shadow">
                    <span class="material-symbols-outlined text-primary-container text-4xl mb-6">upload_file</span>
                    <h3 class="font-headline text-2xl text-primary mb-3">{{ __('1. Submit') }}</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">{{ __('Authors upload manuscripts with title, abstract, and supporting files.') }}</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-xl border-l-4 border-secondary-fixed-dim ambient-shadow">
                    <span class="material-symbols-outlined text-primary-container text-4xl mb-6">assignment_ind</span>
                    <h3 class="font-headline text-2xl text-primary mb-3">{{ __('2. Assignment') }}</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">{{ __('Administrators assign subject-matter experts to review each submission.') }}</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-xl border-l-4 border-tertiary-fixed-dim ambient-shadow">
                    <span class="material-symbols-outlined text-primary-container text-4xl mb-6">rate_review</span>
                    <h3 class="font-headline text-2xl text-primary mb-3">{{ __('3. Peer Review') }}</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">{{ __('Reviewers provide structured comments and recommendations (approve, changes needed, or reject).') }}</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-xl border-l-4 border-surface-tint ambient-shadow">
                    <span class="material-symbols-outlined text-primary-container text-4xl mb-6">verified</span>
                    <h3 class="font-headline text-2xl text-primary mb-3">{{ __('4. Publication') }}</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">{{ __('Accepted works are published to the public repository for open reading.') }}</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-surface">
        <div class="container mx-auto px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-start">
                <div class="lg:w-1/3 lg:sticky lg:top-32">
                    <h2 class="font-headline text-4xl text-primary mb-6">{{ __('Ecosystem Roles') }}</h2>
                    <p class="text-on-surface-variant text-lg mb-8">{{ __('A specialized interface tailored to the distinct needs of the scholarly community.') }}</p>
                    <div class="flex flex-col gap-4">
                        <div class="p-4 rounded-lg bg-surface-container-high border-l-2 border-primary">
                            <span class="font-label text-xs uppercase tracking-widest text-secondary font-bold">{{ __('Author') }}</span>
                            <p class="text-sm mt-1">{{ __('Create and manage manuscripts, track status, and respond to the editorial process.') }}</p>
                        </div>
                        <div class="p-4 rounded-lg hover:bg-surface-container transition-colors cursor-default">
                            <span class="font-label text-xs uppercase tracking-widest text-secondary font-bold">{{ __('Reviewer') }}</span>
                            <p class="text-sm mt-1">{{ __('Review assigned submissions and submit feedback with a clear recommendation.') }}</p>
                        </div>
                        <div class="p-4 rounded-lg hover:bg-surface-container transition-colors cursor-default">
                            <span class="font-label text-xs uppercase tracking-widest text-secondary font-bold">{{ __('Administrator') }}</span>
                            <p class="text-sm mt-1">{{ __('Assign reviewers, oversee the pipeline, and publish approved research.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-2/3 grid md:grid-cols-2 gap-8">
                    <div class="group relative overflow-hidden rounded-xl">
                        <img class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500" alt="" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGBJjDlbxZ8pvIqKvguT258zlA-ESRIpNZbmAqUCwd4IyL1GUbPrB9ApQqDiuuL572aaFpw5znZ_5sVfZ3bl4_OayOlwyYJv0c8zZE4a7EerhrAWntyGVX6fWwdtFRZ_iL49fHsk3qTWgSJnFOFQ6mLbHXFXAFv9DXbptcQ6fqqz7xCAB3VRog3VB1X_T65_yP1FKR8FjZqegL8Ir7ZUYzSKePMaaEuiURB3zWd6XAVKSonyaSJX3AqFC-ouMuXAJ09OHe_0U33BDR"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent flex items-end p-8">
                            <h4 class="text-white font-headline text-2xl">{{ __('Publish with Integrity') }}</h4>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-xl">
                        <img class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500" alt="" src="https://lh3.googleusercontent.com/aida-public/AB6AXuByT7ms1ABTAvSd125gh8BbQnG7kAqR0lOIxSoiCl7vHupGWuQrV8R56ttuz4GshU4AwfXyKsdlTxZOocXs8fwcNat8kfhINaXVrrRApS8up8k157eOI2bXRMNqh5I7YZpJ4k7abeVTFmVbJTdYJDQLKy3jSKB7wJazNCXQHfOz3Hrb_ZoxQTi6af1ZmqnYGnSVkn8f8im1LxkcJ8rSuNNtBoKZ6jnUlSeyqip9YRNeQsN9IPocC8-B0tEfcM6H36qCTTx8_W9pIvq8"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent flex items-end p-8">
                            <h4 class="text-white font-headline text-2xl">{{ __('Connect & Collaborate') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-surface-container-low" id="published-research">
        <div class="container mx-auto px-8">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h2 class="font-headline text-4xl text-primary mb-4">{{ __('Latest Publications') }}</h2>
                    <p class="text-on-surface-variant">{{ __('Synthesizing the forefront of global research.') }}</p>
                </div>
            </div>
            @php
                $badgeForField = function (?string $value): string {
                    return match ($value) {
                        'biological_sciences' => 'bg-surface-tint text-white',
                        'physics_astronomy' => 'bg-primary text-on-primary',
                        'computer_science_ai' => 'bg-secondary text-on-secondary',
                        'social_sciences' => 'bg-secondary-fixed-dim text-on-secondary-fixed',
                        'humanities' => 'bg-tertiary-fixed-dim text-on-tertiary-fixed',
                        'medicine_health' => 'bg-error-container text-on-error-container',
                        default => 'bg-surface-container-high text-primary',
                    };
                };
                $avatarForField = function (?string $value): string {
                    return match ($value) {
                        'biological_sciences' => 'bg-secondary-fixed text-on-secondary-fixed',
                        'physics_astronomy' => 'bg-primary-fixed text-on-primary-fixed',
                        'computer_science_ai' => 'bg-secondary-fixed text-on-secondary-fixed',
                        'social_sciences' => 'bg-tertiary-fixed text-on-tertiary-fixed',
                        'humanities' => 'bg-surface-container text-on-surface',
                        'medicine_health' => 'bg-error-container text-on-error-container',
                        default => 'bg-secondary-fixed text-on-secondary-fixed',
                    };
                };
            @endphp
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($publishedDocuments as $document)
                    @php
                        $user = $document->user;
                        $field = $user?->field_of_study;
                        $fieldValue = $field?->value;
                        $badgeClass = $badgeForField($fieldValue);
                        $avatarClass = $avatarForField($fieldValue);
                        $fieldLabel = $field ? $field->label() : __('Research');
                        $initials = \Illuminate\Support\Str::of($user?->name ?? '')
                            ->explode(' ')
                            ->filter()
                            ->take(2)
                            ->map(fn (string $w) => mb_strtoupper(mb_substr($w, 0, 1)))
                            ->join('');
                        if ($initials === '') {
                            $initials = '?';
                        }
                    @endphp
                    <article class="bg-surface-container-lowest p-8 rounded-xl ambient-shadow hover:bg-surface-bright transition-all group border-b-2 border-transparent hover:border-primary-fixed-dim flex flex-col h-full">
                        <a href="{{ route('published.show', $document) }}" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-xl flex flex-col flex-1 min-h-0 no-underline text-inherit">
                            <div class="flex justify-between items-start mb-6">
                                <span class="{{ $badgeClass }} text-[10px] uppercase tracking-widest px-3 py-1 rounded-full font-label">{{ $fieldLabel }}</span>
                                <time class="text-xs text-secondary" datetime="{{ $document->published_at?->toIso8601String() }}">{{ $document->published_at?->translatedFormat('M j, Y') }}</time>
                            </div>
                            <h3 class="font-headline text-2xl text-primary mb-4 group-hover:text-primary-container leading-tight">{{ $document->title }}</h3>
                            <p class="text-on-surface-variant text-sm mb-8 line-clamp-3 leading-relaxed">{{ \Illuminate\Support\Str::limit(strip_tags((string) ($document->abstract ?? '')), 180) }}</p>
                        </a>
                            <div class="flex items-center gap-3 mt-auto pt-6 border-t border-outline-variant/20">
                                <div class="w-8 h-8 rounded {{ $avatarClass }} flex items-center justify-center text-xs font-bold shrink-0">{{ $initials }}</div>
                                <span class="text-xs font-medium text-secondary truncate">{{ $user?->name }}</span>
                                <a href="{{ route('published.show', $document) }}" class="ml-auto material-symbols-outlined text-primary-container text-xl no-underline shrink-0" aria-label="{{ __('Read publication') }}">arrow_forward</a>
                            </div>
                    </article>
                @empty
                    <p class="text-on-surface-variant md:col-span-2 lg:col-span-3 text-center py-16">{{ __('Published works will appear here once the editorial team releases them.') }}</p>
                @endforelse
            </div>
        </div>
    </section>
    <section class="py-24 bg-primary text-on-primary">
        <div class="container mx-auto px-8 flex flex-col items-center text-center">
            <h2 class="font-headline text-5xl mb-8">{{ __('Ready to Contribute?') }}</h2>
            <p class="text-primary-fixed max-w-2xl text-lg mb-12 opacity-80">{{ __('Join scholars, reviewers, and administrators using this platform for structured peer review and open publication.') }}</p>
            <div class="flex flex-wrap justify-center gap-6">
                @if (\Illuminate\Support\Facades\Route::has('register'))
                    <a class="bg-surface text-primary px-10 py-4 rounded-lg font-bold hover:bg-surface-bright transition-all" href="{{ route('register') }}">{{ __('Get Started') }}</a>
                @endif
                <a class="border border-outline-variant text-on-primary px-10 py-4 rounded-lg font-bold hover:bg-white/5 transition-all" href="#published-research">{{ __('Browse publications') }}</a>
            </div>
        </div>
    </section>
</main>
<footer class="bg-[#f8f9fa] dark:bg-[#00091B] w-full border-t border-[#c4c6cf]/20 flex flex-col md:flex-row justify-between items-center px-12 py-10">
    <div class="mb-6 md:mb-0">
        <p class="text-sm tracking-wide text-[#44474e] dark:text-[#c4c6cf]">© {{ date('Y') }} {{ __('The Editorial Scholar.') }} {{ __('All rights reserved.') }}</p>
    </div>
    <div class="flex flex-wrap gap-6 md:gap-10 justify-center">
        <a class="text-sm tracking-wide text-[#44474e] dark:text-[#c4c6cf] hover:text-[#002045] dark:hover:text-white transition-colors" href="#published-research">{{ __('Browse') }}</a>
        @if (\Illuminate\Support\Facades\Route::has('login'))
            <a class="text-sm tracking-wide text-[#44474e] dark:text-[#c4c6cf] hover:text-[#002045] dark:hover:text-white transition-colors" href="{{ route('login') }}">{{ __('Sign In') }}</a>
        @endif
    </div>
</footer>
</body>
</html>
