<div>
<form action="/upcreate" method="post" name="one">
    @csrf
     
    <h3 style="margin-top: 50px; font-weight: bold; font-size: 18px">作品名</h3>
    <input type="text" name="title" wire:model="title">
    <br>
    <label style="font-weight: bold; font-size: 19px">進行記録</label><br>
    <textarea name="area_text" rows="4" cols="40"></textarea>
        
    <input style="margin-top: 50px;" type="submit">
    </form>
</div>