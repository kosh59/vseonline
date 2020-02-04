<?php

namespace App;
use App\Link;
use Illuminate\Database\Eloquent\Model;

class Links_stat extends Model
{
    public $timestamps = false;

    protected $table = 'links_statistics';

    protected $fillable = ['device_platform','browser_family','type','ip','city','country'];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
