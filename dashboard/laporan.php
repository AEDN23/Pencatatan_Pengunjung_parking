<?php
$title = "Laporan";
include "layout/header.php";
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">LAPORAN ITEM</h1>

        <?php if (!isset($_GET['hideformfilter'])) { ?>
            <h3>Quick Filter</h3>
            <a href="filter/filter.php?start=<?= date('Y-m-d'); ?>&end=<?= date('Y-m-d'); ?>" class="btn btn-dark">Today</a>
            <a href="filter/filter.php?start=<?= date('Y-m-d', strtotime('-1 day')); ?>&end=<?= date('Y-m-d', strtotime('-1 day')); ?>" class="btn btn-dark">Yesterday</a>
            <a href="filter/filter.php?start=<?= date('Y-m-d', strtotime('-7 days')); ?>&end=<?= date('Y-m-d'); ?>" class="btn btn-dark">Last Week</a>
            <a href="filter/filter.php?start=<?= date('Y-m-d', strtotime('-1 month')); ?>&end=<?= date('Y-m-d'); ?>" class="btn btn-dark">Last Month</a>
            <a href="filter/filter.php" class="btn btn-danger">Show All Without Filter</a>

            <br><br>
            <h3>Advanced Filter</h3>
            <form method="GET" action="filter/filter.php">
                <div class="row">
                    <div class="col-md-3">
                        <label>Tahun:</label>
                        <select name="year" class="form-control">
                            <?php for ($i = date('Y'); $i >= date('Y') - 10; $i--) { ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Bulan:</label>
                        <select name="month" class="form-control">
                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>"><?= date('F', mktime(0, 0, 0, $i, 10)); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary form-control">Filter</button>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</main>

<?php
include "layout/footer.php";
?>
