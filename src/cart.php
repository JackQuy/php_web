<?php
session_start();
if(isset($_GET['id'])) {
    require_once('./database.php');
    $db = new Dbh();
    $connect = null;
    $text = null;
    try {
        $connect = $db->connect();
    } catch (PDOException $e) {
        echo "error";
    }
    if(!is_null($connect)) {
        $text = $db->selectAllProduct($connect, "tbl_product");
    }

$idProduct = $_GET['id'];
    $newProduct = array();
    if (!is_null($text)) {
        foreach($text as $val) {
            $newProduct[$val['id']] = $val;
        }
    }
    $check = true;
    if(!empty($newProduct) && !empty($_POST)) {
        $newProduct[$idProduct]['size'] = $_POST['size'];
        $newProduct[$idProduct]['color'] = $_POST['color'];
        $newProduct[$idProduct]['qty'] = $_POST['number'];
        if(!empty($_SESSION['cart'])) {
            $i = 0;
            // echo $_GET['id'];
            // echo "<pre>";
            // print_r($_SESSION);
            // print_r($newProduct);
            // echo "</pre>";
            foreach($_SESSION['cart'] as $val) {
                if(empty(array_diff($val, $newProduct[$idProduct]))) {
                    if($_SESSION['cart'][$idProduct]['qty'] < $text[$idProduct - 1]['quantity']) {
                        $_SESSION['cart'][$i]['qty'] += 1;
                    }
                    $check = false;
                    break;
                }
                $i++;
            }
            
        }
        if($check) {
            
            $_SESSION['cart'][] = $newProduct[$idProduct];
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list cart</title>
    <link rel="stylesheet" href="../public/style_cart.css">
</head>
<body>
<h1>Thông tin giỏ hàng</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Màu sắc</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Số tiền</th>
                <th>Lựa chọn</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            if(isset($_SESSION['cart'])) {
                $temp = 1;
                $total = 0;
                foreach($_SESSION['cart'] as $key => $cart) {
        ?>
            <tr>
                <td><?php echo $temp ?></td>
                <td><?php echo $cart['id'] ?></td>
                <td><?php echo $cart['title'] ?></td>
                <td><?php echo $cart['color'] ?></td>
                <td><?php echo $cart['size'] ?></td>
                <td><?php echo $cart['qty'] ?></td>
                <td><?php echo number_format($cart['price'] * $cart['qty']) ?></td>
                <td><a href="../delete.php?id=<?php echo $key ?>" class="delete" >Delete</a></td>
            </tr>
        <?php
                $temp++;
                $total += ($cart['price'] * $cart['qty']);
                }
                ?>
            <tr>
                <td colspan="6"> Tổng thanh toán </td>
                <td><?php echo number_format($total) ?></td>
                <td></td>
            </tr>
                <?php
            }
        ?>
            
        </tbody>
    </table>
</body>
</html>

<?php
} else {
    header("Location: ../index.php");
}
