<?php
$issue_names = array(
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

if(count($issues_array) > 0) :
foreach($issue_names as $i => $issue) : ?>
    <tr>
        <td><?php echo $issue ?></td>
        <td><?php echo $issues_array[$i] ?></td>
    </tr>
<?php endforeach ?>
<?php else : ?>
    <tr>
        <td colspan="2">No data</td>
    </tr>
<?php endif ?>