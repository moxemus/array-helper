## Installation

Just add the package to your project using Composer:

```bash
composer require moxemus/array-helper
```

## Usage

Add `Helper` class in your project and use like a static class:

```php
use moxemus\array\Helper as ArrayHelper;

$data = [
    'a' => 'word',
    12,5 => 23,
    null => false
];

$realFirstIndex = ArrayHelper::getFirstIndex($data); #: 'a'
$realFirstValue = ArrayHelper::getFirstValue($data); #: 'word'
```