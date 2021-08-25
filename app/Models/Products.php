<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\CategoriiProduse;
use Illuminate\Support\Arr;
use Storage;
use Illuminate\Support\Str; 

class Products extends Model
{
    use CrudTrait, Sluggable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'nume',
        'poze',
        'preturi',
        'descriere',
        'pret',
        'intretinere',
        'materiale',
        'pretvechi',
        'promotie',
        'nou',
        'subcategorie',
        'link',
        'title',
        'description',
        'keywords',
        'vandut',
        'categorie',
        'recomandare',
        'cod',
        'masuri',
        'culoare',
        'vizibil',
        'marimi',
        'personalizabil'
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'poze' => 'array',
        'marimi' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function sluggable()
    {
        return [
            'link' => [
                'source' => 'nume',
            ],
        ];
    }
  
    function setDescriereAttribute($value){
        $description_rich = preg_replace('/font-family.+?;/', '', $value);
        $description_rich = preg_replace('/font-size.+?;/', '', $value);
        $this->attributes['descriere'] = $description_rich;
    }
    function setIntretinereAttribute($value){
        $description_rich = preg_replace('/font-family.+?;/', '', $value);
        $description_rich = preg_replace('/font-size.+?;/', '', $value);
        $this->attributes['intretinere'] = $description_rich;
    }
    function setMaterialeAttribute($value){
        $description_rich = preg_replace('/font-family.+?;/', '', $value);
        $description_rich = preg_replace('/font-size.+?;/', '', $value);
        $this->attributes['materiale'] = $description_rich;
    }
    function setMasuriAttribute($value){
        $description_rich = preg_replace('/font-family.+?;/', '', $value);
        $description_rich = preg_replace('/font-size.+?;/', '', $value);
        $this->attributes['masuri'] = $description_rich;
    }
    
    function getImageLink(){
        $images = array_values($this->poze);

        return 'https://nighters.ro/storage/' . $images[0];
    }

    function getLink(){
        return 'https://nighters.ro/produs/' . $this->link;
    }
    function getDescription(){
        return $this->descriere;
    }

    function getAvailability(){
        if($this->vizibil == 'da'){
            return 'in stock';
        }else{
            return 'out of stock';
        }
        
    }
    function getActualPrice(){
        if($this->promotie == 'da')
        {
            return number_format($this->pretvechi,2,'.',',').' RON';
        }else{
            return number_format($this->pret,2,'.',',').' RON';
        }
        return number_format($this->pret,2,'.',',').' RON';
    }

    function getBrand(){
        return 'Nighters';
    }

    function getSalePrice(){
        return number_format($this->pret,2,'.',',').' RON';
    }

    function getCondition(){
        return 'new';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function subcategorieRelatie()
    {
        return $this->belongsTo(Subcategorii::class, 'subcategorie', 'id');
    }

    public function categorieRelatie()
    {
        return $this->belongsTo(CategoriiProduse::class, 'categorie', 'id');
    }
    public function categorieRelatie2()
    {
        return $this->belongsTo(CategoriiProduse::class, 'categorie', 'id');
    }
  
    public function category() {
      return $this->belongsTo(Subcategorii::class, 'subcategorie');
    }

    public function culori() {
        return $this->belongsTo(Color::class, 'culoare','id');
    }

    public function marimi_rel() {
        return $this->hasMany(Size::class, 'marimi','id');
    }

    public function colectii(){
        return $this->belongsToMany(Collection::class, 'collection_products','colectie','produs');
    }

    public function produse(){
        return $this->belongsToMany(Products::class, 'subcategories_products','produs','subcategorie');
    }


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
    public function updateImageOrder($order) {
      $new_images_attribute = [];

      foreach ($order as $key => $image) {
          $new_images_attribute[$image['id']] = $image['path'];
      }
      $new_images_attribute = json_encode($new_images_attribute);

      $this->attributes['poze'] = $new_images_attribute;
      $this->save();
    }

    public function removeImage($image_id, $image_path, $disk)
    {
      // delete the image from the db
      $poze = $this->poze;
      if(isset($poze[$image_id])){
        unset($poze[$image_id]);
      } 
      $images = json_encode($poze);
      $this->attributes['poze'] = $images;
      $this->save();

      // delete the image from the folder
      if (Storage::disk($disk)->has($image_path)) {
          Storage::disk($disk)->delete($image_path);
      }
    }
  
    public function setPozeAttribute($value)
    {
        $attribute_name = "poze";
        $disk = "public";
        $destination_path = "galerieProdus";
        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
  
    public function uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path) {
        if (! is_array($this->{$attribute_name})) {
            $attribute_value = json_decode($this->{$attribute_name}, true) ?? [];
        } else {
            $attribute_value = $this->{$attribute_name};
        }
        $files_to_clear = request()->get('clear_'.$attribute_name);

        // if a file has been marked for removal,
        // delete it from the disk and from the db
        if ($files_to_clear) {
            foreach ($files_to_clear as $key => $filename) {
                \Storage::disk($disk)->delete($filename);
                $attribute_value = Arr::where($attribute_value, function ($value, $key) use ($filename) {
                    return $value != $filename;
                });
            }
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if (request()->hasFile($attribute_name)) {
            foreach (request()->file($attribute_name) as $key => $file) {
                $date_time = time();
                if ($file->isValid()) {
                    // 1. Generate a new file name
                    $new_file_name = $file->getClientOriginalName().$date_time.$key.'.'.$file->getClientOriginalExtension();

                    // 2. Move the new file to the correct path
                    $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

                    // 3. Add the public path to the database
                    $attribute_value[] = $file_path;
                }
            }
        }
        rsort($attribute_value); // will sort reversed as regular
      
        $this->attributes[$attribute_name] = json_encode(array_values($attribute_value));
    }
}