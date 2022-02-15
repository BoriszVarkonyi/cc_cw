<tr>
    <td onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
        <p>
            <?php echo $comp_name; ?>
        </p>
    </td>
    <td onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
        <p>
            <?php echo $comp_start . "&nbsp;&nbsp;-&nbsp;&nbsp;" . $comp_end; ?>
        </p>
    </td>
    <td class="square" onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
        <p>
            <?php echo $comp_host; ?>
        </p>
    </td>
    <td class="square">
        <button value="<?php echo $comp_id ?>" class="bookmark_button" onclick="favButton(this)">
            <img src="../assets/icons/bookmark_border_black.svg" alt="Save Competition">
        </button>
    </td>
    <!-- HA ONGOING -->
    <?php if ($type >= 0) : ?>
        <td class="square <?php echo $color_class ?>"></td>
    <?php endif ?>
</tr>