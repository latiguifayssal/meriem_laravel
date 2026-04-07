@props(['role'])

@php
    use App\Enums\UserRole;

    $r = $role instanceof UserRole ? $role : UserRole::from((string) $role);
    $label = ucfirst($r->value);

    $classes = match ($r) {
        UserRole::Admin => 'bg-violet-50 text-violet-900 ring-violet-600/20',
        UserRole::Author => 'bg-sky-50 text-sky-900 ring-sky-600/20',
        UserRole::Reviewer => 'bg-teal-50 text-teal-900 ring-teal-600/20',
    };
@endphp

<span {{ $attributes->merge([
    'class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium capitalize ring-1 ring-inset '.$classes,
]) }}>
    {{ $label }}
</span>
