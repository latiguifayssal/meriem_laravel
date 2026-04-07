<x-app-layout :title="__('Dashboard') . ' | ' . config('app.name')">
    <header class="mb-10 max-w-6xl lg:mb-12">
        <span class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-secondary font-label">{{ __('Executive overview') }}</span>
        <h1 class="mb-4 font-headline text-4xl font-bold leading-tight tracking-tight text-primary sm:text-5xl">{{ __('The digital curator dashboard') }}</h1>
        <p class="max-w-2xl font-headline text-lg italic text-on-surface-variant sm:text-xl">
            @if(auth()->user()->isAdmin())
                {{ __('Pipeline health, reviewer assignments, and publishing at a glance.') }}
            @elseif(auth()->user()->isAuthor())
                {{ __('Track manuscripts, respond to reviewers, and move work toward acceptance.') }}
            @else
                {{ __('Open assignments, submit structured reviews, and uphold editorial standards.') }}
            @endif
        </p>
    </header>

    <div class="mb-10 grid max-w-6xl grid-cols-1 gap-6 md:grid-cols-4 lg:mb-12">
        <div class="col-span-1 flex flex-col justify-between rounded-xl border-l-4 border-primary bg-surface-container-lowest p-6 sm:p-8 md:col-span-2">
            <div class="mb-6 flex justify-between items-start sm:mb-8">
                <span class="material-symbols-outlined text-3xl text-primary">article</span>
                @if($statPrimaryHint !== '')
                    <span class="rounded bg-primary-fixed px-2 py-1 text-[10px] font-bold text-on-primary-fixed font-label">{{ $statPrimaryHint }}</span>
                @endif
            </div>
            <div>
                <span class="mb-1 block font-headline text-3xl font-bold text-primary sm:text-4xl">{{ number_format($statPrimary) }}</span>
                <span class="text-sm font-semibold uppercase tracking-wider text-secondary font-label">{{ $statPrimaryLabel }}</span>
            </div>
        </div>
        <div class="flex flex-col justify-between rounded-xl bg-surface-container-low p-6 transition-colors hover:bg-surface-container">
            <span class="material-symbols-outlined text-tertiary-container">pending_actions</span>
            <div>
                <span class="mb-1 block font-headline text-2xl font-bold text-primary">{{ number_format($statMid) }}</span>
                <span class="text-[11px] font-semibold uppercase tracking-wider text-secondary font-label">{{ $statMidLabel }}</span>
            </div>
        </div>
        <div class="flex flex-col justify-between rounded-xl bg-surface-container-low p-6 transition-colors hover:bg-surface-container">
            <span class="material-symbols-outlined text-secondary">verified</span>
            <div>
                <span class="mb-1 block font-headline text-2xl font-bold text-primary">{{ number_format($statWide) }}</span>
                <span class="text-[11px] font-semibold uppercase tracking-wider text-secondary font-label">{{ $statWideLabel }}</span>
            </div>
        </div>
    </div>

    @php
        $manuscriptsIndex = auth()->user()->isAdmin()
            ? route('admin.documents.index')
            : (auth()->user()->isAuthor() ? route('author.documents.index') : route('reviewer.documents.index'));
    @endphp

    <div class="grid max-w-6xl grid-cols-1 gap-10 lg:grid-cols-3 lg:gap-12">
        <section class="lg:col-span-2">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h3 class="font-headline text-xl font-bold text-primary sm:text-2xl">{{ __('Manuscript assignments') }}</h3>
                <a href="{{ $manuscriptsIndex }}" class="font-label flex items-center gap-1 text-sm font-semibold text-primary hover:underline">
                    {{ __('View all') }} <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="overflow-hidden rounded-xl border border-outline-variant/10 bg-surface-container-lowest">
                @if($recentDocuments->isEmpty())
                    <p class="p-8 text-sm text-secondary">{{ __('No manuscripts to show yet.') }}</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-left">
                            <thead class="bg-surface-container-low">
                                <tr>
                                    <th class="px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-secondary font-label sm:px-6 sm:py-4">{{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-secondary font-label sm:px-6 sm:py-4">{{ __('Author') }}</th>
                                    <th class="px-4 py-3 text-[11px] font-bold uppercase tracking-widest text-secondary font-label sm:px-6 sm:py-4">{{ __('Status') }}</th>
                                    <th class="hidden w-24 text-right text-[11px] font-bold uppercase tracking-widest text-secondary font-label sm:table-cell sm:px-6 sm:py-4">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/15">
                                @foreach($recentDocuments as $document)
                                    @php
                                        $docUrl = auth()->user()->isAdmin()
                                            ? route('admin.documents.show', $document)
                                            : (auth()->user()->isAuthor()
                                                ? route('author.documents.edit', $document)
                                                : route('reviewer.documents.show', $document));
                                        $actionLabel = auth()->user()->isAdmin()
                                            ? __('Manage')
                                            : (auth()->user()->isAuthor() ? __('Edit') : __('Review'));
                                    @endphp
                                    <tr class="group transition-colors hover:bg-surface-container-low">
                                        <td class="px-4 py-4 sm:px-6 sm:py-5">
                                            <div class="flex flex-col">
                                                <span class="font-headline text-sm font-bold leading-tight text-primary">{{ \Illuminate\Support\Str::limit($document->title, 64) }}</span>
                                                <span class="mt-1 text-[10px] uppercase tracking-tighter text-slate-400">ID: {{ strtoupper(substr(config('app.name', 'SP'), 0, 2)) }}-{{ $document->id }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 sm:px-6 sm:py-5">
                                            <div class="flex items-center gap-2">
                                                @php
                                                    $initials = collect(explode(' ', $document->user->name))->take(2)->map(fn ($w) => strtoupper(substr($w, 0, 1)))->join('');
                                                @endphp
                                                <div class="flex h-6 w-6 items-center justify-center rounded-full bg-slate-200 text-[10px] font-bold text-slate-600 font-label" aria-hidden="true">{{ $initials }}</div>
                                                <span class="text-sm font-medium text-on-surface">{{ $document->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 sm:px-6 sm:py-5">
                                            <x-document-status-badge :status="$document->status" class="text-[10px] uppercase tracking-wider ring-0" />
                                        </td>
                                        <td class="hidden px-4 py-4 text-right sm:table-cell sm:px-6 sm:py-5">
                                            <a href="{{ $docUrl }}" class="rounded border border-primary/20 px-3 py-1.5 text-[11px] font-bold uppercase text-primary transition-all hover:bg-primary hover:text-white font-label">
                                                {{ $actionLabel }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>

        <aside class="space-y-8">
            <div>
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="font-headline text-xl font-bold text-primary">{{ __('User directory') }}</h3>
                </div>
                @if($directoryUsers->isEmpty())
                    <p class="text-sm text-secondary">{{ __('Collaborators linked to your manuscripts will appear here.') }}</p>
                @else
                    <div class="space-y-4">
                        @foreach($directoryUsers as $dirUser)
                            @php
                                $tag = $dirUser->field_of_study?->label() ?? ucfirst($dirUser->role->value);
                                $fieldClass = $dirUser->role->value === 'reviewer'
                                    ? 'bg-primary-fixed text-on-primary-fixed'
                                    : 'bg-secondary-container text-on-secondary-container';
                            @endphp
                            <div class="group rounded-xl border border-outline-variant/10 bg-surface-container-lowest p-4 transition-all hover:shadow-xl hover:shadow-primary/5">
                                <div class="flex items-center gap-4">
                                    <div class="relative shrink-0">
                                        <img
                                            src="https://ui-avatars.com/api/?name={{ rawurlencode($dirUser->name) }}&background=ebeef0&color=002045&size=128"
                                            alt=""
                                            width="48"
                                            height="48"
                                            class="h-12 w-12 rounded-lg object-cover"
                                        />
                                        <span class="absolute -bottom-1 -right-1 h-4 w-4 rounded-full border-2 border-white {{ $dirUser->reviews_count > 0 ? 'bg-emerald-500' : 'bg-slate-300' }}" aria-hidden="true"></span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-label text-sm font-bold text-primary">{{ $dirUser->name }}</h4>
                                        <p class="text-[11px] font-medium text-secondary">{{ ucfirst($dirUser->role->value) }}</p>
                                        <div class="mt-2 flex flex-wrap items-center gap-2">
                                            <span class="rounded px-1.5 py-0.5 text-[10px] font-bold {{ $fieldClass }}">{{ $tag }}</span>
                                            <span class="text-[10px] font-bold text-slate-400">{{ $dirUser->reviews_count }} {{ __('active reviews') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="relative overflow-hidden rounded-2xl bg-primary p-6 text-white">
                <div class="relative z-10">
                    <h4 class="mb-2 font-headline text-lg italic">{{ __('Editorial guidelines') }}</h4>
                    <p class="text-[11px] leading-relaxed opacity-80">{{ __('Review peer-assessment standards and citation ethics with your team.') }}</p>
                </div>
                <div class="absolute -bottom-8 -right-8 h-32 w-32 rounded-full bg-primary-container opacity-50 blur-3xl" aria-hidden="true"></div>
            </div>
        </aside>
    </div>

    @if(auth()->user()->isAdmin())
        <div class="mt-12 max-w-6xl rounded-xl border border-outline-variant/10 bg-surface-container-low/50 p-6">
            <p class="font-label text-sm text-secondary">{{ __('Need full analytics, pagination, and user tables?') }}
                <a href="{{ route('admin.dashboard') }}" class="font-semibold text-primary hover:underline">{{ __('Open admin console') }}</a>
            </p>
        </div>
    @endif
</x-app-layout>
