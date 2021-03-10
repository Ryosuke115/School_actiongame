<!DOCTYPE html>
<html>
<head>
    <title>ゲーム</title>
  <!-- CDNによるphaserの読み込み -->
    <!--<script src="{{asset('js/test.js')}}"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.15.1/dist/phaser.min.js"></script>
    </head>
  <body>
      <img src="{{asset('./image/test.png')}}" style="width: 100px; height: 100px">
      <script> 
          //ゲームに関する設定
        var config = {
            type: Phaser.AUTO,
            width: 800,
            height: 600,
            scene: {
                preload: preload,
                create: create,
                update: update
            },
            
            physics: {
            default: 'arcade',
            arcade: {             //物理エンジンの設定項目
               gravity: { y: 200},//重力がどの方向に働くかを示す
               debug: false
                 }
            }
        };
          
          //描画関連↓
          //preload()----画像の読み込み
          function preload(){
              //背景画像
              this.load.image('back', "{{asset('./image/test.png')}}");
              //地面の画像
               this.load.image('ground', "{{asset('./image/ground.png')}}");
              //魔法使い
               this.load.spritesheet('witch', "{{asset('./image/witch.png')}}",//spriteはキャラクターやアイテムなどのモノを表す言葉
               { frameWidth: 32, frameHeight: 32 }                             //画像内の切り取り指定,指定しない場合画像を全域使用する
               );
          }
          
          //画面への画像の追加,最初の引数は画面上の画像の位置,今回画面サイズは幅800高さ600
          function create(){
              this.add.image(400, 300, 'back');
              
              player = this.physics.add.sprite(400,300,'witch');//スプライトの作成
              
              cursors = this.input.keyboard.createCursorKeys();

          this.anims.create({
              key: 'down',
              frames: this.anims.generateFrameNumbers('witch', { start: 0, end: 2 }),//第一引数はロードするときに決めたスプライトの名前,第二は開始フレームと終了フレーム
              frameRate: 5,          //1秒間に切り替わるコマの数
              repeat: -1             //アニメーションを繰り返す回数-1で無限リピート
          });
              
          
         this.anims.create({
           key: 'left',
           frames: this.anims.generateFrameNumbers('witch', { start: 3, end: 5}),
           frameRate: 5,
           repeat: -1
               });
              
         this.anims.create({
           key: 'right',
           frames: this.anims.generateFrameNumbers('witch', { start: 6, end: 8 }),
           frameRate: 5,
           repeat: -1
              });
              
          //player.anims.play('down', false);
          player.anims.play('down',false);
          player.setBounce(0.3);
          player.setCollideWorldBounds(true);
          //player.physics.add.collider(grounds);
         
              
        grounds = this.physics.add.staticGroup();//groundsに不動の属性を付与する
          grounds.create(100,550, 'ground');     //引数にxとyの座標とスプライトを指定し、画面に創造する
          grounds.create(300,200, 'ground');
          grounds.create(200,400, 'ground');
          grounds.create(400,550, 'ground');
              
         this.physics.add.collider(player, grounds);   //playerスプライトとgroundsスプライトは重ならずぶつかる関係としている  
              
          }
          
          
    //キー設定
    function update(){
              //左キーが押された時
    if (cursors.left.isDown)
    {
        player.setVelocityX(-100);
        player.anims.play('left', true);
    }
    //右キーが押された時
    else if (cursors.right.isDown)
    {
        player.setVelocityX(100);
        player.anims.play('right', true);
    }
    //キーが押されていない時
    else
    {
        player.setVelocityX(0);
    }
    //上キーが押されたらジャンプ（接地しているときのみ）
    if (cursors.up.isDown && player.body.touching.down)
    {
        player.setVelocityY(-330);
    }
          }
          
        //ゲームオブジェクトの生成
        var game = new Phaser.Game(config);
      </script>
  </body>
</html>