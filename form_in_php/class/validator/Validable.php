<?php
namespace validator; 

interface Validable {

    public function isValid($value);
    // public function message();
    public function getMessage();
    public function getValid();

}