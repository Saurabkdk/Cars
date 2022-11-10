

<section class="right">

    <h2><?=$all->username ?> - Cars Added</h2>

    <ul>

    <?php foreach ($all->getCarsAdded() as $car) { ?>

        <li><?=$car->name ?></li>

    <?php } ?>

    </ul>


</section>



