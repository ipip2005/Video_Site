<?php

class Comment extends Eloquent
{
	protected $fillable = ['comment', 'user_id', 'video_id', 'tid'];
    public function video()
    {
        return $this->belongsTo('Video');
    }
}
