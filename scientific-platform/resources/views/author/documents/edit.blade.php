<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">{{ __('Revise') }}</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Edit document') }}</h2>
        </div>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if ($document->reviews->isNotEmpty())
                <section class="rounded-2xl border border-amber-200/80 bg-amber-50/40 p-6 shadow-sm ring-1 ring-amber-900/5">
                    <h3 class="text-sm font-semibold text-amber-900">{{ __('Reviewer feedback') }}</h3>
                    <ul class="mt-4 space-y-4">
                        @foreach ($document->reviews as $review)
                            <li class="rounded-xl border border-amber-100 bg-white/80 p-4">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="font-semibold text-slate-900">{{ $review->reviewer->name }}</span>
                                    <x-review-status-badge :status="$review->status" />
                                </div>
                                <p class="mt-2 text-sm text-slate-700 whitespace-pre-wrap">{{ $review->comment }}</p>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="max-w-xl space-y-6">
                    <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                        {{ __('Saving changes will set the document status to "under review".') }}
                    </div>
                    <form method="post" action="{{ route('author.documents.update', $document) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="title" :value="__('Title')" class="text-slate-700" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" :value="old('title', $document->title)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="abstract" :value="__('Abstract')" class="text-slate-700" />
                            <textarea id="abstract" name="abstract" rows="6" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" required>{{ old('abstract', $document->abstract) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('abstract')" />
                        </div>
                        @if ($document->file_path)
                            <p class="text-sm text-slate-600">
                                {{ __('Current file:') }}
                                <a href="{{ asset('storage/'.$document->file_path) }}" class="font-semibold text-sky-700 hover:text-sky-800" target="_blank" rel="noopener">{{ basename($document->file_path) }}</a>
                            </p>
                        @endif
                        <div>
                            <x-input-label for="file" :value="__('Replace file (optional)')" class="text-slate-700" />
                            <input id="file" name="file" type="file" class="mt-1 block w-full text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-800 hover:file:bg-slate-200" />
                            <x-input-error class="mt-2" :messages="$errors->get('file')" />
                        </div>
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <x-primary-button class="rounded-xl">{{ __('Save') }}</x-primary-button>
                            <a href="{{ route('author.documents.show', $document) }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
