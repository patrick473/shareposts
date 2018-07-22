<?php
    session_start();
    function flash($name = '', $message = '', $class = 'alert alert-success') {
        //save flash message
        if (!empty($name) and !empty($message) and empty($_SESSION[$name])) {
     
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
     //display flash message
        } elseif (empty($message) and !empty($_SESSION[$name])) {
     
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
     
    }

    