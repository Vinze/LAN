<?php
namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Document extends Model {

    protected $fillable = [
        'title',
        'content',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function boot() {
        parent::boot();

        static::addGlobalScope('filtered', function (Builder $builder) {
            $builder->where('user_id', Auth::id())
                ->orWhere('private', 0);
        });

        static::creating(function($document) {
            $document->user_id = Auth::id();
        });
    }

}
