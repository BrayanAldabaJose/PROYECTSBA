<!-- resources/views/admin/profile/update.blade.php -->

<!-- resources/views/admin/profile/update.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
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

            <div class="mt-4">
                <x-label for="profile_photo_path" :value="__('Profile Photo')" />
                <x-input id="profile_photo_path" class="block mt-1 w-full" type="file" name="profile_photo_path" />
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
/*@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

