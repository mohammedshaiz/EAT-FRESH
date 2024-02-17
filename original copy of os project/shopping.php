<?php
session_start();


include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM cart WHERE user_ids = '$id';";
$result = mysqli_query($conn, $sql);
$n = $result->num_rows;
while($row = mysqli_fetch_assoc($result)) 
{
    $ids[] = $row['id'];
    $item_names[] = $row['item_name'];
    $quantity[] = $row['quantity'];
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id = $_SESSION['user_id'];
    $item_name = $_POST['Item_Name'];
    $price = $_POST['Price'];
    for($i = 0;$i<$n;$i++){
        if($item_names[$i] == $item_name){
            $quant = $quantity[$i] + 1;
            $sql = "UPDATE cart SET quantity = '$quant' WHERE id = '$ids[$i]'";
            mysqli_query($conn, $sql);
            if($result){
                echo"<script>
                          alert('Item Added');
                          </script>";
            }
            else{
                echo "error";
                echo $result;
            }
            break;
        }
    }
    if($i == $n){
        $sql = "INSERT INTO cart(`user_ids`, `item_name`, `price`) VALUES('$user_id', '$item_name', '$price');";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo"<script>
                      alert('Item Added');
                      </script>";
        }
        else{
            echo "error";
            echo $result;
        }
    }
    
}

?>
<html>
    <head>
        <meta name="author" content="">
        <meta name="Keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="shopping.css"/>
        <link rel="stylesheet" href="eatfresh.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="undefined" crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>

        <body>
           
            <div class="parallax">
            <div class="page-title">Eat fresh</div>
            </div>
            <div class="menu" id="sticky">
                <ul class="menu-ul">

                    <a href="#deals" class="a-menu"><li>DEALS</li></a>
                    <a href="#VEGETABLES" class="a-menu"><li>VEGETABLES</li></a>
                    <a href="#fruits" class="a-menu"><li>FRUITS</li></a>
                    <a href="#meat" class="a-menu"><li>MEAT</li></a>
                   <?php
                   $count=0;
                    if(isset($_SESSION['cart']))
                    {
                        $count=count($_SESSION['cart']);
                    }
                    ?>
                    <a href="mycart.php" class="btn btn-outline-success"><li>MY CART</li></a>
                    <a href="logout.php" class="a-menu"><li>LOGOUT</li></a>
                </ul>
                
            </div>

        <!--Home page begins-->
        <div class="container">
            <a href="#VEGETABLES">
                <div class="categories">
                    <img src="vege/greenpapper.jpg" class="item-image" />
                    <div class="image-title">Vegetables</div>
                </div>
            </a>
            <a href="#fruits">
                <div class="categories">
                    <img src="FRUITS/strawberry.jpg" class="item-image"/>
                    <div class="image-title">FRUITS</div>
                </div>
            </a>
            <a href="#meat">
                <div class="categories">
                    <img src="meat/chicken.jpg" class="item-image"/>
                    <div class="image-title">meat</div>
                </div>
            </a>
            <a href="#deals">
                <div class="categories">
                    <img src="deals.jpg" class="item-image"/>
                    <div class="image-title">dairy item</div>
                </div>
            </a>
            
        </div>    
        <!--Deal begins here-->
        <div class="deals-container" id="deals">
            <div class="parallax">
                <div class="title"><marquee>DEALS</marquee></div>
            </div>
            <div class="deal">
                save 20% on min-purchase of Rs149 on Vegetables<br/>
               
            </div>
            <div class="deal">
                save 10% on min-purchase of Rs179 on FRUITS<br/>
                
            </div>
           
        </div>
        <!--Deal ends here-->
        <!--veg begins here-->
        <div class="deals-container" id="VEGETABLES">
          <div class="parallax">
              <div class="title"><marquee>VEGETABLES</marquee></div>
          </div>

         
          <div class="items">
              <div class="images">
                  <img src="vege/Green Beans.jpg" class="item-image-size"/>
              </div>
              <form action="" method="POST">
              <div class="description">
                 <b><i>GREEN BEANS</i></b><br/>
                 <b>PRICE :</b>  40/kg<br/>
                <b>qty :</b> 1kg<br/>
                  
                    <button type="submit" name="Add_To_Cart"class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="GREEN BEANS">
                    <input type="hidden" name="Price" value="40">

              </div>
              </form>
          </div>
      
        
          <div class="items">
            <div class="images">
                <img src="vege/onion.jpg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>ONIONS</i></b><br/>
                <b>PRICE :</b>  30/kg<br/>
                <b>qty :</b> 1kg<br/>
                    <button type="submit" name="Add_To_Cart"  class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="ONIONS">
                    <input type="hidden" name="Price" value="30">

          </div>
          </form>
        </div>  

        <div class="items">
            <div class="images">
                <img src="vege/tomato.jpg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>TOMATO</i></b><br/>
                <b>PRICE :</b>  20/kg<br/>
                <b>qty :</b> 1kg<br/>
                
                   <button type="submit" name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="TOMATO">
                    <input type="hidden" name="Price" value="20">

            </div>
