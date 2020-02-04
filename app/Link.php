<?php

namespace App;
use App\Page;
use App\User;
use App\Links_stat;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['name','value','type','color','url','page_id','order_no','visible'];

    protected $casts = [
        'page_id' => 'int',
    ];

    /**
     * Получить страницу - владельца данной ссылки
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stat() {
        return $this->hasMany(Links_stat::class);
    }
}
