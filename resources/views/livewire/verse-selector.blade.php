

<div>
    

    <div class="flex flex-row items-center justify-center mt-9 min-w-11 bg-slate-400">


        
        <select wire:model.live.debounce.150ms='selectedBook' id="book">
            <option value="">Book</option>
            @foreach ($books as $book)
                <option value="{{ $book->id }}">{{$book->name}}</option>
            @endforeach
        </select>
        
        
        <select wire:model.live.debounce.150ms='selectedChapter' id="chapter" {{ empty($selectedBook) ? 'disabled' : '' }}>
            <option value="">Chapter</option>
            @foreach ($chapters as $chapter)
                <option value="{{$chapter->id}}">{{$chapter->chapter_number}}</option>
            @endforeach
        </select>

        
        <select wire:model.live.debounce.150ms='selectedVerseStart' id="verseStart" {{empty($selectedChapter) ? 'disabled' : ''}}>
            <option value="">Starting Verse</option>
            @foreach ($verses as $verse)
                <option value="{{$verse}}">{{$verse}}</option>
            @endforeach
        </select>


        
        <select wire:model.live.debounce.150ms='selectedVerseEnd' id="verseEnd" {{ empty($selectedVerseStart) ? 'disabled' : '' }}>
            <option value="">Ending Verse</option>
            @foreach ($verses as $verse)
                <option value="{{$verse}}">{{$verse}}</option>
            @endforeach
        </select>

    </div>

    <div class="flex justify-center mt-14">
        <button 
            wire:click='getVerse' 
            class="bg-blue-400 hover:bg-blue-500 active:bg-blue-600 rounded min-w-32 min-h-16 
            disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-blue-400 
            transition-colors duration-200"
            {{empty($selectedVerseStart) ? 'disabled' : '' }}
        >
            Submit Verse
        </button>
    </div>

    


    <div>
        @error('verse-range')
            <div class="text-red-500 mt-4">
                {{ $message }}
            </div>            
        @enderror

        @error('verse-fetch-failed')
            <div class="text-red-500 mt-4">
                {{ $message }}
            </div> 
        @enderror
    </div>


    <div>
        @if ($fullVerse)
            <h3>Full Verse is: {{$fullVerse}}</h3>
        @endif
    </div>


    @if ($showModal)
        <div class="flex">
            <h2>{{ $fullVerse }}</h2>
                <div>
                    <p>{{ $verseContent }}</p>
                </div>
            <div>
                <button wire:click='startGame'>Let's Go</button>
                <button wire:click='cancelSelection'>Cancel</button>
            </div>
        </div>
    @endif


</div>

