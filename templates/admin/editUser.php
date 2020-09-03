<?php include "templates/include/header.php" ?>
<?php include "templates/admin/include/header.php" ?>
<!--<?php
echo "<pre>";
print_r($results);
print_r($data);
echo "</pre>";
?> Данные о массиве $results и типе формы передаются корректно-->

<h1><?php echo $results['pageTitle'] ?></h1>

<form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post">
    <input type="hidden" name="userId" value="<?php echo $results['user']->id ?>">

    <?php if (isset($results['errorMessage'])) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
    <?php } ?>

    <div>

        <div class="form-group">
            <label for="name">Имя клиента</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Имя клиента" autofocus maxlength="255" value="<?= htmlspecialchars($results['user']->name) ?>" required/>
        </div>

        <div class="form-group">
            <label for="name">Телефон клиента</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон клиента" maxlength="20" value="<?= htmlspecialchars($results['user']->phone) ?>" required/>
        </div>

        <div class="form-group">
            <label for="name">Адрес электронной почты</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Адрес электронной почты" maxlength="255" value="<?= htmlspecialchars($results['user']->email) ?>" required/>
        </div>

    <div class="buttons">
        <input type="submit" name="saveChanges" value="Сохранить" />
        <input type="submit" formnovalidate name="cancel" value="Отмена" />
    </div>

</form>

<?php if ($results['user']->id) : ?>
    <p><a href="admin.php?action=deleteUser&amp;userId=<?php echo $results['user']->id ?>" onclick="return confirm('Удалить этого клиента?')">
            Удалить клиента
        </a>
    </p>
<?php endif; ?>

<?php include "templates/include/footer.php" ?>

