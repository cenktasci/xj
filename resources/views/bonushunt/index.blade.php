<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bonus Hunt') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2  text-gray-900">
                    <a href="{{ route('bonushunt.create') }}" class="btn btn-primary">Add New</a>

                    <div class="container table-responsive py-5">
                        @if ($bonushunt->count() > 0)
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Bonus Name</th>
                                        <th scope="col">Start Balance</th>
                                        <th scope="col">Total Game</th>
                                        <th scope="col">Total Avg %</th>
                                        <th scope="col">Win ₺</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($bonushunt as $bonushunt)
                                        <tr>
                                            <th scope="row">{{ $bonushunt->id }}</th>
                                            <td>BONUS HUNT - {{ $bonushunt->bonus_name }}</td>
                                            <td>{{ number_format($bonushunt->start_balance, 2) }} ₺</td>
                                            <td>{{ $bonushunt->total_game }} ADET</td>
                                            <td>{{ $bonushunt->games_avg ?? '-' }}</td>
                                            <td>{{ number_format($bonushunt->finish_balance, 2) . ' ₺' ?? '-' }}</td>
                                            <td>
                                                <div class="buttons">
                                                    <a href="{{ route('bonushunt.bonushuntGame.create', $bonushunt->id) }}" class="btn btn-warning">New Game</a>
                                                    <a href="{{ route('bonushunt.bonushuntGame.edit', $bonushunt->id) }}" class="btn btn-success">Show / Add Bet Game</a>
                                                    <a href="{{ route('bonushunt.edit', $bonushunt->id) }}" class="btn btn-primary">Edit Bonus Name</a>
                                                    <form style="display:inline" method="POST" action="{{ route('bonushunt.destroy', $bonushunt->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if ($bonushunt->count() == 0)
                            No Bonus Added Yet!
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>
