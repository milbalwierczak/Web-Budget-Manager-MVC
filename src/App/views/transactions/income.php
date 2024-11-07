<?php include $this->resolve("partials/_navbar.php"); ?>

<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="form-signin col-10 col-md-6 col-xl-4 m-auto">
                <form method="post">
                    <?php include $this->resolve("partials/_csrf.php"); ?>
                    <h2 class="text-white font-weight-bold mb-5 mt-0">Wprowadź dane</h2>

                    <div class="form-floating">
                        <input value="<?php echo e($oldFormData['value'] ?? ''); ?>"
                            type="number" step=0.01 class="form-control" id="floatingValue" placeholder="" name="value">
                        <label for="floatingValue"><i class="bi bi-currency-dollar"></i> Wartość</label>
                    </div>

                    <?php if (array_key_exists('value', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['value'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-floating mt-3">
                        <input value="<?php echo e($oldFormData['date'] ?? ''); ?>"
                            type="text" class="form-control" id="floatingDate" placeholder="" name="date" autocomplete="off">
                        <label for="floatingDate"><i class="bi bi-calendar3"></i> Data</label>
                    </div>

                    <?php if (array_key_exists('date', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['date'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-floating mt-3">
                        <select class="form-select <?php echo isset($oldFormData['category']) ? 'has-value' : ''; ?>" id="floatingCategory" name="category">
                            <option hidden disabled selected value></option>
                            <?php foreach ($categories as $category):
                                $selected = '';
                                if (isset($oldFormData['category']) && $oldFormData['category'] == $category['name']) {
                                    $selected = 'selected';
                                }
                                echo '<option value="' . e($category['name']) . '" ' . $selected . '>' . e($category['name']) . '</option>';
                            endforeach; ?>
                        </select>
                        <label for="floatingCategory"><i class="bi bi-tag"></i> Kategoria</label>
                    </div>

                    <?php if (array_key_exists('category', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['category'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-floating mt-3">
                        <input value="<?php echo e($oldFormData['description'] ?? ''); ?>"
                            type="text" class="form-control" id="floatingDescription" placeholder="" name="description">
                        <label for="floatingDescription"><i class="bi bi-pencil"></i> Opis (opcjonalnie)</label>
                    </div>

                    <?php if (array_key_exists('description', $errors)) : ?>
                        <div class="error">
                            <?php echo e($errors['description'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <input type="submit" value="Dodaj przychód" class="btn btn-primary btn-xl col-12 col-sm-6 py-3 my-3" />

                    <?php
                    if (isset($_SESSION['income_added'])) {
                        echo '<div class="success">Przychód dodano pomyślnie!</div>';
                        unset($_SESSION['income_added']);
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</header>

<?php include $this->resolve("partials/_footer.php"); ?>