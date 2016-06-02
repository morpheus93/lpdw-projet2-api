<?php

namespace CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class Password
 * @package CoreBundle\Validator\Constraints
 */
class Password extends Constraint
{
    public $message = '"%string%" doesn\'t valid password';
}