<div class="p-4 sm:ml-64">
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a wire:navigate href="{{ route('cars.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Inicio
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Crear nuevo </span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="container mx-auto bg-white">
        <form method="POST" wire:submit='create'>
            <div class="grid gap-6 md:grid-cols-2 px-10 pt-10">
                <div>
                    <label for="brand" class="block mb-1 text-sm font-medium text-gray-900">Marca <span class="text-red-500">*</span></label>
                    <input type="text" wire:model='brand' id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Mazda, Toyota..." required>
                    @if($errors->has('brand'))
                        <span class="text-red-500">
                            {{ $errors->first('brand') }}
                        </span>
                    @endif
                    <label for="model" class="block mb-1 text-sm font-medium text-gray-900">Modelo</label>
                    <input type="text" wire:model='model' id="model" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Land Rover, Ford Fiesta..." required>
                    @if($errors->has('model'))
                        <span class="text-red-500">
                            {{ $errors->first('model') }}
                        </span>
                    @endif
                </div>
                <div>
                    <label for="year" class="block mb-1 text-sm font-medium text-gray-900">Año <span class="text-red-500">*</span></label>
                    <input type="number" wire:model='year' id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="2023" required>
                    @if($errors->has('year'))
                        <span class="text-red-500">
                            {{ $errors->first('year') }}
                        </span>
                    @endif
                    <label for="price" class="block mb-1 text-sm font-medium text-gray-900">Precio</label>
                    <input type="number" wire:model='price' id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="$45,000,000" required>
                    @if($errors->has('price'))
                        <span class="text-red-500">
                            {{ $errors->first('price') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="grid gap-6 md:grid-cols-2 p-10">
                <div class="flex w-full">
                    <button disabled wire:loading type="button" class="w-full h-64 justify-center text-white bg-gray-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:bg-gray-500  inline-flex items-center">
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        Cargando imagen, espera un momento...
                    </button>
                    <label for="dropzone-file" wire:loading.remove class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir</span> o arrastra y suelta</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PDF, WORD, EXCEL, SVG, PNG, JPG or GIF (MAX. 4MB)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" wire:model="image" />
                    </label>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-1 mb-5">
                    @forelse ($images as $image)
                        <div class="max-w-60">
                            <button type="button" wire:click='removeNewImage({{ $loop->index}})'
                                class="px-3 mb-2 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">
                                X
                            </button>

                            <div class="aspect-w-1 aspect-h-1">
                                @if (Str::contains($image->getClientOriginalName(), ['.jpg', '.jpeg', '.png', '.gif']))
                                    <img class="h-32 w-60 object-cover rounded-lg" src="{{ $image->temporaryUrl() }}" alt="">
                                @else
                                    <div>
                                        <img class="h-32 w-60 object-cover rounded-lg" src="{{ asset('img/file-icon.png') }}" alt="">
                                        <small>{{ $image->getClientOriginalName() }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <h3>Sin archivos añadidos</h3>
                    @endforelse
                </div>
            </div>
            <div id="marketing-banner" tabindex="-1" class="mx-auto bg-white border border-gray-200 rounded-lg shadow-sm lg:max-w-7xl dark:bg-white">
                <div class="flex items-center justify-center p-4">
                    <button type="submit" class="px-12 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Crear Publicación
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
