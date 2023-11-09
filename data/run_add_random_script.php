<?php

$command = "python ../data/add_random.py";
$command .= " 2>&1";

$retour = exec($command, $output, $return_var);

var_dump($output);


echo '<br><br><a href="../admin/index.php">retour</a>';