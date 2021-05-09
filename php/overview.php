<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overview</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Overview</p>
                <div class="stripe_button_wrapper">
                    <input type="text" class="selected_list_item_input">
                    <button class="stripe_button primary" type="button" onclick="window.print()">
                        <p>Print Overview</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                </div>
                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
                    <div class="search_results">
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button"></button>
                    </div>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper table" id="overview_wrapper">
                    <div class="table_header">
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="serachInLists()" placeholder="Search by Position" class="search page">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>POSITION</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="serachInLists()" placeholder="Search by Name" class="search page">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>NAME</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="serachInLists()" placeholder="Search by Nationality" class="search page">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>NATION / CLUB</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="big_status_header"></div>
                    </div>
                    <div class="table_row_wrapper">
                        <div class="table_row">
                            <div class="table_item"><p>1.</p></div>
                            <div class="table_item"><p>Néve</p></div>
                            <div class="table_item"><p>Náté</p></div>
                            <div class="big_status_item gold"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item"><p>1.</p></div>
                            <div class="table_item"><p>Néve</p></div>
                            <div class="table_item"><p>Náté</p></div>
                            <div class="big_status_item silver"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item"><p>1.</p></div>
                            <div class="table_item"><p>Néve</p></div>
                            <div class="table_item"><p>Náté</p></div>
                            <div class="big_status_item bronze"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item"><p>1.</p></div>
                            <div class="table_item"><p>Néve</p></div>
                            <div class="table_item"><p>Náté</p></div>
                            <div class="big_status_item"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item"><p>1.</p></div>
                            <div class="table_item"><p>Néve</p></div>
                            <div class="table_item"><p>Náté</p></div>
                            <div class="big_status_item"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/list_search.js"></script>
</body>
</html>