<?php
//file: /.env.local.php
// return the configuration for the 'local' environment
return array(
    'db_localhost' => 'db', // use db container name to use with docker.
    'db_host'      => 'db', // else, use localhost and 127.0.0.1 dor local use
    'db_name'      => 'arquigrafia', // specify database name
    'db_user'      => 'root', // specify database username
    'db_pass'      => '', // specify database password
);

// return array(
//     'db_localhost' => 'localhost', // use db container name to use with docker.
//     'db_host'      => '127.0.0.1', // else, use localhost and 127.0.0.1 dor local use
//     'db_name'      => 'arquigrafia', // specify database name
//     'db_user'      => 'root', // specify database username
//     'db_pass'      => '@Rpa1988', // specify database password
// );