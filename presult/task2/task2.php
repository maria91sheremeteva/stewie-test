<?php

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = 'test_db';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully" . '<br>';

echo '<br><br> Question 1';

$query1 = 'SELECT SUM(summa) FROM payment';

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

$query2 = 'SELECT * FROM product_item INNER JOIN order_item AS item ON'
        . ' product_item.order_item_id = item.id'
        . ' INNER JOIN `order` AS `o` ON item.order_id = o.id'
        . ' WHERE o.status="done" AND MONTH(o.finish_date) = 1 AND YEAR(o.finish_date) = 2017'
        . ' AND product_item.status = "order"';


echo '<br/>' . $query2;
$res2 = mysqli_query($conn, $query2);

echo '<pre>';
print_r($res2);
echo '</pre>';

$summ = 0;

while ($row = $res2->fetch_assoc()) {
    $summ += $row['price'];
    echo '<pre>';
    var_dump($row['price'], $row['product_id']);
    echo '</pre>';
}

printf($summ);


echo '<br/><br/><br/> Question 3';

$query3_1 = 'SELECT product_id FROM `order_item` INNER JOIN `order` AS `o` ON o.id = order_item.order_id'
        . ' WHERE status="new"';

echo '<br>' . $query3_1;
$res3_1 = mysqli_query($conn, $query3_1);


$order_ids = [];
while ($row = $res3_1->fetch_assoc()) {
    array_push($order_ids, $row['product_id']);
}


echo '<br>';
echo '<br>';
echo 'product ids in order_item table <pre>';
print_r($order_ids);
echo '</pre>';


$query3_2 = 'SELECT product_id FROM `product_item` WHERE STATUS="free"  AND order_item_id = "0"';
echo $query3_2 . '<br>';
$res3_2 = mysqli_query($conn, $query3_2);
$product_ids = [];
while ($row = $res3_2->fetch_assoc()) {
    array_push($product_ids, $row['product_id']);
}

echo 'Product Ids in product item table <pre>';
print_r($product_ids);
echo '</pre>';


$pr_ids = array_diff($order_ids, $product_ids);

echo 'id продуктов которые отсутсвуют на складе <pre>';
print_r($pr_ids);
echo '</pre>';