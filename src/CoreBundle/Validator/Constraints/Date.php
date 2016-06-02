<?php

namespace CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class Date
 * @package CoreBundle\Validator\Constraints
 */
class Date extends Constraint
{
    public $message = '"%string%" doesn\'t a valid date';
}