
<div>
 <h1>初めてのLivewire</h1>
    <h2>{{ $count }}</h2>
    <p><button wire:click="inc">+1</button></p>
    
    <input type="text" wire:model.debounce.500ms="message">{{ $message }}<br>
    <input type="text" wire:model.lazy="message2">{{ $message2 }}
    <!--<input type="text" wire:model.defer="message3">{{ $message3 }}<br>
    <button wire:click="search">検索</button>-->
    @if(!$message)<!--$マークを忘れずに-->
    <p style='color: red; font-weight:bold'>文字を入力してください</p>
    @else
    <p>文字を入力しました</p>
    @endif
</div>
