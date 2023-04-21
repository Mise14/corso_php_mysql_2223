<?php
use crud\UserCRUD;

require "./config.php";
require "./autoload.php";

$users = (new UserCRUD())->read();

?>



<?php require "./class/views/head-view.php" ?>

<table class="table">
    <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Comune</th>
        <th>Azioni</th>
    </tr>
    <?php foreach($users as $user){ ?>
    <tr>
        <td> <?= $user->user_id ?> </td>
        <td> <?= $user->first_name ?> </td>
        <td> <?= $user->last_name ?> </td>
        <td> <?= $user->birth_city ?> </td>
        <td>
          <a href="edit-user.php ?user_id=<?= $user->user_id ?>" class="btn btn-sm btn-primary"> modifica</a>
          <a href="delete-user.php?user_id=<?= $user->user_id ?>" class="btn btn-sm btn-danger"> elimina</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php require "./class/views/footer-view.php" ?>



