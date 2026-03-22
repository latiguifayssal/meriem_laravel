<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Documents') }}
            </h2>
            <a href="{{ route('author.documents.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('New document') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') === 'document-created')
                <p class="mb-4 text-sm text-green-600">{{ __('Document created.') }}</p>
            @endif
            @if (session('status') === 'document-deleted')
                <p class="mb-4 text-sm text-green-600">{{ __('Document deleted.') }}</p>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($documents->isEmpty())
                        <p>{{ __('No documents yet.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td class="px-3 py-2 whitespace-nowrap">
                                                <a href="{{ route('author.documents.show', $document) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ $document->title }}
                                                </a>
                                            </td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-600">
                                                {{ str_replace('_', ' ', $document->status->value) }}
                                            </td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-right space-x-2">
                                                <a href="{{ route('author.documents.edit', $document) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
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
            </div>
        </div>
    </div>
</x-app-layout>
