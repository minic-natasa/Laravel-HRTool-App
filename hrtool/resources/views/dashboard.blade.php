<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="text-xl font-semibold leading-tight">
                	Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </div>
        </div>
    </x-slot>
</x-app-layout>
