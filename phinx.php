<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => $_ENV['MODE'],
        'production' => [
            'adapter' => 'mysql',
            'host' => $_ENV['HOST'],
            'name' => $_ENV['DATABASE'],
            'user' => $_ENV['USERNAME'],
            'pass' => $_ENV['PASSWORD'],
            'port' => $_ENV['DBPORT'],
            'charset' => $_ENV['CHARSET'],
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => $_ENV['HOST'],
            'name' => $_ENV['DATABASE'],
            'user' => $_ENV['USERNAME'],
            'pass' => $_ENV['PASSWORD'],
            'port' => $_ENV['DBPORT'],
            'charset' => $_ENV['CHARSET'],
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
