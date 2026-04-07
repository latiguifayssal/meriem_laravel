<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">{{ __('Queue') }}</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Assigned documents') }}</h2>
        </div>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($documents->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-8 py-16 text-center shadow-sm">
                    <p class="text-slate-600">{{ __('You have no assigned documents.') }}</p>
                </div>
            @else
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($documents as $document)
                        <a href="{{ route('reviewer.documents.show', $document) }}" class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-teal-300 hover:shadow-md">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-base font-semibold leading-snug text-slate-900 group-hover:text-teal-800">{{ \Illuminate\Support\Str::limit($document->title, 72) }}</h3>
                                <x-document-status-badge :status="$document->status" class="shrink-0" />
                            </div>
                            <p class="mt-3 text-sm text-slate-600">{{ __('Author: :name', ['name' => $document->user->name]) }}</p>
                            <span class="mt-4 text-sm font-semibold text-teal-700 group-hover:text-teal-800">{{ __('Open review →') }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
