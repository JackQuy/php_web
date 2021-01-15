<?php
session_start();
if(isset($_GET['id'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>infoCart</title>
    <!-- <link rel="stylesheet" href="./public/style_infoCart.css"> -->
    <link rel="stylesheet" href="../public/style_infoCart.css">
</head>
<body>
<h1>Thông tin sản phẩm</h1>
<?php

    require_once('./database.php');
    $db = new Dbh();
    $connect = null;
    try {
        $connect = $db->connect();
    } catch (PDOException $e) {
        echo "error";
    }
    if(!is_null($connect)) {
        $text = $db->selectAllProduct($connect, "tbl_product");
        ?>
        <div class="list_product">
            <?php
            // foreach($text as $val) {
            //     if($val['id'] == $_GET['id']) {
        ?>
            <div class="product">
                <img src= "<?php echo $text[$_GET['id']]["image"]; ?> " alt="">
                <div class="content">
                    <h3><?php echo $text[$_GET['id']]["content"]; ?></h3>
                    <p class="price"><?php echo number_format($text[$_GET['id']]["price"]) . " đ"; ?></p>
                    <form action="../cart.php?id=<?php echo $_GET['id'] ?>" method="post">
                        <h3>Nhóm màu: </h3>
                        <div class="color">
                            <div>
                                <label for="red">red </label>
                                <input type="radio" name="color" id="red" value="red" checked>
                            </div>
                            <div>
                                <label for="yellow">yellow </label>
                                <input type="radio" name="color" id="yellow" value="yellow">
                            </div>
                            <div>
                                <label for="green">green </label>
                                <input type="radio" name="color" id="green" value="green">
                            </div>
                            <div>
                                <label for="black">black </label>
                                <input type="radio" name="color" id="black" value="black">
                            </div>
                            <div>
                                <label for="white">white </label>
                                <input type="radio" name="color" id="white" value="white">
                            </div>
                        </div>
                        <h3>Kích thước: </h3>
                        <?php if($_GET['id'] != 2) {?>
                        <div class="size">
                            <div>
                                <label for="S">S </label>
                                <input type="radio" name="size" id="S" value="S" checked>
                            </div>
                            <div>
                                <label for="M">M </label>
                                <input type="radio" name="size" id="M" value="M">
                            </div>
                            <div>
                                <label for="L">L </label>
                                <input type="radio" name="size" id="L" value="L">
                            </div>
                            <div>
                                <label for="XL">XL </label>
                                <input type="radio" name="size" id="XL" value="XL">
                            </div>
                            <div>
                                <label for="XXL">XXL </label>
                                <input type="radio" name="size" id="XXL" value="XXL">
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="size">
                            <div>
                                <label for="38">38 </label>
                                <input type="radio" name="size" id="38" value="38" checked>
                            </div>
                            <div>
                                <label for="39">39 </label>
                                <input type="radio" name="size" id="39" value="39">
                            </div>
                            <div>
                                <label for="40">40 </label>
                                <input type="radio" name="size" id="40" value="40">
                            </div>
                            <div>
                                <label for="41">41 </label>
                                <input type="radio" name="size" id="41" value="41">
                            </div>
                            <div>
                                <label for="42">42 </label>
                                <input type="radio" name="size" id="42" value="42">
                            </div>
                        </div>
                        <?php } $number = $text[$_GET['id']]['quantity']; ?>
                        <div class="number">
                            <h3>Số lượng: </h3>
                            <input type="number" name="number" id="" min="1" max="<?php echo $number ?>" step="1" value="1">
                            <?php 
                                if($number < 20) {
                                    echo "<p style='display:inline; font-size: 16px;'> Số lượng chỉ còn {$number} sản phẩm</p>";
                                }
                            ?>
                        </div>
                        <div class="list_btn">
                        <a href="" class="btn_1">Mua ngay</a>
                        <!-- <a href="../cart.php?id=<?php //echo $_GET['id'] ?>" class="btn_2">Thêm vào giỏ hàng</a> -->
                        <button class="btn_2" onclick="Info()"  type="submit">Thêm vào giỏ hàng</button>
                    </div>
                    </form>
                    
                </div>
                
                    
            </div>
        
        
        <?php
            //     }
            // }
        ?>

<?php
    }

?>
</body>
<script>
    function Info() {
        Window.location = "../cart.php?id=<?php echo $_GET['id'] ?>";
    }
</script>
</html>
<?php
} else {
    header("Location: ../index.php");
}