</form>
        </div> 
        <div class="items">
            <div class="images">
                <img src="vege/carrot (1).jpg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>CARROT</i></b><br/>
                <b>PRICE :</b>  35/kg<br/>
                <b>qty :</b> 1kg<br/>
                
                   <button type="submit" name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="CARROT">
                    <input type="hidden" name="Price" value="20">
  
                
            </div>
                </form>
        </div> 
        <div class="items">
            <div class="images">
                <img src="vege/okra.jpg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>OKRA</i></b><br/>
                <b>PRICE :</b>  40/kg<br/>
                <b>qty :</b> 1kg<br/>
               
                   <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="OKRA">
                    <input type="hidden" name="Price" value="40">

                    
                
            </div>
</from>
        </div>
        <div class="items">
            <div class="images">
                <img src="vege/greenpapper.jpg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>CAPSICUM</i></b><br/>
                <b>PRICE :</b>  45/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="CAPSICUM">
                    <input type="hidden" name="Price" value="45">

                    
                </div>
                </form>
        </div> 
       
        
        <div class="items">
            <div class="images">
                <img src="vege/Brinjal.jpeg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>BRINJAL</i></b><br/>
                <b>PRICE :</b>  35/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="BRINJAL">
                    <input type="hidden" name="Price" value="35">
                </div>
                </form>
        </div> 
        <div class="items">
            <div class="images">
                <img src="vege/coconet.jpeg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>COCONET</i></b><br/>
                <b>PRICE :</b>  30/pc<br/>
                <b>qty :</b> 1piece<br/>
                 <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="COCONET">
                    <input type="hidden" name="Price" value="30">
                   
            </div>
                </form>
        </div> 
        <div class="items">
            <div class="images">
                <img src="vege/potato (1).jpeg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>POTATO</i></b><br/>
                <b>PRICE :</b>  25/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="POTATO">
                    <input type="hidden" name="Price" value="25">
            </div>
                </form>
        </div> 
        </div>
        <!--veg ends here-->
        <!--Fruitsbegins here-->
        <div class="deals-container" id="fruits">
            <div class="parallax">
                <div class="title"><marquee>FRUITS</marquee></div>
            </div>
           
            <div class="items">
              <div class="images">
                  <img src="FRUITS/apple.jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>APPLE</i></b><br/>
                <b>PRICE :</b>  200/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="APPLE">
                    <input type="hidden" name="Price" value="200">
                    
              </div>
                </form>
          </div>  
         
          <div class="items">
              <div class="images">
                  <img src="FRUITS/banana (1).jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>BANANA</i></b><br/>
                <b>PRICE :</b>  30/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="BANANA">
                    <input type="hidden" name="Price" value="30">
                </div>
                </form>
          </div> 
          
          <div class="items">
              <div class="images">
                  <img src="FRUITS/orange.jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>ORANGE</i></b><br/>
                <b>PRICE :</b>  80/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="ORANGE">
                    <input type="hidden" name="Price" value="80">
                </div>
                </form>
          </div> 
          <div class="items">
            <div class="images">
                <img src="FRUITS/papaya.jpeg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>PAPAYA</i></b><br/>
                <b>PRICE :</b>  25/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="PAPAYA">
                    <input type="hidden" name="Price" value="25">
                 </div>
                </form>
          </div>
          <div class="items">
            <div class="images">
                <img src="FRUITS/PINAPLE.jpg" class="item-image-size"/>
            </div>
            <form  action="" method="POST">
            <div class="description">
                <b><i>PINAPLE</i></b><br/>
                <b>PRICE :</b>  50/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="PINAPLE">
                    <input type="hidden" name="Price" value="50">
                </div>
                </form>
                </div>
                <div class="items">
                    <div class="images">
                        <img src="FRUITS/MUSK MELEN.jpg" class="item-image-size"/>
                    </div>
                    <form  action="" method="POST">
                    <div class="description">
                <b><i>MUSK MELON</i></b><br/>
                <b>PRICE :</b>  50/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="MUSK MELON">
                    <input type="hidden" name="Price" value="50">
                </div>
                </form>
                </div>
               <div class="items">
                 <div class="images">
                  <img src="FRUITS/mosambi.jpg" class="item-image-size"/>
                    </div>
                    <form  action="" method="POST">
                    <div class="description">
                    <b><i>SWEET LIME</i></b><br/>
                    <b>PRICE :</b>  60/kg<br/>
                    <b>qty :</b> 1kg<br/>
                    <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="SWEET LIME">
                    <input type="hidden" name="Price" value=" 60">
                  </div>
                </form>
                  </div>
          
          <!--fruits ends here-->
          
        <!--meat begins here-->
        <div class="deals-container" id="meat">
            <div class="parallax">
                <div class="title"><marquee>MEAT AND SEAFOODS</marquee></div>
            </div>
            <div class="items">
                <div class="images">
                    <img src="meat/chicken.jpg" class="item-image-size"/>
                </div>
                <form  action="" method="POST">
                <div class="description">
                    <b><i>CHICKEN</i></b><br/>
                    <b>PRICE :</b>  200/kg<br/>
                    <b>qty :</b> 1kg<br/>
                    <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="CHICKET">
                    <input type="hidden" name="Price" value=" 200">
                    
                </div>
                </form>
            </div>
            <div class="items">
              <div class="images">
                  <img src="meat/fish.jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>FISH</i></b><br/>
                <b>PRICE :</b>  400/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="FISH">
                    <input type="hidden" name="Price" value=" 400">
              </div>
                </form>
          </div>  
          <div class="items">
              <div class="images">
                  <img src="meat/crab.jpg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>CRAB</i></b><br/>
                <b>PRICE :</b>  350/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="CRAB">
                    <input type="hidden" name="Price" value=" 350">
             </div>
                </form>
          </div> 
          <div class="items">
              <div class="images">
                  <img src="meat/Peeled prawn.jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>PEELED PRAWNS</i></b><br/>
                <b>PRICE :</b>  600/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="PEELED PRAWNS">
                    <input type="hidden" name="Price" value=" 600">
            </div>
                </form>
          </div> 
          <!--meat ends here-->
             <!--Dairy items begins here-->
        <div class="deals-container" id="meat">
            <div class="parallax">
                <div class="title"><marquee>DAIRY ITEMS</marquee></div>
            </div>
            <div class="items">
                <div class="images">
                    <img src="Dairy ITems/ghee.jpeg" class="item-image-size"/>
                </div>
                <form  action="" method="POST">
                <div class="description">
                    <b><i>GHEE</i></b><br/>
                    <b>PRICE :</b>  500/lt<br/>
                    <b>qty :</b> 1liter<br/>
                    <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="GHEE">
                    <input type="hidden" name="Price" value=" 500">
          </div>
                </form>
            </div>
            <div class="items">
              <div class="images">
                  <img src="Dairy ITems/butter.jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>BUTTER</i></b><br/>
                <b>PRICE :</b>  400/gm<br/>
                <b>qty :</b> 500gram<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="BUTTER">
                    <input type="hidden" name="Price" value=" 400">
                 </div>
                </form>
          </div>  
          <div class="items">
              <div class="images">
                  <img src="Dairy ITems/cheese.jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>CHEES</i></b><br/>
                <b>PRICE :</b>  500/gm<br/>
                <b>qty :</b> 500gram<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="CHEES">
                    <input type="hidden" name="Price" value=" 500">
             </div>
                </form>
          </div> 
         
          <div class="items">
              <div class="images">
                  <img src="Dairy ITems/milk.jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>MILK</i></b><br/>
                <b>PRICE :</b>  50/lt<br/>
                <b>qty :</b> 1liter<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="MILK">
                    <input type="hidden" name="Price" value=" 50">
              </div>
                </form>
          </div>
          <div class="items">
              <div class="images">
                  <img src="Dairy ITems/paneer.jpeg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>PANEER</i></b><br/>
                <b>PRICE :</b>  250/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="PANEER">
                    <input type="hidden" name="Price" value=" 250">
                  </div>
                </form>
          </div> 
          
        <!--dairy items  ends here-->
        <!--dryfruits begins here-->
        <div class="deals-container" id="meat">
            <div class="parallax">
                <div class="title"><marquee>DRYFRUITS</marquee></div>
            </div>
            <div class="items">
                <div class="images">
                    <img src="DRYFRUITS/ALMONDS.jpg" class="item-image-size"/>
                </div>
                <form  action="" method="POST">
                <div class="description">
                    <b><i>ALMONDS</i></b><br/>
                <b>PRICE :</b>  250/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="ALMONDS">
                    <input type="hidden" name="Price" value=" 250">
              </div>
                </form>
            </div>
            <div class="items">
              <div class="images">
                  <img src="DRYFRUITS/wallnuts.jpg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>WALLNUTS</i></b><br/>
                <b>PRICE :</b>  250/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="WALLNUTS">
                    <input type="hidden" name="Price" value=" 250">
              </div>
                </form>
          </div>  
          <div class="items">
              <div class="images">
                  <img src="anjeer.jpg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>ANJEER</i></b><br/>
                <b>PRICE :</b>  250/kg<br/>
                <b>qty :</b> 1kg<br/>
                 
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="ANJEER">
                    <input type="hidden" name="Price" value=" 250">
                    
              </div>
                </from>
          </div> 
          <div class="items">
              <div class="images">
                  <img src="cashews-cover-2.jpg" class="item-image-size"/>
              </div>
              <form  action="" method="POST">
              <div class="description">
                <b><i>CASHEW</i></b><br/>
                <b>PRICE :</b>  250/kg<br/>
                <b>qty :</b> 1kg<br/>
                <button type="submit"  name="Add_To_Cart" class="buynow-btn"><a class="buynow"> ADD TO CART</a></button>
                    <input type="hidden" name="Item_Name" value="CASHEW">
                    <input type="hidden" name="Price" value=" 250">
                    
                      
                  
              </div>
                </form>
          </div> 
          

        <!--Home page ends-->
            
        </body>
</html>