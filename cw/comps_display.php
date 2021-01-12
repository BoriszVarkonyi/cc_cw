<div class="table cw">
    <div class="table_header">
        <div class="table_header_text"><p>COMPETITION'S NAME</p></div>
        <div class="table_header_text"><p>STARTING AND ENDING DATE</p></div>
        <div class="table_header_text"><p>HOSTING COUNTRY</p></div>
        <div class="big_status_header"></div>
    </div>
    <div class="table_row_wrapper alt">

<?php
include "../cw/db.php";
include "../includes/functions.php";
include "../cw/competition_filtering.php";

//fetching data drom 'comptetitions' from the rows with the same 'comp_status' as '$statusofpage'
//'$statusofpage' is defined at the beginning of cw_""_competition - s
$query = "SELECT * FROM competitions " . $WHERE_CLAUSE;
$select_all_comps = mysqli_query($connection, $query);
echo $query;

while ($row = mysqli_fetch_assoc($select_all_comps)){
    $comp_name = $row['comp_name'];
    $comp_start = $row['comp_start'];
    $comp_end = $row['comp_end'];
    $comp_host = $row['comp_host'];
    $comp_id = $row['comp_id'];

    ?>

    <!-- outputting the table -->    
    <div class="table_row" onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
        <div class="table_item">
            <p>
                <?php echo $comp_name; ?>
            </p>
        </div>
        <div class="table_item">
            <p>
                <?php echo $comp_start . "&nbsp;&nbsp;-&nbsp;&nbsp;" . $comp_end; ?>
            </p>
        </div>
        <div class="table_item">
            <p>
                <?php echo $comp_host; ?>
            </p>
        </div>
        <div class="big_status_item">
            <button class="favourite_button">
                <img src="../assets/icons/star_border-black-18dp.svg" >
            </button>
        </div>
    </div>

<?php } ?>

</div>