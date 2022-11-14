

<section class="right">

    <h2>Administrators</h2>

    <?php if ($_SESSION['adminLogin'] == 'superAdmin') { ?>
    <a class="new" href="../Administrators/addEdit">Add new administrator</a>
    <?php } ?>

    <?php
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Name</th>';
    echo '<th style="width: 5%">&nbsp;</th>';
    echo '<th style="width: 5%">&nbsp;</th>';
    echo '</tr>';

    foreach ($all as $administrator) {
        echo '<tr>';
        echo '<td><a href="./admin?id='. $administrator->id .'">' . $administrator->username . '</a></td>';
    if ($_SESSION['adminLogin'] == 'superAdmin') {
        echo '<td><a style="float: right" href="../Administrators/addEdit?id=' . $administrator->id . '">Edit</a></td>';
        echo '<td><form method="post" action="../Administrators/delete?id='. $administrator->id .'">
				<input type="hidden" name="id" value="' . $administrator->id . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
    }
        echo '</tr>';
    }

    echo '</thead>';
    echo '</table>';
    ?>

</section>
