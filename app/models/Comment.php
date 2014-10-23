<?php

class Comment extends Eloquent
{

    public function video()
    {
        return $this->belongsTo('Video');
    }

}
