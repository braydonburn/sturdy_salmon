<?php
    $errors = array();
    if (!empty($_POST)) {
        if (count($errors)>0) {
            echo "<h3>Error1.</h3>";
        } else {
          //Post Review
        }
    } else {
        echo "<h3>Error2.</h3>";
    }
