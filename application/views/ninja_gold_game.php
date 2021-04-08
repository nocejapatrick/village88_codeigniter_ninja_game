<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ninja Gold Game</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Syne+Mono&display=swap" rel="stylesheet">

    <style>
        *{
            margin: 0;
            padding: 0;
            outline:none;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
          
        }
        .container{
            max-width:1200px;
            margin:40px auto;
        }

        .player_gold *{
            font-size: 1.3em;
        }

        .player_gold input{
            padding: 2px 5px;
        }

        form *{
            font-family: 'Syne Mono', monospace;
        }

        .users_actions{
            margin: 60px 0px;
        }
        .users_actions > *{
            display: inline-block;
            vertical-align: top;
            width: 23%;
            text-align: center;
            border: 2px solid black;
            margin: 10px;
            padding: 60px 20px;
        }

        .users_actions input[type="submit"]{
            margin-top: 30px;
            border:1px solid black;
            cursor: pointer;
            padding: 8px 15px;
            background: gold;
        }
        .users_activities div{
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #4d4d4d;
        }

        .users_activities div p{
            margin: 5px;
        }

        .users_activities .earned{
            color: green;
        }

        .users_activities .lost{
            color: red;
        }

        .users_activities > div{
            height: 288px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="player_gold">
            <label>Your Gold: </label>
            <input type="text" disabled="disabled" value="<?= ($this->session->userdata('coins')) ? $this->session->userdata('coins') : 0?>">     
        </div>


        <div class="users_actions">
            <form action="/process_money" method="POST">
                <h1>Farm</h1>
                <h2>(earns 10 - 20 golds)</h2>
                <input type="hidden" name="user_actions" value="farm">
                <input type="submit" name="submit" value="Find Gold!">
            </form>

            <form action="/process_money" method="POST">
                <h1>Cave</h1>
                <h2>(earns 5 - 10 golds)</h2>
                <input type="hidden" name="user_actions" value="cave">
                <input type="submit" name="submit" value="Find Gold!">
            </form>

            <form action="/process_money" method="POST">
                <h1>House</h1>
                <h2>(earns 2 - 5 golds)</h2>
                <input type="hidden" name="user_actions" value="house">
                <input type="submit" name="submit" value="Find Gold!">
            </form>

            <form action="/process_money" method="POST">
                <h1>Casino!</h1>
                <h2>(earns/takes 0 - 50 golds)</h2>
                <input type="hidden" name="user_actions" value="casino">
                <input type="submit" name="submit" value="Find Gold!">
            </form>
        </div>
        
        <div class="users_activities">
            <h4>Activities</h4>
            <div>
                <?php 
            
                
                        for($i = count($this->session->userdata('activities'))-1; $i >= 0; $i--){
                            $act = $this->session->userdata('activities')[$i];
                ?>

                    <?php if($act["happen"]=="earned"){
                          
                        ?>


                       <p class="<?= $act["happen"] ?>">Earned <?= $act["coins"] ?> golds from the <?= $act["action"] ?>! (<?= $act["date"] ?>)</p>
       
                    <?php }else {?>
                        <p class="<?= $act["happen"] ?>">Entered a <?= $act["action"] ?> and lost <?= $act["coins"] ?> golds... Ouch ... (<?= $act["date"] ?>)</p>
                    <?php } ?>

       
       
       
          <?php } 
            ?>
            </div>
        </div>
    </div>
</body>
</html>