<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php echo $html->css('admin_login'); ?>
	<title><?php echo Configure::read('Company.name'); ?> -  <?php echo $title_for_layout; ?></title>
</head>
<body class = "<?php echo $title_for_layout; ?>">
	<div id = "login">
      <?php echo $content_for_layout; ?>
	</div>
</body>
</html>