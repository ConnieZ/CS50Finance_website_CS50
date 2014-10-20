<?php

    // configuration
    require("../includes/config.php");
    
    //create an empty array to display to the user the stock they own before they start selling
    $positions = array();
    //lookup all user's stock
        $queryResult = query("SELECT * FROM stocks WHERE userID = ?", $_SESSION["id"]);
        //validate there's shares owned
        if ($queryResult !== false) {
            //fill in the positions array
            foreach ($queryResult as $row)
            {  
                $stock = lookup($row["symbol"]);
                if ($stock !== false)
                {
                    $positions[] = [
                        "name" => $stock["name"],
                        "price" => number_format($stock["price"], 2),
                        "shares" => $row["numShares"],
                        "symbol" => $row["symbol"],
                        "cash" => number_format(query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"])[0]["cash"], 2)
                    ];
                }
            }
        } else {
            $positions[] = [
                        "name" => "none",
                        "price" => "none",
                        "shares" => "none",
                        "symbol" => "none",
                        "cash" => "none"
                    ];
        }

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //lookup the stock value in user's portfolio to see if it's valid
        $userStock = query("SELECT * FROM stocks WHERE userID = ? AND symbol = ?", $_SESSION["id"], $_POST["stockSymbol"]);
        
        // validate the user has that particular stock
        if($userStock === false) {
            apologize("You don't own any shares of that stock.");
        }
        else {
            //delete the stock 
            $deleteResult = query("DELETE FROM stocks WHERE userID = ? AND symbol = ?", $_SESSION["id"], $_POST["stockSymbol"]);
            
            //get the price
            $stockPrice = lookup($_POST["stockSymbol"]);
            //update cash value
            $cashUpdate = query("UPDATE users SET cash = cash + ? WHERE id = ?", 
                        $userStock[0]["numShares"]*$stockPrice["price"], $_SESSION["id"]);
            //log the transaction
            $addTransaction = query("INSERT INTO transactions (userID, type, symbol, shares, price) VALUES(?, ?, ?, 
                                ?, ?)", $_SESSION["id"], "SELL", strtoupper($_POST["stockSymbol"]), $userStock[0]["numShares"], $stockPrice["price"]);
            // redirect user
            render("sold_form.php", ["title" => "Sold Stock",  
                    "gainedCash" => $userStock[0]["numShares"]*$stockPrice["price"], 
                    "symbol" => $_POST["stockSymbol"], "numShares" => $userStock[0]["numShares"]]);
            }
        }
    
    else
    {
        // else render form
        render("sell_form.php", ["title" => "Sell Stock", "allUserStock" => $positions]);
    }

?>
