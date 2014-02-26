<?php
/**
 * User: besirkurtulmus
 * Date: 2/16/14
 * Time: 11:06 PM
 */

class Settings {

    public function __construct(){
        # Define all settings
        $this->setProperties();
    }

    private function fontAwesome($element, $size, $color){
        return '<i class="fa ' . $element . ' ' . $size . '" style="color: ' . $color . ';"></i>';
    }

    private function setProperties(){
        $this->name = 'Tik.li';
        $this->title = 'Tık.li - Hızlı Url Kısaltıcı';
        $this->topNav = array(
            'Link Oluştur' => array('#create', 'create'),
            $this->fontAwesome('fa-question-circle', '', 'white') . ' Yardım' => array('#help', 'help')
        );
        $this->bottomNav = array(
            'Blog' => array('./blog/', 'blog'),
            'Github' => array('https://github.com/besirkurtulmus/tik.li/', 'github'),
            'Yardım' => array('#help', 'help'),
            'Hakkında' => array('#about', 'about'),
            'İstatistik' => array('#stat', 'stat'),
            'İletişim' => array('#contact', 'contact'),
            'API' => array('#api', 'api')
        );
        $this->createShortlink = array(
            'step1' => array(
                'title' => 'Tık.lı\'nı Oluştur',
                'desc' => 'Linklerinizi hızlı bir şekilde oluşturmak hiç bu kadar kolay olmamıştı!'
            ),
            'step2' => array(
                'title' => 'Tık.lı\'nız Oluştu!',
                'desc' => 'Kısa linkinizi paylaşabilirsiniz!'

            )
        );
        $this->social = array(
            $this->fontAwesome('fa-github-square', 'fa-2x', '') => array('https://github.com/besirkurtulmus/tik.li', 'github'),
            $this->fontAwesome('fa-facebook-square', 'fa-2x', '') => array('#', 'facebook'),
            $this->fontAwesome('fa-twitter-square', 'fa-2x', '') => array('#', 'twitter')
        );
    }

    public function getTitle(){
        return $this->title;
    }

}
