<?php

namespace App\Models;

use App\Traits\Actions;
use App\Traits\Frontend;
use App\Traits\Searchable;
use App\Traits\PaginationData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Job extends Model
{
    use HasFactory;
    use Frontend;
    use PaginationData;
    use Searchable;
    use Actions;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime:d-m-Y',
        'created_at' => 'datetime:d-m-Y',
        'time' => 'timestamp:H:i'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'date_formatted',
        'date_formatted_uk',
        'created_by',
        'job_status',
        'job_type'
    ];

    /**
     * Attributes hidden in frontend components
     *
     * @var array
     */
    protected $hidden_frontend = [
        'id',
        'status_id',
        'type_id',
        'user_id',
        'user',
        'status',
        'type',
        'job_status',
        'job_type',
        'created_at',
        'updated_at',
        'date_formatted',
        'date_formatted_uk'
    ];

    /**
     * Attributes sortable in frontend components
     *
     * @var array
     */
    protected $sortable_frontend = [
        'invoice_number',
        'date',
        'time',
        'created_at'
    ];

    /**
     * Attribute images in frontend components
     *
     * @var array
     */
    protected $images_frontend = [];

    /**
     * Attribute dates in frontend components
     *
     * @var array
     */
    protected $dates_frontend = [
        'date',
        'created_at'
    ];

    protected $searchable = [
        'id',
        'invoice_number',
        'date',
        'time',
        'name',
        'created_at',
        'status_id',
        'type_id',
        'user_id'
    ];

    protected $actions = [
        'export',
        'edit',
        'show',
        'delete'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function getDateFormattedAttribute()
    {
        return !is_null($this->date) ? $this->date->format('Y-m-d') : null;
    }

    public function getDateFormattedUKAttribute()
    {
        return !is_null($this->date) ? $this->date->format('d-m-Y') : null;
    }

    public function getCreatedByAttribute()
    {
        return $this->user->name;
    }

    public function getJobStatusAttribute()
    {
        return $this->status->name;
    }

    public function getJobTypeAttribute()
    {
        return $this->type->name;
    }

    /*
     * Convert date to timestamp
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = !is_null($value) ? Carbon::create($value)->toDateTimeString() : null;
    }
}
