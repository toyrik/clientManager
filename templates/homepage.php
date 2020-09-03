
<?php include "templates/include/header.php"; ?>
    <?php foreach ($results['users'] as $user) : ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><?= $user->name; ?></h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?= $user->phone; ?></p>
            <p class="card-text"><?= $user->email; ?></p>
            <?php if($_SESSION): ?>
            <a href="admin.php?action=editUser&amp;userId=<?php echo $user->id ?>" class="card-link">Редактировать клиента</a>
            <a href="admin.php?action=deleteUser&amp;userId=<?php echo $user->id ?>" class="card-link">Удалить клиента</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
<?php include "templates/include/footer.php"; ?>
    
