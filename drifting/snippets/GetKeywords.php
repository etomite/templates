//<?php

$keywords = $etomite->getKeywords();
if (count($keywords)>0) {
    $keys = join($keywords, ", ");
    return '<meta http-equiv="Keywords" content="'.$keys.'" />';
} else {
    return false;
}
