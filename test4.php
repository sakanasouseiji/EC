<?php
print "\r\n";
print "get_include_pathの結果\r\n";
print get_include_path();
print "\r\n";
print "__DIR__の結果\r\n";
print __DIR__;
print "\r\n";

print "get_include().PATH_SEPARATOR.__DIR___の結果\r\n";
$current=get_include_path().PATH_SEPARATOR.__DIR__;
print $current;
print "\r\n";

?>
