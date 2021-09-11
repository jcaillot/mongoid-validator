# chaman/mongoid

### MongoId Symfony Validator

> checks if a string is a valid MongoId

## requirements

- Symfony

- PHP MongoDB PHP Driver

[https://www.php.net/manual/en/set.mongodb.php]()

## Installation

```shell
$composer require chaman/mongoid
```

## Usage

#### As Form Annotations

```php

```

#### in PHP code

```php

use Symfony\Component\Validator\Validation;
use Chaman\Validator\Constraints\MongoId;

...
$validator = Validation::createValidator();
$constraint = new MongoId();
$id = '12345678910';


$violations = $validator->validate($id, $constraint);
if (!count($violations)) {
    ...
}

```

## License

This library is released under the [MIT license](https://github.com/rollerworks/PasswordStrengthBundle/blob/main/LICENSE).
