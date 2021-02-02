<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if($result) : ?>
                    <p>Вы Зарегестрированы!</p>
                    <?php else: ?>
                <?php if (isset($errors) and is_array($errors)) : ?>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li> - <?php echo $error;?></li>
                        <?php endforeach; ?>
                    </ul>

                <?php endif; ?>
                <div class="signup-form" style="margin-bottom: 40px;">
                    <h2>Регистрация на Сайте</h2>
                    <form action="#" method="post">
                        <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>" />
                        <input type="text" name="email" placeholder="E-mail" value="<?php echo $email; ?>" />
                        <input type="text" name="password" placeholder="Пароль" value="<?php echo $password; ?>" />
                        <button type="submit" name="submit" class="btn btn-default">Регистрация</button>
                    </form>
                </div>
                <?php endif;?>
            </div>


        </div>
    </div>
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>