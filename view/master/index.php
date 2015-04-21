

<div> Index of master <?=$put?></div>

<table>
<?php
foreach ($rows as $row) {
    echo '<tr>';
    echo '<td>'.$row->text.'</td>';
    echo '</tr>';
}
?>
</table>
