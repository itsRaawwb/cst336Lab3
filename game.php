<?php
    function main(){
        $deck = array();
        $deck = createDeck($deck);
        
        for($i = 0; $i < 52; $i++){
            echo $deck[$i].'<br>';
        }
        
        $player1 = ["imageName" => "",
                    "name" => $_POST["p1"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null];
                
        $player2 = ["imageName" => "",
                    "name" => $_POST["p2"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null];
                    
        $player3 = ["imageName" => "",
                    "name" => $_POST["p3"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null];
                    
        $player4 = ["imageName" => "",
                    "name" => $_POST["p4"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null];
        $table = [$player1, $player2, $player3, $player4];            
                    
        //Deal cards
        dealCards($table, $deck);
                    

    }
    
    //this function will create the deck and shuffle it.
    function createDeck($deck){
        for($i = 0; $i < 52; $i++){
            $deck[] = $i;
        }
        
        shuffle($deck);
        
        
        return($deck);
    }
    
    //this array takes in 2 arrays, one containing the players; the other is the deck
    function dealCards($table, $deck){
        for($i = 0; $i < 4; $i++){
            $table[$i[2]] = array_pop($deck);
        }
        for($i = 0; $i < 4; $i++){
            $table[$i[3]] = array_pop($deck);
        }
        for($i = 0; $i < 4; $i++){
            $table[$i[4]] = array_pop($deck);
        }
        for($i = 0; $i < 4; $i++){
            $table[$i[5]] = array_pop($deck);
        }
        for($i = 0; $i < 4; $i++){
            $table[$i[6]] = array_pop($deck);
        }
        for($i = 0; $i < 4; $i++){
            $table[$i[7]] = array_pop($deck);
        }
        
    }
    
    //this function will print the table;
    function printTable($table){
            //display table
        echo '<div>';
        echo '<table class="gameTable">';
            //header row
            echo '<tr>';
                echo '<td>';
                echo '';
                echo '</td>';
                    
                echo '<td>';
                echo '';
                echo '</td>';
                    
                echo '<td>';
                echo '';
                echo '</td>';
            echo '</tr>';
        echo '</table>';
        echo '</div>';
    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Play Some Silverjack!</title>
        <link rel="stylesheet" type="css" href="css/main.css">
    </head>
    <body>
        <?php
            main();
        ?>
        <!--<a href="index.php">Play again!</a>-->
        <form action="game.php" method="POST">
            <input type="hidden" name="p1" value="<?=  $_POST["p1"] ?>" />
            <input type="hidden" name="p2" value="<?=  $_POST["p2"] ?>" />
            <input type="hidden" name="p3" value="<?=  $_POST["p3"] ?>" />
            <input type="hidden" name="p4" value="<?=  $_POST["p4"] ?>" />
            <input type="submit" value="Play again?" />
        </form>
    </body>
</html>