<?php
    class NavMenu{
        private $lib;
        private $style;
        function __construct(){
            if(!defined("ENGINE") || !defined("__ENGINEURL__")) die("<b>nav-menu</b> requires LibLoader Engine as, <b>nav-menu</b> cannot be executed outside of LibLoader Engine.");
            if(ENGINE){
                $this->lib = file_get_contents(__ENGINEURL__."library/nav-menu/nav-menu.lib") or die();
                $this->style = file_get_contents(__ENGINEURL__."library/nav-menu/nav-menu.style") or die();
            }
        }

        function set_logo($logo_here){
            $this->lib = str_replace("{%LOGO_HERE%}", $logo_here, $this->lib);  
        }

        function set_menu_items($menu_items=array()){

            foreach ($menu_items as $key => $value) {

                if(is_array($value)){
                    $prepare = '<li><a href="{%MAIN_LINK%}">'.$key.'</a><ul>{%MENU_ITEM%}';
                    $this->lib = str_replace("{%MENU_ITEM%}", $prepare, $this->lib);
                    $main_menu_item = $value;

                    foreach ($main_menu_item as $key2 => $value2) {
                        if($key2=="self"){
                            $this->lib = str_replace("{%MAIN_LINK%}", $value2, $this->lib);
                            continue;
                        }
                        
                        $prepare2 = '<li><a href="'.$value2.'">'.$key2.'</a></li>{%MENU_ITEM%}';
                        $this->lib = str_replace("{%MENU_ITEM%}", $prepare2, $this->lib);    
                    }

                    $prepare = '</li></ul>{%MENU_ITEM%}';
                    $this->lib = str_replace("{%MENU_ITEM%}", $prepare, $this->lib);
                } else {
                    $prepare = '<li><a href="'.$value.'">'.$key.'</a></li>{%MENU_ITEM%}';
                    $this->lib = str_replace("{%MENU_ITEM%}", $prepare, $this->lib);
                } 
            }
            $this->lib = str_replace("{%MENU_ITEM%}", "", $this->lib);
        }

        function set_style($new_style=array()){
            if(!isset($new_style['PRIMARY_COLOR'])) $new_style['PRIMARY_COLOR'] ="darkorange";
            if(!isset($new_style['SECONDARY_COLOR'])) $new_style['SECONDARY_COLOR'] ="red";
            if(!isset($new_style['MENU_TEXT_COLOR'])) $new_style['MENU_TEXT_COLOR'] ="white";
            if(!isset($new_style['LOGO_TEXT_COLOR'])) $new_style['LOGO_TEXT_COLOR'] ="white";
            $this->style = str_replace("{%PRIMARY_COLOR%}", $new_style['PRIMARY_COLOR'], $this->style);
            $this->style = str_replace("{%SECONDARY_COLOR%}", $new_style['SECONDARY_COLOR'], $this->style);
            $this->style = str_replace("{%LOGO_TEXT_COLOR%}", $new_style['LOGO_TEXT_COLOR'], $this->style);
            $this->style = str_replace("{%MENU_TEXT_COLOR%}", $new_style['MENU_TEXT_COLOR'], $this->style);
        }

        function get_style(){
            $new_stylesheet = fopen('./library/nav-menu/nav-menu-style.css', "w+") or die();
            fwrite($new_stylesheet, $this->style);
            fclose($new_stylesheet);
            echo '<link rel="stylesheet" href="'.__ENGINEURL__.'library/nav-menu/nav-menu-style.css">';
            // echo "<style>".$this->style."</style>";
        }

        function execute(){
            echo $this->lib;
        }
    }

?>