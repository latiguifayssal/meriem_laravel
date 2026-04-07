<x-app-layout :title="__('Reviewer') . ' | ' . config('app.name')">
    <header class="mb-10 max-w-6xl">
        <span class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-secondary font-label">{{ __('Peer review') }}</span>
        <h1 class="mb-4 font-headline text-3xl font-bold leading-tight tracking-tight text-primary sm:text-4xl">{{ __('Reviewer console') }}</h1>
        <p class="max-w-2xl font-headline text-lg italic text-on-surface-variant">{{ __('Open assignments, read manuscripts, and submit structured reviews.') }}</p>
    </header>

    <div class="max-w-6xl">
        <div class="rounded-xl border border-outline-variant/10 bg-surface-container-lowest p-8 shadow-sm sm:p-10">
            <div>
                <h3 class="font-headline text-lg font-bold text-primary">{{ __('Assigned documents') }}</h3>
                <p class="mt-1 text-sm text-on-surface-variant">{{ __('Use Manuscripts or Peer Review in the menu to open your queue.') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
