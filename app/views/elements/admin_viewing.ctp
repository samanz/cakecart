<?php 
if(!isset($this->params['named']['status']))
   $text = 'All ';
else {
   $status = $this->params['named']['status'];
   if($status == 0)
      $text = 'Pending ';
   elseif($status == 1)
      $text = 'Processing ';
   elseif($status == 2)
      $text = 'Shipped ';
   elseif($status == 3)
      $text = 'Delivered ';
}
$text .= 'Orders ordered ';
if(!isset($this->params['named']['interval']))
   $text .= 'From All Time';
else {
   $interval = $this->params['named']['interval'];
   if($interval == 0)
      $text .= 'Today';
   if($interval == 1)
      $text .= 'This Week';
   if($interval == 2)
      $text .= 'This Month';
}
?><h2>Viewing <?php echo $text; ?></h2>
   