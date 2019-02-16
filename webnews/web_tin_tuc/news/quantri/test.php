<?php
/*session_start();
require_once "../class/quantritin.php";
$qt = new quantritin();
if($_POST) {
    $u = trim($_POST['username']);
    $p = trim($_POST['password']);
    $kq = $qt->thongtinuser($u, $p);
    echo $kq."<br>";
    var_dump($kq);
    if($kq) {
        $_SESSION['login_id'] = $kq['idUser'];
        $_SESSION['login_user'] = $kq['Username'];
        $_SESSION['login_level'] = $kq['idGroup'];
        $_SESSION['login_hoten'] = $kq['HoTen'];
        $_SESSION['login_email'] = $kq['Email'];
        $test = $_SESSION['back'];
        $ses = $_SESSION;
        //echo $test;
        var_dump($ses);
        //header("location: $test");
        if(strlen($_SESSION['back']) > 0) {
            $back = $_SESSION['back'];
            unset($_SESSION['back']);
            header("location: $back");
        } else header('location: index.php');
    }
    else echo "Thất bại";
}*/
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <?php
    include_once "../quantri/tin_them.php.php";
    $idTL = $_POST['TieuDe'];
    var_dump($idTL);
    echo "Hello: ".$idTL;
    ?>
</div>
</body>
</html>