<div class="row text-center">
	<div id="carousel-main-top" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-main-top" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-main-top" data-slide-to="1"></li>
			<li data-target="#carousel-main-top" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			@for($count = 0; ($count<6 && $count < count($videos)); $count++)
			<div class="item <?php if ($count==0) echo 'active'?>">
				<a href="/watch?vid=<?php echo $videos[$count]->id?>"><img src="<?php echo 'video/'.$videos[$count]->id.'/_thumb.jpg'?>"
					alt="1"></a>
				<div class="carousel-caption">
					<h3>{{$videos[$count]->name}}</h3>
					<p>{{$videos[$count]->introduction}}</p>
				</div>
			</div>
			@endfor
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-main-top"
			role="button" data-slide="prev"> <span
			class="glyphicon glyphicon-chevron-left"></span> <span
			class="sr-only">Previous</span>
		</a> <a class="right carousel-control" href="#carousel-main-top"
			role="button" data-slide="next"> <span
			class="glyphicon glyphicon-chevron-right"></span> <span
			class="sr-only">Next</span>
		</a>
	</div>
	<script>$('.carousel').carousel();</script>
</div>
<div class="row">
	<div class="belt">
		<h3>
			<b class="soft-text"><i class="icon-desktop"></i>系统推荐</b>
		</h3>
	</div>
</div>
<div class="row">
	@if (count($recommend_videos)>0)
	<div class="col-xs-4">
		<a href="/watch?vid=<?php echo $recommend_videos[0]->id?>" class="row"> <img
			src="/video/<?php echo $recommend_videos[0]->id?>/_thumb.jpg"
			style="width: 100%; height: auto;" />
		</a>
		<div class="row text-center">
			<p class="soft-text">{{$recommend_videos[0]->name}}</p>
		</div>
		<div class="row text-center">
			<p class="soft-text">播放量：{{$recommend_videos[0]->view_count}}</p>
		</div>
	</div>
	
	@for($i = 1; $i <= 4; $i++)
	<div class="col-xs-2">
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2-1) < count($recommend_videos)) <a
				href="/watch?vid=<?php echo $recommend_videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $recommend_videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
				
			</a>
		    <span class="margin-tb-0 soft-text">{{$recommend_videos[$j]->name}}</span>
			@endif
		</div>
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2) < count($recommend_videos)) 
			<a
				href="/watch?vid=<?php echo $recommend_videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $recommend_videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
			</a>
			 <span class="margin-tb-0 soft-text">{{$recommend_videos[$j]->name}}</span>
			@endif
		</div>
	</div>
	@endfor
	@endif
</div>
<div class="row">
	<div class="col-xs-12 divider img-rounded"></div>
</div>
<div class="row">
	<div class="belt">
		<h3>
			<b class="soft-text"><i class="icon-play"></i> 最新上传</b>
		</h3>
	</div>
</div>
<div class="row">
    @if (count($videos)>0)
	<div class="col-xs-4">
		<a href="/watch?vid=<?php echo $videos[0]->id?>" class="row"> <img
			src="/video/<?php echo $videos[0]->id?>/_thumb.jpg"
			style="width: 100%; height: auto;" />
		</a>
		<div class="row text-center">
			<p class="soft-text">{{$videos[0]->name}}</p>
		</div>
		<div class="row text-center">
			<p class="soft-text">播放量：{{$videos[0]->view_count}}</p>
		</div>
	</div>
	
	@for($i = 1; $i <= 4; $i++)
	<div class="col-xs-2">
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2-1) < count($videos)) 
			<a
				href="/watch?vid=<?php echo $videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
				
			</a>
		    <span class="margin-tb-0 soft-text">{{$videos[$j]->name}}</span>
			@endif
		</div>
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2) < count($videos)) <a
				href="/watch?vid=<?php echo $videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
			</a>
			 <span class="margin-tb-0 soft-text">{{$videos[$j]->name}}</span>
			@endif
		</div>
	</div>
	@endfor
	@endif
</div>

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
    @if (count($hot_videos)>0)
	<div class="col-xs-4">
		<a href="/watch?vid=<?php echo $hot_videos[0]->id?>" class="row"> <img
			src="/video/<?php echo $hot_videos[0]->id?>/_thumb.jpg"
			style="width: 100%; height: auto;" />
			<span class="img-score2 fire-text"><i class="icon-star"></i>{{$hot_videos[0]->score}}</span>
		</a>
		<div class="row text-center">
			<p class="soft-text">{{$hot_videos[0]->name}}</p>
		</div>
		<div class="row text-center">
			<p class="soft-text">播放量：{{$hot_videos[0]->view_count}}</p>
		</div>
	</div>
	
	@for($i = 1; $i <= 4; $i++)
	<div class="col-xs-2">
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2-1) < count($hot_videos)) 
			<a
				href="/watch?vid=<?php echo $hot_videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $hot_videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
				<span class="img-score fire-text"><i class="icon-star"></i>{{$hot_videos[$j]->score}}</span>
			</a>
		    <span class="margin-tb-0 soft-text">{{$hot_videos[$j]->name}}</span>
			@endif
		</div>
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2) < count($hot_videos)) 
			<a
				href="/watch?vid=<?php echo $hot_videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $hot_videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
				<span class="img-score fire-text"><i class="icon-star"></i>{{$hot_videos[$j]->score}}</span>
			</a>
			 <span class="margin-tb-0 soft-text">{{$hot_videos[$j]->name}}</span>
			@endif
		</div>
	</div>
	@endfor
	@endif
</div>

<div class="row">
	<div class="col-xs-12 divider img-rounded"></div>
</div>
<div class="row">
	<div class="belt">
		<h3>
			<b class="purple-text"><i class="icon-play-circle"></i> 浏览最多</b>
		</h3>
	</div>
</div>
<div class="row rating-sets">
    @if (count($most_watched_videos)>0)
	<div class="col-xs-4">
		<a href="/watch?vid=<?php echo $most_watched_videos[0]->id?>" class="row"> <img
			src="/video/<?php echo $most_watched_videos[0]->id?>/_thumb.jpg"
			style="width: 100%; height: auto;" />
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
			</a>
		    <span class="margin-tb-0 soft-text">{{$most_watched_videos[$j]->name.'('.$most_watched_videos[$j]->view_count.')'}}</span>
			@endif
		</div>
		<div class="row margin-tb-0 text-center">
			@if(($j = $i*2) < count($most_watched_videos)) 
			<a
				href="/watch?vid=<?php echo $most_watched_videos[$j]->id?>" class="row"> <img
				src="/video/<?php echo $most_watched_videos[$j]->id?>/_thumb.jpg"
				style="width: 95%; height: auto;" />
			</a>
			 <span class="margin-tb-0 soft-text">{{$most_watched_videos[$j]->name.'('.$most_watched_videos[$j]->view_count.')'}}</span>
			@endif
		</div>
	</div>
	@endfor
	@endif
</div>