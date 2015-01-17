<?php

$pDest = "fabio@fabiolab.fr";
$pSujet = "Test";
$message = "coucou";
try {
	$res = mail($pDest,$pSujet,$message);
	echo "res mail ".$res;
} catch (Exception $e) {
	echo "erreur ...";
	echo $e;
}
// mail($pDest,$pSujet,$message,$header);

?>