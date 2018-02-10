<?php

namespace Bantenprov\GroupEgovernment\Models\Bantenprov\GroupEgovernment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupEgovernment extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'group_egovernments';
    protected $dates = [
        'deleted_at'
    ];
    protected $fillable = [
        'label',
        'description',
    ];
}

