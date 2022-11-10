
<main class="admin">
    <section class="left">
        <ul>
            <?php $manufacturersList = $all; ?>
            <?php
            foreach ($manufacturersList as $manufacturers) {
                ?>
                <li><a href="../Manufacturers/inventory?id=<?=$manufacturers->id ?>"><?=$manufacturers->name ?></a></li>
            <?php } ?>

        </ul>
    </section>

    <section class="right">

        <h1>Our cars</h1>

        <ul class="cars">

            <?php $manufacturerCar = $one[0]->getManufacturerCar(); ?>

            <?php foreach ($manufacturerCar as $allCar) { ?>
                <li>

                    <div class="details">
                        <h2> <?= $one[0]->name; ?>  <?= $allCar->name ?> </h2>
                        <?php if ($allCar->display == 1) { ?>
                            <h3>Was £ <?= $allCar->price ?>, now £ <?= $allCar->newPrice ?> </h3>
                        <?php } else { ?>
                            <h3>£ <?= $allCar->price ?> </h3>
                        <?php } ?>
                        <p> <?= $allCar->description ?> </p>

                        <?php if (isset($one[0]->getCarDescription($allCar->id)[0]->mileage)) { ?>
                            <p>Mileage : <?= $one[0]->getCarDescription($allCar->id)[0]->mileage; ?> </p>
                        <?php } ?>

                        <?php if (isset($one[0]->getCarDescription($allCar->id)[0]->mileage)) { ?>
                            <p>Engine : <?= $one[0]->getCarDescription($allCar->id)[0]->engine; ?> </p>
                        <?php } ?>


                    </div>
                    <?php
                    foreach ($one[0]->getCarImages($allCar->id) as $image){
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