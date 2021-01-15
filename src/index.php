<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Exercise PHP</title>
        <link rel="stylesheet" href="public/style.css">
    </head>
    <body>
    <h1>Sắm tết đi nồ!</h1>
<?php
// echo "hello";
require_once('./database.php');
$db = new Dbh();
$connect = null;
try {
    // 
    $connect = $db->connect();
    // if($connect) {
    //     echo "da ket noi thanh cong";
    // } else {
    //     echo "chua ket noi dc";
    // }
    
} catch (PDOException $e) {
    echo "error";
}
if(!is_null($connect)) {
    $text = $db->selectAllProduct($connect, "tbl_product");
    ?>
<div class="list_product">
    <?php
    foreach($text as $key => $val) {
?>
    <div class="product">
        <a href="infoCart.php/?id=<?php echo $key ?>" class="info_product">
            <img src= "<?php echo $val["image"]; ?> " alt="">
            <h1><?php echo $val["title"]; ?></h1>
            <p class="price"><?php echo number_format($val["price"]) . " đ"; ?></p>
            <!-- <div> -->
                <a href="" class="btn">Mua ngay</a>
            <!-- </div> -->
            
        </a>
    </div>


<?php
    }
}
?>
        </div>
    </body>
</html>
