<?php
include "../cw/db.php";

//fetching data drom 'comptetitions' from the rows with the same 'comp_status' as '$statusofpage'
//'$statusofpage' is defined at the beginning of cw_""_competition - s
$query = "SELECT * FROM competitions WHERE comp_status = '$statusofpage'";
$select_all_comps = mysqli_query($connection, $query);


while ($row = mysqli_fetch_assoc($select_all_comps)){
    $comp_name = $row['comp_name'];
    $comp_start = $row['comp_start'];
    $comp_end = $row['comp_end'];
    $comp_host = $row['comp_host'];

    ?>

    <!-- outputting the table -->    
    <div class="table_row" onclick="window.location.href='cw_competition.php'">
        <div class="table_item">
            <p><?php echo $comp_name; ?></p>
        </div>
        <div class="table_item">
            <p><?php echo $comp_start . "<h2>&nbsp;-&nbsp;</h2>" . $comp_end; ?></p>
        </div>
        <div class="table_item">
            <p><?php echo $comp_host; ?></p>
        </div>
        </div>

<?php } ?>
    

    
        </div>
    </div>
</div>