<x-admin-layout>
    <div name="header" class="px-6">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorias') }}
        </h1>
    </div>

    <div class="">
        <div class="mx-auto p-6 space-y-6">
            <a href="{{ route('admin.categories.create') }}"
                class="py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer">Crear
                Categoría</a>
            <div class="overflow-x-auto shadow sm:rounded-lg">

                @include('admin.categories.partials.categories-table', ['categories' => $categories])
            </div>
        </div>
    </div>
</x-admin-layout>
