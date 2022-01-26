<?php
$number_of_matches = 0;
foreach ($matches as $match) :
    $fencer_name = "";
    $opponent_name = "";

    if (isset($fencers_data)) {
        foreach ($fencers_data as $row) {
            if ($row == null) continue;
            foreach ($row as $item) {
                if (isset($item->id) && $_SESSION["fencer_id"] == $item->id) {
                    $fencer_name = $item->prenom_nom;
                } else if (isset($item->id) && $match->id == $item->id) {
                    $opponent_name = $item->prenom_nom;
                } else if (isset($item->id) && $match->enemy == $item->id) {
                    $opponent_name = $item->prenom_nom;
                }
            }
            $number_of_matches++;
        }
    }
?>
    <div class="match">
        <div class="match_header upcoming">
            <p>UPCOMING</p>
        </div>
        <div class="match_data">
            <p>11:40</p>
            <p>{piste name} PISTE</p>
        </div>
        <div class="match_content">
            <div>
                <p>OPPONENT:</p>
                <p><?php echo $opponent_name; ?></p>
            </div>
            <div>
                <p>TABLE:</p>
                <p>t32</p>
            </div>
            <!-- IF FINISHED -->
            <div>
                <p>RESULTS:</p>
                <?php
                if ($match->id == $_SESSION["fencer_id"]) {
                    echo  "<p class='winner'>" . $fencer_name . " - " . $match->given . "</p>";
                    echo "<p>" . $opponent_name . " - " . $match->gotten . "</p>";
                } else {
                    echo  "<p class='winner'>" . $fencer_name . " - " . $match->gotten . "</p>";
                    echo "<p>" . $opponent_name . " - " . $match->given . "</p>";
                }
                ?>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php if($number_of_matches == 0) : ?>
    <div>
        <h1>You don't have any matches yet!</h1>
        <p>Please look back later.</p>
    </div>
<?php endif ?>