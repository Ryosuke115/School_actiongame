<!doctype html>

<html>
  <head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, user-scalable=no" />
      <title>わわわ</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.52.0/dist/phaser.min.js"></script>
   
  </head>
  <body>
  <script>
      let Game = {};
      let Data = {};
      
      Game.width = 32 * 8;
      Game.height = 28 * 8;
      
      power = 0;
      player_HP = 20;
      
      //TitleScene
      class TitleScene extends Phaser.Scene{
          
          constructor() {
              super({
                  key: 'TitleScene'
              });
          }
          
          preload(){
              
          }
          
          create() {
              
              
              let start = this.add.text(Game.width / 4, Game.height / 2, 'スタート', {font: '20px MyFont'}).setInteractive().setOrigin(0.5).setTint(0xff00ff, 0xffff00, 0x0000ff, 0xff0000);

        start.on('pointerup', function(pointer) {
            player_HP = 10;
            power = 0;
            this.scene.start('Shibikane');
        }, this);
    }
}
      
      
class GameScene extends Phaser.Scene {
    constructor() {
        super({
            key: 'GameScene'
        });
        
        this.player = null;
        this.cursors = null;
    }
    
    preload()
    {
        this.load.image('star', "{{asset('./image/star.png')}}");
        this.load.image('ground', "{{asset('./image/ground.png')}}");
        this.load.spritesheet('player', "{{asset('./image/girl.png')}}", {frameWidth: 8, frameHeight: 9});
    }
    
    create ()
    {
        this.add.image(Game.width/2, Game.height/2, 'star');
        var platforms = this.physics.add.staticGroup();
        
        platforms.create(400, 568, 'ground').setScale(1).refreshBody();
        platforms.create(600, 400, 'ground');
        platforms.create(50, 250, 'ground');
        platforms.create(750, 220, 'ground');
        
        
        var player = this.physics.add.sprite(100, 100, 'player');
        player.setBounce(0.2);
        player.setCollideWorldBounds(true);
        
        this.anims.create({
            key: 'left',
            frames: this.anims.generateFrameNumbers('player', {start: 2, end: 3}),
            frameRate: 5,
            repeat: -1
        });
        
        this.anims.create({
            key: 'turn',
            frames: [ {key: 'player', frame: 4}],
            frameRate: 20
        });
        
        this.anims.create({
            key: 'right',
            frames: this.anims.generateFrameNumbers('player', {start: 4, end: 5}),
            frameRate: 5,
            repeat: -1
        });
        
        this.cursors = this.input.keyboard.createCursorKeys();
        this.physics.add.collider(player, platforms);
        this.player = player;
        
        this.keys = {};
        this.keys.keyW = this.input.keyboard.addKey('W');
        this.keys.keyA = this.input.keyboard.addKey('A');
    }
    
    update()
    {
        var cursors = this.cursors;
        var player = this.player;
        
        
        if (this.keys.keyW.isDown) {
            player.setVelocityY(-100);
        }
        
        if (this.keys.keyA.isDown){
            player.setVelocityX(-200);
            player.anims.play('left', true);
            //this.facing_direction = -1;
        }/*else{
            player.setVelocityX(0);
        }*/
    }
}
      

      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
