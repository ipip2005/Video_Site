<?php
$vid = $video->id;
$star = 0;
$sum = 0;
$num = 0;
$votes = DB::table("scores")->where("vid", "=", $vid)->get();
foreach ($votes as $vote) {
    $num ++;
    $sum += $vote->score;
}
if ($num == 0)
    echo "暂无评分";
else
    echo ((int) ($sum / $num * 100) / 100);
?>
