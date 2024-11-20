<?php include $this->resolve("partials/_navbar.php"); ?>

<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="form-signin col-8 col-md-12 m-auto">
                <?php
                if (isset($_SESSION['password_changed'])) {
                    echo '<div class="success mb-2">Hasło zmienione pomyślnie!</div>';
                    unset($_SESSION['password_changed']);
                }
                ?>
                <?php
                if (isset($_SESSION['name_changed'])) {
                    echo '<div class="success mb-2">Imię zmienione pomyślnie!</div>';
                    unset($_SESSION['name_changed']);
                }
                ?>
                <h4 class="text-white font-weight-bold mb-3 mt-0">Ustawienia użytkownika</h4>

                <a data-bs-toggle="modal" data-bs-target="#changePasswordModal" class="btn btn-success col-12 col-md-3 mx-md-3 mb-3">Zmień hasło</a>
                <a data-bs-toggle="modal" data-bs-target="#changeNameModal" class="btn btn-info col-12 col-md-3  mx-md-3 mb-3">Zmień imię</a>
                <a data-bs-toggle="modal" data-bs-target="#deleteAccountModal" class="btn btn-danger col-12 col-md-3 mx-md-3 mb-3">Usuń konto</a>

                <hr class="divider">

                <h4 class="text-white font-weight-bold mb-3 mt-0">Kategorie przychodów</h4>

                <a class="btn btn-success col-12 col-md-3 mx-md-3 mb-3">Dodaj</a>
                <a class="btn btn-info col-12 col-md-3  mx-md-3 mb-3">Edytuj</a>
                <a class="btn btn-danger col-12 col-md-3 mx-md-3 mb-3">Usuń</a>

                <hr class="divider">

                <h4 class="text-white font-weight-bold mb-3 mt-0">Kategorie wydatków</h4>

                <a class="btn btn-success col-12 col-md-3 mx-md-3 mb-3">Dodaj</a>
                <a class="btn btn-info col-12 col-md-3  mx-md-3 mb-3">Edytuj</a>
                <a class="btn btn-danger col-12 col-md-3 mx-md-3 mb-3">Usuń</a>

                <hr class="divider">

                <h4 class="text-white font-weight-bold mb-3 mt-0">Metody płatności</h4>

                <a class="btn btn-success col-12 col-md-3 mx-md-3 mb-3">Dodaj</a>
                <a class="btn btn-info col-12 col-md-3  mx-md-3 mb-3">Edytuj</a>
                <a class="btn btn-danger col-12 col-md-3 mx-md-3 mb-3">Usuń</a>

            </div>
        </div>
    </div>

    <!-- Modal password change-->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ustaw nowe hasło</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="CHANGE_PASSWORD" />
                    <div class="modal-body">
                        <div class="form-floating mt-3">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="" name="currentPassword">
                            <label for="floatingPassword"><i class="bi bi-key"></i>Dotychczasowe hasło</label>
                        </div>

                        <?php if (array_key_exists('currentPassword', $errors)) : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['currentPassword'][0]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-floating mt-3">
                            <input type="password" class="form-control" id="floatingConfirmPassword" placeholder="" name="newPassword">
                            <label for="floatingConfirmPassword"><i class="bi bi-key"></i>Nowe hasło</label>
                        </div>

                        <?php if (array_key_exists('newPassword', $errors)) : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['newPassword'][0]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-floating mt-3">
                            <input type="password" class="form-control" id="floatingConfirmPassword" placeholder="" name="confirmNewPassword">
                            <label for="floatingConfirmPassword"><i class="bi bi-key"></i>Powtórz nowe hasło</label>
                        </div>

                        <?php if (array_key_exists('confirmNewPassword', $errors)) : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['confirmNewPassword'][0]); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Zmień hasło" class="btn btn-primary" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (array_key_exists('currentPassword', $errors) || array_key_exists('newPassword', $errors)  || array_key_exists('confirmNewPassword', $errors)): ?>
                    $('#changePasswordModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>


    <!-- Modal name change-->
    <div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ustaw nowe imię</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="CHANGE_NAME" />
                    <div class="modal-body">
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="floatingName" placeholder="" name="name">
                            <label for="floatingName"><i class="bi bi-person"></i>Nowe imię</label>
                        </div>

                        <?php if (array_key_exists('name', $errors)) : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['name'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Zmień imię" class="btn btn-primary" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (array_key_exists('name', $errors)): ?>
                    $('#changeNameModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

    <!-- Modal delete account-->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Usuwanie konta</h5>
                </div>

                <div class="modal-body">
                    <p style="text-align: center;">Usuwając konto, usuwasz także wszystkie zapisane transakcje oraz ustawienia konta.</p>
                    <p style="text-align: center; font-weight: bold">Czy na pewno chcesz usunąć konto?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <a href="/deleteAccount" class="btn btn-danger">Usuń konto</a>
                </div>
                </form>
            </div>
        </div>
    </div>

</header>

<?php include $this->resolve("partials/_footer.php"); ?>