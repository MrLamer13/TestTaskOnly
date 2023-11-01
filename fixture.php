<?php

$pdo = require_once 'db.php';

$pdo->
exec(
    'DROP TABLE IF EXISTS users;
     CREATE TABLE users(
     id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
     name VARCHAR(255) NOT NULL UNIQUE,
     phone VARCHAR(100) NOT NULL UNIQUE,
     email VARCHAR(255) NOT NULL UNIQUE,
     password VARCHAR(255) NOT NULL 
);'
);