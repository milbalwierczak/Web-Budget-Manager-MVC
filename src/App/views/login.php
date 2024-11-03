<?php include $this->resolve("partials/_navbar.php"); ?>

<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="form-signin col-10 col-md-6 col-xl-4 m-auto">
                <form method="POST">
                    <?php include $this->resolve('partials/_csrf.php'); ?>
                    <h1 class="text-white font-weight-bold mb-5 mt-0">Witaj ponownie!</h1>

                    <div class="form-floating">
                        <input value="<?php echo e($oldFormData['email'] ?? ''); ?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="">
                        <label for="floatingInput"><i class="bi bi-envelope"></i> Email</label>
                    </div>

                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['email'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-floating mt-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="" name="password">
                        <label for="floatingPassword"><i class="bi bi-key"></i> Hasło</label>
                    </div>

                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['password'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-check text-start my-3">
                        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                        <label class="form-check-label text-white" for="flexCheckDefault">
                            Zapamiętaj mnie
                        </label>
                    </div>
                    <input type="submit" value="Zaloguj się" class="btn btn-primary btn-xl col-12 col-sm-6 py-3 my-3" />
                </form>
            </div>
        </div>
    </div>
</header>

<?php include $this->resolve("partials/_footer.php"); ?>