<!DOCTYPE html>
<html>
<head>
    <title>ゲーム</title>
  <!-- CDNによるphaserの読み込み -->
    <!--<script src="{{asset('js/test.js')}}"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.52.0/dist/phaser.min.js"></script>
    </head>
    <body>
    <script>
    const TILESIZE = 8;
    const START_X = 8;
    const START_Y = 4;
    
    let PlayerX = START_X * TILESIZE + TILESIZE / 2;
    let PlayerY = START_Y * TILESIZE + TILESIZE / 2;
    let king = 0;

function preload ()//画像フォルダから画像の読み込みとスプライト生成
{
    this.load.image('star', "{{asset('./image/star.png')}}");
    this.load.image('home', "{{asset('./image/home.png')}}");
    this.load.image('mario-tiles', "{{asset('./image/tile1.png')}}");
    this.load.spritesheet('player', "{{asset('./image/girl.png')}}",
                          { frameWidth: 8, frameHeight: 9}
                         );
}

function create ()
{      
    
    
    var kok = [
         [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 3, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         /*[ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
         [ 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],*/
    ];

    var level = [
      [ 7, 7, 6, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 8, 9, 0, 0, 0, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 12, 13, 0, 0, 0, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 0, 0, 0, 0, 11, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 0, 3, 4, 1, 4, 3, 3, 4, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7 ],
      [ 7, 0, 0, 3, 3, 4, 4, 4, 3, 4, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 0, 3, 1, 4, 3, 3, 10, 4, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 0, 0, 0, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 0, 0, 1, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 15, 15, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7]
    ];

    // tilewidthとtileheightの指定を忘れずに
    var map = this.make.tilemap({ data: level, tileWidth: TILESIZE, tileHeight: TILESIZE});
    var tiles = map.addTilesetImage('mario-tiles');
    var layer = map.createLayer(0, tiles, 0, 0);
    //layer.setScale(2);拡大される
    map.setCollisionBetween(7, 7);
    map.setCollisionBetween(3, 4);
    
    
    
     player = this.physics.add.sprite(PlayerX, PlayerY, 'player', 1);
     player.setCollideWorldBounds(true);
     cursors = this.input.keyboard.createCursorKeys();

     this.anims.create({
        key: 'down',
        frames: this.anims.generateFrameNumbers('player', {start: 0, end: 1}),
        frameRate: 6,
        repeat: -1
    });
    
    
    this.anims.create({
        key: 'left',
        frames: this.anims.generateFrameNumbers('player', {start: 2, end: 3}),
        frameRate: 6,
        repeat: -1
    });
    
    this.anims.create({
        key: 'right',
        frames: this.anims.generateFrameNumbers('player', {start: 4, end: 5}),
        frameRate: 6,
        repeat: -1
    });
    
    this.anims.create({
        key: 'up',
        frames: this.anims.generateFrameNumbers('player', {start: 6, end: 7}),
        frameRate: 6,
        repeat: -1
    });
    
homes = this.physics.add.group({
    key: 'home',
    repeat: 0,
    setXY: {x: 45, y: 90}
});
    
    
     this.physics.add.collider(player, layer);

     this.physics.add.collider(homes, layer);
     this.cameras.main.setBounds(0, 0, map.widthInPixels, map.heightInPixels);
     this.cameras.main.startFollow(player);
    
     this.physics.add.overlap(player, homes, sub, null, this);
    
    function sub ()
        {
            console.log('ppp');
            var map = this.make.tilemap({ data: kok, tileWidth: TILESIZE, tileHeight: TILESIZE});
            var tiles = map.addTilesetImage('mario-tiles');
            var layer = map.createLayer(0, tiles, 0, 0);
            player = this.physics.add.sprite(50, 50, 'player', 1);
            player.setCollideWorldBounds(true);
            cursors = this.input.keyboard.createCursorKeys();
    
            homes = this.physics.add.group({
            key: 'home',
            repeat: 0,
            setXY: {x: 5 * TILESIZE, y: 5 * TILESIZE}
            });
            
            star = this.physics.add.group({
            key: 'star',
            repeat: 0,
            setXY: {x: 50, y: 15}
            });
    
    
     this.physics.add.collider(player, layer);
       map.setCollisionBetween(3, 4);
     //this.physics.add.collider(homes, layer);
     this.cameras.main.setBounds(0, 0, map.widthInPixels, map.heightInPixels);
     this.cameras.main.startFollow(player);
    
     //this.physics.add.overlap(player, homes, sub, null, this);//繰り返しプレイヤー画像が消えずに描画される
     this.physics.add.overlap(player, star, gg);
    
    }
    
    
    function gg (){
        
        king += 8;
        console.log(king);
        var map = this.make.tilemap({ data: level, tileWidth: TILESIZE, tileHeight: TILESIZE});
            var tiles = map.addTilesetImage('mario-tiles');
            var layer = map.createLayer(0, tiles, 0, 0);
            player = this.physics.add.sprite(50, 50, 'player', 1);
            player.setCollideWorldBounds(true);
            cursors = this.input.keyboard.createCursorKeys();
    
    }
    
     player.anims.play('down', false);
}

    function update(time, delta){
        
        player.body.setVelocity(0);
        
        if(cursors.left.isDown)
            {
                player.body.setVelocityX(-50);
            }
        else if (cursors.right.isDown)
            {
                player.body.setVelocityX(50);
            }
        
        if (cursors.up.isDown)
            {
                player.body.setVelocityY(-50);
            }
        else if (cursors.down.isDown)
            {
                player.body.setVelocityY(50);
            }
        
        
        if (cursors.left.isDown)
            {
                player.anims.play('left', true);
                PlayerX -= 8;
                
            }
        else if (cursors.right.isDown)
            {
                player.anims.play('right', true);
                PlayerX += 8;
                
            }
        else if (cursors.down.isDown)
            {
                 player.anims.play('down', true);
                 PlayerY += 8;
                 
            }
        else if (cursors.up.isDown)
            {
                player.anims.play('up', true);
                PlayerY -= 8;
                
            }
        else 
        {
            player.anims.stop();
        }
    
    }
        
        
        
        
        var config = {
    type: Phaser.AUTO,
    width: 32 * 8, // Number of tiles * size of the tile
    height: 21 * 8,
    zoom: 4,
    pixelArt: true,
    scene: {
        preload: preload,
        create: create,
        update: update,
        
     },
    physics: {
        default: 'arcade',
        arcade: { gravity: { y: 0 }}
    },
        
};
        var game = new Phaser.Game(config);
        
    </script>
    </body>
</html>