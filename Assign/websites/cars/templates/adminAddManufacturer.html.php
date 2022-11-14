

    <section class="right">

        <?php if (isset($one[0]->id)) { ?>
            <h2>Edit Manufacturer</h2>
        <?php } else { ?>
            <h2>Add Manufacturer</h2>
        <?php } ?>

        <form action="../AdminManufacturers/addEdit" method="POST">
            <?php if (isset($one[0]->id)) {?>
                <label>Id</label>
                <input type="text" name="manufacturer[id]" readonly="readonly" value="<?= $one[0]->id ?? '' ?>" />
            <?php } ?>

            <label>Name</label>
            <input type="text" name="manufacturer[name]" value="<?= $one[0]->name ?? '' ?>"/>

            <?php if (isset($one[0]->id)) { ?>
            <input type="submit" name="submit" value="Edit Manufacturer" />
            <?php } else { ?>
            <input type="submit" name="submit" value="Add Manufacturer" />
            <?php } ?>

        </form>

    </section>

