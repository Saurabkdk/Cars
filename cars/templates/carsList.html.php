
<main class="admin">
<section class="left">
    <ul>
<!--        <li><a href="jaguar.php">Jaguar</a></li>-->
<!--        <li><a href="mercedes.php">Mercedes</a></li>-->
<!--        <li><a href="aston.php">Aston Martin</a></li>-->
        <?php $manufacturersList = $all[0]->getAllManufacturers(); ?>
        <?php
        foreach ($manufacturersList as $manufacturers) {
        ?>
            <li><a href="jaguar.php"><?=$manufacturers->name ?></a></li>
        <?php } ?>

    </ul>
</section>

<section class="right">

    <h1>Our cars</h1>

    <ul class="cars">

<?php foreach ($all as $allCar) { ?>
<li>

<!--    --><?php
//    foreach ($allCar->getCarImages() as $image){
//        if (file_exists('../public/images/cars/' . $image->name)) { ?>
<!--        <a href="../images/cars/--><?//= $image->name ?><!--"><img src="../images/cars/--><?//= $image->name ?><!--" /></a>-->
<!--     --><?php
//    }
//    }
//    ?>

    <div class="details">
        <h2> <?= $allCar->getManufacturerName()->name; ?>  <?= $allCar->name ?> </h2>
        <?php if ($allCar->display == 1) { ?>
            <h3>Was £ <?= $allCar->price ?>, now £ <?= $allCar->newPrice ?> </h3>
        <?php } else { ?>
        <h3>£ <?= $allCar->price ?> </h3>
        <?php } ?>
        <p> <?= $allCar->description ?> </p>

        <?php if (isset($allCar->getCarDescription()[0]->mileage)) { ?>
        <p>Mileage : <?= $allCar->getCarDescription()[0]->mileage; ?> </p>
        <?php } ?>

        <?php if (isset($allCar->getCarDescription()[0]->mileage)) { ?>
        <p>Engine : <?= $allCar->getCarDescription()[0]->engine; ?> </p>
        <?php } ?>


    </div>
    <?php
    foreach ($allCar->getCarImages() as $image){
        if (file_exists('../public/images/cars/' . $image->name)) { ?>
            <a href="../images/cars/<?= $image->name ?>"><img src="../images/cars/<?= $image->name ?>" /></a>
            <?php
        }
    }
    ?>
</li>
<?php } ?>

    </ul>

</section>
</main>