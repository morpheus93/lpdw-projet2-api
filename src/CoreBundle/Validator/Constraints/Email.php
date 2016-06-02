<?php

namespace CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class Email
 * @package CoreBundle\Validator\Constraints
 */
class Email extends Constraint
{
    public $message = '"%string%" doesn\'t valid email';
}