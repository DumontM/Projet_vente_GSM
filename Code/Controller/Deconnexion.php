<?php

    unset($_SESSION);
    session_start();
    session_destroy();
    header('location: connection.php');
