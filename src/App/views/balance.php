<?php include $this->resolve("partials/_navbar.php"); ?>

<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <?php
                echo '<h2 class="text-white">Bilans w okresie od ' . e(date('d-m-Y', strtotime($start_date))) .
                    ' do ' . e(date('d-m-Y', strtotime($end_date))) . ': ' . e(number_format($balance, 2, ',', '')) . ' zł</h2>'
                ?>
            </div>
            <div class="col-lg-4 align-self-center">
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

            <!-- Modal -->
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

            <script>
                $(document).ready(function() {
                    <?php if (array_key_exists('dateStart', $errors) || array_key_exists('dateEnd', $errors)): ?>
                        $('#exampleModalCenter').modal('show');
                    <?php endif; ?>
                });
            </script>

            <div class="row gx-4 gx-lg-5 align-items-center justify-content-center text-center">
                <div class="col-lg-6 align-self-baseline">
                    <h2 class="text-white mt-3">Wydatki</h2>
                    <div class="table-wrapper col-12">
                        <table class="table table-striped table-sm text-white ">
                            <thead class="header">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Wartość [zł]</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Kategoria</th>
                                    <th scope="col">Szczegóły</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($expenses as $index => $expense):
                                    echo '<tr>';
                                    echo '<td>' . ($index + 1) . '</td>';
                                    echo '<td>' . e(number_format($expense['amount'], 2, ',', '')) . '</td>';
                                    echo '<td>' . e(date('d-m-Y', strtotime($expense['date_of_expense']))) . '</td>';
                                    echo '<td>' . e($expense['name']) . '</td>';
                                    echo '<td><a class="text-reset text-decoration-none description" href="#">Kliknij</a></td>';
                                    echo '</tr>';
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="container mt-1 pie-chart">
                        <canvas id="myChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: <?php echo json_encode($expenses_labels); ?>,
                                datasets: [{
                                    data: <?php echo json_encode($expenses_data); ?>
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    </script>

                </div>
                <div class="col-lg-6 align-self-baseline">
                    <h2 class="text-white mt-3">Przychody</h2>
                    <div class="table-wrapper col-12">
                        <table class="table table-striped table-sm text-white ">
                            <thead class="header">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Wartość [zł]</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Kategoria</th>
                                    <th scope="col">Szczegóły</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($incomes as $index => $income):
                                    echo '<tr>';
                                    echo '<td>' . ($index + 1) . '</td>';
                                    echo '<td>' . e(number_format($income['amount'], 2, ',', '')) . '</td>';
                                    echo '<td>' . e(date('d-m-Y', strtotime($income['date_of_income']))) . '</td>';
                                    echo '<td>' . e($income['name']) . '</td>';
                                    echo '<td><a class="text-reset text-decoration-none description" href="#">Kliknij</a></td>';
                                    echo '</tr>';
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="container mt-1 pie-chart">
                        <canvas id="myChart2"></canvas>
                    </div>
                    <script>
                        const ctx2 = document.getElementById('myChart2');

                        new Chart(ctx2, {
                            type: 'pie',
                            data: {
                                labels: <?php echo json_encode($incomes_labels); ?>,
                                datasets: [{
                                    data: <?php echo json_encode($incomes_data); ?>
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
</header>

<?php include $this->resolve("partials/_footer.php"); ?>