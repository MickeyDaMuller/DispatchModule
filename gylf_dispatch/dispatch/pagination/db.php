<?php
/**
 * @link: http://www.Awcore.com/dev
 */
 
    $db = @mysql_connect('localhost', 'root', '') or die(mysql_error());
    @mysql_select_db('pagination', $db) or die(mysql_error());
 
?>
