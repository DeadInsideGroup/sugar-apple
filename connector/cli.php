<?php

require __DIR__."/../autoload.php";

$input = file_get_contents("php://input");

shell_exec("nohup /usr/bin/php ".__DIR__."/bg.php \"".urlencode($input)."\" >> ".LOG_DIR."/nohup.out 2>&1");
