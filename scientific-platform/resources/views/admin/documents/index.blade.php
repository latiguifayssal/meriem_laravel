<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">{{ __('Editorial') }}</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('All documents') }}</h2>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-violet-700 hover:text-violet-900">{{ __('← Dashboard') }}</a>
        </div>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($documents->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-8 py-16 text-center shadow-sm">
                    <p class="text-slate-600">{{ __('No documents yet.') }}</p>
                </div>
            @else
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm ring-1 ring-slate-900/5">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead class="bg-slate-50/90">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">{{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">{{ __('Author') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">{{ __('Status') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">{{ __('Published') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">{{ __('Reviewers') }}</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-600">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($documents as $document)
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900">
                                            <a href="{{ route('admin.documents.show', $document) }}" class="text-violet-700 hover:text-violet-900">{{ \Illuminate\Support\Str::limit($document->title, 50) }}</a>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $document->user->name }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">
                                            <x-document-status-badge :status="$document->status" />
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">
                                            @if ($document->published_at)
                                                {{ $document->published_at->format('Y-m-d') }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $document->reviewers->count() }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-right text-sm">
                                            <a href="{{ route('admin.documents.show', $document) }}" class="font-semibold text-violet-700 hover:text-violet-900">{{ __('Assign') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-6">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
