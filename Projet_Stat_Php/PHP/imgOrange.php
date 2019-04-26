<?php

header('Content-type: image/png');

     $image   = imagecreate(100, 10);
     $orange    = imagecolorallocate($image, 255, 165, 0);
     $noir      = imagecolorallocate($image, 0, 0, 0);
     imagepng($image);
 ?>



