<?php
function getDuration($a , $b) {
  $start = strtotime($a);
  $end = strtotime($b);
  $time = (int)(($end - $start) / 60);

  $hours = floor($time / 60);
  $minutes = ($time % 60);
  return $hours.'h '.$minutes.'m';
}
function getPrice($type) {
  if($type==='Guest'){
    return 105.40;
  }
  else if ($type==='Business'){
    return 135.40;
  }
  else {
    return 165.40;
  }
}
 ?>
