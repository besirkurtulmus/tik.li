<?php
/**
 * User: besirkurtulmus
 * Date: 2/16/14
 * Time: 11:27 PM
 */

include('./settings.php');

class Lib {

    public function __construct(Settings $settings){
        $this->settings = $settings;
        $this->js = array(
            '//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js',
            '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js',
            './res/js/jquery.ez-pinned-footer.js',
            './res/js/chardinjs.min.js',
            './res/js/Chart.js',
            './res/js/highlight.pack.js',
            './res/js/app.js'
        );
        $this->css = array(
            './res/css/app.css',
            './res/css/chardinjs.css',
            './res/css/highlight/railscasts.css',
            './res/css/bootstrap.css',
            './res/css/bootswatch.min.css',
            './res/css/animate.min.css',
            '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'
        );
    }

    public function run(){
        include('./layout/header.php');
        include('./layout/body.php');
        include('./layout/footer.php');
    }
}

# Get the settings
$settings = new Settings();

# Start the new app with setting
$app = new Lib($settings);