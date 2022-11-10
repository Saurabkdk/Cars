
<section class="right">

    <?php if (isset($one->id)) { ?>
        <h2>Edit News/Story</h2>
    <?php } else { ?>
        <h2>Add News/Story</h2>
    <?php } ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <?php if (isset($one->id)) {?>
            <input type="text" name="stories[id]" value="<?= $one->id ?? '' ?>" />
        <?php } ?>

        <label>Title</label>
        <input type="text" name="stories[title]" value="<?= $one->title ?? '' ?>" />

        <label>Description</label>
        <textarea name="stories[content]"><?= $one->content ?? '' ?></textarea>

        <label>Image</label>

        <input type="file" name="image" />

        <?php if (isset($one->id)) { ?>
            <input type="submit" name="submit" value="Edit News/Story" />
        <?php } else { ?>
            <input type="submit" name="submit" value="Add News/Story" />
        <?php } ?>

    </form>

</section>

