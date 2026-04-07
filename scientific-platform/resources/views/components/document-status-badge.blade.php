@props(['status'])

@php
    use App\Enums\DocumentStatus;

    $docStatus = $status instanceof DocumentStatus
        ? $status
        : DocumentStatus::from((string) $status);

    $label = str_replace('_', ' ', $docStatus->value);

    $classes = match ($docStatus) {
        DocumentStatus::Pending => 'bg-slate-100 text-slate-800 ring-slate-500/15',
        DocumentStatus::UnderReview => 'bg-amber-50 text-amber-900 ring-amber-600/20',
        DocumentStatus::Accepted => 'bg-emerald-50 text-emerald-900 ring-emerald-600/20',
        DocumentStatus::Rejected => 'bg-rose-50 text-rose-900 ring-rose-600/20',
        DocumentStatus::Published => 'bg-violet-50 text-violet-900 ring-violet-600/20',
    };
@endphp

<span {{ $attributes->merge([
    'class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold uppercase tracking-wide ring-1 ring-inset '.$classes,
]) }}>
    {{ ucwords($label) }}
</span>
