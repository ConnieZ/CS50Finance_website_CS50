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
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Symbol</th>
                <th>Shares</th>
                <th>Price</th>
                <th>Cash</th>
            </tr>
        </thead>
        <tbody>
        <?php
            //validate that positions is not an empty array
            if (empty($positions)) {
                print("No shares owned.");
                print("Your id is: ". $id);
            }
            else {
                foreach ($positions as $position)
                {
                    print("<tr>");
                    print("<td>" . $position["symbol"] . "</td>");
                    print("<td>" . $position["shares"] . "</td>");
                    print("<td>" . "$" . $position["price"] . "</td>");
                    print("<td>" . "$" . $position["cash"] . "</td>");
                    print("</tr>");
                }
            }
            

        ?>
        </tbody>
    </table>
</div>

