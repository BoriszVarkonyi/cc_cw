<?php
//copied from cw/fencers_weapon_control.php
$array_issues = array(
    "FIE mark on blade",
    "Arm gap and weight",
    "Arm lenght",
    "Blade lenght",
    "Grip lenght",
    "Form and depth of the guard",
    "Guard oxydation/ deformation",
    "Excentricity of the blade",
    "Blade flexibility",
    "Curve on the blade",
    "Foucault current device",
    "point and arm size",
    "spring of the point",
    "total travel of the point",
    "residual travel of the point",
    "isolation of the point",
    "resistance of the arm",
    "length/ condition of body/ mask wire",
    "resistance of body/ mask wire",
    "mask: FIE mark",
    "mask: condition and insulation",
    "mask: resistance (sabre, foil)",
    "metallic jacket condition",
    "metallic jacket resistance",
    "sabre glove/ overlay condition",
    "sabre glove/ overlay resistance",
    "glove condition",
    "jacket condition",
    "breeches condition",
    "under-plastron condition",
    "foil chest protector",
    "socks",
    "incorrect name printing",
    "incorrect national logo",
    "commercial",
    "other items",
);
?>

<?php if (property_exists($data, $_SESSION['fencer_id'])) : ?>
    <?php foreach ($data->$fencer_id->equipment as $key => $quantity) : ?>
        <tr>
            <td>
                <p><?php echo $array_issues[$key]; ?></p>
            </td>
            <td>
                <p><?php echo $quantity; ?></p>
            </td>
        </tr>
    <?php endforeach ?>
<?php else : ?>
    <tr>
        <td colspan="2">Nothing found</td>
    </tr>
<?php endif ?>