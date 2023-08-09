<?php 

include_once("../Config.php");
$start = $_POST["start"];
$end = $_POST["end"];
$selected_date = $_POST["selected_date"];

$start_num = ConvertTimeToNumber($start);
$end_num = ConvertTimeToNumber($end);
$counter = $start_num;
echo '<table class="table table-hover table-sm">';
    echo '<thead align="center">';
        echo '<tr>';
            echo '<th><input id="check_all" onclick="selectAll(this.id);" type="checkbox"> انتخاب همه</th>';
            echo '<th>ساعت شروع</th>';
            echo '<th>ساعت پایان</th>';
        echo '</tr>';
    echo '</thead>';
    echo '<tbody align="center">';
    while($counter < $end_num){
        echo '<tr>';
            echo "<td><input type='checkbox' name='checkboxes' onclick='controlSelect(this);' value='$counter'></td>";
            echo '<td>'.ConvertNumberToTime($counter).'</td>';
            echo '<td>'.ConvertNumberToTime($counter + 0.5).'</td>';
        echo '</tr>';
        $counter = $counter + 0.5;
    }
    echo '</tbody>';
echo '</table>';
echo "<input type='submit' onClick='setAppointment(this.id)' id='set-appointment'  class='btn btn-success subnobat' value='ثبت نوبت' />";

