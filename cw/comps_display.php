<table class="cw">
    <thead>
        <tr>
            <th><p>COMPETITION'S NAME</p></th>
            <th><p>STARTING AND ENDING DATE</p></th>
            <th><p>HOSTING COUNTRY</p></th>
            <th class="square"></th>
            <!-- HA ONGOING -->
            <th class="square"></th>
        </tr>
    </thead>
    <tbody class="alt">

<?php
include "../cw/db.php";
include "../includes/functions.php";
include "../cw/competition_filtering.php";
//fetching data drom 'comptetitions' from the rows with the same 'comp_status' as '$statusofpage'
//'$statusofpage' is defined at the beginning of cw_""_competition - s
$query = "SELECT * FROM competitions " . $WHERE_CLAUSE;
$select_all_comps = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_comps)){
    $comp_name = $row['comp_name'];
    $comp_start = $row['comp_start'];
    $comp_end = $row['comp_end'];
    $comp_host = $row['comp_host'];
    $comp_id = $row['comp_id'];


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
            <td class="square"></td>
        </tr>

        <!-- ha üres
            <tr>
                <td colspan="4">
                    <p>
                    No competitions are in this category
                    </p>
                </td>
            </tr>
        -->

<?php } ?>
    </tbody>

</table>