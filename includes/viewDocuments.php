<?php

$id=$_GET['id'];
$ext=$_GET['ext'];
$path="../documents/ccm".$id.".".$ext;
?>
<p><img src="<?php echo $path; ?>"></p>
        