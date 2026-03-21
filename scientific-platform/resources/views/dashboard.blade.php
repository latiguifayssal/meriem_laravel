<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-2">
                    <p>{{ __("You're logged in!") }}</p>
                    <p class="text-sm text-gray-600">{{ __('Your role: :role', ['role' => auth()->user()->role->value]) }}</p>
                    @if (auth()->user()->isAdmin())
                        <p><a class="text-indigo-600 hover:underline" href="{{ route('admin.dashboard') }}">{{ __('Admin dashboard') }}</a></p>
                    @endif
                    @if (auth()->user()->isAuthor())
                        <p><a class="text-indigo-600 hover:underline" href="{{ route('author.dashboard') }}">{{ __('Author dashboard') }}</a></p>
                    @endif
                    @if (auth()->user()->isReviewer())
                        <p><a class="text-indigo-600 hover:underline" href="{{ route('reviewer.dashboard') }}">{{ __('Reviewer dashboard') }}</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
