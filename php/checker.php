<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../css/preums.css" type="text/css" />
</head>
<body>
<?php
require_once 'crawlAnnonces.php';

$dateHeure = getAnnonces();

?>
<h1>Alertes mises à jour le <?php echo ($dateHeure); ?></h1>
</body>
</html>