@props(['status'])

@php
    use App\Enums\ReviewStatus;

    $revStatus = $status instanceof ReviewStatus
        ? $status
        : ReviewStatus::from((string) $status);

    $label = str_replace('_', ' ', $revStatus->value);

    $classes = match ($revStatus) {
        ReviewStatus::Approved => 'bg-emerald-50 text-emerald-900 ring-emerald-600/20',
        ReviewStatus::NeedsChanges => 'bg-amber-50 text-amber-900 ring-amber-600/20',
        ReviewStatus::Rejected => 'bg-rose-50 text-rose-900 ring-rose-600/20',
    };
@endphp

<span {{ $attributes->merge([
    'class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold uppercase tracking-wide ring-1 ring-inset '.$classes,
]) }}>
    {{ ucwords($label) }}
</span>
