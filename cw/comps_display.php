<table>
    <thead>
        <tr>
            <th><p>COMPETITION'S NAME</p></th>
            <th><p>STARTING AND ENDING DATE</p></th>
            <th><p>HOSTING COUNTRY</p></th>
            <th class="square"></th>
            <!-- HA ONGOING -->
            <?php
                if ($statusofpage == 3) {
                    ?>
                    <th class="square"></th>
                    <?php
                }
            ?>
        </tr>
    </thead>
    <tbody class="alt">

<?php
include "db.php";
include "includes/functions.php";
include "../cw/competition_filtering.php";
//fetching data drom 'comptetitions' from the rows with the same 'comp_status' as '$statusofpage'
//'$statusofpage' is defined at the beginning of cw_""_competition - s
$query = "SELECT * FROM competitions " . $WHERE_CLAUSE;
$select_all_comps = mysqli_query($connection, $query);

$empty = true;
if($select_all_comps) {
while ($row = mysqli_fetch_assoc($select_all_comps)){
    $empty = false;
    $comp_name = $row['comp_name'];
    $comp_start = $row['comp_start'];
    $comp_end = $row['comp_end'];
    $comp_host = $row['comp_host'];
    $comp_id = $row['comp_id'];

    $color_class = "purple";

    if ($statusofpage == 3) {

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

        <!-- outputting the table -->
        <tr>
            <td onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
                <p>
                    <?php echo $comp_name; ?>
                </p>
            </td>
            <td onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
                <p>
                    <?php echo $comp_start . "&nbsp;&nbsp;-&nbsp;&nbsp;" . $comp_end; ?>
                </p>
            </td>
            <td class="square" onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
                <p>
                    <?php echo $comp_host; ?>
                </p>
            </td>
            <td class="square">
                <button value="<?php echo $comp_id ?>" class="bookmark_button" onclick="favButton(this)">
                    <img src="../assets/icons/bookmark_border_black.svg" alt="Save Competition">
                </button>
            </td>
            <!-- HA ONGOING -->
            <?php
                if ($statusofpage == 3) {
                    ?>
                    <td class="square <?php echo $color_class ?>"></td>
                    <?php
                }
            ?>
        </tr>
<?php
    } }
?>
        <?php
            if ($empty) {
        ?>
            <tr>
                <td colspan="4">
                    <p>
                    No competitions are in this category
                    </p>
                </td>
            </tr>

        <?php
            }
        ?>
    </tbody>

</table>