<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Provider Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('provider.update', $provider->id) }}">
                        @csrf
                        @method('PUT')
                        <label for="fname">Provider Name:</label><br>
                        <input type="text" id="provider_name" name="provider_name" value="{{ $provider->provider_name }}"><br>
                        <label for="lname">Provider Explanation:</label><br>
                        <input type="text" id="provider_explanation" name="provider_explanation" value="{{ $provider->provider_explanation }}"><br>
                        <label for="provider_picture">Picture:</label><br>
                        <input type="file" id="provider_picture" name="provider_picture"><br>
                        <label for="provider_logo">Logo:</label><br>
                        <input type="file" id="provider_logo" name="provider_logo"><br><br>

                        <input type="submit">

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
