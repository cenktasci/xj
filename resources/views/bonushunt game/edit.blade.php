<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Provider') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="post" action="{{ route('bonushunt.store') }}">
                        @csrf
                        <label for="bonus_name">Bonus Name:</label><br>
                        <input type="text" id="bonus_name" name="bonus_name" value="{{ $bonus->bonus_name }}"><br>
                        <label for="start_balance">Start
                            Balance:</label><br>
                        <input type="text" id="start_balance" name="start_balance" value="{{ $bonus->start_balance }}"><br>
                        <label for="total_game">Total Game:</label><br>
                        <input type="text" id="total_game" name="total_game" value="{{ $bonus->total_game }}"><br>

                        <br><br>

                        <input type="submit">

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
