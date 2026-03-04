<x-layout>

    <x-slot:title>
        Welcome
    </x-slot:title>

        <div class="max-w-2xl mx-auto">
            @forelse ($chirps as $chirp )

            @empty
                <p class="text-gray-500">No one has chirped yet. Be the first!</p>
            @endforelse
        </div>
</x-layout>