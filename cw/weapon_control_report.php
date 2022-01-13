<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finished competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="finished_competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>My Weapon Control Report</h1>
            </div>
            <div id="content_wrapper">
                <div id="weapon_control_info" class="red">
                    <p id="fencer_name">{Fencername}'s Weapon Control</p>
                    <p id="wc_status">Status: {Status name}</p>
                </div>

                <!-- only if administrated weapo control -->
                <h1>EQUIPMENT GIVEN FOR CONTROL</h1>
                <table class="no_interaction">
                    <thead>
                        <tr>
                            <th><p>EQUIPMENT</p></th>
                            <th><p>QUANTITY</p></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
                        <tr>
                            <td>
                                <p>EQ</p>
                            </td>
                            <td>
                                <p>quantritxy</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h1>WEAPON CONTROL RESULTS</h1>
                <table class="no_interaction">
                    <thead>
                        <tr>
                            <th><p>ISSUES</p></th>
                            <th><p>QUANTITY</p></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
                        <tr>
                            <td>
                                <p>Issue name</p>
                            </td>
                            <td>
                                <p>quantritxy</p>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/cw_bookmark_competition.js"></script>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>