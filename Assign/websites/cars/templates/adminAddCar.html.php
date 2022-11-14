
    <section class="right">

        <?php if (isset($one->id)) { ?>
            <h2>Edit Car</h2>
        <?php } else { ?>
            <h2>Add Car</h2>
        <?php } ?>

                <form action="../AdminCars/addEdit" method="POST" enctype="multipart/form-data">
                    <?php if (isset($one->id)) {?>
                        <label>Id</label>
                    <input type="text" name="car[id]" readonly="readonly" value="<?= $one->id ?? '' ?>" />
                    <?php } ?>

                    <label>Car Model</label>
                    <input type="text" name="car[name]" value="<?= $one->name ?? '' ?>" />

                    <label>Description</label>
                    <textarea name="car[description]"><?= $one->description ?? '' ?></textarea>

                    <label>Price</label>
                    <input type="text" name="car[price]" value="<?= $one->price ?? '' ?>"/>

                    <label>Category</label>

                    <select name="car[manufacturerId]">
                        <?php
                        foreach ($manufacturers as $category) {
                            echo '<option value="' . $category->id . '"';
                            if (isset($one->id) && $one->id == $category->id) echo 'selected = "selected"';
                            echo '>' . $category->name . '</option>';
                        }

                        ?>

                    </select>

                    <?php if (isset($one->id)) {?>
                    <label>New Price</label>
                    <input type="text" name="car[newPrice]" value="<?= $one->newPrice ?? '' ?>"/>

                    <label>Display old price / Do not</label>
                    <input type="radio" name="car[display]" value="1" style="margin-top: 33px">
                    <input type="radio" name="car[display]" value="0" style="margin-top: 33px">
                    <?php } ?>

                    <label>Mileage</label>
                    <input type="text" name="carDesc[mileage]" value="<?= $desc[0]->mileage ?? '' ?>"/>

                    <label>Engine Type</label>
                    <input type="text" name="carDesc[engine]" value="<?= $desc[0]->engine ?? '' ?>"/>

                    <label>Image</label>

                    <input type="file" name="image[]" multiple />

                    <?php if (isset($one->id)) { ?>
                        <input type="submit" name="submit" value="Edit Car" />
                    <?php } else { ?>
                        <input type="submit" name="submit" value="Add Car" />
                    <?php } ?>

                </form>

    </section>

