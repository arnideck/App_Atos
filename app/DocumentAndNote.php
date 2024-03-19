<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\DocumentAndNote
 *
 * @property int $id
 * @property int $business_id
 * @property int $notable_id
 * @property string $notable_type
 * @property string|null $heading
 * @property string|null $description
 * @property int $is_private
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\User $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read int|null $media_count
 * @property-read Model|\Eloquent $notable
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereHeading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereIsPrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereNotableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereNotableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentAndNote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DocumentAndNote extends Model
{
    use LogsActivity;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;


    /**
    * Get all of the owning notable models.
    */
    public function notable()
    {
        return $this->morphTo();
    }
    
    public function media()
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    /**
     * Get the user who added note.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
