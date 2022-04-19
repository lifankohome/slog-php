<?php

use lifanko\Slog;

Slog::log('Hello World');

Slog::log(12345.6789);

Slog::log([1, 2, 3, 4, 5, '67890']);

Slog::log([
    'name' => 'slog',
    'function' => 'send real time log',
    'author' => [
        'name' => 'lifanko',
        'repository' => 'https://github.com/lifankohome/slog-php'
    ]
]);
