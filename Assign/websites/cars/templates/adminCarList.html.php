
    <section class="right">


            <h2>Cars</h2>

            <a class="new" href="../AdminCars/addEdit">Add new car</a>

        <?php

            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Model</th>';
            echo '<th style="width: 10%">Price</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '</tr>';

            foreach ($all as $car) {
                echo '<tr>';
                echo '<td>' . $car->name . '</td>';
                echo '<td>£' . $car->price. '</td>';
                echo '<td><a style="float: right" href="../AdminCars/addArchive?id=' . $car->id . '">Archive</a></td>';
                echo '<td><a style="float: right" href="../AdminCars/addEdit?id=' . $car->id . '">Edit</a></td>';
                echo '<td><form method="post" action="../AdminCars/delete?id='. $car->id .'">
				<input type="hidden" name="id" value="' . $car->id . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
                echo '</tr>';
            }

            echo '</thead>';
            echo '</table>';

        ?>

    </section>

