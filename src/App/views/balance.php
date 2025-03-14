<?php include $this->resolve("partials/_navbar.php"); ?>

<header class="masthead">
    <div class="container px-4 px-lg-5 h-75">
        <div class="row gx-4 gx-lg-5 align-items-center h-100 justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <?php
                echo '<h4 class="text-white">Bilans w okresie od ' . e(date('d-m-Y', strtotime($start_date))) .
                    ' do ' . e(date('d-m-Y', strtotime($end_date))) . ': ' . e(number_format($balance, 2, ',', '')) . ' zł</h4>'
                ?>
            </div>
            <div class="d-flex col-lg-4 justify-content-center">
                <div class="dropdown">
                    <button class="btn btn-primary btn-xl mb-3 mb-sm-0"><i class="bi bi-calendar3"></i>Wybierz okres</button>
                    <div class="dropdown-content">
                        <a class="first" href="/balance">Bieżący miesiąc</a>
                        <a href="/balancePreviousMonth">Poprzedni miesiąc</a>
                        <a href="/balanceCurrentYear">Bieżący rok</a>
                        <a class="last" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Niestandardowy okres</a>
                    </div>
                </div>
            </div>

            <!-- Modal data range-->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ustaw zakres dat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form method="post">
                            <?php include $this->resolve('partials/_csrf.php'); ?>
                            <div class="modal-body">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingDateStart" placeholder=""
                                        value="<?php echo e(date('d-m-Y', strtotime($start_date))) ?>"
                                        autocomplete="off" name="dateStart">
                                    <label for="floatingDateStart"><i class="bi bi-calendar3"></i>Data od</label>
                                </div>

                                <?php if (array_key_exists('dateStart', $errors)) : ?>
                                    <div class="error">
                                        <?php echo e($errors['dateStart'][0]); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-floating mt-3">
                                    <input type="text" class="form-control" id="floatingDateEnd" placeholder=""
                                        value="<?php echo e(date('d-m-Y', strtotime($end_date))) ?>" autocomplete="off" name="dateEnd">
                                    <label for="floatingDateEnd"><i class="bi bi-calendar3"></i>Data do</label>
                                </div>

                                <?php if (array_key_exists('dateEnd', $errors)) : ?>
                                    <div class="error">
                                        <?php echo e($errors['dateEnd'][0]); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                <input type="submit" value="Zapisz zmiany" class="btn btn-primary" data-bs-dismiss="modal" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal income details-->

            <?php foreach ($incomes as $index => $income): ?>
                <div class="modal fade" id="modalIncomeDetails<?php echo e($income['id']); ?>" tabindex="-1" aria-labelledby="modalDetailsTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailsTitle">Szczegóły przychodu</h5>
                            </div>

                            <div class="modal-body">
                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e(number_format($income['amount'], 2, ',', '')); ?></p>
                                    <label for="floatingValue"><i class="bi bi-currency-dollar"></i>Wartość [zł]</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e(date('d-m-Y', strtotime($income['date_of_income']))); ?></p>
                                    <label for="floatingValue"><i class="bi bi-calendar3"></i>Data</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e($income['name']); ?></p>
                                    <label for="floatingValue"><i class="bi bi-tag"></i>Kategoria</label>
                                </div>

                                <?php if (!empty($income['income_comment'])) : ?>
                                    <div class="form-floating">
                                        <p class="form-control form-description" id="floatingValue"><?php echo e($income['income_comment']); ?></p>
                                        <label for="floatingValue"><i class="bi bi-pencil"></i>Opis</label>
                                    </div>
                                <?php endif; ?>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Modal expense details-->

            <?php foreach ($expenses as $index => $expense): ?>
                <div class="modal fade" id="modalExpenseDetails<?php echo e($expense['id']); ?>" tabindex="-1" aria-labelledby="modalDetailsTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailsTitle">Szczegóły wydatku</h5>
                            </div>

                            <div class="modal-body">
                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e(number_format($expense['amount'], 2, ',', '')); ?></p>
                                    <label for="floatingValue"><i class="bi bi-currency-dollar"></i>Wartość [zł]</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e(date('d-m-Y', strtotime($expense['date_of_expense']))); ?></p>
                                    <label for="floatingValue"><i class="bi bi-calendar3"></i>Data</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e($expense['category_name']); ?></p>
                                    <label for="floatingValue"><i class="bi bi-tag"></i>Kategoria</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e($expense['payment_method']); ?></p>
                                    <label for="floatingValue"><i class="bi bi-credit-card"></i>Metoda płatności</label>
                                </div>

                                <?php if (!empty($expense['expense_comment'])) : ?>
                                    <div class="form-floating">
                                        <p class="form-control form-description" id="floatingValue"><?php echo e($expense['expense_comment']); ?></p>
                                        <label for="floatingValue"><i class="bi bi-pencil"></i>Opis</label>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


            <!-- Modal income edit-->

            <?php foreach ($incomes as $index => $income): ?>
                <div class="modal fade" id="modalIncomeEdit<?php echo e($income['id']); ?>" tabindex="-1" aria-labelledby="modalEditTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <form method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditTitle">Edytuj przychód</h5>
                                </div>

                                <input type="hidden" name="id" value="<?php echo e($income['id']); ?>">

                                <div class="modal-body">
                                    <input type="hidden" name="_METHOD" value="EDIT_INCOME" />

                                    <?php include $this->resolve("partials/_csrf.php"); ?>

                                    <div class="form-floating">
                                        <input value="<?php echo e(isset($oldFormData['value']) && $oldFormData['id'] == $income['id'] ? $oldFormData['value'] : $income['amount']); ?>"
                                            type="number" step=0.01 class="form-control" id="floatingValue" placeholder="" name="value">
                                        <label for="floatingValue"><i class="bi bi-currency-dollar"></i>Wartość</label>
                                    </div>

                                    <?php if (array_key_exists('value', $errors) && $oldFormData['id'] == $income['id'] && $oldFormData['_METHOD'] == 'EDIT_INCOME') : ?>
                                        <div class="error">
                                            <?php echo e($errors['value'][0]); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-floating mt-3">
                                        <input value="<?php echo e(isset($oldFormData['date']) && $oldFormData['id'] == $income['id'] ? $oldFormData['date'] : date('d-m-Y', strtotime($income['date_of_income']))); ?>"
                                            type="text" class="form-control floatingDate" id="floatingDate" placeholder="" name="date" autocomplete="off">
                                        <label for="floatingDate"><i class="bi bi-calendar3"></i>Data</label>
                                    </div>

                                    <?php if (array_key_exists('date', $errors) && $oldFormData['id'] == $income['id'] && $oldFormData['_METHOD'] == 'EDIT_INCOME') : ?>
                                        <div class="error">
                                            <?php echo e($errors['date'][0]); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-floating mt-3">
                                        <select class="form-select has-value" id="floatingCategory" name="category">
                                            <option hidden disabled selected value></option>
                                            <?php foreach ($incomeCategories as $category):
                                                $selected = '';

                                                if (isset($oldFormData['category']) && $oldFormData['id'] == $income['id'] && $oldFormData['category'] == $category['name']) {
                                                    $selected = 'selected';
                                                } elseif (isset($oldFormData['category']) && $oldFormData['id'] != $income['id'] && $income['name'] == $category['name']) {
                                                    $selected = 'selected';
                                                } elseif (!isset($oldFormData['category']) && $income['name'] == $category['name']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option value="' . e($category['name']) . '" ' . $selected . '>' . e($category['name']) . '</option>';
                                            endforeach; ?>
                                        </select>
                                        <label for="floatingCategory"><i class="bi bi-tag"></i>Kategoria</label>
                                    </div>

                                    <div class="form-floating mt-3">
                                        <input value="<?php echo e(isset($oldFormData['description']) && $oldFormData['id'] == $income['id'] ? $oldFormData['description'] : $income['income_comment']); ?>"
                                            type="text" class="form-control" id="floatingDescription" placeholder="" name="description">
                                        <label for="floatingDescription"><i class="bi bi-pencil"></i>Opis (opcjonalnie)</label>
                                    </div>

                                    <?php if (array_key_exists('description', $errors) && $oldFormData['id'] == $income['id'] && $oldFormData['_METHOD'] == 'EDIT_INCOME') : ?>
                                        <div class="error">
                                            <?php echo e($errors['description'][0]); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                    <input type="submit" value="Zapisz zmiany" class="btn btn-primary" data-bs-dismiss="modal" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


            <!-- Modal expense edit-->

            <?php foreach ($expenses as $index => $expense): ?>
                <div class="modal fade" id="modalExpenseEdit<?php echo e($expense['id']); ?>" tabindex="-1" aria-labelledby="modalEditTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <form method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditTitle">Edytuj wydatek</h5>
                                </div>

                                <input type="hidden" name="id" value="<?php echo e($expense['id']); ?>">

                                <div class="modal-body">
                                    <input type="hidden" name="_METHOD" value="EDIT_EXPENSE" />

                                    <?php include $this->resolve("partials/_csrf.php"); ?>

                                    <div class="form-floating">
                                        <input value="<?php echo e(isset($oldFormData['value']) && $oldFormData['id'] == $expense['id'] ? $oldFormData['value'] : $expense['amount']); ?>"
                                            type="number" step=0.01 class="form-control" id="floatingValue" placeholder="" name="value">
                                        <label for="floatingValue"><i class="bi bi-currency-dollar"></i>Wartość</label>
                                    </div>

                                    <?php if (array_key_exists('value', $errors) && $oldFormData['id'] == $expense['id'] && $oldFormData['_METHOD'] == 'EDIT_EXPENSE') : ?>
                                        <div class="error">
                                            <?php echo e($errors['value'][0]); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-floating mt-3">
                                        <input value="<?php echo e(isset($oldFormData['date']) && $oldFormData['id'] == $expense['id'] ? $oldFormData['date'] : date('d-m-Y', strtotime($expense['date_of_expense']))); ?>"
                                            type="text" class="form-control floatingDate" id="floatingDate" placeholder="" name="date" autocomplete="off">
                                        <label for="floatingDate"><i class="bi bi-calendar3"></i>Data</label>
                                    </div>

                                    <?php if (array_key_exists('date', $errors) && $oldFormData['id'] == $expense['id'] && $oldFormData['_METHOD'] == 'EDIT_EXPENSE') : ?>
                                        <div class="error">
                                            <?php echo e($errors['date'][0]); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-floating mt-3">
                                        <select class="form-select has-value" id="floatingCategory" name="category">
                                            <option hidden disabled selected value></option>
                                            <?php foreach ($expenseCategories as $category):
                                                $selected = '';

                                                if (isset($oldFormData['category']) && $oldFormData['id'] == $expense['id'] && $oldFormData['category'] == $category['name']) {
                                                    $selected = 'selected';
                                                } elseif (isset($oldFormData['category']) && $oldFormData['id'] != $expense['id'] && $expense['category_name'] == $category['name']) {
                                                    $selected = 'selected';
                                                } elseif (!isset($oldFormData['category']) && $expense['category_name'] == $category['name']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option value="' . e($category['name']) . '" ' . $selected . '>' . e($category['name']) . '</option>';
                                            endforeach; ?>
                                        </select>
                                        <label for="floatingCategory"><i class="bi bi-tag"></i>Kategoria</label>
                                    </div>

                                    <div class="form-floating mt-3">
                                        <select class="form-select has-value" id="floatingMethod" name="method">
                                            <option hidden disabled selected value></option>
                                            <?php foreach ($paymentMethods as $method):
                                                $selected = '';

                                                if (isset($oldFormData['method']) && $oldFormData['id'] == $expense['id'] && $oldFormData['method'] == $method['name']) {
                                                    $selected = 'selected';
                                                } elseif (isset($oldFormData['method']) && $oldFormData['id'] != $expense['id'] && $expense['payment_method'] == $method['name']) {
                                                    $selected = 'selected';
                                                } elseif (!isset($oldFormData['method']) && $expense['payment_method'] == $method['name']) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option value="' . e($method['name']) . '" ' . $selected . '>' . e($method['name']) . '</option>';
                                            endforeach; ?>
                                        </select>
                                        <label for="floatingMethod"><i class="bi bi-credit-card"></i>Metoda płatności</label>
                                    </div>

                                    <div class="form-floating mt-3">
                                        <input value="<?php echo e(isset($oldFormData['description']) && $oldFormData['id'] == $expense['id'] ? $oldFormData['description'] : $expense['expense_comment']); ?>"
                                            type="text" class="form-control" id="floatingDescription" placeholder="" name="description">
                                        <label for="floatingDescription"><i class="bi bi-pencil"></i>Opis (opcjonalnie)</label>
                                    </div>

                                    <?php if (array_key_exists('description', $errors) && $oldFormData['id'] == $expense['id'] && $oldFormData['_METHOD'] == 'EDIT_EXPENSE') : ?>
                                        <div class="error">
                                            <?php echo e($errors['description'][0]); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                    <input type="submit" value="Zapisz zmiany" class="btn btn-primary" data-bs-dismiss="modal" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Modal income delete-->

            <?php foreach ($incomes as $index => $income): ?>
                <div class="modal fade" id="modalIncomeDelete<?php echo e($income['id']); ?>" tabindex="-1" aria-labelledby="modalDeleteTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeleteTitle">Usuń przychód</h5>
                            </div>

                            <div class="modal-body">
                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e(number_format($income['amount'], 2, ',', '')); ?></p>
                                    <label for="floatingValue"><i class="bi bi-currency-dollar"></i>Wartość [zł]</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e(date('d-m-Y', strtotime($income['date_of_income']))); ?></p>
                                    <label for="floatingValue"><i class="bi bi-calendar3"></i>Data</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e($income['name']); ?></p>
                                    <label for="floatingValue"><i class="bi bi-tag"></i>Kategoria</label>
                                </div>

                                <?php if (!empty($income['income_comment'])) : ?>
                                    <div class="form-floating">
                                        <p class="form-control form-description" id="floatingValue"><?php echo e($income['income_comment']); ?></p>
                                        <label for="floatingValue"><i class="bi bi-pencil"></i>Opis</label>
                                    </div>
                                <?php endif; ?>

                                <p class="error">Czy na pewno chcesz usunąć powyższy przychód?</p>

                            </div>
                            <div class="modal-footer">
                                <form method="POST">
                                    <?php include $this->resolve("partials/_csrf.php"); ?>
                                    <input type="hidden" name="id" value="<?php echo e($income['id']); ?>">

                                    <input type="hidden" name="_METHOD" value="DELETE_INCOME" />
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                    <input type="submit" value="Usuń przychód" class="btn btn-danger" data-bs-dismiss="modal" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Modal expense delete-->

            <?php foreach ($expenses as $index => $expense): ?>
                <div class="modal fade" id="modalExpenseDelete<?php echo e($expense['id']); ?>" tabindex="-1" aria-labelledby="modalDeleteTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeleteTitle">Usuń wydatek</h5>
                            </div>

                            <div class="modal-body">
                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e(number_format($expense['amount'], 2, ',', '')); ?></p>
                                    <label for="floatingValue"><i class="bi bi-currency-dollar"></i>Wartość [zł]</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e(date('d-m-Y', strtotime($expense['date_of_expense']))); ?></p>
                                    <label for="floatingValue"><i class="bi bi-calendar3"></i>Data</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e($expense['category_name']); ?></p>
                                    <label for="floatingValue"><i class="bi bi-tag"></i>Kategoria</label>
                                </div>

                                <div class="form-floating">
                                    <p class="form-control" id="floatingValue"><?php echo e($expense['payment_method']); ?></p>
                                    <label for="floatingValue"><i class="bi bi-credit-card"></i>Metoda płatności</label>
                                </div>

                                <?php if (!empty($expense['expense_comment'])) : ?>
                                    <div class="form-floating">
                                        <p class="form-control form-description" id="floatingValue"><?php echo e($expense['expense_comment']); ?></p>
                                        <label for="floatingValue"><i class="bi bi-pencil"></i>Opis</label>
                                    </div>
                                <?php endif; ?>

                                <p class="error">Czy na pewno chcesz usunąć powyższy wydatek?</p>

                            </div>
                            <div class="modal-footer">
                                <form method="POST">
                                    <?php include $this->resolve("partials/_csrf.php"); ?>
                                    <input type="hidden" name="id" value="<?php echo e($expense['id']); ?>">

                                    <input type="hidden" name="_METHOD" value="DELETE_EXPENSE" />
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                    <input type="submit" value="Usuń wydatek" class="btn btn-danger" data-bs-dismiss="modal" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>



            <script>
                $(document).ready(function() {
                    <?php if (array_key_exists('value', $errors) || array_key_exists('date', $errors) || array_key_exists('description', $errors)) : ?>
                        <?php if ($oldFormData['_METHOD'] == 'EDIT_INCOME') : ?>
                            $('#modalIncomeEdit<?php echo e($oldFormData['id']); ?>').modal('show');
                        <?php elseif ($oldFormData['_METHOD'] == 'EDIT_EXPENSE') : ?>
                            $('#modalExpenseEdit<?php echo e($oldFormData['id']); ?>').modal('show');
                        <?php endif; ?>
                    <?php endif; ?>
                });
            </script>

            <script>
                $(document).ready(function() {
                    <?php if (array_key_exists('dateStart', $errors) || array_key_exists('dateEnd', $errors)): ?>
                        $('#exampleModalCenter').modal('show');
                    <?php endif; ?>
                });
            </script>

            <div class="row gx-4 gx-lg-5 h-75 align-items-center justify-content-center text-center">
                <div class="col-lg-6 align-self-baseline">
                    <h4 class="text-white mt-3">Wydatki</h4>
                    <div class="table-wrapper col-12">
                        <table class="table table-striped table-sm text-white ">
                            <thead class="header">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Wartość [zł]</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Kategoria</th>
                                    <th scope="col">Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($expenses as $index => $expense):
                                    echo '<tr>';
                                    echo '<td>' . ($index + 1) . '</td>';
                                    echo '<td>' . e(number_format($expense['amount'], 2, ',', '')) . '</td>';
                                    echo '<td>' . e(date('d-m-Y', strtotime($expense['date_of_expense']))) . '</td>';
                                    echo '<td>' . e($expense['category_name']) . '</td>';
                                    echo '<td>
                                    <a data-bs-toggle="modal" data-bs-target="#modalExpenseDetails' . e($expense['id'])  . '" class="text-reset text-decoration-none description" href="#"><i class="bi bi-clipboard-data"></i></a>
                                    <a data-bs-toggle="modal" data-bs-target="#modalExpenseEdit' . e($expense['id']) . '" class="text-reset text-decoration-none description" href="#"><i class="bi bi-pencil-square"></i></a>
                                    <a data-bs-toggle="modal" data-bs-target="#modalExpenseDelete' . e($expense['id']) . '" class="text-reset text-decoration-none description" href="#"><i class="bi last bi-trash"></i></a></td>';
                                    echo '</tr>';
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 align-self-baseline">
                    <h4 class="text-white mt-3">Przychody</h4>
                    <div class="table-wrapper col-12">
                        <table class="table table-striped table-sm text-white ">
                            <thead class="header">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Wartość [zł]</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Kategoria</th>
                                    <th scope="col">Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($incomes as $index => $income):
                                    echo '<tr>';
                                    echo '<td>' . ($index + 1) . '</td>';
                                    echo '<td>' . e(number_format($income['amount'], 2, ',', '')) . '</td>';
                                    echo '<td>' . e(date('d-m-Y', strtotime($income['date_of_income']))) . '</td>';
                                    echo '<td>' . e($income['name']) . '</td>';
                                    echo '<td>
                                    <a data-bs-toggle="modal" data-bs-target="#modalIncomeDetails' . e($income['id']) . '" class="text-reset text-decoration-none" href="#"><i class="bi bi-clipboard-data"></i></a>
                                    <a data-bs-toggle="modal" data-bs-target="#modalIncomeEdit' . e($income['id']) . '" class="text-reset text-decoration-none" href="#"><i class="bi bi-pencil-square"></i></a>
                                    <a data-bs-toggle="modal" data-bs-target="#modalIncomeDelete' . e($income['id']) . '" class="text-reset text-decoration-none" href="#"><i class="bi last bi-trash"></i></a>
                                        </td>';
                                    echo '</tr>';
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <h4 class="text-white m-0">Struktura wydatków w wybranym okresie</h4>

                <div class="container mt-3 pie-chart h-25 w-lg-50">
                    <canvas id="myChart"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    const ctx = document.getElementById('myChart');

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: <?php echo json_encode($expenses_labels); ?>,
                            datasets: [{
                                data: <?php echo json_encode($expenses_data); ?>
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'right',
                                    labels: {
                                        color: 'white',
                                        font: {
                                            family: 'serif',
                                            size: '16px'
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
</header>

<?php include $this->resolve("partials/_footer.php"); ?>