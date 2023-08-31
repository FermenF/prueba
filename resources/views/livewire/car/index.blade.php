<div class="p-4 sm:ml-64">
    <div class="relative overflow-x-auto p-4 mb-4 shadow-md sm:rounded-lg bg-gray-100">
        <p>Total de vehiculos registrados: {{ $cars->count() }}</p>
    </div>
    <div class="flex justify-between my-3">
        <div class="flex">
            <div class="flex">
                <select wire:model.live='filter_brand'
                    class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100">
                    <option value="" class="text-sm text-gray-700 hover:bg-gray-100">Mostrar todos</option>
                    @foreach ($availableBrands as $brand)
                        <option value="{{ $brand }}" class="text-sm text-gray-700 hover:bg-gray-100">{{ $brand }}</option>
                    @endforeach
                </select>
                <div class="relative w-full">
                    <input type="search" wire:model.live='filter_model' id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Busqueda por modelo" required>
                </div>
            </div>
        </div>
        <a href="{{ route('cars.create') }}"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-r-lg text-sm px-5 py-2.5 ml-2">
            Añadir Nuevo +
        </a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Marca
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modelo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Año
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Precio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cars as $car)
                    <tr class="border-b {{ $loop->iteration % 2 == 1 ? 'bg-white' : 'bg-gray-50' }}">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $car->brand }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $car->model }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $car->year }}
                        </td>
                        <td class="px-6 py-4">
                            $ {{ number_format($car->price) }}
                        </td>
                        <td class="px-6 py-4">
                            <a wire:navigate href="{{ route('cars.edit', $car->id) }}" class="font-medium text-blue-600 hover:underline">Editar</a>
                            <button type="button" wire:click='destroy({{ $car->id }}, "{{ $car->brand }}", "{{ $car->model }}")' class="font-medium text-red-600 hover:underline">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    @if (!$filter_model)
                        <tr class="border-b bg-gray-50 text-center">
                            <td colspan="5" class="py-4">
                                Sin carros registrados en el sistema.
                                <a wire:navigate href="{{ route('cars.create') }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Registrar uno nuevo
                                </a>
                            </td>
                        </tr>
                    @else
                    <tr class="border-b bg-gray-50 text-center">
                        <td colspan="5" class="py-4">
                            Sin carros registrados en el sistema, con los siguientes parametros;
                            @if($filter_brand != "")
                                Marca: <b>{{ $filter_brand }}</b>
                            @endif
                            @isset($filter_model)
                                Modelo: <b>{{ $filter_model }}</b>
                            @endisset
                        </td>
                    </tr>
                    @endif
                @endforelse
            </tbody>
        </table>
    </div>
</div>