//////////////////////////////////////////////タイルのマップシーン
    class Shibikane extends Phaser.Scene {
        constructor() {
            super({
                key: 'Shibikane'
            });
            
            this.map = null;
            this.player = null;
            this.cursors = null;
            this.level = null;
            this.layer = null;
            this.homes = null;
        }
        
        preload(){
            this.load.image('tile_map', "{{asset('./image/tile1.png')}}");
            this.load.image('home', "{{asset('./image/home.png')}}");
            this.load.spritesheet('player', "{{asset('./image/girl.png')}}", {frameWidth: 8, frameHeight: 9});
        }
        
    create() {
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
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7],
      [ 7, 7, 7, 7, 7, 7, 7, 14, 14, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7]
      
      
    ];
            
    var map = this.make.tilemap({data: level, tileWidth: 8, tileHeight: 8});
    var tiles = map.addTilesetImage('tile_map');
    var layer = map.createLayer(0, tiles, 0, 0);
    
    map.setCollisionBetween(7, 7);
            
    
    var player = this.physics.add.sprite(50, 40, 'player', 1);
    player.setCollideWorldBounds(true);
    
    this.anims.create({
            key: 'left',
            frames: this.anims.generateFrameNumbers('player', {start: 2, end: 3}),
            frameRate: 5,
            repeat: -1
        });
        
        this.anims.create({
            key: 'turn',
            frames: [ {key: 'player', frame: 4}],
            frameRate: 20
        });
        
        this.anims.create({
            key: 'right',
            frames: this.anims.generateFrameNumbers('player', {start: 4, end: 5}),
            frameRate: 5,
            repeat: -1
        });
            
        this.anims.create({
            key: 'up',
            frames: this.anims.generateFrameNumbers('player', {start: 6, end: 7}),
            frameRate: 5,
            repeat: -1
        });
            
        this.anims.create({
            key: 'down',
            frames: this.anims.generateFrameNumbers('player', {start: 0, end: 1}),
            frameRate: 5,
            repeat: -1
        });
            
            
        var home = this.physics.add.group({
            key: 'home',
            repeat: 0,
            setXY: {x: 45, y: 90}
        });
        this.physics.add.collider(home, layer);    
        
        this.cursors = this.input.keyboard.createCursorKeys();
        this.physics.add.collider(player, layer);
        this.player = player;
        this.physics.add.overlap(player, home, sub, null, this);
        this.keys = {};
        this.keys.keyW = this.input.keyboard.addKey('W');
        this.keys.keyA = this.input.keyboard.addKey('A');
        this.keys.keyS = this.input.keyboard.addKey('S');
        this.keys.keyD = this.input.keyboard.addKey('D');
        
        
            
            
        function sub(){
            console.log('aaa');
            this.scene.start('First_School');
        }
            
            
        }
    update()
    {
        var cursors = this.cursors;
        var player = this.player;
        var home = this.home;
        
        
        if (this.keys.keyW.isDown) {
            player.setVelocityY(-50);
            player.anims.play('up', true);
            //this.physics.add.overlap(player, home, this.sub);
        
        }
        else if (this.keys.keyA.isDown){
            player.setVelocityX(-50);
            player.anims.play('left', true);
            //this.facing_direction = -1;
            //this.physics.add.overlap(player, home, this.sub);
        
        }
        else if (this.keys.keyS.isDown){
            player.setVelocityY(50);
            player.anims.play('down', true);
            //this.physics.add.overlap(player, home, this.sub);
        
        }
        else if (this.keys.keyD.isDown){
            player.setVelocityX(50);
            player.anims.play('right', true);
            //this.physics.add.overlap(player, home, this.sub);
        
        }
        else{
            player.anims.stop();
            player.setVelocity(0);
        }
      }
    }

      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      /////////////////////////////最初の学校でのシーン
      
  class First_School extends Phaser.Scene {
      constructor() {
          super({
              key: 'First_School'
          });
          
          this.map = null;
          this.player = null;
          this.cursors = null;
          this.level = null;
          this.layer = null;
          this.student1 = null;
          this.evState = 0;    //会話イベントの状態
      }
      
      preload(){
          this.load.image('school_tile', "{{asset('./image/school_tile.png')}}");
          this.load.image('star', "{{asset('./image/star.png')}}");
          this.load.image('ground', "{{asset('./image/ground.png')}}");
          this.load.spritesheet('student1', "{{asset('./image/student1.png')}}", {frameWidth: 8, frameHeight: 9});
          this.load.spritesheet('player', "{{asset('./image/girl.png')}}", {frameWidth: 8, frameHeight: 9});
      }
      
      create() {
          var level = [
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9],
              [9, 9, 9, 9, 9, 9, 9, 9, 9, 11, 11, 11, 11, 11, 11, 11, 11, 11, 11, 11, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9]
              
          ];
          
          var map = this.make.tilemap({data: level, tileWidth: 8, tileHeight: 8});
          var tiles = map.addTilesetImage('school_tile');
          var layer = map.createLayer(0, tiles, 0, 0);
          
          var star = this.physics.add.image(10, 30, 'star');
          var ground = this.physics.add.image(300, 200, 'ground');
          
          
          map.setCollisionBetween(12, 15);
          
          var player = this.physics.add.sprite(50, 40, 'player', 1);
          player.setCollideWorldBounds(true);
          
          //部活メイト１
          //var student1 = this.physics.add.sprite(50, 100, 'student1', 1);
          var student1 = this.physics.add.staticGroup();
          student1.create(50, 100, 'student1', 6);
          //platforms.create(600, 400, 'ground');
          
          var evState = 0;
          
          
          this.anims.create({
            key: 'left',
            frames: this.anims.generateFrameNumbers('player', {start: 2, end: 3}),
            frameRate: 5,
            repeat: -1
           });
        
        this.anims.create({
            key: 'turn',
            frames: [ {key: 'player', frame: 4}],
            frameRate: 20
           });
        
        this.anims.create({
            key: 'right',
            frames: this.anims.generateFrameNumbers('player', {start: 4, end: 5}),
            frameRate: 5,
            repeat: -1
           });
            
        this.anims.create({
            key: 'up',
            frames: this.anims.generateFrameNumbers('player', {start: 6, end: 7}),
            frameRate: 5,
            repeat: -1
           });
            
        this.anims.create({
            key: 'down',
            frames: this.anims.generateFrameNumbers('player', {start: 0, end: 1}),
            frameRate: 5,
            repeat: -1
           });
          
        this.anims.create({
            key: 'stuup',
            frames: this.anims.generateFrameNumbers('student1', 
            {start: 6, end: 7}),
            frameRate: 4,
            repeat: 0
        });
        
          
        this.anims.create({
            key: 'studown',
            frames: this.anims.generateFrameNumbers('student1', 
            {start: 0, end: 1}),
            frameRate: 4,
            repeat: -1
        });
          
          
          this.cursors = this.input.keyboard.createCursorKeys();
          this.physics.add.collider(player, layer);
          this.physics.add.collider(player, student1, talk, null, this);
          
          this.player = player;
          this.student1 = student1;
          this.evState = evState;
          
          
          //this.physics.moveToObject(student1, player, 200);
          
          this.keys = {};
          this.keys.keyW = this.input.keyboard.addKey('W');
          this.keys.keyA = this.input.keyboard.addKey('A');
          this.keys.keyS = this.input.keyboard.addKey('S');
          this.keys.keyD = this.input.keyboard.addKey('D');
          
           function talk(){
              console.log('sss');
            
              var message1 = this.add.text(10, 170, 'ちなつー！', {
                  fontSize: '10px',
                  fill: '#ffffff'
              }).setInteractive();
              
              var message2 = this.add.text(20, 190, '今日の部活、先生出張だから', {
                  fontSize: '10px',
                  fill: '#ffffff'
              }).setInteractive();
              
              var message3 = this.add.text(30, 210, '自由参加でいいんだってー',{
                      fontsize: '10px',
                      fill: '#ffffff'
                  }).setInteractive();
              
              this.physics.moveToObject(star, ground, 200);
              
              message1.on('pointermove', function(){
                  message1.setText('');
                  message2.setText('');
                  message3.setText('');
                 
              }, this);
          }
          
          
          
      }
      
      update()
      {
          var cursors = this.cursors;
          var player = this.player;
          var student1 = this.student1;
          var evState = this.evState;
          evState = 1;
          
        if (this.keys.keyW.isDown && evState == 1) {
            player.setVelocityY(-50);
            player.anims.play('up', true);
            //this.physics.add.overlap(player, home, this.sub);
        
        }
        else if (this.keys.keyA.isDown && evState == 1){
            player.setVelocityX(-50);
            player.anims.play('left', true);
            //this.facing_direction = -1;
            //this.physics.add.overlap(player, home, this.sub);
        
        }
        else if (this.keys.keyS.isDown && evState == 1){
            player.setVelocityY(50);
            player.anims.play('down', true);
            //this.physics.add.overlap(player, home, this.sub);
        
        }
        else if (this.keys.keyD.isDown && evState == 1){
            player.setVelocityX(50);
            player.anims.play('right', true);
            //this.physics.add.overlap(player, home, this.sub);
        
        }
        else{
            player.anims.stop();
            player.setVelocity(0);
            //student1.setVelocity(0);
        }
        
          
         
          
      }
    }
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
    ///////////////////////////////////////////////////////////////////////////////////ウィンドウのロード
      window.onload = function(){
          
        let config = {
          type: Phaser.AUTO,
          scale: {
              //autoCenter: Phaser.Scale.CENTER_BOTH,
              //parent: 'phaser-example',
              width: Game.width,
              height: Game.height,
              pixelArt: true,
              zoom: 3
          },
          physics: {
              default: 'arcade',
              arcade: {
              debug: false,
              gravity: { y: 0}
              }
        },
        scene: [TitleScene, GameScene, Shibikane, First_School]
      };
          
        let game = new Phaser.Game(config);
      }
      </script>
    </body>
</html>