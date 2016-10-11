<?php 

include 'php/mysqlConnect.php';

//<div class="box box1"><span>1.</span><div class="boxContent">

$my = new MysqlConnect();

$allboxes = $my->getAllBoxes();
$allboxes = json_decode($allboxes);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Moving boxes Example</title>
		<style type="text/css">
            @import url('css/reset.css');
            @import url('css/style.css');
        </style>
        <script src="js/splash.js" type="text/javascript"></script>
        <script src="js/ajax.js" type="text/javascript"></script>
        <script type="text/javascript">
        </script>
	</head>
	<body>
        <?php foreach ($allboxes as $box): ?>
			<div id="<?php echo $box->boxid?>" class="box"><span><?php echo $box->title?></span><div class="boxContent"><?php echo $box->text?></div></div>
        <?php endforeach; ?>
    	<a id="admin" href="boxAdmin.php">Boxes Admin</a>
        
	</body>
</html>