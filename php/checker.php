<html>
<head>
   <link rel="stylesheet" href="gSlurp.css" type="text/css" />
</head>
<body>
<?php
require_once 'crawlAnnonces.php';

$dateHeure = getAnnonces();

?>
<h1>Alertes mises à jour le <?php echo ($dateHeure); ?></h1>
</body>
</html>