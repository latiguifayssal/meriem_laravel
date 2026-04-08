@php
    use App\Enums\ReviewStatus;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-700/80">{{ __('Review') }}</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">{{ $document->title }}</h2>
                <div class="mt-3">
                    <x-document-status-badge :status="$document->status" />
                </div>
            </div>
            <a href="{{ route('reviewer.documents.index') }}" class="inline-flex text-sm font-semibold text-slate-600 hover:text-teal-700">{{ __('← Queue') }}</a>
        </div>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if (session('status') === 'review-submitted')
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">{{ __('Review submitted.') }}</div>
            @endif
            @if (session('status') === 'review-updated')
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">{{ __('Review updated.') }}</div>
            @endif

            <div class="grid gap-8 lg:grid-cols-2">
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-900/5 sm:p-8">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">{{ __('Manuscript') }}</h3>
                    <dl class="mt-4 space-y-3 text-sm">
                        <div>
                            <dt class="text-slate-500">{{ __('Author') }}</dt>
                            <dd class="font-medium text-slate-900">{{ $document->user->name }}</dd>
                        </div>
                    </dl>
                    <div class="mt-6 text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $document->abstract }}</div>
                    @if ($document->file_path)
                        <div class="mt-6 rounded-xl border border-slate-100 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('File') }}</p>
                            <a href="{{ route('documents.file', $document) }}" class="mt-2 inline-flex text-sm font-semibold text-teal-700 hover:text-teal-800" target="_blank" rel="noopener">{{ basename($document->file_path) }}</a>
                        </div>
                    @endif
                </section>

                <div class="space-y-8">
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-900/5 sm:p-8">
                        <h3 class="text-lg font-semibold text-slate-900">{{ __('Your reviews') }}</h3>
                        @if ($myReviews->isEmpty())
                            <p class="mt-4 text-sm text-slate-600">{{ __('You have not submitted a review for this document yet.') }}</p>
                        @else
                            <ul class="mt-6 space-y-6">
                                @foreach ($myReviews as $rev)
                                    <li class="rounded-xl border border-slate-100 bg-slate-50/80 p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-2 text-xs text-slate-500">
                                            <span>{{ __('Submitted :date', ['date' => $rev->created_at->format('Y-m-d H:i')]) }}</span>
                                            @if (! $rev->created_at->eq($rev->updated_at))
                                                <span>{{ __('Updated :date', ['date' => $rev->updated_at->format('Y-m-d H:i')]) }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-3 flex flex-wrap items-center gap-2">
                                            <span class="text-xs font-medium text-slate-500">{{ __('Decision') }}</span>
                                            <x-review-status-badge :status="$rev->status" />
                                        </div>
                                        <div class="mt-3 text-sm text-slate-700 whitespace-pre-wrap">{{ $rev->comment }}</div>
                                        <form method="post" action="{{ route('reviewer.reviews.update', $rev) }}" class="mt-5 space-y-4 border-t border-slate-200 pt-5">
                                            @csrf
                                            @method('patch')
                                            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">{{ __('Update review') }}</p>
                                            <div>
                                                <x-input-label for="comment-{{ $rev->id }}" :value="__('Comments')" class="text-slate-700" />
                                                <textarea id="comment-{{ $rev->id }}" name="comment" rows="4" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>{{ old('comment', $rev->comment) }}</textarea>
                                                <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                                            </div>
                                            <div>
                                                <x-input-label for="status-{{ $rev->id }}" :value="__('Recommendation')" class="text-slate-700" />
                                                <select id="status-{{ $rev->id }}" name="status" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                                    @foreach (ReviewStatus::cases() as $case)
                                                        <option value="{{ $case->value }}" @selected(old('status', $rev->status->value) === $case->value)>
                                                            {{ str_replace('_', ' ', $case->value) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                            </div>
                                            <x-secondary-button type="submit" class="rounded-xl">{{ __('Save changes') }}</x-secondary-button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </section>

                    <section class="rounded-2xl border border-teal-200/60 bg-gradient-to-b from-teal-50/50 to-white p-6 shadow-sm ring-1 ring-teal-900/5 sm:p-8">
                        <h3 class="text-lg font-semibold text-slate-900">{{ __('Submit a review') }}</h3>
                        <p class="mt-1 text-sm text-slate-600">{{ __('Share a clear recommendation and actionable comments for the author.') }}</p>
                        <form method="post" action="{{ route('reviewer.documents.reviews.store', $document) }}" class="mt-6 space-y-5">
                            @csrf
                            <div>
                                <x-input-label for="new-comment" :value="__('Comments')" class="text-slate-700" />
                                <textarea id="new-comment" name="comment" rows="6" class="mt-1 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500" required>{{ old('comment') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                            </div>
                            <div>
                                <x-input-label for="new-status" :value="__('Recommendation')" class="text-slate-700" />
                                <select id="new-status" name="status" class="mt-1 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                    @foreach (ReviewStatus::cases() as $case)
                                        <option value="{{ $case->value }}" @selected(old('status') === $case->value)>
                                            {{ str_replace('_', ' ', $case->value) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>
                            <x-primary-button class="rounded-xl bg-teal-700 hover:bg-teal-800 focus:ring-teal-600">{{ __('Submit review') }}</x-primary-button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
