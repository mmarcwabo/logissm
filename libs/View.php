<?php

class View  
{
    function __construct(){
        //echo "<br/>Main view";
    }

    //A method that allows to render a view given to it as an arg
    public function render($viewname, $content = false, $sidebar = false, $navbar= false){
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
        if ($content) {
            //echo $content;
        }
        //Including the footer
        require "views/footer.php";

    }
}
