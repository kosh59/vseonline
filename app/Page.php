<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name','bgcolor','logo','url','user_id'];

    /**
     * Получить пользователя - владельца данной страницы
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function links() {
        return $this->hasMany(Page::class);
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
}
