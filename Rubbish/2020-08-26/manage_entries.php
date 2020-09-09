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
    <title>Manage Entries</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
</head>
<body>
<!-- header -->
    <div id="confirmation" class="hidden">
        <form id="confirmation_form">
            <button id="close_button" class="round_button" onclick="">
                <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
            </button>
            <p>Are you sure you want to {action} {object}?</p>
            <p>You cannot withdraw this action!</p>
            <button id="close_button" class="round_button" onclick="">
                <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
            </button>
            <div id="confirmation_button_section">
                <button onclick="" type="submit" value="Cancel">Cancel</button>
                <button onclick="" type="submit" value="{Action}" class="action">{Action}</button>
            </div>
        </form>
    </div>
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">Manage Entries</p>
                </div>
                <div id="page_content_panel_main">
                    <div id="manage_entries_wrapper">

                        <div id="new_entries_panel">

                            <p>New Entries</p>
                            <div class="table_header">
                                <div class="table_header_text">FEDARATION'S NAME</div>
                                <div class="table_header_text">FEDARATION'S EMAIL ADDRESS</div>
                                <div class="table_header_text">NATIONALITY</div>
                                <div class="big_status_header"></div>
                            </div>

                            <div class="entry" id="entry_1">
                                <div class="table_row" onclick="toggleEntry(this)">
                                    <div class="table_item">Hungarian Fencing Federation</div>
                                    <div class="table_item">nemzetkozi.nevezes@hunfencing.hu</div>
                                    <div class="table_item">HUN</div>
                                    <div class="big_status_item gray"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <p>8 / 4</p>
                                    <form class="approve_fencers_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                            <div class="approved_status_header">
                                                <button type="button" class="approve_all_button">
                                                    <img src="../assets/icons/select_all-black-18dp.svg" alt="">
                                                    <p>Approve all</p>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="table_row">
                                            <div class="table_item">Neve</div>
                                            <div class="table_item">Náció</div>
                                            <div class="table_item">Drum</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_1" id="e1_f1" value="1" class="small_option_label" />
                                                <label for="e1_f1">Not Approved</label>
                                            </div>
                                        </div>
                                        <input type="submit" value="Save">
                                    </form>
                                </div>
                            </div>

                            <div class="entry" id="entry_2">
                                <div class="table_row" onclick="toggleEntry(this)">
                                    <div class="table_item">Hungarian Fencing Federation</div>
                                    <div class="table_item">nemzetkozi.nevezes@hunfencing.hu</div>
                                    <div class="table_item">HUN</div>
                                    <div class="big_status_item gray"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <p>8 / 4</p>
                                    <form class="approve_fencers_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                            <div class="approved_status_header">
                                                <button type="button" class="approve_all_button">
                                                    <img src="../assets/icons/select_all-black-18dp.svg" alt="">
                                                    <p>Approve all</p>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="table_row">
                                            <div class="table_item">Neve</div>
                                            <div class="table_item">Náció</div>
                                            <div class="table_item">Drum</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_1" id="e2_f1" value="1" class="small_option_label" />
                                                <label for="e2_f1">Not Approved</label>
                                            </div>
                                        </div>
                                        <div class="table_row">
                                            <div class="table_item">Neve</div>
                                            <div class="table_item">Náció</div>
                                            <div class="table_item">Drum</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_1" id="e2_f2" value="1" class="small_option_label" />
                                                <label for="e2_f2">Not Approved</label>
                                            </div>
                                        </div>
                                        <div class="table_row">
                                            <div class="table_item">Neve</div>
                                            <div class="table_item">Náció</div>
                                            <div class="table_item">Drum</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_1" id="e2_f3" value="1" class="small_option_label" />
                                                <label for="e2_f3">Not Approved</label>
                                            </div>
                                        </div>
                                        <input type="submit" value="Save">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="managed_entries_panel">
                            <p>Managed Entries</p>
                            <div class="table_header">
                                <div class="table_header_text">FEDARATION'S NAME</div>
                                <div class="table_header_text">FEDARATION'S EMAIL ADDRESS</div>
                                <div class="table_header_text">NATIONALITY</div>
                                <div class="table_header_text">APPROVED FENCERS</div>
                                <div class="big_status_header"></div>
                            </div>
                            
                            <div class="entry" id="entry_f_1">
                                <div class="table_row" onclick="toggleEntry(this)">
                                    <div class="table_item">Hungarian Fencing Federation</div>
                                    <div class="table_item">nemzetkozi.nevezes@hunfencing.hu</div>
                                    <div class="table_item">HUN</div>
                                    <div class="table_item">4 / 0</div>
                                    <div class="big_status_item red"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <form class="approve_fencers_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                            <div class="approved_status_header">
                                                <button type="button" class="approve_all_button">
                                                    <img src="../assets/icons/select_all-black-18dp.svg" alt="">
                                                    <p>Approve all</p>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="table_row">
                                            <div class="table_item">Ném</div>
                                            <div class="table_item">Federáció mél</div>
                                            <div class="table_item">Náci</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_f_1" id="ef1_f1" class="small_option_label" />
                                                <label for="ef1_f1">Approved</label>
                                            </div>
                                        </div>

                                        <div class="table_row">
                                            <div class="table_item">Ném</div>
                                            <div class="table_item">Federáció mél</div>
                                            <div class="table_item">Náci</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_f_1" id="ef1_f2" class="small_option_label" />
                                                <label for="ef1_f2">Approved</label>
                                            </div>
                                        </div>

                                        <div class="table_row">
                                            <div class="table_item">Ném</div>
                                            <div class="table_item">Federáció mél</div>
                                            <div class="table_item">Náci</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_f_1" id="ef1_f3" class="small_option_label" />
                                                <label for="ef1_f3">Approved</label>
                                            </div>
                                        </div>
                                        <input type="submit" value="Save">
                                    </form>
                                </div>
                            </div>
                            <div class="entry" id="entry_f_2">
                                <div class="table_row" onclick="toggleEntry(this)">
                                    <div class="table_item">Hungarian Fencing Federation</div>
                                    <div class="table_item">nemzetkozi.nevezes@hunfencing.hu</div>
                                    <div class="table_item">HUN</div>
                                    <div class="table_item">4 / 0</div>
                                    <div class="big_status_item red"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <form class="approve_fencers_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                            <div class="approved_status_header">
                                                <button type="button" class="approve_all_button">
                                                    <img src="../assets/icons/select_all-black-18dp.svg" alt="">
                                                    <p>Approve all</p>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="table_row">
                                            <div class="table_item">Ném</div>
                                            <div class="table_item">Federáció mél</div>
                                            <div class="table_item">Náci</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_f_1" id="ef1_f1" class="small_option_label" />
                                                <label for="ef1_f1">Approved</label>
                                            </div>
                                        </div>

                                        <div class="table_row">
                                            <div class="table_item">Ném</div>
                                            <div class="table_item">Federáció mél</div>
                                            <div class="table_item">Náci</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_f_1" id="ef1_f2" class="small_option_label" />
                                                <label for="ef1_f2">Approved</label>
                                            </div>
                                        </div>

                                        <div class="table_row">
                                            <div class="table_item">Ném</div>
                                            <div class="table_item">Federáció mél</div>
                                            <div class="table_item">Náci</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_f_1" id="ef1_f3" class="small_option_label" />
                                                <label for="ef1_f3">Approved</label>
                                            </div>
                                        </div>
                                        <input type="submit" value="Save">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/manage_entries.js"></script>
</html>