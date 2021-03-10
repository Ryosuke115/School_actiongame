<?php

namespace App\Http\Livewire;

use App\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

//基本更地の書きなぐり形式タスク管理板、認識させるのは日付時間とテキスト
class Postform extends Component
{
    public Post $post;
    public $post_type = '';
    public $title = '';
    public $title_list = '';
    public $text = '';
    
    
    public function mount(){
        $user_id = Auth::id();           //認証ユーザーidを取得
        $list_col = Comment::where('user_id', $user_id)->pluck('name');//認証ユーザーidとカラムidが合致しているCommentカラムのnameを取得
        $list = $list_col->all();        //上記のコレクションを配列に変換
        $this->title_list = $list;       //$title_listに上記の配列を格納、認証ユーザが登録したタスクのみpostform.bladeとtasklist.bladeに表示される
        
    }
    
    
    public function render()
    {
        return view('livewire.postform');
    }
    
}
