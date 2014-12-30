
<span>评分 <?php
$star = 0;
if (Auth::check() && count(DB::table("scores")->where("uid", "=", Auth::id())
    ->where("vid", "=", $vid)
    ->get()) > 0) {
    $star = DB::table("scores")->where("uid", "=", Auth::id())
        ->where("vid", "=", $vid)
        ->first()->score;
    $sum = 0; $num = 0;
    $votes = DB::table("scores")->where("vid" ,"=" , $vid)->get();
    foreach($votes as $vote){
        $num++;
        $sum+=$vote->score; 
    }
    if ($num==0) echo "(暂无评分)"; else echo "(" . ((int)($sum/$num*100)/100) . ")";
}
?>:</span>
<span class="rating"> 
@for($i = 5;$i >= 1;$i--) 
    @if ($i <= $star) 
    <span class="red-star" onclick="rate(<?php echo $i.','.$vid?>)">★</span>
    @else 
    <span class="star" onclick="rate(<?php echo $i.','.$vid?>)">☆</span>
    @endif 
@endfor
</span>
