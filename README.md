[![](https://img.shields.io/packagist/v/kafene/str_putcsv.svg)](https://packagist.org/packages/kafene/str_putcsv)

# str_putcsv

The missing `str_putcsv` function for php.

Works analogous to https://www.php.net/manual/function.str-getcsv.php

## Installation

    composer require kafene/str_putcsv

## Usage

```php
<?php declare(strict_types=1);

require 'vendor/autoload.php';

$entries = [
    [1, 'a'],
    [2, 'b'],
];

$csv = '';
foreach($entries as $entry){
    $csv .= str_putcsv($entry) . PHP_EOL;
}
var_dump($csv);
```

Result

```
string(8) "1,a
2,b
"
```

## Credits

Implemented based on these resources:

- https://gist.github.com/johanmeiring/2894568
- https://secure.php.net/manual/en/function.str-getcsv.php#88773
- https://secure.php.net/manual/en/function.str-getcsv.php#91170
- https://secure.php.net/manual/en/function.fputcsv.php
