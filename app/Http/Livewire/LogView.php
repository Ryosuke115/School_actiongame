<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class LogView extends Component
{
    
    public $log_select = '';
    public $search;
    
    protected $queryString = ['search'];
    
    public function render()
    {
        $user_id = Auth::id();
        return view('livewire.log-view', [
            'posts' => Comment::where('name', 'like', '%'.$this->search.'%')->where('user_id', $user_id)->get(),
        ]);
    }
    
    public function mount(){
        
    }
    
    /*public function inc(){
        $user_id = Auth::id();
        $select_name = $this->log_select;
        $log_des = array();
        $log_time = array();
        
        $log = Comment::where('user_id', $user_id)
                  ->where('name', $select_name)
                  ->pluck('description');
        
        $logs = Comment::where('user_id', $user_id)
                  ->where('name', $select_name)
                  ->pluck('post_time');
        
        $log_des = $log->all();
        $log_time = $logs->all();
        
    }*/
}
