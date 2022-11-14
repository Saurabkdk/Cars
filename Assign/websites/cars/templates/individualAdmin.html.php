

<section class="right">

    <h2><?=$all[0]->username ?> - Cars Added</h2>

    <ul>

    <?php foreach ($all[0]->getCarsAdded() as $car) { ?>

        <li><?=$car->name ?></li>

    <?php } ?>

    </ul>


</section>



