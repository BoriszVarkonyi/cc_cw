<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Weapon Control</title>
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
                    <button class="stripe_button bold" onclick="window.close()" shortcut="SHIFT+C">
                        <p>Close Page</p>
                        <img src="../assets/icons/close_black.svg" />
                    </button>
                    <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                        <p>Print</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                </div>

                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg" />
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main" class="loose">

                <div class="paper">
                    <p class="print_title">{Fencer name}'s Weapon Control</p>
                    <table class="small">
                        <thead>
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
                            <tr>
                                <td>
                                    <p>{ISSUE NAME}</p>
                                </td>
                                <td>
                                    <p>{ISSUE quantity}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="print_title">Notes given by Weapon Control</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus consequatur dolorum cum impedit officia
                        numquam error dignissimos officiis consectetur odio distinctio labore inventore repellat, necessitatibus
                            voluptatem veniam iste accusantium quasi.</p>
                </div>

                <div class="paper">
                    <p class="print_title">{Fencer name}'s Weapon Control</p>
                    <table class="small">
                        <thead>
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
                            <tr>
                                <td>
                                    <p>{ISSUE NAME}</p>
                                </td>
                                <td>
                                    <p>{ISSUE quantity}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="print_title">Notes given by Weapon Control</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus consequatur dolorum cum impedit officia
                        numquam error dignissimos officiis consectetur odio distinctio labore inventore repellat, necessitatibus
                            voluptatem veniam iste accusantium quasi.</p>
                </div>



                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/search.js"></script>
    <script src="javascript/print.js"></script>
</body>
</html>