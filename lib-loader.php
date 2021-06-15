<?php

    define( "echoes_off", "false" );
    define( "echoes_on", "true" );
    define( "errors_off", "false" );
    define( "errors_on", "true" );
    define( "ENGINE", "true" );
    define("__ENGINEURL__", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

    // errors
    define( "ENGINE_STOPPED", array("type"=>"engine_stopped", "elapsed"=>(rand(0,4999)/1000), "err_title"=>"ENGINE_STOP_ERR", "return_msg" => "You cannot access any parameters. The engine has been stopped earlier.") );
    define( "LIBRARY_NOT_FOUND", array("type"=>"library_not_found", "elapsed"=>(rand(0,4999)/1000), "err_title"=>"LIBRARY_NOT_FOUND_ERR", "return_msg" => "The Library you are trying to access was not found.") );
    
    global $engine_stopped;
    $engine_stopped = false;

    class LibLoader{
        private $display_status = echoes_on;
        private $errors_status = errors_on;
        private $used_libraries = array();
        function __construct( $var = echoes_on ){
            if ( $var == echoes_off ){
                $this->display_status = echoes_off;
            }
            if( $this->display_status ){
                echo "<script>console.log('LibLoader engine started');</script>";
            }
        }

        // set errors on or off
        function set_errors( $var = errors_on ){
            $this->errors_status = $var;
        }
        
        // to generate errors
        function generate_error($error_value){
            if( $this->errors_status == errors_on ){
                echo '
                    <div style="background-color:red; padding:5px;border:1px solid">
                    <div style="padding:5px;border:1px solid">'.$error_value['err_title'].'</div>
                    <div style="padding:5px;border:1px solid; border-top:none;">'.$error_value['elapsed'].' s</div>
                    <div style="padding:5px;border:1px solid; border-top:none;">'.$error_value['return_msg'].'</div>
                    </div>
                ';
            }
        }

        // any function
        function echoes(){
            global $engine_stopped;
            if( ! $engine_stopped )
                echo "Hello World!";
            else
                $this->generate_error(ENGINE_STOPPED);
        }

        function defaults(){
            unlink('./static/default.css');
            $defaults = fopen('./static/default.css', "a") or die();
            fwrite($defaults, "");
            fclose($defaults);
            echo "<style>@include('./static/default.css')</style>\n";
        }
        
        // get library
        function get_library($library_name){
            global $engine_stopped;
            if( ! $engine_stopped ){
                if(file_exists('library/'.$library_name.'/'.$library_name.'.php')){
                    include_once('library/'.$library_name.'/'.$library_name.'.php');
                    if( $this->display_status ){
                        echo '<script>console.log("LibLoader engine initiated '.$library_name.' library.");</script>';
                    }
                    $library_class_name = $this->get_class_name_from_library($library_name);
                    $library_instance = new $library_class_name;
                    if( $this->display_status ){
                        echo '<script>console.log("LibLoader engine created object for '.$library_class_name.' class.");</script>';
                    }
                    // array_push($this->used_libraries, $library_instance);
                    $this->used_libraries[$library_class_name] = $library_instance;

                } else
                    $this->generate_error(LIBRARY_NOT_FOUND);
            }
            else
                $this->generate_error(ENGINE_STOPPED);
        }

        // get the librarry instance
        function get_instance_of($class_name){
            return $this->used_libraries[$class_name];
        }

        // get the library class name from library name
        function get_class_name_from_library($library_name){
            $names = explode("-",$library_name);
            $final_name = "";
            foreach ($names as $value) {
                $final_name .= " ".$value;
            }
            $final_name = ucwords($final_name);
            $final_name = str_replace(" ", "", $final_name);
            return $final_name;
        }

        function form_control(){
            
        }

        // function envelope($envelope_name, $executor_instance){
        //     $defaults = fopen('./static/default.css', "a") or die();
        //     $stylesheets = $executor_instance->get_style_links();
        //     if(is_array($stylesheets)){
        //         $prepare = "#".$envelope_name."{";
        //         foreach ($stylesheets as $style) {
        //             $prepare .= "\n\t@import '".$style."';";
        //         }
        //         $prepare .= "\n}\n";
        //     } else{
        //         $prepare = "#".$envelope_name."{\n\t@import '".$stylesheets."';\n}";
        //     }
        //     fwrite($defaults, $prepare);
        //     fclose($defaults);
        //     echo '<libloader id="'.$envelope_name.'">';
        //     echo "\n";
        //     $executor_instance->execute();
        //     echo "\n";
        //     echo "</libloader>";
        //     echo "\n";
        // }

        // stop the engine
        function stop(){
            global $engine_stopped;
            foreach ( $this as $key ) {
                error_reporting(E_ERROR | E_PARSE);
                unset( $this->$key );
            }
            if( !$engine_stopped ){
                echo "<script>console.log('LibLoader engine stopped');</script>";
                $engine_stopped = true;
            }
        }

    }

?>