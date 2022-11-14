


    <section class="right">


        <h2>Archived Cars</h2>

        <?php

        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Model</th>';
        echo '<th style="width: 10%">Price</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '</tr>';

        foreach ($all as $car) {
            echo '<tr>';
            echo '<td>' . $car->name . '</td>';
            echo '<td>£' . $car->price. '</td>';
            echo '<td><a style="float: right" href="../AdminArchive/remove?id=' . $car->id . '">Remove</a></td>';
            echo '<td><form method="post" action="../AdminArchive/delete?id='. $car->id .'">
				<input type="hidden" name="id" value="' . $car->id . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
            echo '</tr>';
        }

        echo '</thead>';
        echo '</table>';

        ?>

    </section>

