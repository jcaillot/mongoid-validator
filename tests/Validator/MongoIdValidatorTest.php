<?php

namespace Tests\Chaman\Validator;

use MongoDB\BSON\ObjectId;

use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Translation\DataCollectorTranslator;

use Chaman\Validator\Constraints\MongoId;
use Chaman\Validator\Constraints\MongoIdValidator;

// php bin/phpunit tests/Validator/MongoIdValidatorTest
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
        $this->validator->validate("foobar", $constraint);

        $this->buildViolation($constraint->invalidMongoIdMessage)
      ->setParameter("{{ value }}", "foobar")
      ->assertRaised();
    }

    /**
     * @return DescriptionComesWithHeadingValidator
     */
    protected function createValidator()
    {
        $translator = $this->createMock(DataCollectorTranslator::class);
        $translator
      ->expects($this->any())
      ->method("getLocale")
      ->will($this->returnValue("fr"));

        return new MongoIdValidator($translator);
    }
}
