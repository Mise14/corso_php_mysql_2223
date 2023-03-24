<?php
namespace validator; 

/**
 * - [x] Preservare il valore iniziale valido (e ripulito) del campo di testo
 * - visualizzare il messaggio di errore per il singolo campo
 *    - [x] sapere se cè un errore **is valid()**
 *    - [x] ripulire e controllare i valori (sicurezza)
 *    - ogni validazione ha il suo messaggio di errore 
 *    - impostare la classe di bootstrap is-invalid
 *    
 */

class ValidateRequired implements Validable {

 /** @var string rappresenta il valore immesso nel form ripulito */
 private $value;
 private $message;

 /** se il valore è valido e se devo visualizzare il messaggio  */
 private $valid;
 
 public function __construct($default_value='',$message='è obbligatorio') {
   $this->value = $default_value;
   $this->valid = true;
   $this->message = $message;
 }

 public function isValid($value) // ?
 {

    $strip_tag = strip_tags($value);
    $valueWidoutSpace = trim($strip_tag);
    
    if($valueWidoutSpace == ''){
       $this->valid = false;
       return false;
    }
    $this->valid = true;
    $this->value = $valueWidoutSpace;
    return $valueWidoutSpace;    
    
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