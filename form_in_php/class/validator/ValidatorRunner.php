<?php 
namespace validator;


class ValidatorRunner  
{
    private $validatorList;

    public function __construct(array $validatorList) {
        $this->validatorList = $validatorList;
    }

    public function getValidatorList()
    {
        return $this->validatorList;
    }

    public function isValid()
    {
        foreach ($this->validatorList as $name_attribute => $instance_validator) {
            if(!isset($_POST[$name_attribute])){
                $_POST[$name_attribute] = "";
            }
            $instance_validator->isValid($_POST[$name_attribute]);
        }
    }

    public function getValid(): bool
    {
        $all_valid = true;
        foreach ($this->validatorList as $key => $instance_validator) {
            $all_valid = $instance_validator->getValid() && $all_valid;
        }
        return $all_valid;
    }

}
