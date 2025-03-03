<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title"><?= $title; ?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active">Main Page</li>
            </ul>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <!-- Main -->
        Welcome, Admin!
    </div>
</div>

<!-- End contents -->

<?= $this->endSection() ?>