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
                <th>Transaction</th>
                <th>Symbol</th>
                <th>Shares</th>
                <th>Price</th>
                <th>Date/Time</th>
            </tr>
        </thead>
        <tbody>
        <?php
            //validate that positions is not an empty array
            if (empty($positions)) {
                print("No transactions available");
                
            }
            else {
                foreach ($positions as $position)
                {
                    print("<tr>");
                    print("<td>" . $position["Transaction"] . "</td>");
                    print("<td>" . $position["Symbol"] . "</td>");
                    print("<td>" . $position["Shares"] . "</td>");
                    print("<td>" . "$". $position["Price"] . "</td>");
                    print("<td>" . $position["Date/Time"] . "</td>");
                    print("</tr>");
                }
            }
            

        ?>
        </tbody>
    </table>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
