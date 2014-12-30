<div class="row">
	<div class="col-xs-12 divider img-rounded"></div>
</div>
<div class="row">
	<div class="belt">
		<h3>
			<b class="fire-text"><i class="icon-fire"></i> 评分最高</b>
		</h3>
	</div>
</div>
<div class="row rating-sets">
    @if (count($most_watched_videos)>0)
	<div class="col-xs-4">
		<a href="/watch?vid=<?php echo $most_watched_videos[0]->id?>" class="row"> <img
			src="/video/<?php echo $most_watched_videos[0]->id?>/_thumb.jpg"
			style="width: 100%; height: auto;" />
			<span class="img-score2 fire-text"><i class="icon-star"></i>{{$most_watched_videos[0]->score}}</span>
		</a>
		<div class="row text-center">
			<p class="soft-text">{{$most_watched_videos[0]->name}}</p>
		</div>
		<div class="row text-center">
			<p class="soft-text">播放量：{{$most_watched_videos[0]->view_count}}</p>
		</div>
	</div>
	
	@for($i = 1; $i <= 4; $i++)
	<div class="col-xs-2">
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2-1) < count($most_watched_videos)) 
			<a
				href="/watch?vid=<?php echo $most_watched_videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $most_watched_videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
				<span class="img-score fire-text"><i class="icon-star"></i>{{$most_watched_videos[$j]->score}}</span>
			</a>
		    <span class="margin-tb-0 soft-text">{{$most_watched_videos[$j]->name}}</span>
			@endif
		</div>
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2) < count($most_watched_videos)) 
			<a
				href="/watch?vid=<?php echo $most_watched_videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $most_watched_videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
				<span class="img-score fire-text"><i class="icon-star"></i>{{$most_watched_videos[$j]->score}}</span>
			</a>
			 <span class="margin-tb-0 soft-text">{{$most_watched_videos[$j]->name}}</span>
			@endif
		</div>
	</div>
	@endfor
	@endif
</div>