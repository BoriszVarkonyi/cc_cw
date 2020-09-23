<?php //egyan az mint index.php elejen a comp_name lekérés
    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);

    if($row = mysqli_fetch_assoc($check_comp_query)){

        $comp_status = $row["comp_status"];

    }
?>  

<div class="db_panel_title_stripe">
    <img src="../assets/icons/beenhere-black-18dp.svg" alt="" class="db_panel_stripe_icon">
    <p>Competition's status:</p><p><?php echo statusConverter($comp_status) ?></p>
</div>