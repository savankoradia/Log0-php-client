# Log0-php-client
Log PHP Exception

#How to install?
```shell
- composer require log0/php-client
- composer require log0/php-client "@dev"
```

# Core PHP Usage
To use this library with code php code, make following configurations:

```php
require_once 'vendor/autoload.php';
use Log0\Exceptioner\Core\Handler;
Handler::init();
```

# CakePHP 3 Usage
To use this library with CakePHP 3, make following configurations:

```php
#boostrap.php
use Log0\Exceptioner\Cake3\Error as Log0Error;
Configure::write('Error.exceptionRenderer', 'Log0\Exceptioner\Cake3\Renderer');
(new Log0Error(Configure::read('Error')))->register();
```