# Namoz-vaqtlari-parser

## Foyalanish uchun namuna
```php
<?php
date_default_timezone_set('Asia/Tashkent');
require 'namoz.php';
$namoz = new Namoz("Tashkent", "bugungi");
var_dump($namoz->get());

Author: [Abdulaziz Nazirov](https://github.com/Nazirov-Dev)
