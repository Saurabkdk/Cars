

<section class="right">

    <?php if (isset($one->id)) { ?>
        <h2>Edit Administrator</h2>
    <?php } else { ?>
        <h2>Add Administrator</h2>
    <?php } ?>

    <form action="../Administrators/addEdit" method="POST">
        <?php if (isset($one->id)) {?>
            <input type="text" name="administrator[id]" value="<?= $one->id ?? '' ?>" />
        <?php } ?>

        <label>Username</label>
        <input type="text" name="administrator[username]" value="<?= $one->username ?? '' ?>"/>

        <label>Password</label>
        <input type="password" name="administrator[password]"/>

        <label>Super Admin Yes/No</label>
        <input type="radio" name="administrator[adminAccess]" value="1" style="margin-top: 33px">
        <input type="radio" name="administrator[adminAccess]" value="0" style="margin-top: 33px">

        <?php if (isset($one->id)) { ?>
            <input type="submit" name="submit" value="Edit Administrator" />
        <?php } else { ?>
            <input type="submit" name="submit" value="Add Administrator" />
        <?php } ?>

    </form>

</section>

