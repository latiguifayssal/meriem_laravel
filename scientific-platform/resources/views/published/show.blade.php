<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $document->title }} — {{ config('app.name', 'Editorial Scholar') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&amp;family=Public+Sans:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              headline: ['Newsreader', 'serif'],
              body: ['Public Sans', 'sans-serif'],
            },
            colors: {
              primary: '#002045',
              surface: '#f7fafc',
            },
          },
        },
      };
    </script>
</head>
<body class="bg-surface text-slate-900 font-body antialiased">
<nav class="border-b border-slate-200 bg-white/90 backdrop-blur">
    <div class="max-w-3xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="font-headline text-xl italic text-primary">{{ __('The Editorial Scholar') }}</a>
    </div>
</nav>
<main class="max-w-3xl mx-auto px-6 py-12">
    <p class="text-xs uppercase tracking-widest text-slate-500 mb-3">
        {{ __('Published') }} · <time datetime="{{ $document->published_at?->toIso8601String() }}">{{ $document->published_at?->format('F j, Y') }}</time>
    </p>
    <h1 class="font-headline text-4xl text-primary leading-tight mb-6">{{ $document->title }}</h1>
    <p class="text-slate-600 mb-8">{{ $document->user->name }}</p>
    <div class="max-w-none">
        <h2 class="font-headline text-xl text-primary mt-8 mb-3">{{ __('Abstract') }}</h2>
        <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $document->abstract }}</p>
        @if ($document->file_path)
            <p class="mt-8">
                <a href="{{ route('documents.file', $document) }}" class="text-blue-900 font-medium underline hover:no-underline" target="_blank" rel="noopener">{{ __('Download manuscript file') }}</a>
            </p>
        @endif
    </div>
    <p class="mt-12">
        <a href="{{ url('/') }}" class="text-sm text-blue-900 hover:underline">{{ __('← Back to homepage') }}</a>
    </p>
</main>
</body>
</html>
