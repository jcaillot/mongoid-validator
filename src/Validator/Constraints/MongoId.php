<?php

declare(strict_types=1);

namespace Chaman\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class MongoId extends Constraint
{
  /**
   * @var string
   */
  public $invalidMongoIdMessage = 'Invalid Mongo Id: "{{ value }}"';

  /**
   * @return string
   */
  public function validatedBy()
  {
    return static::class . "Validator";
  }
}
