
<main class="admin">

    <?php if (isset($_SESSION['adminLogin'])) {?>
        <section class="left">
            <ul>
                <li><a href="../AdminManufacturers/inventory">Manufacturers</a></li>
                <li><a href="../AdminCars/inventory">Cars</a></li>
                <li><a href="../AdminArchive/inventory">Archive</a></li>
                <li><a href="../Administrators/inventory">Administrators</a></li>
                <li><a href="../Stories/addEdit">Add News/Story</a></li>
                <li><a href="../Contacts/inventory">Enquiries</a></li>
                <li><a href="../Login/logoutAdmin">Logout</a></li>

            </ul>
        </section>
    <?php } ?>

    <section class="right">

        <h1>Home</h1>

        <ul class="cars">

            <?php foreach ($all as $stories) { ?>
                <li>

                    <div class="details">

                        <h2><?= $stories->title ?></h2>

                        <p><?= $stories->content ?></p>

                    </div>
                    <?php

                        if (file_exists('../public/images/stories/' . $stories->image)) { ?>
                            <a href="../images/stories/<?= $stories->image ?>"><img src="../images/stories/<?= $stories->image ?>" style="width: 1000px; height: 720px;"/></a>
                            <?php
                        }

                    ?>

                    <?php
                    if (isset($_SESSION['adminLogin']) && isset($stories)) {
                        echo '<p style="margin-left: 20px;">This article was posted by ' . $stories->admin . '.</p>';

                        echo '<a style="margin-left: 20px;" href="../Stories/addEdit?id=' . $stories->id. '">Edit</a>';

                        echo '<form method="post" action="../Stories/delete?id=' . $stories->id. '">
                            <input type="hidden" name="id" value="' . $stories->id . '" />
                            <input type="submit" name="submit" value="Delete" style="width: 70px; margin-left: 20px;"/>
                            </form>';
                    }
                    ?>

                </li>

            <?php } ?>

        </ul>

    </section>
</main>