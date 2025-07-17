<?php
// 
// Inclusion du framework
include_once('framework/view.fw.php');

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();
$view->assign('title','Introduction');
$view->assign('message',"Ce backoffice vous permet de gerer vos articles. Pour pouvoir l'utiliser, il faut vous connecter.");
$view->display('message');
?>
