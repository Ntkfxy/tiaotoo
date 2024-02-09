<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <title>Update customer </title>
</head>

<body>

  <?php
  require 'connect.php';

  $sql_select = 'SELECT * FROM menu ORDER BY menuID';
  $stmt_s = $conn->prepare($sql_select);
  $stmt_s->execute();
  // echo "CustomerID = " . $_GET['CustomerID'];

  if (isset($_GET['F_ID'])) {
    $sql_select_food = 'SELECT * FROM food WHERE F_ID=:F_ID';
    $stmt_c = $conn->prepare($sql_select_food);
    $stmt_c->bindParam(':F_ID', $_GET['F_ID']);
    $stmt_c->execute();
    echo "get = " . $_GET['F_ID'];
    $result_c = $stmt_c->fetch(PDO::FETCH_ASSOC);
  }
  ?>


  <div class="container">
    <div class="row">
      <div class="col-md-4"> <br>
        <h3>ฟอร์มแก้ไขข้อมูลลูกค้า</h3>
        <form action="update.php" method="POST">

          <input type="hidden" name="F_ID" value="<?php echo $result_c['F_ID']; ?>">

          <label for="name" class="col-sm-2 col-form-label"> ชื่ออาหาร: </label>
          <input type="text" name="foodname" class="form-control" value="<?php echo $result_c['foodname']; ?>">


          <label for="name" class="col-sm-2 col-form-label"> ราคา : </label>
          <input type="number" name="price" class="form-control" required value="<?php echo $result_c['price']; ?>">

          <label for="name" class="col-sm-2 col-form-label"> ประเภทอาหาร: </label>
          <label>Enter menuID</label>

          <select name="menuID">

            <?php
            while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) :
            ?>

              <option value="<?php echo $cc["menuID"];  ?>">
                <?php echo $cc["menuName"]; ?>
              </option>
            <?php
            endwhile
            ?>
          </select>

          <br> <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>