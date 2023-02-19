<?php
function loadFiles($path){

    return asset($path);
}

function changeDirection(){

    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';;
}
?>
