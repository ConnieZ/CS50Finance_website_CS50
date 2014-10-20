<div class="span12 text-center">
            <ul class="nav nav-pills center-pills">
                <li><a href="quote.php">Quote</a></li>
                <li><a href="buy.php">Buy</a></li>
                <li><a href="sell.php">Sell</a></li>
                <li><a href="deposit.php">Deosit Funds</a></li>
                <li><a href="history.php">History</a></li>
                <li><a href="logout.php"><strong>Log Out</strong></a></li>
            </ul>
</div>
<div>
    <?php
    // return the gained cash
    print("Congratulations! You sold " . $numShares . " shares of " . $symbol . " stock." .
            "You gained $" . number_format($gainedCash, 2) . ".");
     ?>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>

