<?php
redirect('index.php?v=d&m=wcellar&p=panel');
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}

?>