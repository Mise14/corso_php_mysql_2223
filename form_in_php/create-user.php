<?php

use crud\UserCRUD;
use models\User;
use Registry\it\Provincia;
use Registry\it\Regione;
use validator\ValidateDate;
use validator\ValidateMail;
use validator\ValidateRequired;
use validator\ValidatorRunner;

require "../config.php";
require "./autoload.php";

// die();
/**
 * TODO: Implementare criteri mutipli di valiidazione (array di validazioni non singole)
 *'first_name' => [new ValidateRequired('','Il Nome è obblicatorio')],
 *'username'  => [new ValidateRequired('','Username è obbligaztorio'),new ValidateMail('','')]
 */

$validatorRunner = new ValidatorRunner([
    'first_name' => new ValidateRequired('','Il Nome è obblicatorio'),
    'last_name'  => new ValidateRequired('','Il Cognome è obblicatorio'),
    'birthday'  => new ValidateDate('','La data di nascità non è valida'),
    'gender'  => new ValidateRequired('','Il Genere è obbligatorio'),
    'birth_city'  => new ValidateRequired('','La città  è obbligatoria'),
    'regione_id'  => new ValidateRequired('','La regione è obbligatoria'),
    'provincia_id'  => new ValidateRequired('','La provincia è obbligatoria'),

    'username'  => new ValidateRequired('','Username è obbligaztorio'),
    // 'username:email'  => new ValidateMail('','Formato email non valido'),
    'password'  => new ValidateRequired('','Password è obbligatorio')
]);
extract($validatorRunner->getValidatorList());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $validatorRunner->isValid();
    var_dump($validatorRunner->isValid());
    var_dump($validatorRunner->getValid());
    
    if($validatorRunner->getValid()){

       
       $user = User::arrayToUser($_POST);
       $crud = new UserCRUD();
       $crud->create($user);
       //Redirect
       header("location: ./index-user.php");
    } else{
        echo "il form non è valido";
    }
}



?>

<?php require "./class/views/head-view.php" ?>

        <section class="row">
            <div class="col-sm-8">
                <form class="mt-1 mt-md-5" action="create-user.php" method="post">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">nome</label>
                        <input type="text" 
                            value="<?= $first_name->getValue() ?>"
                            class="form-control <?php echo !$first_name->getValid() ? 'is-invalid':''  ?>" 
                            name="first_name" 
                            id="first_name"
                        >
                      
                        <?php if (!$first_name->getValid()) : ?>
                            <div class="invalid-feedback">
                                <?php echo $first_name->getMessage() ?>
                            </div>
                        <?php endif ?>


                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">cognome</label>
                        <input type="text"
                               id="last_name"
                               value="<?= $last_name->getValue() ?>"
                               name="last_name" 
                               class="form-control <?php echo !$last_name->getValid() ? 'is-invalid':'' ?>"
                               >
                        <?php if (!$last_name->getValid()) : ?>
                            <div class="invalid-feedback">
                                <?php echo $last_name->getMessage() ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Data Di Nascita</label>
                        <input type="date"
                               value="<?= $birthday->getValue() ?>"
                               class="form-control <?php echo !$birthday->getValid() ? 'is-invalid':'' ?>" 
                               name="birthday" 
                               id="birthday">
                        
                        <?php if (!$birthday->getValid()) : ?>
                            <div class="invalid-feedback">
                                <?php echo $birthday->getMessage() ?>
                            </div>
                        <?php endif ?>
                    </div>


                <div class="mb-3">
                    <div class="row">
                    <div class="col">
                        
                        <label for="birth_city" class="form-label">Città</label>
                        <input type="text" class="form-control" name="birth_city" id="birth_city">


                    </div>
                    <div class="col">
                        
                        <label for="regione_id" class="form-label">Regione</label>
                        <select id="regione_id" class="form-select regione_id" name="regione_id">
                                <option value=""></option>
                                <?php foreach(Regione::all() as $regione) : ?> 
                                    <option value="<?= $regione->regione_id ?>"><?= $regione->nome ?></option>
                                <?php endforeach;  ?>
                        </select>

                        </div>
                        <div class="col">
                        <label for="provincia_id" class="form-label">Provincia</label>
                        <select id="provincia_id" class="form-select provincia_id" name="provincia_id">
                        <option value=""></option>
                                <?php foreach(Provincia::all() as $provincia) : ?> 
                                    <option value="<?= $provincia->provincia_id ?>"><?= $provincia->nome ?></option>
                                <?php endforeach;  ?>
                        </select>
                            
                    </div>
                    </div>
                </div>

                    <div class="mb-3">
                        <!-- <h1><?php echo $gender->getValue() == 'M' ? 'AA':'BB' ?></h1> -->
                        <label for="gender" class="form-label">Genere</label>
                        <select name="gender" class="form-select <?php echo !$gender->getValid() ? 'is-invalid' :'' ?>" id="gender">
                            <option value=""></option>
                            <option <?php echo $gender->getValue() == 'M' ? 'selected':''  ?> value="M">M</option>
                            <option <?php echo $gender->getValue() == 'F' ? 'selected':''  ?> value="F">F</option>
                        </select>
                        <?php
                        if (!$gender->getValid()) : ?>
                            <div class="invalid-feedback">
                                <?php echo $gender->getMessage() ?>  
                            </div>
                        <?php endif; ?>
                        
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nome Utente / EMAIL</label>
                        <input type="text"  value="<?php echo $username->getValue() ?>" class="form-control 
                            <?php echo (!$username->getValid() && !$username->getValid()) ? 'is-invalid':'' ?>" name="username" id="username">
                        <?php
                        //if (!$username_email->getValid()) : ?>
                            <div class="invalid-feedback">
                            <?php //echo $username_email->getMessage() ?>
                            </div>
                        <?php // endif ?>

                        <?php
                        if (!$username->getValid()) : ?>
                            <div class="invalid-feedback">
                            <?php echo $username->getMessage() ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" value="<?= $password->getValue()  ?>" id="password" name="password" class="form-control <?php echo !$password->getValid() ? 'is-invalid' : ''  ?>">
                        <?php
                        if (!$password->getValid()) : ?>
                            <div class="invalid-feedback">
                               <?php echo $password->getMessage() ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <button class="btn btn-primary btn-sm" type="submit">Registrati</button>
                </form>
            </div>
        </section>
<?php require "./class/views/footer-view.php" ?>