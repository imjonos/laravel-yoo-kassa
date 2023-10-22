<?php

namespace Nos\YooKassa\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $abbr
 * @property string $locale
 * @property string $name
 * @property bool $active
 *
 * @method Builder ofAbbr(string $value)
 * @method Builder active()
 */
final class PaymentModel extends Model
{
    /**
     * Columns available for sorting
     * @var array
     */
    protected $sortable = [
        'id',
        'abbr',
        'locale',
        'name',
        'active'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'abbr',
        'locale',
        'name',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
