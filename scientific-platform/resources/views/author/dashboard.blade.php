<x-app-layout :title="__('Author') . ' | ' . config('app.name')">
    <header class="mb-10 max-w-6xl">
        <span class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-secondary font-label">{{ __('Author workspace') }}</span>
        <h1 class="mb-4 font-headline text-3xl font-bold leading-tight tracking-tight text-primary sm:text-4xl">{{ __('Your scholarly desk') }}</h1>
        <p class="max-w-2xl font-headline text-lg italic text-on-surface-variant">{{ __('Submit work, respond to reviewers, and track status in one place.') }}</p>
    </header>

    <div class="max-w-6xl">
        <div class="rounded-xl border border-outline-variant/10 bg-surface-container-lowest p-8 shadow-sm sm:p-10">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="font-headline text-lg font-bold text-primary">{{ __('Your manuscripts') }}</h3>
                    <p class="mt-1 text-sm text-on-surface-variant">{{ __('Open the library to create, edit, or read reviewer comments.') }}</p>
                </div>
                <a href="{{ route('author.documents.index') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-primary/20 bg-white px-5 py-3 text-sm font-bold text-primary transition hover:bg-surface-container-low">
                    {{ __('View documents') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
