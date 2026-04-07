<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">{{ __('Your manuscripts') }}</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Documents') }}</h2>
        </div>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'document-created')
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">
                    {{ __('Document created.') }}
                </div>
            @endif
            @if (session('status') === 'document-deleted')
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">
                    {{ __('Document deleted.') }}
                </div>
            @endif

            @if ($documents->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-8 py-16 text-center shadow-sm">
                    <p class="text-slate-600">{{ __('No documents yet.') }}</p>
                    <a href="{{ route('author.documents.create') }}" class="mt-4 inline-flex text-sm font-semibold text-slate-900 underline decoration-slate-400 decoration-2 underline-offset-4 hover:text-sky-700">{{ __('Create your first document') }}</a>
                </div>
            @else
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($documents as $document)
                        <article class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-slate-300 hover:shadow-md">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="min-w-0 text-base font-semibold leading-snug text-slate-900">
                                    <a href="{{ route('author.documents.show', $document) }}" class="hover:text-sky-700 focus:outline-none focus:text-sky-700">{{ \Illuminate\Support\Str::limit($document->title, 80) }}</a>
                                </h3>
                                <x-document-status-badge :status="$document->status" class="shrink-0" />
                            </div>
                            <p class="mt-4 flex-1 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($document->abstract, 120) }}</p>
                            <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                                <span class="text-xs text-slate-500">{{ $document->updated_at->diffForHumans() }}</span>
                                <a href="{{ route('author.documents.edit', $document) }}" class="text-sm font-semibold text-slate-900 hover:text-sky-700">{{ __('Edit') }}</a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
