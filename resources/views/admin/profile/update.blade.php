<!-- resources/views/admin/profile/update.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus />
            </div>

            <div>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
            </div>

            <!-- Otros campos del perfil que desees editar -->

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Update Profile') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
