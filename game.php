<?php
    //global array 'deck'
    $deck = array();

    function main(){
        
        $deck = createDeck($deck);
        
        // for($i = 0; $i < 52; $i++){
        //     echo $deck[$i].'<br>';
        // }
        
        $player1 = ["imageName" => "",
                    "name" => $_POST["p1"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null,
                    "points" => 0];
                
        $player2 = ["imageName" => "",
                    "name" => $_POST["p2"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null,
                    "points" => 0];
                    
        $player3 = ["imageName" => "",
                    "name" => $_POST["p3"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null,
                    "points" => 0];
                    
        $player4 = ["imageName" => "",
                    "name" => $_POST["p4"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null,
                    "points" => 0];
        
        //Deal cards
        $player1 = dealCards($player1, $deck);
        $player2 = dealCards($player2, $deck);
        $player3 = dealCards($player3, $deck);
        $player4 = dealCards($player4, $deck);
    }
    
    //this function will create the deck and shuffle it.
    function createDeck($deck){
        for($i = 0; $i < 52; $i++){
            $deck[$i] = ($i+1);
        }
        
        shuffle($deck);
        return($deck);
    }
    
    //this array takes in 2 arrays, one containing the players; the other is the deck
    function dealCards($player, $deck){
        //algorithm checks a person's deck before dealing more cards
        
        if($player["points"] < 30 ){
            $player["card1"] = array_pop($deck);
        }
        if($player["points"] < 30 ){
            $player["card2"] = array_pop($deck);
        }
        if($player["points"] < 30 ){
            $player["card3"] = array_pop($deck);
        }
        if($player["points"] < 30 ){
            $player["card4"] = array_pop($deck);
        }
        if($player["points"] < 30 ){
            $player["card5"] = array_pop($deck);
        }
        if($player["points"] < 30 ){
            $player["card6"] = array_pop($deck);
        }
        
        echo $player["card1"]."<br>";
        echo $player["card2"]."<br>";
        echo $player["card3"]."<br>";
        echo $player["card4"]."<br>";
        echo $player["card5"]."<br>";
        echo $player["card6"]."<br>";
        
        return($player);

    }
    
    function getCardValue($card){
        switch($card){
            //1's
            case '1':
                $cardValue=[1,"AoS"];
                return($cardValue);
                break;
            case '2':
                $cardValue=[1,"AoH"];
                return($cardValue);
                break;
            case '3':
                $cardValue=[1,"AoD"];
                return($cardValue);
                break;
            case '4':
                $cardValue=[1,"AoC"];
                return($cardValue);
                break;
            //2's
            case '5':
                $cardValue=[2,"2oS"];
                return($cardValue);
                break;
            case '6':
                $cardValue=[2,"2oH"];
                return($cardValue);
                break;
            case '7':
                $cardValue=[2,"2oD"];
                return($cardValue);
                break;
            case '8':
                $cardValue=[2,"2oC"];
                return($cardValue);
                break;
            //3's
            case '9':
                $cardValue=[3,"3oS"];
                return($cardValue);
                break;
            case '10':
                $cardValue=[3,"3oH"];
                return($cardValue);
                break;
            case '11':
                $cardValue=[3,"3oD"];
                return($cardValue);
                break;
            case '12':
                $cardValue=[3,"3oC"];
                return($cardValue);
                break;
            //4's
            case '13':
                $cardValue=[4,"4oS"];
                return($cardValue);
                break;
            case '14':
                $cardValue=[4,"4oD"];
                return($cardValue);
                break;
            case '15':
                $cardValue=[4,"4oH"];
                return($cardValue);
                break;
            case '16':
                $cardValue=[4,"4oC"];
                return($cardValue);
                break;
            //5's
            case '17':
                $cardValue=[5,"5oS"];
                return($cardValue);
                break;
            case '18':
                $cardValue=[5,"5oD"];
                return($cardValue);
                break;
            case '19':
                $cardValue=[5,"5oH"];
                return($cardValue);
                break;
            case '20':
                $cardValue=[5,"5oC"];
                return($cardValue);
                break;
            //6's
            case '21':
                $cardValue=[6,"6oS"];
                return($cardValue);
                break;
            case '22':
                $cardValue=[6,"6oD"];
                return($cardValue);
                break;
            case '23':
                $cardValue=[6,"6oH"];
                return($cardValue);
                break;
            case '24':
                $cardValue=[6,"6oC"];
                return($cardValue);
                break;
            //7's
            case '25':
                $cardValue=[7,"7oS"];
                return($cardValue);
                break;
            case '26':
                $cardValue=[7,"7oD"];
                return($cardValue);
                break;
            case '27':
                $cardValue=[7,"7oH"];
                return($cardValue);
                break;
            case '28':
                $cardValue=[7,"7oC"];
                return($cardValue);
                break;
            //8's
            case '29':
                $cardValue=[8,"8oS"];
                return($cardValue);
                break;
            case '30':
                $cardValue=[8,"8oD"];
                return($cardValue);
                break;
            case '31':
                $cardValue=[8,"8oH"];
                return($cardValue);
                break;
            case '32':
                $cardValue=[8,"8oC"];
                return($cardValue);
                break;
            //9's
            case '33':
                $cardValue=[9,"9oS"];
                return($cardValue);
                break;
            case '34':
                $cardValue=[9,"9oD"];
                return($cardValue);
                break;
            case '35':
                $cardValue=[9,"9oH"];
                return($cardValue);
                break;
            case '36':
                $cardValue=[9,"9oC"];
                return($cardValue);
                break;
            //10's
            case '37':
                $cardValue=[10,"10oS"];
                return($cardValue);
                break;
            case '38':
                $cardValue=[10,"10oD"];
                return($cardValue);
                break;
            case '39':
                $cardValue=[10,"10oH"];
                return($cardValue);
                break;
            case '40':
                $cardValue=[10,"10oC"];
                return($cardValue);
                break;
            //Jacks
            case '41':
                $cardValue=[11,"JoS"];
                return($cardValue);
                break;
            case '42':
                $cardValue=[11,"JoD"];
                return($cardValue);
                break;
            case '43':
                $cardValue=[11,"JoH"];
                return($cardValue);
                break;
            case '44':
                $cardValue=[11,"JoC"];
                return($cardValue);
                break;
            //Queens
            case '45':
                $cardValue=[12,"QoS"];
                return($cardValue);
                break;
            case '46':
                $cardValue=[12,"QoD"];
                return($cardValue);
                break;
            case '47':
                $cardValue=[12,"QoH"];
                return($cardValue);
                break;
            case '48':
                $cardValue=[12,"QoC"];
                return($cardValue);
                break;
            //Kings
            case '49':
                $cardValue=[13,"KoS"];
                return($cardValue);
                break;
            case '50':
                $cardValue=[13,"KoD"];
                return($cardValue);
                break;
            case '51':
                $cardValue=[13,"KoH"];
                return($cardValue);
                break;
            case '52':
                $cardValue=[13,"KoC"];
                return($cardValue);
                break;
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