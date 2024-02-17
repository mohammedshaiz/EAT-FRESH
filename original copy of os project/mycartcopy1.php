<?php 
session_start();
include 'config.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $id = $_POST['id'];
  $quantity = $_POST['quantitys'];

  
    $sql = "UPDATE cart SET quantity = '$quantity' WHERE id = '$id' ";
    if(mysqli_query($conn, $sql)){
      echo "<script>alert('Item Quantity Updated');</script>";
    
  }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>cart</title>
        <div style="background-image:url('veg12.jpg');
        background-repeat:fixed;
        background-size:50% 1000%">
        </div>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

</head>
<body >
        <div class="container">
     <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light myt-5">
        <h1><i>MY CART</i></h1>
</div>
<div class="col-lg-9">

     <table class=" table table-dark table-striped">
     <thead class="text-center" >
    <tr>
      <th scope="col">Serial Number</th>
      <th scope="col">Item Name</th>
      <th scope="col">Item Price</th>
      <th scope="col">Quantity</th>
      <th scope=""></th>
    </tr>
  </thead>
  <tbody class="text-center">
    <?php
    // echo $_SESSION['cart'][0];
    // $total=0;
    // if(isset($_SESSION['cart']))
    // {
    // foreach($_SESSION['cart']as $key=>$value)
    // {
    //   $sr=$key+1;
    //  $total=$total+$value['Price'];
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM cart WHERE user_ids = '$user_id' ";
    $result = mysqli_query($conn, $sql);
    $n = $result->num_rows;
    $total = 0;
    while($row = mysqli_fetch_assoc($result))
    {
        $ids[] = $row['id'];
        $cart_item_name[] = $row['item_name'];
        $cart_item_price[] = $row['price'];
        $quantities[] = $row['quantity'];
        $total += $row['quantity']*$row['price']; 
    }
    for($i = 0;$i < $n;$i++){
      $m = $i+1;
      echo"
      <tr>
     <td>$m</td>
      <td>$cart_item_name[$i]</td>
      <td>$cart_item_price[$i]</td>
      <form action='' method='POST'>
      <td><input class='text-center' type='number' name='quantitys' value='$quantities[$i]'></td>
      <td>
      <button id='delete".$i."' name='Remove_Item'class='btn btn-sm btn-outline-success'>UPDATE</button>
      <input type='hidden' name='id' value='$ids[$i]'>
      
     <a href="deletion.php" > <button name='Remove_Item'class='btn btn-sm btn-outline-success'>DELETE</a> 
      
      
      </td>
      </tr>
      
    }
    ?>
     </tbody>
    </table>
</div>
     <div class="col-lg-3">
       <div class="border bg-light rounded p-4">
       <h4>Total:</h4>
       <h5 class="table-right"><?php echo $total?></h5>   
       <h4>Items:</h4>
       <h5 class="table-right"><?php echo $n?></h5>   
       <br>
          <form>

              <div class="form-check">
             <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">
          Cash On Delivery
  </label>
</div>
<br>
         <button onClick="handleClick()" class="btn btn-primary btn-block">Make Purchase</button>
         <a href="shopping.php" button class="btn btn-primary btn-block">Go to Home</a>
         <!-- <a href="shopping.php"><button class="btn btn-secondary btn-block">Logout</button></a> -->

         </form>

</div>  
      </div>
       </div>
       <script>
        function handleClick(){
          if (confirm("Purchase Successfull") == true) {
            // window.location.href = "http://localhost//original%20copy%20of%20os%20project/shopping.php";
            text = "You canceled!";

          } else {
            text = "You canceled!";
          }
        }

      </script>
      <bu
</body>
</html>
