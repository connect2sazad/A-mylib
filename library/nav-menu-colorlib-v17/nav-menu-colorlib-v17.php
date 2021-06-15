<?php
    class NavMenuColorlibV17{
        private $lib;
        private $style;
        function __construct(){
            if(!defined("ENGINE") || !defined("__ENGINEURL__")) die("<b>nav-menu-colorlib-v17</b> requires LibLoader Engine as, <b>nav-menu-colorlib-v17</b> cannot be executed outside of LibLoader Engine.");
            if(ENGINE){
                $this->lib = file_get_contents(__ENGINEURL__."library/nav-menu-colorlib-v17/nav-menu-colorlib-v17.lib") or die();
                $this->main_style = file_get_contents(__ENGINEURL__."library/nav-menu-colorlib-v17/nav-menu-colorlib-v17.style") or die();
                $this->style = file_get_contents(__ENGINEURL__."library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-colors.style") or die();
            }
        }

        function set_logo($logo_here){
            $this->lib = str_replace("{%LOGO_HERE%}", $logo_here, $this->lib);  
        }

        function set_tagline($tagline_here){
            $this->lib = str_replace("{%TAGLINE_HERE%}", $tagline_here, $this->lib);  
        }

        function set_socials($social_items=array()){
            foreach ($social_items as $key => $value) {
                $prepare = '<a href="'.$value.'" class="d-flex align-items-center justify-content-center"><span class="fa fa-'.strtolower($key).'"><i class="sr-only">'.$key.'</i></span></a>{%SOCIAL_ITEM%}';
                $this->lib = str_replace("{%SOCIAL_ITEM%}", $prepare, $this->lib);
            }
            $this->lib = str_replace("{%SOCIAL_ITEM%}", "", $this->lib);
        }

        function set_menu_items($menu_items=array()){

            foreach ($menu_items as $key => $value) {

                if(is_array($value)){
                    $prepare = '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="{%MAIN_LINK%}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$key.'</a><div class="dropdown-menu" aria-labelledby="dropdown04">{%MENU_ITEM%}';
                    $this->lib = str_replace("{%MENU_ITEM%}", $prepare, $this->lib);
                    $main_menu_item = $value;

                    foreach ($main_menu_item as $key2 => $value2) {
                        if($key2=="self"){
                            $this->lib = str_replace("{%MAIN_LINK%}", $value2, $this->lib);
                            continue;
                        }
                        
                        $prepare2 = '<a class="dropdown-item" href="'.$value2.'">'.$key2.'</a>{%MENU_ITEM%}';
                        $this->lib = str_replace("{%MENU_ITEM%}", $prepare2, $this->lib);    
                    }

                    $prepare = '</div></li>{%MENU_ITEM%}';
                    $this->lib = str_replace("{%MENU_ITEM%}", $prepare, $this->lib);
                } else {
                    $prepare = '<li class="nav-item"><a href="'.$value.'" class="nav-link">'.$key.'</a></li>{%MENU_ITEM%}';
                    $this->lib = str_replace("{%MENU_ITEM%}", $prepare, $this->lib);
                } 
            }
            $this->lib = str_replace("{%MENU_ITEM%}", "", $this->lib);
        }

        function set_style($new_style=array()){
            if(!isset($new_style['PRIMARY_COLOR'])) $new_style['PRIMARY_COLOR'] ="#252525";
            if(!isset($new_style['SECONDARY_COLOR'])) $new_style['SECONDARY_COLOR'] ="red";
            if(!isset($new_style['SUBMENU_DESKTOP_COLOR'])) $new_style['SUBMENU_DESKTOP_COLOR'] ="white";
            if(!isset($new_style['SUBMENU_MOBILE_COLOR'])) $new_style['SUBMENU_MOBILE_COLOR'] ="black";
            if(!isset($new_style['LOGO_TEXT_COLOR'])) $new_style['LOGO_TEXT_COLOR'] ="black";
            if(!isset($new_style['TAGLINE_TEXT_COLOR'])) $new_style['TAGLINE_TEXT_COLOR'] ="rgba(0, 0, 0, 0.3)";
            if(!isset($new_style['MENU_TEXT_COLOR'])) $new_style['MENU_TEXT_COLOR'] ="white";
            if(!isset($new_style['SUBMENU_TEXT_COLOR'])) $new_style['SUBMENU_TEXT_COLOR'] ="black";

            $this->style = str_replace("{%PRIMARY_COLOR%}", $new_style['PRIMARY_COLOR'], $this->style);
            $this->style = str_replace("{%SECONDARY_COLOR%}", $new_style['SECONDARY_COLOR'], $this->style);
            $this->style = str_replace("{%SUBMENU_DESKTOP_COLOR%}", $new_style['SUBMENU_DESKTOP_COLOR'], $this->style);
            $this->style = str_replace("{%SUBMENU_MOBILE_COLOR%}", $new_style['SUBMENU_MOBILE_COLOR'], $this->style);
            $this->style = str_replace("{%LOGO_TEXT_COLOR%}", $new_style['LOGO_TEXT_COLOR'], $this->style);
            $this->style = str_replace("{%TAGLINE_TEXT_COLOR%}", $new_style['TAGLINE_TEXT_COLOR'], $this->style);
            $this->style = str_replace("{%MENU_TEXT_COLOR%}", $new_style['MENU_TEXT_COLOR'], $this->style);
            $this->style = str_replace("{%SUBMENU_TEXT_COLOR%}", $new_style['SUBMENU_TEXT_COLOR'], $this->style);
        }

        function get_style(){
            $new_stylesheet = fopen('./library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-colors.css', "w+") or die();
            fwrite($new_stylesheet, $this->style);
            fclose($new_stylesheet);
            if(!file_exists('./library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-style.css')){
                $new_stylesheet = fopen('./library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-style.css', "w+") or die();
                fwrite($new_stylesheet, $this->main_style);
                fclose($new_stylesheet);
            }
            echo '<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">';
            echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">';
            echo '<link rel="stylesheet" href="'.__ENGINEURL__.'library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-style.css">';
            
        }

        function get_style_links(){
            $new_stylesheet = fopen('./library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-colors.css', "w+") or die();
            fwrite($new_stylesheet, $this->style);
            fclose($new_stylesheet);
            if(!file_exists('./library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-style.css')){
                $new_stylesheet = fopen('./library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-style.css', "w+") or die();
                fwrite($new_stylesheet, $this->main_style);
                fclose($new_stylesheet);
            }
            return array(
                "https://fonts.googleapis.com/css?family=Roboto:400,100,300,700",
                "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",
                __ENGINEURL__."library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-style.css"
            );
        }

        function get_script(){
            echo '<script src="'.__ENGINEURL__.'library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-jquery.min.js"></script>';
            echo '<script src="'.__ENGINEURL__.'library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-popper.js"></script>';
            echo '<script src="'.__ENGINEURL__.'library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-bootstrap.min.js"></script>';
            echo '<script src="'.__ENGINEURL__.'library/nav-menu-colorlib-v17/nav-menu-colorlib-v17-main.js"></script>';
            
        }

        function execute(){
            echo $this->lib;
            $this->get_script();
        }
    }

?>