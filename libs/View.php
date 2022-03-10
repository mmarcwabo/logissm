<?php
class View  
{
    
    function __construct(){
        //echo "<br/>Main view";
    }

    public function render($viewname, $content, $sidebar = false, $navbar= false){
        
        if($content != '') {
            list($message_, $message_type_) = explode("#", $content);
            Session::add_to_session('message_', $message_);
            Session::add_to_session('message_type_', $message_type_);
        }
        //Including the header
        require "views/header.php";
        //Including sidebar too
        if ($sidebar) {
            require "views/sidebar.php";
        }
        //As per the template structure,
        //Contents start after the sidebar and before navbar
        echo '<div class="content">';
        //Including navbar too
        if ($navbar) {
            require "views/navbar.php";
        }          
        //Including the page content
        require "views/".$viewname.".php";

        //Including the footer
        require "views/footer.php";
    }
}
