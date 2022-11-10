

    <section class="right">

        <?php if (isset($one->id)) { ?>
            <h2>Edit Manufacturer</h2>
        <?php } else { ?>
            <h2>Add Manufacturer</h2>
        <?php } ?>

        <form action="../AdminManufacturers/addEdit" method="POST">
            <?php if (isset($one->id)) {?>
                <input type="text" name="manufacturer[id]" value="<?= $one->id ?? '' ?>" />
            <?php } ?>

            <label>Name</label>
            <input type="text" name="manufacturer[name]" value="<?= $one->name ?? '' ?>"/>

            <?php if (isset($one->id)) { ?>
            <input type="submit" name="submit" value="Edit Manufacturer" />
            <?php } else { ?>
            <input type="submit" name="submit" value="Add Manufacturer" />
            <?php } ?>

        </form>

    </section>

