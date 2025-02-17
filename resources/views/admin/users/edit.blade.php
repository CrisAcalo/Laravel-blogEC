<x-admin-layout>
    <div name="header" class="px-6">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuarios') }}
        </h1>
    </div>

    <div class="">
        <div class="mx-auto px-6 py-4">
            <div class="sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('admin.users.partials.edit-form')
            </div>
        </div>

        <div class="mx-auto px-6 py-4">
            <div class="sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('admin.users.partials.update-password')
            </div>
        </div>
    </div>

</x-admin-layout>
