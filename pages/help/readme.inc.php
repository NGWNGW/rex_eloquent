<?php

$search = array('(CHANGELOG.md)', '(LICENSE.md)');
$replace = array('(index.php?page=eloquent&subpage=help&chapter=changelog)', '(index.php?page=eloquent&subpage=help&chapter=license)');

echo rex_eloquent_utils::getHtmlFromMDFile('README.md', $search, $replace);

