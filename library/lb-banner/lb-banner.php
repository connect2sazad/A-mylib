<?php
    class LbBanner{
        private $lib;
        private $style;
        function __construct(){
            if(!defined("ENGINE") || !defined("__ENGINEURL__")) die("<b>lb-banner</b> requires LibLoader Engine as, <b>lb-banner</b> cannot be executed outside of LibLoader Engine.");
            if(ENGINE){
                $this->lib = file_get_contents(__ENGINEURL__."library/lb-banner/lb-banner.lib") or die();
                $this->style = file_get_contents(__ENGINEURL__."library/lb-banner/lb-banner.style") or die();
            }
        }

        function set_slider_images($slider_images=array()){
            $items_count = 0;
            foreach ($slider_images as $key => $value) {
                $prepare = '<img src="'.$key.'" id="slide-'.$items_count.'" alt="'.$value['alt'].'" data-caption="'.$value['caption'].'">{%SLIDER_IMAGES%}';
                $this->lib = str_replace("{%SLIDER_IMAGES%}", $prepare, $this->lib);
                $items_count++;
            }
            $this->lib = str_replace("{%SLIDER_IMAGES%}", "", $this->lib);
            for ($i=0; $i < $items_count; $i++) {
                if($i == 0)
                    $prepare = '<div class="slides-button slides-button-active" id="slide-dots-'.$i.'" onclick="slideIt('.$i.')"></div>{%SLIDER_BUTTONS%}';
                else
                    $prepare = '<div class="slides-button" id="slide-dots-'.$i.'" onclick="slideIt('.$i.')"></div>{%SLIDER_BUTTONS%}';
                $this->lib = str_replace("{%SLIDER_BUTTONS%}", $prepare, $this->lib);
            }
            $this->lib = str_replace("{%SLIDER_BUTTONS%}", "", $this->lib);
        }

        function set_slider_interval($time_in_miliseconds){
            $this->lib = str_replace("{%SLIDER_TIME_INTERVAL%}", $time_in_miliseconds, $this->lib);
        }

        function set_style($new_style=array()){
            if(!isset($new_style['PRIMARY_COLOR'])) $new_style['PRIMARY_COLOR'] ="transparent";
            if(!isset($new_style['SECONDARY_COLOR'])) $new_style['SECONDARY_COLOR'] ="red";
            if(!isset($new_style['BANNER_NAVIGATON_BUTTONS_BGCOLOR'])) $new_style['BANNER_NAVIGATON_BUTTONS_BGCOLOR'] ="#ffffff80";
            if(!isset($new_style['BANNER_NAVIGATON_BUTTONS_COLOR'])) $new_style['BANNER_NAVIGATON_BUTTONS_COLOR'] ="blue";
            if(!isset($new_style['BANNER_CAPTIONS_COLOR'])) $new_style['BANNER_CAPTIONS_COLOR'] ="#ffffff80";
            if(!isset($new_style['BANNER_CAPTIONS_TEXT_COLOR'])) $new_style['BANNER_CAPTIONS_TEXT_COLOR'] ="black";

            $this->style = str_replace("{%PRIMARY_COLOR%}", $new_style['PRIMARY_COLOR'], $this->style);
            $this->style = str_replace("{%SECONDARY_COLOR%}", $new_style['SECONDARY_COLOR'], $this->style);
            $this->style = str_replace("{%BANNER_NAVIGATON_BUTTONS_BGCOLOR%}", $new_style['BANNER_NAVIGATON_BUTTONS_BGCOLOR'], $this->style);
            $this->style = str_replace("{%BANNER_NAVIGATON_BUTTONS_COLOR%}", $new_style['BANNER_NAVIGATON_BUTTONS_COLOR'], $this->style);
            $this->style = str_replace("{%BANNER_CAPTIONS_COLOR%}", $new_style['BANNER_CAPTIONS_COLOR'], $this->style);
            $this->style = str_replace("{%BANNER_CAPTIONS_TEXT_COLOR%}", $new_style['BANNER_CAPTIONS_TEXT_COLOR'], $this->style);
        }

        function get_style(){
            $new_stylesheet = fopen('./library/lb-banner/lb-banner-style.css', "w+") or die();
            fwrite($new_stylesheet, $this->style);
            fclose($new_stylesheet);
            echo '<link rel="stylesheet" href="'.__ENGINEURL__.'library/lb-banner/lb-banner-style.css">';
            // echo "<style>".$this->style."</style>";
        }

        function get_style_links(){
            $new_stylesheet = fopen('./library/lb-banner/lb-banner-style.css', "w+") or die();
            fwrite($new_stylesheet, $this->style);
            fclose($new_stylesheet);
            return (__ENGINEURL__.'library/lb-banner/lb-banner-style.css');
        }

        function execute(){
            echo $this->lib;
        }
    }

?>