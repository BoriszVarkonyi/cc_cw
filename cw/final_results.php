<?php include "cw_comp_getdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s final results</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="competitions">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">
                    <a class="back_button" href="competition.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    Final Results of <?php echo $comp_name ?>
                </p>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                    <input type="button" value="Search" onclick="cwSearchEngine()">
                </form>
                <table class="cw">
                    <thead>
                        <tr>
                            <th><p>POSITION</p></th>
                            <th><p>NAME</p></th>
                            <th><p>NATION / CLUB</p></th>
                            <th class="square"></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
                        <tr>
                            <td>
                                <p>1.</p>
                            </td>
                            <td>
                                <p>NAME</p>
                            </td>
                            <td>
                                <p>HUN</p>
                            </td>
                            <td class="square gold">
                                <img src="../assets/icons/emoji_events_black.svg" alt="Winner Icon">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2.</p>
                            </td>
                            <td>
                                <p>NAME</p>
                            </td>
                            <td>
                                <p>HUN</p>
                            </td>
                            <td class="square silver"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>3.</p>
                            </td>
                            <td>
                                <p>NAME</p>
                            </td>
                            <td>
                                <p>HUN</p>
                            </td>
                            <td class="square bronze"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>4.</p>
                            </td>
                            <td>
                                <p>NAME</p>
                            </td>
                            <td>
                                <p>HUN</p>
                            </td>
                            <td class="square"></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
     <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/cw_temporary_ranking.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>