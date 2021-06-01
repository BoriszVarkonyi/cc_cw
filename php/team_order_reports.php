<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team Order Reports</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Team Order Reports</p>
                <div class="stripe_button_wrapper">
                    <form action="" method="POST" id="IDE KELL A FORM IDJE">
                        <input type="text" class="selected_list_item_input hidden" name="selected_id" readonly>
                    </form>

                    <a class="stripe_button bold" href="teams.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Teams</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <a class="stripe_button primary" href="print_team_order_reports.php?comp_id=<?php echo $comp_id ?>">
                        <p>Print Team Order Reports</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </a>
                </div>

                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search Team" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
                    <div class="search_results">
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button"></button>
                    </div>
                </div>

            </div>
            <div id="page_content_panel_main">

                <div class="wrapper w80">
                    <div class="team_order_report">
                        <p>TEAM 1</p>
                        <p>TABLE 8 AND BEFORE READY</p>
                        <a href="team_order_report.php?comp_id=<?php echo $comp_id ?>"">
                            <img src="../assets/icons/open_in_new_black.svg">
                        </a>
                    </div>
                    <div class="team_order_report">
                        <p>TEAM 1</p>
                        <p>TABLE 8 AND BEFORE READY</p>
                        <a href="team_order_report.php?comp_id=<?php echo $comp_id ?>"">
                            <img src="../assets/icons/open_in_new_black.svg">
                        </a>
                    </div>
                    <div class="team_order_report">
                        <p>TEAM 1</p>
                        <p>TABLE 8 AND BEFORE READY</p>
                        <a href="team_order_report.php?comp_id=<?php echo $comp_id ?>"">
                            <img src="../assets/icons/open_in_new_black.svg">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/search.js"></script>
    <script>
        function toggleAddTeamPanel() {
            var panel = document.getElementById("add_team_panel");
            panel.classList.toggle("hidden");
        }
    </script>
</body>
</html>