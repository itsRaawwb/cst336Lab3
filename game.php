<!DOCTYPE html>
<html>
    <head>
        <title>Play Some Silverjack!</title>
        <link rel="shortcut icon" href="https://csumb.edu/sites/default/files/pixelotter.png" type="image/png">
        <link rel="stylesheet" type="css" href="css/main.css">
    </head>
    <body class = "b2">
        <h1>Silverjack</h1>
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
        <footer>
        <HR WIDTH="80%" NOSHADE>
        This site is for the purpose of CST 336. The information may not be accurate.
        <br>2016
        <br>
        <img src="assets/csumb.png" height="50" />
    </footer>
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
            
        echo '<center>';
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
                echo $player1["points"];
                echo '</td>';
                
                echo '<td>';
                if($player1["winner"] == 1){
                    echo "Winner: ". $player1["name"];
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
                echo $player2["points"];
                echo '</td>';
                
                echo '<td>';
                if($player2["winner"] == 1){
                    echo "Winner: ". $player2["name"];
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
                echo $player3["points"];
                echo '</td>';
                
                echo '<td>';
                if($player3["winner"] == 1){
                    echo "Winner: ". $player3["name"];
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
                echo $player4["points"];
                echo '</td>';
                
                echo '<td>';
                if($player4["winner"] == 1){
                    echo "Winner: ". $player4["name"];
                }
                else{
                    echo "Loser";
                }
                echo '</td>';
            echo '</tr>'; // end fourth player
        echo '</table>';
        echo '</div>';
        echo '</center>';

    }
    
    
    
    function getCardValue($card){
        switch($card){
            //1's
            case '1':
                $cardValue=[1,"AoS","<img width = 75 src = 'assets/cards/spades/1.png' />"];
                return($cardValue);
                break;
            case 2:
                $cardValue=[1,"AoH","<img width = 75 src = 'assets/cards/hearts/1.png' />"];
                return($cardValue);
                break;
            case 2:
                $cardValue=[1,"AoD","<img width = 75 src = 'assets/cards/diamonds/1.png' />"];
                return($cardValue);
                break;
            case '4':
                $cardValue=[1,"AoC","<img width = 75 src = 'assets/cards/clubs/1.png' />"];
                return($cardValue);
                break;
            //2's
            case '5':
                $cardValue=[2,"2oS","<img width = 75 src = 'assets/cards/spades/2.png' />"];
                return($cardValue);
                break;
            case '6':
                $cardValue=[2,"2oH","<img width = 75 src = 'assets/cards/hearts/2.png' />"];
                return($cardValue);
                break;
            case '7':
                $cardValue=[2,"2oD","<img width = 75 src = 'assets/cards/diamonds/2.png' />"];
                return($cardValue);
                break;
            case '8':
                $cardValue=[2,"2oC","<img width = 75 src = 'assets/cards/clubs/2.png' />"];
                return($cardValue);
                break;
            //3's
            case '9':
                $cardValue=[3,"3oS","<img width = 75 src = 'assets/cards/spades/3.png' />"];
                return($cardValue);
                break;
            case '10':
                $cardValue=[3,"3oH","<img width = 75 src = 'assets/cards/hearts/3.png' />"];
                return($cardValue);
                break;
            case '11':
                $cardValue=[3,"3oD","<img width = 75 src = 'assets/cards/diamonds/3.png' />"];
                return($cardValue);
                break;
            case '12':
                $cardValue=[3,"3oC","<img width = 75 src = 'assets/cards/clubs/3.png' />"];
                return($cardValue);
                break;
            //4's
            case '13':
                $cardValue=[4,"4oS","<img width = 75 src = 'assets/cards/spades/4.png' />"];
                return($cardValue);
                break;
            case '14':
                $cardValue=[4,"4oD","<img width = 75 src = 'assets/cards/diamonds/4.png' />"];
                return($cardValue);
                break;
            case '15':
                $cardValue=[4,"4oH","<img width = 75 src = 'assets/cards/hearts/4.png' />"];
                return($cardValue);
                break;
            case '16':
                $cardValue=[4,"4oC","<img width = 75 src = 'assets/cards/clubs/4.png' />"];
                return($cardValue);
                break;
            //5's
            case '17':
                $cardValue=[5,"5oS","<img width = 75 src = 'assets/cards/spades/5.png' />"];
                return($cardValue);
                break;
            case '18':
                $cardValue=[5,"5oD","<img width = 75 src = 'assets/cards/diamonds/5.png' />"];
                return($cardValue);
                break;
            case '19':
                $cardValue=[5,"5oH","<img width = 75 src = 'assets/cards/hearts/5.png' />"];
                return($cardValue);
                break;
            case '20':
                $cardValue=[5,"5oC","<img width = 75 src = 'assets/cards/clubs/5.png' />"];
                return($cardValue);
                break;
            //6's
            case '21':
                $cardValue=[6,"6oS","<img width = 75 src = 'assets/cards/spades/6.png' />"];
                return($cardValue);
                break;
            case '22':
                $cardValue=[6,"6oD","<img width = 75 src = 'assets/cards/diamonds/6.png' />"];
                return($cardValue);
                break;
            case '23':
                $cardValue=[6,"6oH","<img width = 75 src = 'assets/cards/hearts/6.png' />"];
                return($cardValue);
                break;
            case '24':
                $cardValue=[6,"6oC","<img width = 75 src = 'assets/cards/clubs/6.png' />"];
                return($cardValue);
                break;
            //7's
            case '25':
                $cardValue=[7,"7oS","<img width = 75 src = 'assets/cards/spades/7.png' />"];
                return($cardValue);
                break;
            case '26':
                $cardValue=[7,"7oD","<img width = 75 src = 'assets/cards/diamonds/7.png' />"];
                return($cardValue);
                break;
            case '27':
                $cardValue=[7,"7oH","<img width = 75 src = 'assets/cards/hearts/7.png' />"];
                return($cardValue);
                break;
            case '28':
                $cardValue=[7,"7oC","<img width = 75 src = 'assets/cards/clubs/7.png' />"];
                return($cardValue);
                break;
            //8's
            case '29':
                $cardValue=[8,"8oS","<img width = 75 src = 'assets/cards/spades/8.png' />"];
                return($cardValue);
                break;
            case '30':
                $cardValue=[8,"8oD","<img width = 75 src = 'assets/cards/diamonds/8.png' />"];
                return($cardValue);
                break;
            case '31':
                $cardValue=[8,"8oH","<img width = 75 src = 'assets/cards/hearts/8.png' />"];
                return($cardValue);
                break;
            case '32':
                $cardValue=[8,"8oC","<img width = 75 src = 'assets/cards/clubs/8.png' />"];
                return($cardValue);
                break;
            //9's
            case '33':
                $cardValue=[9,"9oS","<img width = 75 src = 'assets/cards/spades/9.png' />"];
                return($cardValue);
                break;
            case '34':
                $cardValue=[9,"9oD","<img width = 75 src = 'assets/cards/diamonds/9.png' />"];
                return($cardValue);
                break;
            case '35':
                $cardValue=[9,"9oH","<img width = 75 src = 'assets/cards/hearts/9.png' />"];
                return($cardValue);
                break;
            case '36':
                $cardValue=[9,"9oC","<img width = 75 src = 'assets/cards/clubs/9.png' />"];
                return($cardValue);
                break;
            //10's
            case '37':
                $cardValue=[10,"10oS","<img width = 75 src = 'assets/cards/spades/10.png' />"];
                return($cardValue);
                break;
            case '38':
                $cardValue=[10,"10oD","<img width = 75 src = 'assets/cards/diamonds/10.png' />"];
                return($cardValue);
                break;
            case '39':
                $cardValue=[10,"10oH","<img width = 75 src = 'assets/cards/hearts/10.png' />"];
                return($cardValue);
                break;
            case '40':
                $cardValue=[10,"10oC","<img width = 75 src = 'assets/cards/clubs/10.png' />"];
                return($cardValue);
                break;
            //Jacks
            case '41':
                $cardValue=[11,"JoS","<img width = 75 src = 'assets/cards/spades/11.png' />"];
                return($cardValue);
                break;
            case '42':
                $cardValue=[11,"JoD","<img width = 75 src = 'assets/cards/diamonds/11.png' />"];
                return($cardValue);
                break;
            case '43':
                $cardValue=[11,"JoH","<img width = 75 src = 'assets/cards/hearts/11.png' />"];
                return($cardValue);
                break;
            case '44':
                $cardValue=[11,"JoC","<img width = 75 src = 'assets/cards/clubs/11.png' />"];
                return($cardValue);
                break;
            //Queens
            case '45':
                $cardValue=[12,"QoS","<img width = 75 src = 'assets/cards/spades/12.png' />"];
                return($cardValue);
                break;
            case '46':
                $cardValue=[12,"QoD","<img width = 75 src = 'assets/cards/diamonds/12.png' />"];
                return($cardValue);
                break;
            case '47':
                $cardValue=[12,"QoH","<img width = 75 src = 'assets/cards/hearts/12.png' />"];
                return($cardValue);
                break;
            case '48':
                $cardValue=[12,"QoC","<img width = 75 src = 'assets/cards/clubs/12.png' />"];
                return($cardValue);
                break;
            //Kings
            case '49':
                $cardValue=[13,"KoS","<img width = 75 src = 'assets/cards/spades/13.png' />"];
                return($cardValue);
                break;
            case '50':
                $cardValue=[13,"KoD","<img width = 75 src = 'assets/cards/diamonds/13.png' />"];
                return($cardValue);
                break;
            case '51':
                $cardValue=[13,"KoH","<img width = 75 src = 'assets/cards/hearts/13.png' />"];
                return($cardValue);
                break;
            case '52':
                $cardValue=[13,"KoC","<img width = 75 src = 'assets/cards/clubs/13.png' />"];
                return($cardValue);
                break;
        }
    }

?>
