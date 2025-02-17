<x-admin-layout>
    <div name="header" class="px-6">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorias') }}
        </h1>
    </div>

    <div class="">
        <div class="mx-auto p-6 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    @include('admin.categories.partials.create-category-form')
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
