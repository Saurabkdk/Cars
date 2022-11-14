
<main class="admin">

    <section class="right">

        <h1>Enquiries</h1>

        <ul class="cars">

            <?php foreach ($all as $enquiry) { ?>
                <li>

                    <div class="details">

                        <h3><?=$enquiry->name ?></h3>

                        <h4><?=$enquiry->telephone ?>, <?=$enquiry->email ?></h4>

                        <p><?=$enquiry->enquiry ?></p>

                        <?php if ($enquiry->complete == 1) {?>
                            <a href="./enquiryCheck?id=<?=$enquiry->id ?>&check=<?=$enquiry->complete ?>"><p>Enquiry Checked. Click to uncheck.</p></a>
                            <p>Checked by : <?=$enquiry->admin ?></p>
                        <?php } else{ ?>
                            <a href="./enquiryCheck?id=<?=$enquiry->id ?>&check=<?=0 ?>"><p>Enquiry Unchecked. Click to check.</p></a>
                        <?php } ?>

                        <form method="post" action="../Contacts/delete?id=<?=$enquiry->id ?>">
                            <input type="hidden" name="id" value="<?=$enquiry->id ?>" />
                            <input type="submit" name="submit" value="Delete" style="margin-left: 0;"/>
                        </form>

                    </div>

                </li>
            <?php } ?>

        </ul>

    </section>
</main>