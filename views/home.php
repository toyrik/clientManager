<?php
/**
 * @var $this \app\core\View
 */
$this->title = 'Home';

?>
<h1>Home</h1>
<h3>Welcome <?= $name; ?></h3>

<table id="myTable" class="table table-striped tablesorter">
    <thead>
        <tr class="thead-light">
            <th scope="col">Имя</th>
            <th scope="col">Телефон</th>
            <th scope="col">E-mail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customers as $customer) : ?>

        <tr>

            <td>
                <?php echo $customer['name'] ?>
            </td>
            <td>
                <?= $customer['phone'] ?>
            </td>
            <td>
                <?= $customer['email'] ?>
            </td>
            <td>
                <a href="/delete-customer?id=<?= $customer['id'] ?>">Удалить</a>
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>

</table>
