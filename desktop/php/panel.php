<?php
if (!isConnect()) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
?>
<?php include_file('desktop', 'panel', 'js', 'wcellar');?>