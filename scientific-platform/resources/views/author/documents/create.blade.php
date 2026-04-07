<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">{{ __('New submission') }}</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('New document') }}</h2>
        </div>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('author.documents.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="title" :value="__('Title')" class="text-slate-700" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="abstract" :value="__('Abstract')" class="text-slate-700" />
                            <textarea id="abstract" name="abstract" rows="6" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" required>{{ old('abstract') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('abstract')" />
                        </div>
                        <div>
                            <x-input-label for="file" :value="__('File (optional)')" class="text-slate-700" />
                            <input id="file" name="file" type="file" class="mt-1 block w-full text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-800 hover:file:bg-slate-200" />
                            <x-input-error class="mt-2" :messages="$errors->get('file')" />
                        </div>
                        <div class="flex flex-wrap items-center gap-4">
                            <x-primary-button class="rounded-xl">{{ __('Create') }}</x-primary-button>
                            <a href="{{ route('author.documents.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
