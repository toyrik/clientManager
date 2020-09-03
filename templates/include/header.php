<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo htmlspecialchars($results['pageTitle'])?></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    
                    <nav class="navbar main-navbar navbar-expand-lg navbar-dark bg-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                           <ul class="navbar-nav main-nav">
                               <li class="nav-item ">
                                   <a class="nav-link" href="/"> Главная </a>
                               </li>
                               <li class="nav-item ">
                                   <a class="nav-link" href="admin.php"> Управление </a>
                               </li>
                           </ul>
                            <?php if ($_SESSION) : ?>
                            <ul class="navbar-nav user-nav">
                                <li class="nav-item">
                                <span>Вы авторизованы как <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>.</span>
                                   <a href="admin.php?action=logout"?>Выход</a>
                               </li>
                            </ul>
                            <?php endif; ?>
                          </div>
                    </nav>
                </div>
            </div>
            

              