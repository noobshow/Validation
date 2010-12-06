<?php

namespace Respect\Validation\Rules;

class OneOf extends AbstractComposite
{

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        $numRules = count($validators);
        $numExceptions = count($exceptions);
        if ($numExceptions === $numRules)
            throw $this->getException() ? : $this->createException()
                    ->configure($input, $numExceptions, 1, $numRules)
                    ->setRelated($exceptions);
        return true;
    }

    public function validate($input)
    {
        foreach ($this->getRules() as $v)
            if ($v->validate($input))
                return true;
        return false;
    }

}