<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveMatch extends Model
{
    use HasFactory;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function country()
    {
        return $this->hasOne('App\Models\BlockCountry', 'live_match_id', 'id')->withDefault();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function streamingSource()
    {
        return $this->hasMany('App\Models\StreamingSource', 'match_id', 'id');
    }
}
