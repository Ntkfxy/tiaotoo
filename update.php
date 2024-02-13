<?php
echo 'hello ' . $_POST['F_ID'];
if (isset($_POST['F_ID'])) {
    require 'connect.php';

    // $F_ID = $_POST['F_ID'];
    // $foodname =  $_POST['foodname'];
    // $price = $_POST['price'];
    // $menuID = $_POST['menuID'];

    // echo 'F_ID = ' . $F_ID;
    // echo 'foodname = ' . $foodname;
    // echo 'price = ' . $price;
    // echo 'menuID = ' . $menuID;



    // $stmt = $conn->prepare("UPDATE  Customer SET Name=:Name, Email=:Email WHERE CustomerID=:CustomerID");
    $sql = "UPDATE food
            SET 
           foodname=:foodname,
           price =:price,
           M_ID = :menuID
            WHERE F_ID=:F_ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':F_ID', $_POST['F_ID']);
    $stmt->bindParam(':foodname', $_POST['foodname']);
    $stmt->bindParam(':price', $_POST['price']);
    $stmt->bindParam(':menuID', $_POST['menuID']);

    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->execute()) {
        echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly update food information",
                type: "success",
                timer: 2500,
                showConfirmButton: false
              }, function(){
                    window.location.href = "index.php";
              });
        });
        
        </script>
        ';
    }
    $conn = null;
}
