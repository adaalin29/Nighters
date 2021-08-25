<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
  
  
    public function showAddress() {
        $delivery = json_decode($this->delivery_address, true);
        $html = '';
        foreach($delivery as $key => $addr){
          $cheie = $key;
          switch($key){
            case 'user_name':
              $cheie = 'Nume/Prenume';
              break;
            case 'phone':
              $cheie = 'Telefon';
              break;
            case 'email':
              $cheie = 'Email';
              break;
            case 'address':
              $cheie = 'Adresa';
              break;
            case 'county':
              $cheie = 'Judet/Oras';
              break;
            case 'city':
              $cheie = 'Oras';
              break;
          }
          $html .= '<span>'.$cheie.': '.$addr.'</span><br>';
        }
        return $html;
    }
  
    public function showBillingAddress() {
      if($this->billing_address != 'aceleasi'){
        $delivery = json_decode($this->billing_address, true);
        $html = '';
        foreach($delivery as $key => $addr){
          $cheie = $key;
          switch($key){
            case 'user_name':
              $cheie = 'Nume/Prenume';
              break;
            case 'phone':
              $cheie = 'Telefon';
              break;
            case 'email':
              $cheie = 'Email';
              break;
            case 'address':
              $cheie = 'Adresa';
              break;
            case 'county':
              $cheie = 'Judet/Oras';
              break;
            case 'city':
              $cheie = 'Oras';
              break;
          }
          $html .= '<span>'.$cheie.': '.$addr.'</span><br>';
        }
        return $html;
      } 
      return '<span>Aceleasi date</span><br>';
    }
  
   public function isOrderWithAccount() {
     if($this->id_user == -1){
      return '<span>Comanda fara cont</span><br>'; 
     } else{
       return '<span>Comanda cu cont</span><br>';
     }
   }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
  
    public function order_products () {
      return $this->hasMany(Orderproduct::class);
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
}
