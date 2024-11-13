<?php include $this->resolve("partials/_navbar.php"); ?>

<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="form-signin col-10 col-md-6 col-xl-4 m-auto">
                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>
                    <h2 class="text-white font-weight-bold my-0">Rejestracja</h2>
                    <hr class="divider">
                    <div class="form-floating mt-3">
                        <input
                            value="<?php echo e($oldFormData['name'] ?? ''); ?>"
                            type="text" class="form-control" id="floatingName" placeholder="" name="name">
                        <label for="floatingName"><i class="bi bi-person"></i>Imię</label>
                    </div>

                    <?php if (array_key_exists('name', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['name'][0]); ?>
                        </div>
                    <?php endif; ?>


                    <div class="form-floating mt-3">
                        <input value="<?php echo e($oldFormData['email'] ?? ''); ?>"
                            type="email" class="form-control" id="floatingEmail" placeholder="" name="email">
                        <label for="floatingEmail"><i class="bi bi-envelope"></i>Email</label>
                    </div>

                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['email'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-floating mt-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="" name="password">
                        <label for="floatingPassword"><i class="bi bi-key"></i>Hasło</label>
                    </div>

                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['password'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-floating mt-3">
                        <input type="password" class="form-control" id="floatingConfirmPassword" placeholder="" name="confirmPassword">
                        <label for="floatingConfirmPassword"><i class="bi bi-key"></i>Powtórz Hasło</label>
                    </div>

                    <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['confirmPassword'][0]); ?>
                        </div>
                    <?php endif; ?>


                    <div class="text-xs-center">
                        <div class="g-recaptcha mt-3" data-sitekey="6LfyKXcqAAAAAMjSemEz8nV1279FzBirGHwgwRTk"></div>
                    </div>

                    <?php if (array_key_exists('g-recaptcha-response', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['g-recaptcha-response'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <input type="submit" value="Załóż konto" class="btn btn-primary btn-xl col-12 col-sm-6 py-3 my-3" />
                </form>
            </div>
        </div>
    </div>
</header>

<?php include $this->resolve("partials/_footer.php");
