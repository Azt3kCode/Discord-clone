<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create server') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form method="post" action="{{ route('server.store') }}" class="mt-6 space-y-6">
        @csrf
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <x-input-label for="image" :value="__('Image link')" />
                <x-text-input id="image" name="image" type="text" class="mt-1 block w-full"  required autofocus autocomplete="image" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </form>
        </div>
    </div>
</x-app-layout>