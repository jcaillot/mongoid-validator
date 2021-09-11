<?php

declare(strict_types=1);

namespace Tests\Chaman\Validator;

use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

use Chaman\Validator\Constraints\MongoId;
use Chaman\Validator\Constraints\MongoIdValidator;

// php vendor/bin/phpunit tests/Validator/MongoIdValidatorTest.php
// php vendor/bin/phpunit tests

class MongoIdValidatorTest extends ConstraintValidatorTestCase
{
    public function testNullIsValid()
    {
        $this->validator->validate(null, new MongoId());
        // 1st assertion
        $this->assertNoViolation();
    }

    public function testUsingValidMongoIds()
    {
        /** @var \Symfony\Component\Validator\ConstraintViolationList|null $violations */
        $violations = $this->validator->validate(
            "612e33894726a713fd310aff",
            new MongoId()
        );

        $this->assertNull($violations);


        $obIds = [
            "612e33894726a713fd310aed",
            "612e33884726a713fd31009b",
            "612e33874726a713fd310028",
        ];

        foreach ($obIds as $obId) {
            $this->validator->validate($obId, new MongoId());
            $this->assertNoViolation();
        }
    }

    public function testDummyValues()
    {
        $this->expectNoValidate();

        $constraint = new MongoId();
        $invalidValue = 'foobar';
        $this->validator->validate($invalidValue, $constraint);

        $this->buildViolation($constraint->message)
            ->setParameter("{{ value }}", $invalidValue)
            ->assertRaised();
    }

    /**
     * @return MongoIdValidator
     */
    protected function createValidator(): MongoIdValidator
    {
        return new MongoIdValidator();
    }
}
