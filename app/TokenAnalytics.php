<?php

namespace App;

use App\Token;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TokenAnalytics extends Model
{
    protected $fillable = [
    	'ip_address',
    	'user_data',
    ];

    /**
     * @return BelongsTo
     */
    public function token() : BelongsTo
    {
    	return $this->belongsTo(Token::class);
    }
}
