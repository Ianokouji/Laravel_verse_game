<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;

use function Symfony\Component\Clock\now;

class GameBoard extends Component
{
    // protected $listeners = ["keypressed" => "setKeyPress"];


    public $verseContent = '';
    public $verseContext = '';

    public $keyPressed;

    #[On("keypressed")]
    public function setKeyPress($key){
        $this->keyPressed = $key;
    }

    public function mount(){

        $game_data = session('game_data');

      

        $this->verseContent = $game_data['verseContent'];
        $this->verseContext = $game_data['verseContext'];

    }


    public function render()
    {
        return view('livewire.game-board');
    }
}




  // if(!$game_data){
        //     session()->forget('game_data');
        //     return redirect()->route('verseSelector')
        //             ->with('error', 'Please select a verse to start the game');
        // }