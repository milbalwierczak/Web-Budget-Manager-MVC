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

                <?php
                if (isset($_SESSION['income_category_added'])) {
                    echo '<div class="success mb-2">Nowa kateogria przychodu dodana pomyślnie!</div>';
                    unset($_SESSION['income_category_added']);
                }
                ?>
                <?php
                if (isset($_SESSION['income_category_edited'])) {
                    echo '<div class="success mb-2">Kateogria przychodu edytowana pomyślnie!</div>';
                    unset($_SESSION['income_category_edited']);
                }
                ?>
                <?php
                if (isset($_SESSION['income_category_deleted'])) {
                    echo '<div class="success mb-2">Kateogria przychodu usunięta pomyślnie!</div>';
                    unset($_SESSION['income_category_deleted']);
                }
                ?>
                <h4 class="text-white font-weight-bold mb-3 mt-0">Kategorie przychodów</h4>

                <a data-bs-toggle="modal" data-bs-target="#addIncomeCategoryModal" class="btn btn-success col-12 col-md-3 mx-md-3 mb-3">Dodaj</a>
                <a data-bs-toggle="modal" data-bs-target="#editIncomeCategoryModal" class="btn btn-info col-12 col-md-3  mx-md-3 mb-3">Edytuj</a>
                <a data-bs-toggle="modal" data-bs-target="#deleteIncomeCategoryModal" class="btn btn-danger col-12 col-md-3 mx-md-3 mb-3">Usuń</a>

                <hr class="divider">

                <?php
                if (isset($_SESSION['expense_category_added'])) {
                    echo '<div class="success mb-2">Nowa kateogria wydatku dodana pomyślnie!</div>';
                    unset($_SESSION['expense_category_added']);
                }
                ?>
                <?php
                if (isset($_SESSION['expense_category_edited'])) {
                    echo '<div class="success mb-2">Kateogria wydatku edytowana pomyślnie!</div>';
                    unset($_SESSION['expense_category_edited']);
                }
                ?>
                <?php
                if (isset($_SESSION['expense_category_deleted'])) {
                    echo '<div class="success mb-2">Kateogria wydatku usunięta pomyślnie!</div>';
                    unset($_SESSION['expense_category_deleted']);
                }
                ?>

                <h4 class="text-white font-weight-bold mb-3 mt-0">Kategorie wydatków</h4>

                <a data-bs-toggle="modal" data-bs-target="#addExpenseCategoryModal" class="btn btn-success col-12 col-md-3 mx-md-3 mb-3">Dodaj</a>
                <a data-bs-toggle="modal" data-bs-target="#editExpenseCategoryModal" class="btn btn-info col-12 col-md-3  mx-md-3 mb-3">Edytuj</a>
                <a data-bs-toggle="modal" data-bs-target="#deleteExpenseCategoryModal" class="btn btn-danger col-12 col-md-3 mx-md-3 mb-3">Usuń</a>

                <hr class="divider">

                <?php
                if (isset($_SESSION['payment_method_added'])) {
                    echo '<div class="success mb-2">Nowa metoda płatności dodana pomyślnie!</div>';
                    unset($_SESSION['payment_method_added']);
                }
                ?>
                <?php
                if (isset($_SESSION['payment_method_edited'])) {
                    echo '<div class="success mb-2">Metoda płatności edytowana pomyślnie!</div>';
                    unset($_SESSION['payment_method_edited']);
                }
                ?>
                <?php
                if (isset($_SESSION['payment_method_deleted'])) {
                    echo '<div class="success mb-2">Metoda płatności usunięta pomyślnie!</div>';
                    unset($_SESSION['payment_method_deleted']);
                }
                ?>

                <h4 class="text-white font-weight-bold mb-3 mt-0">Metody płatności</h4>

                <a data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal" class="btn btn-success col-12 col-md-3 mx-md-3 mb-3">Dodaj</a>
                <a data-bs-toggle="modal" data-bs-target="#editPaymentMethodModal" class="btn btn-info col-12 col-md-3  mx-md-3 mb-3">Edytuj</a>
                <a data-bs-toggle="modal" data-bs-target="#deletePaymentMethodModal" class="btn btn-danger col-12 col-md-3 mx-md-3 mb-3">Usuń</a>

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
                    <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <input type="hidden" name="_METHOD" value="DELETE_ACCOUNT" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Usuń konto" class="btn btn-danger" data-bs-dismiss="modal" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add income category -->
    <div class="modal fade" id="addIncomeCategoryModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Dodaj kategorię przychodu</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="ADD_INCOME_CATEGORY" />
                    <div class="modal-body">
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="floatingName" placeholder="" name="newIncomeCategory">
                            <label for="floatingName"><i class="bi bi-tag"></i>Nowa kategoria</label>
                        </div>

                        <?php if (array_key_exists('newIncomeCategory', $errors) && $oldFormData['_METHOD'] == 'ADD_INCOME_CATEGORY') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['newIncomeCategory'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Dodaj" class="btn btn-success" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (array_key_exists('newIncomeCategory', $errors) && $oldFormData['_METHOD'] == 'ADD_INCOME_CATEGORY'): ?>
                    $('#addIncomeCategoryModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

    <!-- Modal edit income category -->
    <div class="modal fade" id="editIncomeCategoryModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edytuj kategorię przychodu</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="EDIT_INCOME_CATEGORY" />
                    <div class="modal-body">

                        <div class="form-floating mt-3">
                            <select class="form-select <?php echo isset($oldFormData['category']) ? 'has-value' : ''; ?>" id="floatingCategory" name="category">
                                <option hidden disabled selected value></option>
                                <?php foreach ($incomeCategories as $category):
                                    $selected = '';
                                    if (isset($oldFormData['category']) && $oldFormData['category'] == $category['name']  && $oldFormData['_METHOD'] == 'EDIT_INCOME_CATEGORY') {
                                        $selected = 'selected';
                                    }
                                    echo '<option value="' . e($category['name']) . '" ' . $selected . '>' . e($category['name']) . '</option>';
                                endforeach; ?>
                            </select>
                            <label for="floatingCategory"><i class="bi bi-tag"></i>Dotychczasowa kategoria</label>
                        </div>

                        <?php if (array_key_exists('category', $errors) && $oldFormData['_METHOD'] == 'EDIT_INCOME_CATEGORY') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['category'][0]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="floatingName" placeholder="" name="newIncomeCategory">
                            <label for="floatingName"><i class="bi bi-tag"></i>Nowa nazwa</label>
                        </div>

                        <?php if (array_key_exists('newIncomeCategory', $errors) && $oldFormData['_METHOD'] == 'EDIT_INCOME_CATEGORY') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['newIncomeCategory'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <p style="text-align: center">Uwaga: Zmieniając nazwę kategorii zmieniasz także kategorię przypisaną do dotychczasowych przychodów.</p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Zmień nazwę" class="btn btn-primary" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if ((array_key_exists('newIncomeCategory', $errors) || (array_key_exists('category', $errors))) && $oldFormData['_METHOD'] == 'EDIT_INCOME_CATEGORY'): ?>
                    $('#editIncomeCategoryModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

    <!-- Modal delete income category -->
    <div class="modal fade" id="deleteIncomeCategoryModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Usuń kategorię przychodu</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="DELETE_INCOME_CATEGORY" />
                    <div class="modal-body">

                        <div class="form-floating mt-3">
                            <select class="form-select <?php echo isset($oldFormData['category']) ? 'has-value' : ''; ?>" id="floatingCategory" name="category">
                                <option hidden disabled selected value></option>
                                <?php foreach ($incomeCategories as $category):
                                    $selected = '';
                                    if (isset($oldFormData['category']) && $oldFormData['category'] == $category['name']  && $oldFormData['_METHOD'] == 'DELETE_INCOME_CATEGORY') {
                                        $selected = 'selected';
                                    }
                                    echo '<option value="' . e($category['name']) . '" ' . $selected . '>' . e($category['name']) . '</option>';
                                endforeach; ?>
                            </select>
                            <label for="floatingCategory"><i class="bi bi-tag"></i>Kategoria</label>
                        </div>

                        <?php if (array_key_exists('category', $errors) && $oldFormData['_METHOD'] == 'DELETE_INCOME_CATEGORY') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['category'][0]); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <p style="text-align: center">Uwaga: Dotychczasowe przychody z usuwaną kategorią, zmienią kategorię na "inne"</p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Usuń kategorię" class="btn btn-danger" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (array_key_exists('category', $errors) && $oldFormData['_METHOD'] == 'DELETE_INCOME_CATEGORY'): ?>
                    $('#deleteIncomeCategoryModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

    <!-- Modal add expense category -->
    <div class="modal fade" id="addExpenseCategoryModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Dodaj kategorię wydatku</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="ADD_EXPENSE_CATEGORY" />
                    <div class="modal-body">
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="floatingName" placeholder="" name="newExpenseCategory">
                            <label for="floatingName"><i class="bi bi-tag"></i>Nowa kategoria</label>
                        </div>

                        <?php if (array_key_exists('newExpenseCategory', $errors) && $oldFormData['_METHOD'] == 'ADD_EXPENSE_CATEGORY') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['newExpenseCategory'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Dodaj" class="btn btn-success" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (array_key_exists('newExpenseCategory', $errors) && $oldFormData['_METHOD'] == 'ADD_EXPENSE_CATEGORY'): ?>
                    $('#addExpenseCategoryModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

    <!-- Modal edit expense category -->
    <div class="modal fade" id="editExpenseCategoryModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edytuj kategorię wydatku</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="EDIT_EXPENSE_CATEGORY" />
                    <div class="modal-body">

                        <div class="form-floating mt-3">
                            <select class="form-select <?php echo isset($oldFormData['category']) ? 'has-value' : ''; ?>" id="floatingExpenseCategory" name="category">
                                <option hidden disabled selected value></option>
                                <?php foreach ($expenseCategories as $category):
                                    $selected = '';
                                    if (isset($oldFormData['category']) && $oldFormData['category'] == $category['name'] && $oldFormData['_METHOD'] == 'EDIT_EXPENSE_CATEGORY') {
                                        $selected = 'selected';
                                    }
                                    echo '<option value="' . e($category['name']) . '" ' . $selected . '>' . e($category['name']) . '</option>';
                                endforeach; ?>
                            </select>
                            <label for="floatingExpenseCategory"><i class="bi bi-tag"></i>Dotychczasowa kategoria</label>
                        </div>

                        <?php if (array_key_exists('category', $errors) && $oldFormData['_METHOD'] == 'EDIT_EXPENSE_CATEGORY') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['category'][0]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="floatingExpenseName" placeholder="" name="newExpenseCategory">
                            <label for="floatingExpenseName"><i class="bi bi-tag"></i>Nowa nazwa</label>
                        </div>

                        <?php if (array_key_exists('newExpenseCategory', $errors) && $oldFormData['_METHOD'] == 'EDIT_EXPENSE_CATEGORY') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['newExpenseCategory'][0]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckAddLimit">
                            <label class="form-check-label" for="flexCheckAddLimit">
                                Dodaj limit dla kategorii
                            </label>
                        </div>

                        <div class="form-floating" id="floatingLimitContainer" style="display: none;">
                            <input value="<?php echo e($oldFormData['value'] ?? ''); ?>"
                                type="number" step=0.01 class="form-control" id="floatingLimit" placeholder="" name="value">
                            <label for="floatingLimit"><i class="bi bi-currency-dollar"></i>Limit</label>
                        </div>

                        <?php if (array_key_exists('value', $errors)) : ?>
                            <div class="error">
                                <?php echo e($errors['value'][0]); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <p style="text-align: center">Uwaga: Zmieniając nazwę kategorii zmieniasz także kategorię przypisaną do dotychczasowych wydatków.</p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Potwierdź" class="btn btn-primary" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if ((array_key_exists('newExpenseCategory', $errors) || (array_key_exists('category', $errors))) && $oldFormData['_METHOD'] == 'EDIT_EXPENSE_CATEGORY'): ?>
                    $('#editExpenseCategoryModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

    <!-- Modal delete expense category -->
    <div class="modal fade" id="deleteExpenseCategoryModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Usuń kategorię wydatku</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="DELETE_EXPENSE_CATEGORY" />
                    <div class="modal-body">

                        <div class="form-floating mt-3">
                            <select class="form-select <?php echo isset($oldFormData['category']) ? 'has-value' : ''; ?>" id="floatingCategory" name="category">
                                <option hidden disabled selected value></option>
                                <?php foreach ($expenseCategories as $category):
                                    $selected = '';
                                    if (isset($oldFormData['category']) && $oldFormData['category'] == $category['name'] && $oldFormData['_METHOD'] == 'DELETE_EXPENSE_CATEGORY') {
                                        $selected = 'selected';
                                    }
                                    echo '<option value="' . e($category['name']) . '" ' . $selected . '>' . e($category['name']) . '</option>';
                                endforeach; ?>
                            </select>
                            <label for="floatingCategory"><i class="bi bi-tag"></i>Kategoria</label>
                        </div>

                        <?php if (array_key_exists('category', $errors) && $oldFormData['_METHOD'] == 'DELETE_EXPENSE_CATEGORY') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['category'][0]); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <p style="text-align: center">Uwaga: Dotychczasowe wydatki z usuwaną kategorią, zmienią kategorię na "inne"</p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Usuń kategorię" class="btn btn-danger" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (array_key_exists('category', $errors) && $oldFormData['_METHOD'] == 'DELETE_EXPENSE_CATEGORY'): ?>
                    $('#deleteExpenseCategoryModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>


    <!-- Modal add payment method -->
    <div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Dodaj metodę płatności</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="ADD_PAYMENT_METHOD" />
                    <div class="modal-body">
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="floatingName" placeholder="" name="newPaymentMethod">
                            <label for="floatingName"><i class="bi bi-tag"></i>Nowa metoda płatności</label>
                        </div>

                        <?php if (array_key_exists('newPaymentMethod', $errors) && $oldFormData['_METHOD'] == 'ADD_PAYMENT_METHOD') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['newPaymentMethod'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Dodaj" class="btn btn-success" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (array_key_exists('newPaymentMethod', $errors) && $oldFormData['_METHOD'] == 'ADD_PAYMENT_METHOD'): ?>
                    $('#addPaymentMethodModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

    <!-- Modal edit payment method -->
    <div class="modal fade" id="editPaymentMethodModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edytuj metodę płatności</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="EDIT_PAYMENT_METHOD" />
                    <div class="modal-body">

                        <div class="form-floating mt-3">
                            <select class="form-select <?php echo isset($oldFormData['method']) ? 'has-value' : ''; ?>" id="floatingCategory" name="method">
                                <option hidden disabled selected value></option>
                                <?php foreach ($paymentMethods as $method):
                                    $selected = '';
                                    if (isset($oldFormData['method']) && $oldFormData['method'] == $method['name'] && $oldFormData['_METHOD'] == 'EDIT_PAYMENT_METHOD') {
                                        $selected = 'selected';
                                    }
                                    echo '<option value="' . e($method['name']) . '" ' . $selected . '>' . e($method['name']) . '</option>';
                                endforeach; ?>
                            </select>
                            <label for="floatingCategory"><i class="bi bi-tag"></i>Dotychczasowa metoda płatności</label>
                        </div>

                        <?php if (array_key_exists('method', $errors) && $oldFormData['_METHOD'] == 'EDIT_PAYMENT_METHOD') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['method'][0]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="floatingName" placeholder="" name="newPaymentMethod">
                            <label for="floatingName"><i class="bi bi-tag"></i>Nowa nazwa</label>
                        </div>

                        <?php if (array_key_exists('newPaymentMethod', $errors) && $oldFormData['_METHOD'] == 'EDIT_PAYMENT_METHOD') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['newPaymentMethod'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <p style="text-align: center">Uwaga: Zmieniając nazwę metody płatności zmieniasz także metodę płatności przypisaną do dotychczasowych wydatków.</p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Zmień nazwę" class="btn btn-primary" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if ((array_key_exists('newPaymentMethod', $errors) || (array_key_exists('method', $errors))) && $oldFormData['_METHOD'] == 'EDIT_PAYMENT_METHOD'): ?>
                    $('#editPaymentMethodModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

    <!-- Modal delete payment method -->
    <div class="modal fade" id="deletePaymentMethodModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Usuń metodę płatności</h5>
                </div>

                <form method="post">
                    <?php include $this->resolve('partials/_csrf.php'); ?>

                    <input type="hidden" name="_METHOD" value="DELETE_PAYMENT_METHOD" />
                    <div class="modal-body">

                        <div class="form-floating mt-3">
                            <select class="form-select <?php echo isset($oldFormData['method']) ? 'has-value' : ''; ?>" id="floatingCategory" name="method">
                                <option hidden disabled selected value></option>
                                <?php foreach ($paymentMethods as $method):
                                    $selected = '';
                                    if (isset($oldFormData['method']) && $oldFormData['method'] == $method['name'] && $oldFormData['_METHOD'] == 'DELETE_PAYMENT_METHOD') {
                                        $selected = 'selected';
                                    }
                                    echo '<option value="' . e($method['name']) . '" ' . $selected . '>' . e($method['name']) . '</option>';
                                endforeach; ?>
                            </select>
                            <label for="floatingCategory"><i class="bi bi-tag"></i>Metoda płatności</label>
                        </div>

                        <?php if (array_key_exists('method', $errors) && $oldFormData['_METHOD'] == 'DELETE_PAYMENT_METHOD') : ?>
                            <div class="d-flex error justify-content-center">
                                <?php echo e($errors['method'][0]); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <p style="text-align: center">Uwaga: Dotychczasowe wydatki z usuwaną metodą płatności, zmienią metodę płatności na "gotówka"</p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <input type="submit" value="Usuń metodę" class="btn btn-danger" data-bs-dismiss="modal" />
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                <?php if (array_key_exists('method', $errors) && $oldFormData['_METHOD'] == 'DELETE_PAYMENT_METHOD'): ?>
                    $('#deletePaymentMethodModal').modal('show');
                <?php endif; ?>
            });
        </script>

    </div>

</header>


<script>
    var formSelects = document.getElementsByClassName('form-select');

    for (i = 0; i < formSelects.length; i++) {
        formSelects[i].addEventListener('change', function() {
            if (this.value) {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    }
</script>

<?php include $this->resolve("partials/_footer.php"); ?>