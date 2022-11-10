

    <section class="right">

            <h2>Manufacturers</h2>

            <a class="new" href="../AdminManufacturers/addEdit">Add new manufacturer</a>

            <?php
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Name</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '</tr>';

            foreach ($all as $manufacturer) {
                echo '<tr>';
                echo '<td>' . $manufacturer->name . '</td>';
                echo '<td><a style="float: right" href="../AdminManufacturers/addEdit?id=' . $manufacturer->id . '">Edit</a></td>';
                echo '<td><form method="post" action="../AdminManufacturers/delete?id='. $manufacturer->id .'">
				<input type="hidden" name="id" value="' . $manufacturer->id . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
                echo '</tr>';
            }

            echo '</thead>';
            echo '</table>';
            ?>

    </section>


