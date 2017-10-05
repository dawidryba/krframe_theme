<!DOCTYPE html>
<html class="errorTheme">
    <head>
        <meta charset="utf-8">
        <title>Error theme: <?php echo $code; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo $krTemplateUrl;?>/assets/css/theme.css">
    </head>
    <body>
        <div class="errorPage">
            <i class="fa fa-frown-o" aria-hidden="true"></i>
            <div class="code"><?php echo $code; ?></div>
            <div class="check"><?php echo $errorText; ?></div>
        </div>
    </body>
</html>
