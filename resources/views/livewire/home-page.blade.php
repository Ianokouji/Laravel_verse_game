

<div class="min-h-screen flex flex-col items-center justify-center">
    <h1 class="text-2xl font-bold mb-6 text-center">Start and Keep the scripture close to your Heart and Mind</h1>
    <div>
        <input wire:model.live.debounce.500ms="input"
                class="p-2 border rounded"
        >
        <div class="mt-2 text-center">{{ $input }}</div>
    </div>
    
    <div class="text-center">
        <div class="mt-2">{{ $count }}</div>

        <button wire:click='increment'
                class="px-4 py-4 bg-red-500 text-white rounded hover:bg-red-600 mt-4"
        >       
            Increment
        </button>
    </div>

    <div class="mt-7">
        <a href="{{route('verseSelector')}}"
            class="px-4 py-4 bg-green-500 text-white rounded hover:bg-green-600 mt-4"
        >
        Start
        </a>
    </div>
    
</div>

