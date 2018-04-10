<?php

define('BASEPATH', '/');
define('ENVIRONMENT', '/');
require './application/config/database.php';

return [
    "paths"        => [
        "migrations" => "application/db/migrations",
        "seeds"      => "application/db/seeds",
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database"        => "dev",
        "dev"                     => [
            "adapter" => "mysql",
            "host"    => "localhost",
            "name"    => $db['default']['database'],
            "user"    => $db['default']['username'],
            "pass"    => $db['default']['password'],
        ],
    ],
];
