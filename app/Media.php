<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Media
 *
 * @property int $id
 * @property int $business_id
 * @property string $file_name
 * @property string|null $description
 * @property int|null $uploaded_by
 * @property string $model_type
 * @property string|null $model_media_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $display_name
 * @property-read mixed $display_path
 * @property-read mixed $display_url
 * @property-read Model|\Eloquent $mediable
 * @property-read \App\User|null $uploaded_by_user
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelMediaType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUploadedBy($value)
 * @mixin \Eloquent
 */
class Media extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $appends = ['display_name', 'display_url'];


    /**
     * Get all of the owning mediable models.
     */
    public function mediable()
    {
        return $this->morphTo();
    }

    /**
     * Get display name for the media
     */
    public function getDisplayNameAttribute()
    {
        $array = explode('_', $this->file_name, 3);
        return !empty($array[2]) ? $array[2] : $array[1];
    }

    /**
     * Get display link for the media
     */
    public function getDisplayUrlAttribute()
    {
        $path = asset('/uploads/media/' . rawurlencode($this->file_name));

        return $path;
    }

    /**
     * Get display path for the media
     */
    public function getDisplayPathAttribute()
    {
        $path = public_path('uploads/media') . '/' . rawurlencode($this->file_name);

        return $path;
    }

    /**
     * Get display link for the media
     */
    public function thumbnail($size = [60, 60], $class = null)
    {
        $html = '<img';
        $html .= ' src="' . $this->display_url . '"';
        $html .= ' width="' . $size[0] . '"';
        $html .= ' height="' . $size[1] . '"';

        if (!empty($class)) {
            $html .= ' class="' . $class . '"';
        }

        $html .= '>';

        return $html;
    }

    /**
     * Uploads files from the request and add's medias to the supplied model.
     *
     * @param  int $business_id, obj $model, $obj $request, string $file_name
     */
    public static function uploadMedia($business_id, $model, $request, $file_name, $is_single = false, $model_media_type = null)
    {
        //If app environment is demo return null
        if (config('app.env') == 'demo') {
            return null;
        }

        $uploaded_files = [];

        if ($request->hasFile($file_name)) {
            $files = $request->file($file_name);

            //If multiple files present
            if (is_array($files)) {
                foreach ($files as $file) {
                    $uploaded_file = Media::uploadFile($file);

                    if (!empty($uploaded_file)) {
                        $uploaded_files[] = $uploaded_file;
                    }
                }
            } else {
                $uploaded_file = Media::uploadFile($files);
                if (!empty($uploaded_file)) {
                    $uploaded_files[] = $uploaded_file;
                }
            }
        }

        //check if base64
        if (!empty($request->$file_name) && !is_array($request->$file_name)) {

            $base64_array = explode(',', $request->$file_name);

            $base64_string = $base64_array[1] ?? $base64_array[0];

            if (Media::is_base64($base64_string)) {
                $uploaded_files[] = Media::uploadBase64Image($base64_string);
            }
        }

        if (!empty($uploaded_files)) {
            //If one to one relationship upload single file
            if ($is_single) {
                $uploaded_files = $uploaded_files[0];
            }
            // attach media to model
            Media::attachMediaToModel($model, $business_id, $uploaded_files, $request, $model_media_type);
        }
    }

    public static function is_base64($s)
    {
          return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
    }

    /**
     * Uploads requested file to storage.
     *
     */
    public static function uploadFile($file)
    {
        $file_name = null;
        if ($file->getSize() <= config('constants.document_size_limit')) {
            $new_file_name = time() . '_' . mt_rand() . '_' . $file->getClientOriginalName();
            if ($file->storeAs('/media', $new_file_name)) {
                $file_name = $new_file_name;
            }
        }

        return $file_name;
    }

    public static function uploadBase64Image($base64_string) {

        $file_name = time() . '_' . mt_rand() . '_media.jpg';

        $output_file = public_path('uploads') . '/media/' . $file_name;

        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 

        fwrite( $ifp, base64_decode( $base64_string ) );

        // clean up the file resource
        fclose( $ifp ); 

        return $file_name; 
    }

    /**
     * Deletes resource from database and storage
     *
     */
    public static function deleteMedia($business_id, $media_id)
    {
        $media = Media::where('business_id', $business_id)
                        ->findOrFail($media_id);

        $media_path = public_path('uploads/media/' . $media->file_name);

        if (file_exists($media_path)) {
            unlink($media_path);
        }
        $media->delete();
    }

    public function uploaded_by_user()
    {
        return $this->belongsTo(\App\User::class, 'uploaded_by');
    }

    public static function attachMediaToModel($model, $business_id, $uploaded_files, $request = null, $model_media_type = null)
    {
        if (!empty($uploaded_files)) {
            if (is_array($uploaded_files)) {
                $media_obj = [];
                foreach ($uploaded_files as $value) {
                    $media_obj[] = new \App\Media([
                            'file_name' => $value,
                            'business_id' => $business_id,
                            'description' => !empty($request->description) ? $request->description : null,
                            'uploaded_by' => !empty($request->uploaded_by) ? $request->uploaded_by : auth()->user()->id,
                            'model_media_type' => $model_media_type
                        ]);
                }
                
                $model->media()->saveMany($media_obj);
            } else {
                //delete previous media if exists
                $model->media()->delete();
                
                $media_obj = new \App\Media([
                        'file_name' => $uploaded_files,
                        'business_id' => $business_id,
                        'description' => !empty($request->description) ? $request->description : null,
                        'uploaded_by' => !empty($request->uploaded_by) ? $request->uploaded_by : auth()->user()->id,
                        'model_media_type' => $model_media_type
                    ]);
                $model->media()->save($media_obj);
            }
        }
    }
}
