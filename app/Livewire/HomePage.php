<?php

namespace App\Livewire;

use Livewire\Component;

class HomePage extends Component
{   

    public $count = 0;

    public $input = 'Hello';

    public function increment() {
        $this->count++;
    }


    public function render()
    {
        return view('livewire.home-page');
    }
}
