<?php

namespace Bantenprov\GroupEgovernment\Models\Bantenprov\GroupEgovernment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupEgovernment extends Model
{
    // protected $table = 'group_egovernments';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];
    protected $fillable = [
        'label',
        'description',
    ];
}

