    <body>
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="#create" class="navbar-brand"><?php echo $this->settings->name; ?></a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
<?php
# Creates the top navbar
foreach($this->settings->topNav as $key => $val){
    $ident = '                        ';
    echo $ident . '<li><a class="' . $val[1] . '" href="' . $val[0] . '">' . $key . '</a></li>' . "\n";
};
?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right" data-intro="Sosyal linklerimiz." data-position="bottom">
<?php
# Creates the social links
foreach($this->settings->social as $key => $val){
    $ident = '                        ';
    echo $ident . '<li><a class="' . $val[1] . '" href="' . $val[0] . '">' . $key . '</a></li>' . "\n";
};
?>
                    </ul>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="page-header" id="banner">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
<?php
include('./pages/about.php');
include('./pages/api.php');
include('./pages/contact.php');
include('./pages/create.php');
include('./pages/stat.php');
?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        <div id="bottomNav">
            <div class="well">
                <div class="container row">
                    <ul class="list-unstyled nav navbar-nav col-md-8">
<?php
foreach($this->settings->bottomNav as $key => $val){
    $ident = '                        ';
    echo $ident . '<li><a class="' . $val[1] . '" href="' . $val[0] . '">' . $key . '</a></li>' . "\n";
}
?>
                    </ul>
                    <h4 class="text-right col-md-4">Kebab Stronk!</h4>
                </div>
            </div>
        </div>
    </body>
