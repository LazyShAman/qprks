<?php

$str = $row['ObjectName'];
$str = substr($str,strrpos($str,' '));
$str = str_replace('«','',$str);
$str = str_replace('»','',$str);

echo'
<li class="nav-item">
    <a class="nav-link text-secondary" data-toggle="tab" href="#id'.  $row['id'] .'" style="font-size: 20px">'. $str .'</a>
</li>';

?>