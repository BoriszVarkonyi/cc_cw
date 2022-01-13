<?php
    if(count($competitors) == 0) {
    echo "<p>You have no competitors set up or the search criteria is too narrow!</p>";
    } else {
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
    </tr>

    <?php endforeach ?>
</tbody>
<?php } ?>
