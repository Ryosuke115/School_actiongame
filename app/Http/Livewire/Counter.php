<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    
    public $message;
    public $message2;
    public $message3;
    
    public function render()
    {
        return view('livewire.counter');
    }
    
    public function inc(){
        $this->count++;
    }
}
