<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('game.create') }}" class="btn btn-primary">Add New</a>

                    <div class="container table-responsive py-5">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Slot Name</th>
                                    <th scope="col">Provider</th>
                                    <th scope="col">Rtp</th>
                                    <th scope="col">Volatility</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($game as $game)
                                    <tr>
                                        <th scope="row">{{ $game->id }}</th>
                                        <td>{{ $game->slot_name }}</td>
                                        <td>{{ $game->provider->provider_name }}</td>
                                        <td>{{ $game->slot_rtp }}</td>
                                        <td>{{ $game->slot_volatility }} </td>
                                        <td>
                                            <div class="buttons">
                                                <a href="{{ route('game.show', $game->id) }}" class="btn btn-warning">Show</a>
                                                <a href="{{ route('game.edit', $game->id) }}" class="btn btn-primary">Edit</a>
                                                <form style="display:inline" method="POST" action="{{ route('game.destroy', $game->id) }}">
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
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
