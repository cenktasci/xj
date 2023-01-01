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
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Bonus Name</label>
                            <input class="form-control" type="text" id="bonus_name1" disabled value="{{ $id }}">
                            <input class="form-control" type="hidden" id="bonus_name" name="bonus_name" value="{{ $id }}">
                        </div>
                        <div class="form-group mt-4">
                            <label for="start_balance">Start Balance</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">₺</span>
                                <input type="number" class="form-control" id="start_balance" name="start_balance"><br>
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleFormControlSelect2">Total Game</label>
                            <input class="form-control" type="number" id="total_game" name="total_game">
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        let data = document.getElementById('bonus_name1').value;
        document.getElementById("bonus_name1").value = 'BONUS HUNT - ' + data;
    </script>

</x-app-layout>
