<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <link rel="stylesheet" href="gSlurp.css" type="text/css" />
</head>
<body>
<?php
require_once 'crawlAnnonces.php';

$dateHeure = getAnnonces();

?>
<h1>Mis à jour le <?php $dateHeure ?></h1>
</body>
</html>