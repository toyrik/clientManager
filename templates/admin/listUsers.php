<?php include "templates/include/header.php" ?>
<?php include "templates/admin/include/header.php" ?>

<h1>Все клиенты</h1>

<?php if (isset($results['errorMessage'])) : ?>
    <div class="alert alert-danger" role="alert"><?php echo $results['errorMessage'] ?></div>
<?php endif; ?>


<?php if (isset($results['statusMessage'])) : ?>
    <div class="alert alert-primary" role="alert"><?php echo $results['statusMessage'] ?></div>
<?php endif; ?>

<!--<?php
    echo "<pre>";
    print_r($data);
    print_r($_POST);
    echo "<pre>";
?>!-->
<table class="table table-striped">
    <thead>
        <tr class="thead-light">
            <th scope="col">Имя</th>
            <th scope="col">Телефон</th>
            <th scope="col">E-mail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results['users'] as $user) : ?>

        <tr onclick="location = 'admin.php?action=editUser&amp;userId=<?php echo $user->id ?>'" style="cursor: pointer">

            <td>
                <?php echo $user->name ?>
            </td>
            <td>
                <?= $user->phone ?>
            </td>
            <td>
                <?= $user->email ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>

</table>

<p> Всего клиентов: <?= $results['totalRows'] ?></p>

<p><a href="admin.php?action=newUser">Добавить нового клиента</a></p>

<?php include "templates/include/footer.php" ?>