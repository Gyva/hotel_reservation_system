<?php
    function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    function isCustomer() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'customer';
    }

    function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    function displayFlashMessage() {
        if (isset($_SESSION['flash_message'])) {
            echo '<p>' . $_SESSION['flash_message'] . '</p>';
            unset($_SESSION['flash_message']);
        }
    }
?>