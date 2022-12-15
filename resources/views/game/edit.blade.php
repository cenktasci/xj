<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="post" action="{{ route('game.update', $game->id) }}">
                        @csrf
                        @method('PUT')
                        <label for="provider_id">Select Provider:</label><br>
                        <select name="provider_id" id="provider_id" required>
                            <option value="">Select Game</option>
                            @foreach ($provider as $provider)
                                <option value="{{ $provider->id }}" {{ $provider->id == $game->provider_id ? 'selected' : '' }}> {{ $provider->provider_name }} </option>
                            @endforeach
                        </select><br>
                        <label for="slot_name">Slot Name:</label><br>
                        <input required type="text" id="slot_name" name="slot_name" value="{{ $game->slot_name }}"><br>
                        <label for="slot_rtp">Slot Rtp:</label><br>
                        <input required type="text" id="slot_rtp" name="slot_rtp" value="{{ $game->slot_rtp }}"><br>
                        <label for="slot_volatility">Slot Volatility:</label><br>
                        <input required type="text" id="slot_volatility" name="slot_volatility" value="{{ $game->slot_volatility }}"><br>

                        <label for="slot_picture">Slot Picture:</label><br>
                        <input type="file" id="slot_picture" name="slot_picture"><br><br><br>

                        <input type="submit">

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
