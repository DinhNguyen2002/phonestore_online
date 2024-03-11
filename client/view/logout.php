<?php

unset($_SESSION['username']);
unset($_SESSION["cart"]);


header ('Location: index.php?act=login');