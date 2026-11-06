<?php
// Runs at the very top of process_order.php, alongside session_start().
// One day = 86400 seconds. One week = 604800.
$visitStamp = date('l, F j, Y g:i a');
setcookie('lastVisit', $visitStamp, time() + 86400, '/');
?>

<?php
require "./order_functions.php";
$orderSummary = order();
?>


<div class="receipt-card"><?= $orderSummary; ?></div>

<div class="insight-card">
   <h3>Order feedback</h3>
   <p><?= htmlspecialchars(completionMessage()); ?></p>
   <p class="insight-note"><?= htmlspecialchars(pairingSuggestion()); ?></p>
</div>

<div class="insight-card pricing-grid">
   <div>
      <h3>Estimated total</h3>
      <p class="price-figure"><?= htmlspecialchars(formattedTotal()); ?></p>
   </div>
   <div>
      <h3>Order profile</h3>
      <p><?= htmlspecialchars(orderProfile()); ?></p>
   </div>
   <p class="insight-note full-width-note"><?= htmlspecialchars(pricingNote()); ?></p>
</div>