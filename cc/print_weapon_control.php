<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
    $comp_id = filter_input(INPUT_GET, 'comp_id', FILTER_SANITIZE_NUMBER_INT) ?? 0;
    $qry_fencers = "SELECT fencer_id, issues_array, notes FROM weapon_control WHERE assoc_comp_id = $comp_id";
    $do_fencers = mysqli_query($connection, $qry_fencers);
    $fencers = array();
    while($row = mysqli_fetch_assoc($do_fencers)) {
        array_push($fencers, $row);
    }

    $qry_competitiors = "SELECT data FROM competitors WHERE assoc_comp_id = $comp_id";
    $do_competitors = mysqli_query($connection, $qry_competitiors);
    if($row = mysqli_fetch_assoc($do_competitors)) {
        $competitors = json_decode($row['data']);
    }

    function findNameById($competitors, $id) {
        foreach($competitors as $competitor) {
            if($competitor->id == $id) {
                return $competitor->nom . " " . $competitor->prenom;
            }
        }
        return "$id";
    }

    $issue_names = array(
        "FIE mark on blade",
        "Arm gap and weight",
        "Arm lenght",
        "Blade lenght",
        "Grip lenght",
        "Form and depth of the guard",
        "Guard oxydation/ deformation",
        "Excentricity of the blade",
        "Blade flexibility",
        "Curve on the blade",
        "Foucault current device",
        "point and arm size",
        "spring of the point",
        "total travel of the point",
        "residual travel of the point",
        "isolation of the point",
        "resistance of the arm",
        "length/ condition of body/ mask wire",
        "resistance of body/ mask wire",
        "mask: FIE mark",
        "mask: condition and insulation",
        "mask: resistance (sabre, foil)",
        "metallic jacket condition",
        "metallic jacket resistance",
        "sabre glove/ overlay condition",
        "sabre glove/ overlay resistance",
        "glove condition",
        "jacket condition",
        "breeches condition",
        "under-plastron condition",
        "foil chest protector",
        "socks",
        "incorrect name printing",
        "incorrect national logo",
        "commercial",
        "other items",
    );
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Weapon Control Reports</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_paper_style.min.css">
    <link rel="stylesheet" href="../css/print_list_style.min.css">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Print Match Reports</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button bold" shortcut="SHIFT+C" href="weapon_control_immediate.php?comp_id=<?php echo $comp_id; ?>">
                        <p>Back to Weapon Control</p>
                        <img src="../assets/icons/close_black.svg" />
                    </a>
                    <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                        <p>Print</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                </div>
                <!--
                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg" />
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg" />
                    </button>
                </div>
                -->
            </div>
            <div id="page_content_panel_main" class="loose">
            <?php foreach($fencers as $fencer) : ?>
                <div class="paper">
                    <p class="print_title"><?php echo findNameById($competitors, $fencer['fencer_id']) ?>'s Weapon Control</p>
                    <table class="small no_interaction">
                        <thead class="no_stick">
                            <tr>
                                <th>
                                    <p>ISSUE</p>
                                </th>
                                <th>
                                    <p>QUANTITY</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($fencer['issues_array'])) : ?>
                                <?php foreach(json_decode($fencer['issues_array']) as $i => $issue) : ?>
                                    <tr>
                                        <td>
                                            <p><?php echo $issue_names[$i] ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $issue ?></p>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="2">Nothing found!</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <?php if(isset($fencer['notes']) && strlen($fencer['notes']) > 0) : ?>
                        <p class="print_title">Notes given by Weapon Control</p>
                        <p><?php echo $fencer['notes'] ?></p>
                    <?php else : ?>
                        <p class="print_title">No notes were given by Weapon Control</p>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/search.js"></script>
    <script src="javascript/print.js"></script>
</body>
</html>