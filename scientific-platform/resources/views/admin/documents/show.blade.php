<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">{{ __('Document detail') }}</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">{{ $document->title }}</h2>
                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <x-document-status-badge :status="$document->status" />
                </div>
            </div>
            <a href="{{ route('admin.documents.index') }}" class="inline-flex text-sm font-semibold text-violet-700 hover:text-violet-900">{{ __('← All documents') }}</a>
        </div>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if (session('status') === 'reviewers-updated')
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900">{{ __('Reviewer assignments updated.') }}</div>
            @endif
            @if (session('status') === 'published')
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900">{{ __('Document published.') }}</div>
            @endif
            @if (session('status') === 'publish-not-accepted')
                <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium text-amber-900">{{ __('Only accepted documents can be published.') }}</div>
            @endif
            @if (session('status') === 'publish-already')
                <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium text-amber-900">{{ __('This document is already published.') }}</div>
            @endif

            <div class="grid gap-8 lg:grid-cols-3">
                <div class="lg:col-span-2 space-y-6">
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">{{ __('Author') }}</h3>
                        <p class="mt-2 text-slate-900">{{ $document->user->name }} <span class="text-slate-500">({{ $document->user->email }})</span></p>
                        @if ($document->published_at)
                            <p class="mt-4 text-sm text-slate-600"><span class="font-medium text-slate-700">{{ __('Published at') }}:</span> {{ $document->published_at->format('Y-m-d H:i') }}</p>
                        @endif
                        <h3 class="mt-8 text-sm font-semibold uppercase tracking-wider text-slate-500">{{ __('Abstract') }}</h3>
                        <div class="mt-2 text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $document->abstract }}</div>
                        @if ($document->file_path)
                            <div class="mt-6 rounded-xl border border-slate-100 bg-slate-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('File') }}</p>
                                <a href="{{ route('documents.file', $document) }}" class="mt-2 inline-flex text-sm font-semibold text-violet-700 hover:text-violet-900" target="_blank" rel="noopener">{{ basename($document->file_path) }}</a>
                            </div>
                        @endif
                    </section>
                </div>
                <aside class="space-y-6">
                    @if ($document->status === \App\Enums\DocumentStatus::Accepted && $document->published_at === null)
                        <section class="rounded-2xl border border-violet-200 bg-gradient-to-b from-violet-50 to-white p-6 shadow-sm ring-1 ring-violet-900/5">
                            <h3 class="text-sm font-semibold text-violet-900">{{ __('Publishing') }}</h3>
                            <p class="mt-2 text-sm text-violet-900/80">{{ __('Release this accepted work to the public homepage.') }}</p>
                            <form method="post" action="{{ route('admin.documents.publish', $document) }}" class="mt-4" onsubmit="return confirm('{{ __('Publish this document on the public homepage?') }}');">
                                @csrf
                                <button type="submit" class="w-full rounded-xl bg-violet-700 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-violet-800 focus:outline-none focus:ring-2 focus:ring-violet-600 focus:ring-offset-2">
                                    {{ __('Publish') }}
                                </button>
                            </form>
                        </section>
                    @endif
                </aside>
            </div>

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-lg font-semibold text-slate-900">{{ __('Assign reviewers') }}</h3>
                <p class="mt-1 text-sm text-slate-600">{{ __('Choose who should evaluate this submission.') }}</p>
                <form method="post" action="{{ route('admin.documents.reviewers.sync', $document) }}" class="mt-6 space-y-4">
                    @csrf
                    @method('patch')
                    @if ($reviewers->isEmpty())
                        <p class="text-sm text-slate-600">{{ __('No reviewer accounts in the system.') }}</p>
                    @else
                        <fieldset class="grid gap-3 sm:grid-cols-2">
                            @foreach ($reviewers as $reviewer)
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 transition hover:border-violet-300 hover:bg-white">
                                    <input
                                        type="checkbox"
                                        name="reviewer_ids[]"
                                        value="{{ $reviewer->id }}"
                                        class="rounded border-slate-300 text-violet-600 shadow-sm focus:ring-violet-500"
                                        @checked($document->reviewers->contains('id', $reviewer->id))
                                    />
                                    <span class="text-sm text-slate-900">{{ $reviewer->name }} <span class="text-slate-500">({{ $reviewer->email }})</span></span>
                                </label>
                            @endforeach
                        </fieldset>
                        <x-input-error class="mt-2" :messages="$errors->get('reviewer_ids')" />
                        <x-input-error class="mt-2" :messages="$errors->get('reviewer_ids.*')" />
                        <x-primary-button class="rounded-xl bg-slate-900 hover:bg-slate-800 focus:ring-slate-900">{{ __('Save assignments') }}</x-primary-button>
                    @endif
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
