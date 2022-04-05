<?php
    /*
     * I am not going to write the code that checks the status of the fencer
     * or just rework the stupid JSON based tables and all of a sudden half
     * of our problems will be gone. Furthermore, the developers will not burn
     * out completely after trying to solve the simplest fucking tasks.
     * Thanks!
     */

    if(count($competitors) == 0) :
        echo "<p>You have no competitors set up or the search criteria is too narrow!</p>";
    else :
?>
<thead>
    <th>
        <p>NAME</p>
    </th>
    <th>
        <p>NATION</p>
    </th>
    <th>
        <p>CLUB</p>
    </th>
    <th class="small"></th>
</thead>
<tbody class="alt">
    <?php foreach($competitors as $competitor) : ?>
    <tr>
        <td>
            <p>
                <?php echo $competitor->fullName ?>
            </p>
        </td>
        <td>
            <p>
                <?php echo $competitor->nation ?>
            </p>
        </td>
        <td>
            <p>
                <?php echo $competitor->club ?>
            </p>
        </td>
        <td class="small red"></td>
    </tr>

    <?php endforeach ?>
</tbody>
<?php endif ?>
