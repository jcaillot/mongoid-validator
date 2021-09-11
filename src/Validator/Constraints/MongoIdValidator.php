<?php

declare(strict_types=1);

namespace Chaman\Validator\Constraints;

use MongoDB\BSON\ObjectId;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MongoIdValidator extends ConstraintValidator
{
  public function validate($value, Constraint $constraint)
  {
    if (!$constraint instanceof MongoId) {
      throw new UnexpectedTypeException($constraint, MongoId::class);
    }

    if (null === $value || "" === $value) {
      return;
    }

    try {
      /** @var \MongoDB\BSONObjectId */
      new ObjectId($value);

      /* @var \MongoDB\Driver\Exception\InvalidArgumentException */
    } catch (\Throwable $exception) {
      $this->context
        ->buildViolation($constraint->invalidMongoIdMessage)
        ->setParameter("{{ value }}", $value)
        ->addViolation();
    }
  }
}
