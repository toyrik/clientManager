<?php include "templates/include/header.php" ?>
	  
    <form action="admin.php?action=login" method="post" style="width: 50%;">
        <input type="hidden" name="login" value="true" />

        <?php if ( isset( $results['errorMessage'] ) ):?>
                <div class="errorMessage"><?= $results['errorMessage'] ?></div>
        <?php endif; ?>

            <div class="form-group">
                <label for="username">Логин</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Your admin username" required autofocus maxlength="20" />
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
            </div>

        <div class="buttons">
            <input type="submit" name="login" value="Войти" />
        </div>

    </form>
	  
<?php include "templates/include/footer.php" ?>

