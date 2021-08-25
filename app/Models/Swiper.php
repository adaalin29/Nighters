<?php
namespace App\Models;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Swiper extends Model
{
    use CrudTrait;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'swiper';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        "imagine",
        "link",
        "device"
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            \Storage::disk("public")->delete($obj->imagine);
        });
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    // public function setImagineAttribute($value)
    // {
    //     $attribute_name = "imagine";
    //     $disk = 'public';
    //     $destination_path = "swiper"; 
    //     if ($value==null) {
    //         \Storage::disk($disk)->delete($this->{$attribute_name});
    //         $this->attributes[$attribute_name] = null;
    //     }
    //     if (Str::startsWith($value, 'data:image'))
    //     {
    //         $image = \Image::make($value)->encode('png', 90);
    //         $filename = md5($value.time()).'.jpg';
    //         \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
    //         \Storage::disk($disk)->delete($this->{$attribute_name});
    //         $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
    //         $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
    //     }
    // }
    public function setImagineAttribute($value)
    {
        $attribute_name = "imagine";
        $disk = "public";
        $destination_path = "swiper";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }
}
