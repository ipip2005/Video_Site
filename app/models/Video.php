<?php

class Article extends Eloquent
{

    public function comments()
    {
        return $this->hasMany('Comment');
    }
    public function user()
    {
    	return $this->belongsto('User');
    }
    public function delete()
    {
        foreach ($this->comments as $comment) {
            $comment->delete();
        }
        return parent::delete();
    }
}
