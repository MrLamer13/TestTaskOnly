<?php

return new PDO(
    dsn: 'sqlite:db.sqlite',
    options: [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);