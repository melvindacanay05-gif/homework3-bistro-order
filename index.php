<?php
   // if (session_status() === PHP_SESSION_NONE){
   //    }
   session_start();
   // var_dump($_SESSION);

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['dessert']    = $_POST['dessert']    ?? '';
    $_SESSION['drink']      = $_POST['drink']      ?? '';
    $_SESSION['drinkSize']  = $_POST['drinkSize']  ?? '';
   }
   

   setcookie('lastVisit', date('Y-m-d H:i:s'), time() + 3600, "/");
   
   $welcomeBack = '';
   
   if (isset($_COOKIE['lastVisit'])) {
      $last = htmlspecialchars($_COOKIE['lastVisit']);
      $welcomeBack = "Welcome back! Your last visit was {$last}.";
   } else {
         $welcomeBack = 'First time at Chez Session? Welcome in!';
   }

   require "./order_functions.php"; 

   
?>

<html>
   <style>
   body {
      background-color: lemonchiffon;  
      display: flex;
      flex-direction:column ;
      max-width:90% ;
      width: 60%;
      place-self:center ;
   }

   .welcome-note, .form, .insight-card, .insight-card-pricing-grid {
      border: 2px dashed black ;
      border-radius: 1em; 
      box-sizing: border;
      padding:1em ;
      background-color: antiquewhite;

   }

   .form button {
      border: 2px solid black ; 
   }

   .selections{
      font-size:larger;
      align-self:center;
      text-align:center;
      margin:1em;
   }

   div {
      margin-top:1em;
   }

   </style>
   <p class="welcome-note"><?=$welcomeBack?></p>

   <p>
      
      <form class="form" action="" method="post">
         
         <select name="dessert" >
            <option value="">(choose a dessert)</option>
            <option value="Cheesecake" <?php echo dessertSelected("Cheesecake"); ?>>Cheesecake</option>
            <option value="Chocolate Cake" <?php echo dessertSelected("Chocolate Cake"); ?>>Chocolate Cake</option>
            <option value="Tiramisu" <?php echo dessertSelected("Tiramisu"); ?>>Tiramisu</option>
            <option value="Carrot Cake" <?php echo dessertSelected("Carrot Cake"); ?>>Carrot Cake</option>
         </select><br>
         
         <select name="drink">
            <option value="">(choose a drink)</option>
            <option value="Coffee" <?php echo drinkSelected("Coffee"); ?>>Coffee</option>
            <option value="Milk" <?php echo drinkSelected("Milk"); ?>>Milk</option>
            <option value="Tea" <?php echo drinkSelected("Tea"); ?>>Tea</option>
            <option value="Root Beer" <?php echo drinkSelected("Root Beer"); ?>>Root Beer</option>
            <option value="Hot Chocolate" <?php echo drinkSelected("Hot Chocolate"); ?>>Hot Chocolate</option>
         </select><br>
         
         <label for="drinkSize">size</label>
         <input type="radio" value="Small" name="drinkSize" <?php echo drinkSizeSelected("Small"); ?>> Small</input>  
         <input type="radio" value="Medium" name="drinkSize" <?php echo drinkSizeSelected("Medium"); ?>>Medium</input>  
         <input type="radio" value="Large" name="drinkSize" <?php echo drinkSizeSelected("Large"); ?>>Large</input>  
         <br>
         
         <button type="submit" <?php order()?>>submit</button><br><br>
         <button type="submit" <?php order()?>>order again</button>
      </form>
      
      
      
      <form class="forget" action="forget_order.php" method="post">
         <button type="submit">forget</button>
      </form>
   </p>
   
   <div class="selections">
      <?=$_SESSION['dessert']?><br>
      <?=$_SESSION['drink']?><br>  
      <?=$_SESSION['drinkSize']?>   
   </div>
   
   <div class="insight-card">
      <h3>Live guidance</h3>
      <p><?= htmlspecialchars(completionMessage()); ?></p>
      <p class="insight-note"><?= htmlspecialchars(pairingSuggestion()); ?></p>
   </div>
   
   <div class="insight-card-pricing-grid">
      <div>
         <h3>Estimated total</h3>
         <p class="price-figure"><?= htmlspecialchars(formattedTotal()); ?></p>
      </div>
      <div>
         <h3>Order profile</h3>
         <p><?= htmlspecialchars(orderProfile()); ?></p>
      </div>
   </div>
</html>

<!-- <?=var_dump(headers_sent());?> -->