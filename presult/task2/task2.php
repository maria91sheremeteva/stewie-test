<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'task2';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully" . '<br>';

echo '<br><br> Question 1';

$query1 = 'SELECT * FROM `order` AS `o` INNER JOIN `payment` ON o.id = payment.order_id';

echo '<br/>' . $query1;
$res1 = mysqli_query($conn, $query1);

echo '<pre>';
print_r($res1);
echo '</pre>';
while ($row = $res1->fetch_assoc()) {
    echo '<pre>';
    print_r($row);
    echo '</pre>';
}




echo '<br><br><br>Question 2';

$query2 = 'SELECT SUM(price) FROM product_item INNER JOIN order_item AS item ON'
        . ' product_item.order_item_id = item.id'
        . ' INNER JOIN `order` AS `o` ON item.order_id = o.id'
        . ' WHERE o.status="done" AND MONTH(o.finish_date) = 1 AND YEAR(o.finish_date) = 2017'
        . ' AND product_item.status = "order"';


echo '<br/>' . $query2;
$res2 = mysqli_query($conn, $query2);

echo '<pre>';
print_r($res2);
echo '</pre>';

echo '<pre>';
print_r($res2->fetch_assoc());
echo '</pre>';



echo '<br/><br/><br/> Question 3';

$query3 = 'SELECT product_id FROM `order_item` INNER JOIN `order` AS `o` ON o.id = order_item.order_id'
        . ' WHERE o.status="new" AND order_item.product_id NOT IN (SELECT product_id FROM `product_item` AS `pri` '
        . ' WHERE pri.status="free"  AND pri.order_item_id=0)';


echo '<br>' . $query3;
$res3 = mysqli_query($conn, $query3);

echo '<pre>';
print_r($res3);
echo '</pre>';

echo 'Количество недостающих товаров = '.$res3->num_rows;

while ($row = $res3->fetch_assoc()) {
    echo '<pre>';
    print_r($row);
    echo '</pre>';
}


