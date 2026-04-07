<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">{{ __('Manuscript') }}</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">{{ $document->title }}</h2>
                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <x-document-status-badge :status="$document->status" />
                    @if ($document->published_at)
                        <span class="inline-flex items-center rounded-full bg-violet-50 px-2.5 py-1 text-xs font-medium text-violet-900 ring-1 ring-inset ring-violet-600/20">{{ __('Public · :date', ['date' => $document->published_at->format('M j, Y')]) }}</span>
                    @endif
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('author.documents.edit', $document) }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-800 shadow-sm transition hover:bg-slate-50">
                    {{ __('Edit') }}
                </a>
                <form method="post" action="{{ route('author.documents.destroy', $document) }}" onsubmit="return confirm('{{ __('Delete this document?') }}');">
                    @csrf
                    @method('delete')
                    <x-danger-button type="submit" class="rounded-xl">{{ __('Delete') }}</x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if (session('status') === 'document-updated')
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">{{ __('Document updated.') }}</div>
            @endif

            <div class="grid gap-8 lg:grid-cols-3">
                <div class="lg:col-span-2 space-y-8">
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">{{ __('Abstract') }}</h3>
                        <div class="mt-4 text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $document->abstract }}</div>
                        @if ($document->file_path)
                            <div class="mt-8 rounded-xl border border-slate-100 bg-slate-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Attachment') }}</p>
                                <a href="{{ asset('storage/'.$document->file_path) }}" class="mt-2 inline-flex text-sm font-semibold text-sky-700 hover:text-sky-800" target="_blank" rel="noopener">{{ basename($document->file_path) }}</a>
                            </div>
                        @endif
                    </section>
                </div>
                <aside class="space-y-6">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-sm font-semibold text-slate-900">{{ __('Submission') }}</h3>
                        <dl class="mt-4 space-y-3 text-sm">
                            <div>
                                <dt class="text-slate-500">{{ __('Last updated') }}</dt>
                                <dd class="font-medium text-slate-900">{{ $document->updated_at->format('M j, Y g:i a') }}</dd>
                            </div>
                        </dl>
                        <a href="{{ route('author.documents.index') }}" class="mt-6 inline-flex text-sm font-semibold text-slate-900 hover:text-sky-700">{{ __('← Back to library') }}</a>
                    </div>
                </aside>
            </div>

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-lg font-semibold text-slate-900">{{ __('Reviewer feedback') }}</h3>
                @if ($document->reviews->isEmpty())
                    <p class="mt-4 text-sm text-slate-600">{{ __('No reviewer comments yet.') }}</p>
                @else
                    <ul class="mt-6 space-y-4">
                        @foreach ($document->reviews as $review)
                            <li class="rounded-xl border border-slate-100 bg-slate-50/50 p-5 ring-1 ring-slate-900/5">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <span class="font-semibold text-slate-900">{{ $review->reviewer->name }}</span>
                                    <span class="text-xs text-slate-500">{{ $review->created_at->format('Y-m-d H:i') }}</span>
                                </div>
                                <div class="mt-3 flex items-center gap-2">
                                    <span class="text-xs font-medium text-slate-500">{{ __('Recommendation') }}</span>
                                    <x-review-status-badge :status="$review->status" />
                                </div>
                                <div class="mt-3 text-sm text-slate-700 whitespace-pre-wrap">{{ $review->comment }}</div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
