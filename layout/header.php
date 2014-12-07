<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->settings->title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
for($i = 0; $i < count($this->css); $i++){
    $ident = '        ';
    echo $ident . '<link rel="stylesheet" href="'. $this->css[$i] . '">' . "\n";
}
?>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
        <script src="../bower_components/respond/dest/respond.min.js"></script>
        <![endif]-->
    </head>
