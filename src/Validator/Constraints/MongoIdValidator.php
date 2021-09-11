<?php

declare(strict_types=1);

namespace Chaman\Validator\Constraints;

use MongoDB\BSON\ObjectId;

use MongoDB\BSONObjectId;
use MongoDB\Driver\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Throwable;

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
            /** @var BSONObjectId */
            new ObjectId($value);
            /* @var InvalidArgumentException */
        } catch (Throwable $exception) {
            $this->context
                ->buildViolation($constraint->invalidMongoIdMessage)
                ->setParameter("{{ value }}", $value)
                ->addViolation();
        }
    }
}
