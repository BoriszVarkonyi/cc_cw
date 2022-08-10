<form method="GET" id="browsing_bar">
    <!-- search by name box -->
    <div class="search_wrapper wide">
        <input type="text" name="q" placeholder="<?= $i18n->get('search_by_title') ?>" class="search page alt" value="<?php if (isset($_GET['q'])) echo $q ?>">
        <button class="clear_search_button" type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
    </div>
    <!-- year drop-down -->
    <div class="search_wrapper narrow">
        <label for="type"><?= $i18n->get('status') ?></label>
        <select name="type" id="type">
            <option value="0">-</option>
            <option value="2">Upcoming</option>
            <option value="3">Ongoing</option>
            <option value="4">Finished</option>
        </select>
    </div>
    <div class="search_wrapper narrow">
        <label for="year"><?= $i18n->get('year') ?></label>
        <select name="year" id="year">
            <option value="Every" selected>-</option>
            <?php for ($i = -1; $i <= 10; $i++) : ?>
                <?php if (isset($yearInput) && $yearInput == date("Y") - $i) : ?>
                    <option value="<?php echo date("Y") - $i; ?>" selected><?php echo date("Y") - $i ?></option>
                <?php else : ?>
                    <option value="<?php echo date("Y") - $i; ?>"><?php echo date("Y") - $i ?></option>
                <?php endif ?>
            <?php endfor ?>
        </select>
    </div>
    <div class="search_wrapper narrow">
        <label for="sex"><?= $i18n->get('sex') ?></label>
        <select name="sex" id="sex">
            <?php foreach (array("Both", "Male", "Female") as $gender) : ?>
                <?php if (isset($sex) && $sex == $gender) : ?>
                    <option value="<?php echo $gender ?>" selected><?php if($gender == "Both") echo "-"; else echo $gender ?></option>
                <?php else : ?>
                    <option value="<?php echo $gender ?>"><?php if($gender === "Both") echo "-"; else echo $gender ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
    <!-- weapon type drop-down -->
    <div class="search_wrapper narrow">
        <label for="weapon"><?= $i18n->get('weapon') ?></label>
        <select name="weapon" id="weapon">
            <?php foreach (array("All", "Epee", "Foil", "Sabre") as $weapon_type) : ?>
                <?php if (isset($weapon) && $weapon == $weapon_type) : ?>
                    <option value="<?php echo $weapon_type ?>" selected><?php if($weapon_type == "All") echo "-"; else echo $weapon_type ?></option>
                <?php else : ?>
                    <option value="<?php echo $weapon_type ?>"><?php if($weapon_type == "All") echo "-"; else echo $weapon_type ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
    <input class="submit_search" name="submit_search" type="submit" value="<?=  $i18n->get('search') ?>">
</form>