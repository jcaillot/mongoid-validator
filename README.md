# jcaillot/mongoid

### MongoId Symfony Validator

> checks if a string is a valid MongoId

## requirements

- Symfony >=4

- PHP MongoDB PHP Driver

[https://www.php.net/manual/en/set.mongodb.php]()

## Installation

```shell
$composer require jcaillot/mongoid
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
$id = '612e33884726a713fd31009b';


$violations = $validator->validate($id, $constraint);
if (!count($violations)) {
    ...
}

```

## License

This library is released under the [MIT license](https://github.com/rollerworks/PasswordStrengthBundle/blob/main/LICENSE).
