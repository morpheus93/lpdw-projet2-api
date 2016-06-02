<?php

namespace CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class Name
 * @package CoreBundle\Validator\Constraints
 */
class Name extends Constraint
{
    public $message = '"%string%" doesn\'t valid field';
}