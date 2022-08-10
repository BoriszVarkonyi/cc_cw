<table>
    <thead>
        <tr>
            <th>
                <p><?= $i18n->get('competition_name') ?></p>
            </th>
            <th>
                <p><?= $i18n->get('start_and_end_date') ?></p>
            </th>
            <th>
                <p><?= $i18n->get('host_country') ?></p>
            </th>
            <th class="square"></th>
            <th class="square"></th>
        </tr>
    </thead>
    <tbody class="alt">
        <?php
        include "includes/db.php";
        include "includes/functions.php";

        //$WHERE_CLAUSE is from 'competition_filtering.php'
        include "includes/competition_filtering.php";
        $query = "SELECT * FROM competitions " . $WHERE_CLAUSE;
        $select_all_comps = mysqli_query($connection, $query);

        $empty = true;
        if ($select_all_comps) :
            while ($row = mysqli_fetch_assoc($select_all_comps)) :
                $empty = false;
                $comp_name = $row['comp_name'];
                $comp_start = $row['comp_start'];
                $comp_end = $row['comp_end'];
                $comp_host = $row['comp_host'];
                $comp_id = $row['comp_id'];

                $color_class = "purple";

                if ($type >= 0) {

                    //test for table
                    $qry_test_table = "SELECT `id` FROM `tables` WHERE `ass_comp_id` = '$comp_id'";
                    $do_test_table = mysqli_query($connection, $qry_test_table);

                    if (mysqli_num_rows($do_test_table) == NULL) {
                        $color_class = "blue";

                        //test for started pools
                        $qry_test_pool = "SELECT `id` FROM `pools` WHERE `assoc_comp_id` = '$comp_id'";
                        $do_test_pool = mysqli_query($connection, $qry_test_pool);

                        if (mysqli_num_rows($do_test_pool) == NULL) {
                            $color_class = "yellow";
                        }
                    }
                }
        ?>
                <?php include "CompItem.php" ?>

            <?php endwhile ?>
        <?php endif ?>
        <?php if ($empty) : ?>
            <tr>
                <td colspan="4">
                    <p>
                        No competitions are in this category
                    </p>
                </td>
            </tr>
        <?php endif ?>
    </tbody>

</table>