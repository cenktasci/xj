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

                    <a href="{{ route('provider.create') }}" class="btn btn-primary">Add New</a>

                    <div class="container table-responsive py-5">

                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Provider Name</th>
                                    <th scope="col">Provider Explanation</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($provider as $provider)
                                    <tr>
                                        <th scope="row">{{ $provider->id }}</th>
                                        <td>{{ $provider->provider_name }}</td>
                                        <td>{{ $provider->provider_explanation }}</td>
                                        <td>
                                            <div class="buttons">
                                                <a href="{{ route('provider.show', $provider->id) }}" class="btn btn-warning">Show</a>
                                                <a href="{{ route('provider.edit', $provider->id) }}" class="btn btn-primary">Edit</a>
                                                <form style="display:inline" method="POST" action="{{ route('provider.destroy', $provider->id) }}">
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
