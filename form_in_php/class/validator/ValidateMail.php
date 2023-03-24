<?php
namespace validator;

class ValidateMail implements Validable {

 /** @var string rappresenta il valore immesso nel form ripulito */
 private $value;
 private $message;
 /** se il valore è valido e se devo visualizzare il messaggio  */
 private $valid;

    public function __construct($default_value='',$message='deve essere una email') {
        $this->value = $default_value;
        $this->valid = true;
        $this->message = $message;
      }
     

    public function isValid(mixed $email) : bool {
        $strip_tag = strip_tags($email);
        $valueWidoutSpace = trim($strip_tag);
        return filter_var($valueWidoutSpace,FILTER_VALIDATE_EMAIL);
    }

    public function getValue()
    {
      return $this->value;
    }
   
    public function getMessage()
    {
      return $this->message;
    }
   
    public function getValid()
    {
      return $this->valid;
    }
}