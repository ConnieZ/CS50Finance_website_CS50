<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //lookup the stock value submitted to see if it's valid
        $stock = lookup($_POST["stockSymbol"]);
        
        // validate the user provided valid symbol and shares quantity
        if($stock === false) { 
            apologize("This stock symbol isn't valid.");
        }
        else {
            if (preg_match("/^\d+$/", $_POST["numShares"])) {
                if($stock["price"]*$_POST["numShares"] <= query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"])[0]["cash"])
                    {
                        //add the shares to portfolio
                        $addedShares = query("INSERT INTO stocks (userID, symbol, numShares) VALUES(?, ?, ?) 
                                ON DUPLICATE KEY UPDATE numShares = numShares + VALUES(numShares)", $_SESSION["id"], 
                                strtoupper($_POST["stockSymbol"]), $_POST["numShares"]);
                        //decrease cash
                        $cashUpdate = query("UPDATE users SET cash = cash - ? WHERE id = ?", 
                            $stock["price"]*$_POST["numShares"], $_SESSION["id"]);
                        //log the transaction
                        $addTransaction = query("INSERT INTO transactions (userID, type, symbol, shares, price) VALUES(?, ?, ?, 
                                ?, ?)", $_SESSION["id"], "BUY", strtoupper($_POST["stockSymbol"]), $_POST["numShares"], $stock["price"]);
                        //redirect home
                        redirect("/");
                    }
                else {
                    apologize("You don't have enough cash."); 
                }
            }
            else {
                apologize("This is not a valid number of shares.");
            }
        }
    }
     
    else
    {
        // else render form
        render("buy_form.php", ["title" => "Buy Stock"]);
    }

?>
