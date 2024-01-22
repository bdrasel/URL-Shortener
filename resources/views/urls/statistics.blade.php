<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    <table class="table-fixed w-full">
                        <tr>
                            <td class="border px-4 py-2">Original Url</td>
                            <td class="border px-4 py-2">{{ $url->original_url }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">Short Url</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('shorten.redirect', $url->short_url) }}"
                                    target="_blank">{{ route('shorten.redirect', $url->short_url) }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">Click</td>
                            <td class="border px-4 py-2">{{ $url->clicks }}</td>
                        </tr>

                        {{-- user name --}}
                        <tr>
                            <td class="border px-4 py-2">User</td>
                            <td class="border px-4 py-2">{{ $url->user?->name }}</td>
                        </tr>

                        {{-- created at --}}
                        <tr>
                            <td class="border px-4 py-2">Created At</td>
                            <td class="border px-4 py-2">{{ $url->created_at->format('d M Y H:i:s') }}</td>
                        </tr>

                    </table>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
