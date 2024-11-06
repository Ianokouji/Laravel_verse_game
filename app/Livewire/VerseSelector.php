<?php

namespace App\Livewire;

use App\Models\BibleBook;
use App\Models\BibleChapter;
use Livewire\Component;

use Illuminate\Support\Facades\Http;

use function Laravel\Prompts\text;
use function Symfony\Component\Clock\now;

class VerseSelector extends Component
{   


    // public $selectedBook = '';
    
    
    // public $bookName;
    // public $testament;
    // public $isSuccess = false;
    
    
    
    
    public $selectedBook = '';        // Reference for current selected Book on update
    public $selectedChapter = '';     // Reference for current selected Chapter -> Dependent on Book
    public $selectedVerseStart = '';  // Reference for current selected Verse -> Dependent on Chapter
    public $selectedVerseEnd = '';    // Reference for current selected Verse to complete range -> Greater than or equal to First
   
    public $fullVerse = '';           // Contains the Verse string to be used in fetching the verseContent

    public $errorMessage = '';        // Is a global way to track errors in this component

    public $verseContent = '';        // State that would hold the fetched content of the verse from the api

    public $showModal = false;        // State that handles modal flashing in the frontend

    // Temporary Containers for Verses and Chapters //
    public $books = [];
    public $chapters = [];
    public $verses = [];

    protected $rules = [
        'selectedBook' => 'required',
        'selectedChapter' => 'required',
        'selectedVerseStart'=> 'required|integer',
        'selectedVerseEnd'=> 'integer|gte:selectedVerseStart',
    ];

     // protected $listeners = ["keypressed" => "setKeyPress"];
    

    // When the component first mounts it sets the bible_book objects from the database to the public states to be used in the components
    public function mount() {
        $this->books = BibleBook::all();
    }

    public function updatedselectedBook($bookId) {

        // Resest dependent states for this
        $this->selectedChapter = '';
        $this->selectedVerseStart = '';
        $this->selectedVerseEnd = '';


        // Fetch the chapter based on the $bookId
        $this->chapters = BibleChapter::where('book_id',$bookId)->get();
        $this->verses = [];
    }

    public function updatedselectedChapter($chapterId) {

        $this->selectedVerseStart = '';
        $this->selectedVerseEnd = '';

        $chapter = BibleChapter::find($chapterId);
        $this->verses = range(1, $chapter->verse_count);

    }
    


    


    public function getVerse() {

        try {

            if($this->selectedVerseEnd && $this->selectedVerseEnd < $this->selectedVerseStart) {
                throw new \Exception('Starting verse must be greater than Ending verse');
            }
            

            // Find current Book
            $current_book = BibleBook::find($this->selectedBook);
            $book_name = $current_book->name;

            // Find current Chapter
            $current_chapter = BibleChapter::find($this->selectedChapter);
            $chapter_num = $current_chapter->chapter_number;

            $this->fullVerse = $book_name . ' ' . 
                               $chapter_num . ':' . 
                               $this->selectedVerseStart . 
                               (!empty($this->selectedVerseEnd) ? "-{$this->selectedVerseEnd}" : "");


            $this->fetchVerse($this->fullVerse);

        } catch (\Exception $e){
            $this->addError('verse-range',$e->getMessage());
        }
    }


    public function fetchVerse($verseRef) {
        try {

            $encoded_verseRef = urlencode($verseRef);
            $response = Http::get("https://bible-api.com/{$encoded_verseRef}");

            if  ($response->successful() && isset($response['text'])) { 
                $this->verseContent = $response['text'];
                $this->showModal = true;
            } else {
                throw new \Exception('Verse selection not found');
            }


         } catch (\Exception $e){
            $this->addError('verse-fetch-failed',$e->getMessage());
         }
    }

    public function startGame() {

        session([
            'game_data'=> [
                'verseContent' => $this->verseContent,
                'verseContext'=> $this->fullVerse,
            ],
        ]);

        return redirect()->route('gameBoard');
    }


    public function completeGame()
    {
        // Save score or other game data if needed
        session()->forget('game_data');
        //return redirect()->route('game-complete');
    }


    public function cancelSelection() { 
        
         // Hide the Modal
        $this->showModal = false; 
        
        // Reset other properties if needed
        $this->reset([
            'selectedBook',
            'selectedChapter',
            'selectedVerseStart',
            'selectedVerseEnd',
            'fullVerse',
            'verseContent',
            'chapters',
            'verses'
        ]);
    }
    


    public function render()
    {
        return view('livewire.verse-selector');
    }


   
}
