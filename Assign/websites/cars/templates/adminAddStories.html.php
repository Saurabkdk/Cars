
<section class="right">

    <?php if (isset($one[0]->id)) { ?>
        <h2>Edit News/Story</h2>
    <?php } else { ?>
        <h2>Add News/Story</h2>
    <?php } ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <?php if (isset($one[0]->id)) {?>
            <label>Id</label>
            <input type="text" name="stories[id]" readonly="readonly" value="<?= $one[0]->id ?? '' ?>" />
        <?php } ?>

        <label>Title</label>
        <input type="text" name="stories[title]" value="<?= $one[0]->title ?? '' ?>" />

        <label>Description</label>
        <textarea name="stories[content]"><?= $one[0]->content ?? '' ?></textarea>

        <label>Image</label>

        <input type="file" name="image" />

        <?php if (isset($one[0]->id)) { ?>
            <input type="submit" name="submit" value="Edit News/Story" />
        <?php } else { ?>
            <input type="submit" name="submit" value="Add News/Story" />
        <?php } ?>

    </form>

</section>

