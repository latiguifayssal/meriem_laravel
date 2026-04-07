<x-app-layout :title="__('Admin') . ' | ' . config('app.name')">
    <header class="mb-10 max-w-6xl">
        <span class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-secondary font-label">{{ __('Administration') }}</span>
        <h1 class="mb-4 font-headline text-3xl font-bold leading-tight tracking-tight text-primary sm:text-4xl">{{ __('Operations dashboard') }}</h1>
        <p class="max-w-2xl font-headline text-lg italic text-on-surface-variant">{{ __('Pipeline health, documents, and accounts.') }}</p>
    </header>

    <div class="max-w-6xl space-y-10">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border-l-4 border-slate-400 bg-surface-container-lowest p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-secondary font-label">{{ __('Total documents') }}</p>
                <p class="mt-2 font-headline text-3xl font-bold tabular-nums text-primary">{{ number_format($totalDocuments) }}</p>
            </div>
            <div class="rounded-xl border-l-4 border-amber-500 bg-surface-container-low p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-secondary font-label">{{ __('Pending reviews') }}</p>
                <p class="mt-2 font-headline text-3xl font-bold tabular-nums text-primary">{{ number_format($pendingReviews) }}</p>
                <p class="mt-1 text-xs text-on-surface-variant">{{ __('Pending or under review') }}</p>
            </div>
            <div class="rounded-xl border-l-4 border-emerald-500 bg-surface-container-low p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-secondary font-label">{{ __('Accepted') }}</p>
                <p class="mt-2 font-headline text-3xl font-bold tabular-nums text-primary">{{ number_format($acceptedCount) }}</p>
            </div>
            <div class="rounded-xl border-l-4 border-rose-500 bg-surface-container-low p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-secondary font-label">{{ __('Rejected') }}</p>
                <p class="mt-2 font-headline text-3xl font-bold tabular-nums text-primary">{{ number_format($rejectedCount) }}</p>
            </div>
        </div>

        <section class="overflow-hidden rounded-xl border border-outline-variant/10 bg-surface-container-lowest shadow-sm">
            <div class="border-b border-outline-variant/10 bg-surface-container-low px-6 py-4">
                <h3 class="font-headline text-lg font-bold text-primary">{{ __('Documents') }}</h3>
            </div>
            <div class="p-6">
                @if ($documents->isEmpty())
                    <p class="text-sm text-secondary">{{ __('No documents yet.') }}</p>
                @else
                    <div class="overflow-x-auto rounded-lg border border-outline-variant/10">
                        <table class="w-full min-w-[32rem] border-collapse text-left">
                            <thead class="bg-surface-container-low">
                                <tr>
                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Author') }}</th>
                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Status') }}</th>
                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Published') }}</th>
                                    <th class="px-4 py-3 text-right text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/15 bg-white">
                                @foreach ($documents as $document)
                                    <tr class="transition-colors hover:bg-surface-container-low/80">
                                        <td class="px-4 py-3 text-sm font-medium text-on-surface">
                                            <a href="{{ route('admin.documents.show', $document) }}" class="font-headline font-semibold text-primary hover:underline">{{ \Illuminate\Support\Str::limit($document->title, 55) }}</a>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-on-surface-variant">{{ $document->user->name }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">
                                            <x-document-status-badge :status="$document->status" />
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-on-surface-variant">
                                            @if ($document->published_at)
                                                {{ $document->published_at->format('Y-m-d') }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-right text-sm">
                                            <a href="{{ route('admin.documents.show', $document) }}" class="font-label text-xs font-bold uppercase text-primary hover:underline">{{ __('Manage') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>
        </section>

        <section class="overflow-hidden rounded-xl border border-outline-variant/10 bg-surface-container-lowest shadow-sm">
            <div class="border-b border-outline-variant/10 bg-surface-container-low px-6 py-4">
                <h3 class="font-headline text-lg font-bold text-primary">{{ __('Users') }}</h3>
            </div>
            <div class="p-6">
                @if ($users->isEmpty())
                    <p class="text-sm text-secondary">{{ __('No users.') }}</p>
                @else
                    <div class="overflow-x-auto rounded-lg border border-outline-variant/10">
                        <table class="w-full min-w-[32rem] border-collapse text-left">
                            <thead class="bg-surface-container-low">
                                <tr>
                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Name') }}</th>
                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Email') }}</th>
                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Role') }}</th>
                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-widest text-secondary font-label">{{ __('Registered') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/15 bg-white">
                                @foreach ($users as $user)
                                    <tr class="transition-colors hover:bg-surface-container-low/80">
                                        <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-on-surface">{{ $user->name }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-on-surface-variant">{{ $user->email }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">
                                            <x-role-badge :role="$user->role" />
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-on-surface-variant">{{ $user->created_at?->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</x-app-layout>
