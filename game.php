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

<?php   
    
    function main(){
        $deck = array();
        $deck = createDeck($deck);
        //an array that contains whether the corresponding player is a winner.
        $winningPlayers = [0,0,0,0];
        
        $player1 = ["imageName" => "",
                    "name" => $_POST["p1"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null,
                    "points" => 0,
                    "popCount" => 0,
                    "winner" => null];
                
        $player2 = ["imageName" => "",
                    "name" => $_POST["p2"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null,
                    "points" => 0,
                    "popCount" => 0,
                    "winner" => null];
                    
        $player3 = ["imageName" => "",
                    "name" => $_POST["p3"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null,
                    "points" => 0,
                    "popCount" => 0,
                    "winner" => null];
                    
        $player4 = ["imageName" => "",
                    "name" => $_POST["p4"],
                    "card1" => null,
                    "card2" => null,
                    "card3" => null,
                    "card4" => null,
                    "card5" => null,
                    "card6" => null,
                    "points" => 0,
                    "popCount" => 0,
                    "winner" => null];
        
        //Deal cards
        $player1 = dealCards($player1, $deck);
        for($i = 0; $i < $player1["popCount"]; $i++){
            array_pop($deck);
        }
        
        $player2 = dealCards($player2, $deck);
        for($i = 0; $i < $player2["popCount"]; $i++){
            array_pop($deck);
        }
       
        $player3 = dealCards($player3, $deck);
        for($i = 0; $i < $player3["popCount"]; $i++){
            array_pop($deck);
        }
       
        $player4 = dealCards($player4, $deck);
        for($i = 0; $i < $player4["popCount"]; $i++){
            array_pop($deck);
        }
        
        //Check for winner
        //this will return an array containing winners.
        //For instance, winners will have: 1; losers: 0.
        $winningPlayers = checkWin($player1["points"],$player2["points"],$player3["points"],$player4["points"]);
        printTable($player1, $player2, $player3, $player4, $winningPlayers);
        //****Print this shit out*********************************************
    } // End main
    
    //**************************************************************************
    //**************************************************************************
    //*******************************functions**********************************
    //**************************************************************************
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
        global $points;
        //algorithm checks a person's hand before dealing more cards
        $temp = array();
        
        if($player["points"] < 35 ){
            $player["card1"] = array_pop($deck);
            $temp = getCardValue($player["card1"]);
            $player["points"] += $temp[0];
            $player["popCount"]++;
        }

        if($player["points"] < 35 ){
            $player["card2"] = array_pop($deck);
            $temp = getCardValue($player["card2"]);
            $player["points"] += $temp[0];
            $player["popCount"]++;
        }
        if($player["points"] < 35 ){
            $player["card3"] = array_pop($deck);
            $temp = getCardValue($player["card3"]);
            $player["points"] += $temp[0];
            $player["popCount"]++;
        }
        if($player["points"] < 35 ){
            $player["card4"] = array_pop($deck);
            $temp = getCardValue($player["card4"]);
            $player["points"] += $temp[0];
            $player["popCount"]++;
        }
        if($player["points"] < 35 ){
            $player["card5"] = array_pop($deck);
            $temp = getCardValue($player["card5"]);
            $player["points"] += $temp[0];
            $player["popCount"]++;
        }
        if($player["points"] < 35 ){
            $player["card6"] = array_pop($deck);
            $temp = getCardValue($player["card6"]);
            $player["points"] += $temp[0];
            $player["popCount"]++;
        }
        
        $points = $player["points"]; // Points that player gets
        
        return($player);

    }
    function checkWin($p1,$p2,$p3,$p4){
        $points = [$p1,$p2,$p3,$p4];
        $max = 0;
        $winners=[0,0,0,0];
        
        for ($i=0; $i< 4; $i++){
            if ($points[$i] <= 42 && $points[$i]>=$max){
                if($points[$i]==$max){
                    $winners[$i] = 1;
                }
                else{
                    //set new max
                    $max = $points[$i];
                    $winners = [0,0,0,0];
                    $winners[$i] = 1;
                }
            }
        }
        return $winners;
    }
    
    //this function will print the table;
    function printTable($player1, $player2, $player3, $player4, $winningTables){
        
        //temp array to hold cards for printing
        //temp[0] holds point value, temp[2] holds the url for the image
        $temp = array();
        $player1["winner"] = $winningTables[0];
        $player2["winner"] = $winningTables[1];
        $player3["winner"] = $winningTables[2];
        $player4["winner"] = $winningTables[3];
            //display table
            
            
        echo '<div>';
        echo '<table border ="1" class="gameTable">';
            //header row
            echo '<tr>';
                echo '<td> Players </td>';
                echo '<td> Card 1 </td>';
                echo '<td> Card 2 </td>';
                echo '<td> Card 3 </td>';
                echo '<td> Card 4 </td>';
                echo '<td> Card 5 </td>';
                echo '<td> Card 6 </td>';
                echo '<td> Total </td>';
                echo '<td> Winner </td>';
            echo '</tr>';
            //first player
            echo '<tr>';
                echo '<td>';
                echo "<img width = 75 src = 'assets/faces/bulldog.jpg' />";
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player1["card1"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player1["card2"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player1["card2"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player1["card3"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player1["card4"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player1["card5"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player1["card6"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                if($player1["winner"] == 1){
                    echo "Winner";
                }
                else{
                    echo "Loser";
                }
                echo '</td>';
            echo '</tr>'; // end first player
            
            //second player
            echo '<tr>';
                echo '<td>';
                echo "<img width = 75 src = 'assets/faces/chihua.jpg' />";
                
                echo '<td>';
                $temp = getCardValue($player2["card1"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player2["card2"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player2["card2"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player2["card3"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player2["card4"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player2["card5"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player2["card6"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                if($player2["winner"] == 1){
                    echo "Winner";
                }
                else{
                    echo "Loser";
                }
                echo '</td>';
            echo '</tr>'; // end second player
            
            //third player
            echo '<tr>';
                echo '<td>';
                echo "<img width = 75 src = 'assets/faces/GSD.jpg' />";
                
                echo '<td>';
                $temp = getCardValue($player3["card1"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player3["card2"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player3["card2"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player3["card3"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player3["card4"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player3["card5"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player3["card6"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                if($player3["winner"] == 1){
                    echo "Winner";
                }
                else{
                    echo "Loser";
                }
                echo '</td>';
            echo '</tr>'; // end third player
            
            //fourth player
            echo '<tr>';
                echo '<td>';
                echo "<img width = 75 src = 'assets/faces/lab.jpg' />";
                
                echo '<td>';
                $temp = getCardValue($player4["card1"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player4["card2"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player4["card2"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player4["card3"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player4["card4"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player4["card5"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                $temp = getCardValue($player4["card6"]);
                echo $temp[2];
                echo '</td>';
                
                echo '<td>';
                if($player4["winner"] == 1){
                    echo "Winner";
                }
                else{
                    echo "Loser";
                }
                echo '</td>';
            echo '</tr>'; // end fourth player
        echo '</table>';
        echo '</div>';

    }
    
    
    
    function getCardValue($card){
        switch($card){
            //1's
            case '1':
                $cardValue=[1,"AoS","<img width = 75 src = 'assets/cards/spades/1.png' />"];
                return($cardValue);
                break;
            case 2:
                $cardValue=[1,"AoH"];
                return($cardValue);
                break;
            case 2:
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

?>
