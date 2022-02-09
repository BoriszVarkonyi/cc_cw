<form method="GET" id="browsing_bar">
    <!-- search by name box -->
    <div class="search_wrapper wide">
        <input type="text" name="q" placeholder="Search by Title" class="search page alt" value="<?php if (isset($_GET['q'])) echo $q ?>">
        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
    </div>
    <!-- year drop-down -->
    <div class="search_wrapper narrow">
        <select name="year" id="year">
            <option value="Every" selected>Every</option>
            <?php for ($i = -1; $i <= 10; $i++) : ?>
                <?php if ($yearInput == date("Y") - $i) : ?>
                    <option value="<?php echo date("Y") - $i; ?>" selected><?php echo date("Y") - $i ?></option>
                <?php else : ?>
                    <option value="<?php echo date("Y") - $i; ?>"><?php echo date("Y") - $i ?></option>
                <?php endif ?>
            <?php endfor ?>
        </select>
    </div>
    <div class="search_wrapper narrow">
        <select name="sex" id="sex">
            <?php foreach (array("Both", "Male", "Female") as $gender) : ?>
                <?php if ($sex == $gender) : ?>
                    <option value="<?php echo $gender ?>" selected><?php echo $gender ?></option>
                <?php else : ?>
                    <option value="<?php echo $gender ?>"><?php echo $gender ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
    <!-- weapon type drop-down -->
    <div class="search_wrapper narrow">
        <select name="weapon" id="weapon">
            <?php foreach (array("All", "Epee", "Foil", "Sabre") as $weapon_type) : ?>
                <?php if ($weapon == $weapon_type) : ?>
                    <option value="<?php echo $weapon_type ?>" selected><?php echo $weapon_type ?></option>
                <?php else : ?>
                    <option value="<?php echo $weapon_type ?>"><?php echo $weapon_type ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
    <input name="submit_search" type="submit" value="Search">
</form>