<?php
/**
 * Manage sessions and cookies all over the application scope
 */
class Session{
    public static function init_session(){
        session_start();
    }

    public static function add_to_session($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function remove_from_session($key) {
        unset($_SESSION[$key]);
    }

    public static function get_from_session($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }  
    }

    public static function destroy_session() {
        session_destroy();
    }

}