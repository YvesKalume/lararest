<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Post
 * @package App
 */

class Post extends Model
{
    protected $fillable = ['id','user_id','title','content'];
}
