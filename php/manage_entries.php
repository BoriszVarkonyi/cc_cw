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
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="confirmation" class="hidden">
        <form id="confirmation_form">
            <button class="panel_button" onclick="">
                <img src="../assets/icons/close-black-18dp.svg" alt="">
            </button>
            <p>Are you sure you want to {action} {object}?</p>
            <p>You cannot withdraw this action!</p>
            <div id="confirmation_button_section">
                <button type="submit" value="Cancel">Cancel</button>
                <button type="submit" value="{Action}" class="action">{Action}</button>
            </div>
        </form>
    </div>
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Manage Entries</p>
                </div>
                <div id="page_content_panel_main">
                    <div id="manage_entries_wrapper">

                        <div id="new_entries_panel" class="entry_table_row_wrapper">
                            <p>New Entries</p>
                            <div class="entry" id="entry_1">
                                <div class="table_row" onclick="toggleEntry(this)">
                                    <div class="table_item">Hungarian Fencing Federation</div>
                                    <div class="table_item">nemzetkozi.nevezes@hunfencing.hu</div>
                                    <div class="table_item">HUN</div>
                                    <div class="big_status_item gray"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <button type="button" class="entry_info_button" onclick="toggleEntryInfo(this)">
                                        <img src="../assets/icons/info-black-18dp.svg" alt="">
                                    </button>
                                    <form class="approve_fencers_wrapper table_row_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                        </div>
                                        <div class="table_row">
                                            <div class="table_item">Neve</div>
                                            <div class="table_item">Náció</div>
                                            <div class="table_item">Drum</div>
                                        </div>
                                        <input type="submit" value="Approve" class="panel_submit">
                                    </form>

                                    <div class="entry_overlay_info hidden">
                                        <div>
                                            <p class="label_text">FEDERATION'S NAME:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">COUNTRY / FENCING CLUB:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S PHONE NUMBER:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S FULL NAME:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S EMAIL ADDRESS:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S PHONE NUMBER:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                    </div>
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
                                    <button type="button" class="entry_info_button" onclick="toggleEntryInfo(this)">
                                        <img src="../assets/icons/info-black-18dp.svg" alt="">
                                    </button>
                                    <form class="approve_fencers_wrapper table_row_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                        </div>
                                        <div class="table_row">
                                            <div class="table_item">Neve</div>
                                            <div class="table_item">Náció</div>
                                            <div class="table_item">Drum</div>
                                        </div>
                                        <input type="submit" value="Approve" class="panel_submit">
                                    </form>

                                    <div class="entry_overlay_info hidden">

                                        <div>
                                            <p class="label_text">FEDERATION'S NAME:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">COUNTRY / FENCING CLUB:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S PHONE NUMBER:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text"">CONTACT KEEPER'S FULL NAME:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S EMAIL ADDRESS:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S PHONE NUMBER:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div id="managed_entries_panel" class="entry_table_row_wrapper">
                            <p>Managed Entries</p>
                            <div class="entry" id="entry_f_1">
                                <div class="table_row" onclick="toggleEntry(this)">
                                    <div class="table_item">Hungarian Fencing Federation</div>
                                    <div class="table_item">nemzetkozi.nevezes@hunfencing.hu</div>
                                    <div class="table_item">HUN</div>
                                    <div class="big_status_item green"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <button type="button" class="entry_info_button" onclick="toggleEntryInfo(this)">
                                        <img src="../assets/icons/info-black-18dp.svg" alt="">
                                    </button>
                                    <form class="approve_fencers_wrapper table_row_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                        </div>
                                        <div class="table_row">
                                            <div class="table_item">Neve</div>
                                            <div class="table_item">Náció</div>
                                            <div class="table_item">Drum</div>
                                        </div>
                                    </form>
                                    <div class="entry_overlay_info hidden">
                                        <div>
                                            <p class="label_text">FEDERATION'S NAME:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">COUNTRY / FENCING CLUB:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S PHONE NUMBER:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text"">CONTACT KEEPER'S FULL NAME:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S EMAIL ADDRESS:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S PHONE NUMBER:</p>
                                            <p>FEDERATION'S NAME</p>
                                        </div>
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