<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Urls') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- session message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- form --}}
                    <form method="POST" action="{{ route('shorten.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="original_url" :value="__('Original Url')" />
                            <input type="text" name="original_url" required placeholder="Original Url"
                                class="block w-full border-gray-300 mt-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                value="{{ old('original_url') }}" />
                            <x-input-error :messages="$errors->store->get('original_url')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ms-3">
                                {{ __('Shorten') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>

                {{-- show data --}}
                @if (count($urls) > 0)
                    <div class="p-6 text-gray-900">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Original Url</th>
                                    <th class="px-4 py-2">Short Url</th>

                                    <th class="px-4 py-2">Statistics</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($urls as $link)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $link->original_url }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('shorten.redirect', $link->short_url) }}"
                                                target="_blank">{{ route('shorten.redirect', $link->short_url) }}</a>
                                        </td>

                                        <td class="border px-4 py-2">
                                            <a href="{{ route('shorten.statistics', $link->short_url) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Statistics
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
