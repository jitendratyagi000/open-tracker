<?php

namespace App;

use App\TokenAnalytics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Token extends Model
{
    protected $fillable = [
    	'token',
    	'open_count',
    	'open_unique_count',
    ];

    /**
     * @return HasMany
     */
    public function analytics() : HasMany
    {
    	return $this->hasMany(TokenAnalytics::class);
    }

    /**
     * @param $count
     */
    public function setOpenCount($count)
    {
    	$this->open_count = $count;
    }

    /**
     * @param $uniqueCount
     */
    public function setOpenUniqueCount($uniqueCount)
    {
    	$this->open_unique_count = $uniqueCount;
    }

    /**
     * @return mixed
     */
    public function getOpenCount()
    {
    	return $this->analytics()->count();
    }

    /**
     * @return mixed
     */
    public function getUniqueOpenCount()
    {
    	return $this->analytics()->groupBy('ip_address')->get()->count();
    }
}
