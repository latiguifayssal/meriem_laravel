<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $document->title }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('author.documents.edit', $document) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>
                <form method="post" action="{{ route('author.documents.destroy', $document) }}" onsubmit="return confirm('{{ __('Delete this document?') }}');">
                    @csrf
                    @method('delete')
                    <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') === 'document-updated')
                <p class="mb-4 text-sm text-green-600">{{ __('Document updated.') }}</p>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">{{ __('Status') }}</h3>
                        <p class="mt-1">{{ str_replace('_', ' ', $document->status->value) }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">{{ __('Abstract') }}</h3>
                        <p class="mt-1 whitespace-pre-wrap">{{ $document->abstract }}</p>
                    </div>
                    @if ($document->file_path)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">{{ __('File') }}</h3>
                            <p class="mt-1">
                                <a href="{{ asset('storage/'.$document->file_path) }}" class="text-indigo-600 hover:text-indigo-900" target="_blank" rel="noopener">{{ basename($document->file_path) }}</a>
                            </p>
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('author.documents.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">{{ __('Back to list') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
