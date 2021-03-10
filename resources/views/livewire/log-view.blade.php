<div>
<label>閲覧したいプロジェクトの名前を入力してください</label>
<input type="search" wire:model="search" placeholder="検索">
    
<ul>
    @foreach($posts as $post)
     <li style="margin-top: 10px; margin-bottom: 10px";>{{ $post->description }}  ----------------------日付{{$post->post_time}}</li>
    @endforeach
    </ul>
    
</div>