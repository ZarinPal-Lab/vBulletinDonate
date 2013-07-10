<?php

$files = glob('{*.PNG,*.png,*.JPG,*.jpg,*.GIF,*.gif}', GLOB_BRACE);
readfile($files[array_rand($files)]);

?>