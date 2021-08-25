@extends('parts.template')

@section('title', $produs->title)
@section('description', $produs->description)
@section('keywords', $produs->keywords)

@section('content')

@php
  if(Session::has('user')){
    $wishlist = \App\Models\Wishlist::where('uid', Session::get('user')['id'])->get();
    $wishlist_prod_ids = [];
    if(count($wishlist) > 0){
      foreach($wishlist as $wish){
        array_push($wishlist_prod_ids, $wish->pid);
      }
    }
  }
@endphp

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class = "container-mare">
   <div class ="produs-container">
      <div class="swiper-container produs-swiper">
         <div class="swiper-wrapper">
            <?php
            foreach($produs->poze as $poza)
            {
               ?>
                  <div class="swiper-slide">
                    
                     <div class = "produs-imagine">
                        <a href="{{ thumb('width:1000', $poza) }}" data-fancybox="gallery" >
                           <img src = "{{ thumb('width:700', $poza) }}" class = "full-width-cover">
                        </a>
                     </div>
                  </div>
               <?php
            }
            ?>
         </div>
         <!-- Add Arrows -->
         <div class="swiper-button-next produs-next"></div>
         <div class="swiper-button-prev produs-prev"></div>

         
      </div>
    
      <div class = "produs-right">
         <div class= "produs-breadcrumb"> <a href="/produse/<?php echo $categorieqq->slug;?>"><?php echo $categorieqq->nume;?></a> </div>
         <div class = "produs-name"><?php echo $produs->nume;?></div>
         <div class = "cod-produs">Cod produs: <?php echo $produs->cod;?></div>
         <?php
            if($produs->promotie == 'da')
            {
               ?>
               <div class = "reducere-pret-container">
                  <div class = "pret-produs pret-produs-actual"><?php echo $produs->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                  <div class = "pret-produs pret-container-reducere"><?php echo $produs->pretvechi;?> </div>
               </div>
               <?php
            }else{
               ?>
                  <div class = "pret-produs pret-produs-actual"><?php echo $produs->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
               <?php
            }
         ?>
         <!-- <div class = "pret-produs">
            <?php echo $produs->pret;?> 
            <div class = "pret-produs-lei">LEI</div>
         </div> -->
         <div class = "produs-descriere">
            <?php echo $produs->descriere;?>
         </div>

         <div class = "informatii-produs-container">
            <div class = "informatii-item">
               <div class = "informatii-item-title-container">
                  <div class = "informatii-item-title">Materiale</div>
                  <div class = "informatii-item-title-sageata"><img src = "images/right-arrow.svg" class = "full-width"></div>
               </div>
               <div class = "informatii-item-descriere"><?php echo $produs->materiale;?></div>
            </div>
            <div class = "informatii-item">
               <div class = "informatii-item-title-container">
                  <div class = "informatii-item-title">ingrijire</div>
                  <div class = "informatii-item-title-sageata"><img src = "images/right-arrow.svg" class = "full-width"></div>
               </div>
               <div class = "informatii-item-descriere"><?php echo $produs->intretinere;?></div>
            </div>
            <div class = "informatii-item">
               <div class = "informatii-item-title-container">
                  <div class = "informatii-item-title">Masuri produs</div>
                  <div class = "informatii-item-title-sageata"><img src = "images/right-arrow.svg" class = "full-width"></div>
               </div>
               <div class = "informatii-item-descriere"><?php echo $produs->masuri;?>
               <?php
                  if($produs->categorie != '5'){
                     ?>
                        <div id="ghid-masuri">
                           <svg xmlns="http://www.w3.org/2000/svg" width="30" height="13.795" viewBox="0 0 30 13.795">
                           <g id="tape" transform="translate(-5 -100.162)">
                              <path id="Path_147" data-name="Path 147" d="M95.308,128.089c0-1.224-2.573-1.865-5.114-1.865s-5.114.641-5.114,1.865,2.573,1.865,5.114,1.865S95.308,129.313,95.308,128.089Zm-9.511,0c0-.39,1.552-1.147,4.4-1.147s4.4.758,4.4,1.147-1.552,1.147-4.4,1.147-4.4-.758-4.4-1.147Z" transform="translate(-75.294 -24.505)"/>
                              <path id="Path_148" data-name="Path 148" d="M253.359,228.717h.12a.359.359,0,0,0,0-.717h-.12a.359.359,0,1,0,0,.717Z" transform="translate(-233.179 -120.198)"/>
                              <path id="Path_149" data-name="Path 149" d="M275.359,228.717h5.5a.359.359,0,1,0,0-.717h-5.5a.359.359,0,0,0,0,.717Z" transform="translate(-253.865 -120.198)"/>
                              <path id="Path_150" data-name="Path 150" d="M34.641,106.308H24.781v-2.724c0-.7-.523-1.7-3.037-2.508a23.307,23.307,0,0,0-6.851-.914,23.325,23.325,0,0,0-6.852.914C5.526,101.884,5,102.886,5,103.584v7.086H5c.042,2.151,5,3.287,9.895,3.287H34.641a.372.372,0,0,0,.359-.374v-6.944A.337.337,0,0,0,34.641,106.308Zm-.359,6.932h-.837v-1.7a.368.368,0,0,0-.348-.373.359.359,0,0,0-.37.359v1.715H30.936V109.9a.369.369,0,0,0-.348-.373.359.359,0,0,0-.37.359v3.357H28.785v-1.7a.368.368,0,0,0-.348-.373.359.359,0,0,0-.37.359v1.715H26.514V109.9a.369.369,0,0,0-.348-.373.359.359,0,0,0-.37.359v3.357H24.3v-1.7a.368.368,0,0,0-.348-.373.359.359,0,0,0-.37.359v1.715H22.032V109.9a.369.369,0,0,0-.348-.373.359.359,0,0,0-.37.359v3.357H19.88v-1.7a.368.368,0,0,0-.348-.373.359.359,0,0,0-.37.359v1.715H17.55V109.9a.369.369,0,0,0-.348-.373.359.359,0,0,0-.37.359v3.357H15.4v-1.791a.369.369,0,0,0-.348-.373.359.359,0,0,0-.37.359v1.79c-.6,0-1.076-.021-1.614-.051v-3.428a.368.368,0,0,0-.348-.373.359.359,0,0,0-.37.359v3.394c-.478-.041-1.016-.095-1.434-.158v-1.79a.369.369,0,0,0-.348-.373.359.359,0,0,0-.37.359v1.693a16.355,16.355,0,0,1-1.614-.351v-3.217a.368.368,0,0,0-.348-.373.359.359,0,0,0-.37.359v3.012c-1.375-.472-2.151-1.064-2.151-1.637v-5.721a6.641,6.641,0,0,0,2.325,1.168c.321.1.66.2,1.015.286a.355.355,0,1,0,.169-.689c-2.2-.535-3.514-1.344-3.514-2.1,0-1.279,3.775-2.708,9.184-2.708s9.178,1.439,9.178,2.718c0,1.223-3.445,2.591-8.473,2.71h-.023v-.013c-.239.005-.455,0-.693,0a27.754,27.754,0,0,1-3.317-.191.354.354,0,0,0-.4.352v.007a.355.355,0,0,0,.312.352,27.893,27.893,0,0,0,3.413.2l19.388,0Zm-10.219-8.316v1.384H21.106c.221-.06.431-.136.638-.2A6.762,6.762,0,0,0,24.064,104.924Z"/>
                           </g>
                           </svg>
                           <div class="ghid-text">GHID DE MASURATORI</div>
                        </div>
                     <?php
                  }
               ?>              
               </div>

              
            </div>
            <div class = "informatii-item">
               <div class = "informatii-item-title-container">
                  <div class = "informatii-item-title">impachetare cadou</div>
                  <div class = "informatii-item-title-sageata"><img src = "images/right-arrow.svg" class = "full-width"></div>
               </div>
               <div class = "informatii-item-descriere">{{config('settings.impachetare_cadou')}}</div>
            </div>
         </div>
         <?php
         if($produs->categorie != '5'){
            ?>
               <div class = "marime-inaltime-text">Inaltimea:</div>
               <input type = "text" class = "produs-input" placeholder = "Introduceti inaltimea dumneavoastra" id="inaltime">
            <?php
         }  else{
            ?>
               <input type = "hidden" class = "produs-input" placeholder = "Introduceti inaltimea dumneavoastra" id="inaltime" value="-">
            <?php
         }
         ?>
         
         <?php
         if($produs->personalizabil == 'da')
         {
            ?>
               <div class = "marime-inaltime-text">Monograma (Max 15 Caractere):</div>
               <input type = "text" class = "produs-input" placeholder = "Introduceti textul personalizat" id="monograma">
            <?php
         }
         ?>
      
         <?php
         if($produs->categorie == '5'){
            ?>
               <div class = "marimi-text">selecteaza marimea pernelor</div>
            <?php
         }else{
            ?>
               <div class = "marimi-text">selecteaza marimea</div>
            <?php
         }
         ?>
        
         <div class = "marimi-container">
            <?php
            if($produs->marimi_nou){
               foreach($produs->marimi_nou as $marime)
               {
                  ?>
                  <a class = "marime-element">
                     <?php echo $marime['denumire'];?>
                     <!-- <div class = "marime-bar"></div> -->
                  </a>
                  <?php
               }
            }
            ?>
            <!-- <a class = "marime-element marime-element-unavailable">
               XL
               <div class = "marime-unavailable"></div>
            </a> -->
         </div>
         <div class = "produs-butoane">
            <button class = "adauga-cos" onclick="add_product({{$produs->id}})">  Adauga in cos</button>
         </div>

    

         @if(Session::has('user'))
         <div class = "wishlist-contianer" @if(in_array($produs->id, $wishlist_prod_ids)) onclick="crud_wishlist({{$produs->id}},'remove')" @else onclick="crud_wishlist({{$produs->id}},'add')" @endif>
               @if(in_array($produs->id, $wishlist_prod_ids))
                  <div class = "wishlist-star pulse"><img src = "images/star-full.svg" class = "full-width"></div>
                  <div class = "wishlist-text"> Adaugat in wishlist<div class = "wishlist-bar"></div> </div>
                  @else
                  <div class = "wishlist-star pulse"><img src = "images/star.svg" class = "full-width"></div>
                  <div class = "wishlist-text"> Adauga in wishlist<div class = "wishlist-bar"></div> </div>
               @endif
              
         </div>
         @endif

        
      </div>
   </div>
</div>
<div class = "contaienr-overflow">
   <div class = "big-title big-title-margin-top no-bottom-bar">Iti mai recomandam</div>
   <div class="swiper-container loved">
      <div class="swiper-wrapper">
         <?php
         foreach($produse_recomandate as $produs_recomandat)
         {
            ?>
               <div class="swiper-slide">
                  <a class = "swiper-produs" href = "/produs/<?php echo $produs_recomandat->link;?>">
                     <?php
                        if($produs_recomandat->nou =='da'){
                           ?>
                              <div class = "produs-nou">NOU</div>
                           <?php
                        }
                        $k = 0;
                        foreach($produs_recomandat->poze as $poza){
                          
                           if($k == 0)
                           {
                              ?>
                                 <img class = "full-width first-image" src = "{{ thumb('width:350', $poza) }}" />
                           <?php
                           }
                           if($k == 1)
                           {
                              ?>
                                 <img class = "full-width second-image" src = "{{ thumb('width:350', $poza) }}" />
                              <?php
                           }
                           $k++;
                        }
                     ?>
                     
                     
                     <div class = "swiper-produs-descriere"><?php echo $produs_recomandat->nume;?></div>
                     <?php
                     if($produs_recomandat->promotie =='da')
                     {
                         ?>
                         <div class = "produs-nou"><img src = "images/percentage.svg"></div>
                         <div class = "reducere-pret-container">
                             <div class = "swiper-produs-pret-container"><?php echo $produs_recomandat->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                             <div class = "swiper-produs-pret-container pret-container-reducere"><?php echo $produs_recomandat->pretvechi;?> </div>
                         </div>
                         <?php
                     }else{
                         ?>
                             <div class = "swiper-produs-pret-container"><?php echo $produs_recomandat->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                         <?php
                     }
                     ?>
                  </a>
               </div>
            <?php
         }
         ?>
       
        
      </div>
      <!-- Add Arrows -->
   </div>
   <div class="swiper-button-next loved-next"></div>
   <div class="swiper-button-prev loved-prev"></div>
</div>
<div class = "container">
   <div class = "newsletter-container">
      <div class = "small-title">Newsletter</div>
      <div class = "big-title no-bottom-bar">Fii la curent cu ultimele noutati!</div>
      <input type = "email" class = "newsletter-input" id="newsletter_email" placeholder = "Introduceti aici adresa dvs. de e-mail.">
      <button type = "submit" class = "newsletter-btn" onclick="subscribe();">Aboneaza-te</button>
   </div>
</div>

<div id="product-container-size"></div>

<input type="hidden" value="<?php echo $produs->cod;?>" id="cod_produs_pixel">

@endsection
@push('scripts')
<script>
  $(document).ready(function(){
    var Produs = new Swiper('.produs-swiper', {
      slidesPerView: 1,
      spaceBetween: 10,
      slidesPerGroup: 1,
      loop: true,
      loopFillGroupWithBlank: true,
      navigation: {
        nextEl: '.produs-next',
        prevEl: '.produs-prev',
      },
      breakpoints:{
         1025:{
            slidesPerView: 2,
            spaceBetween: 10,
            slidesPerGroup: 1,
         },

      }
    });
  
    var Loved = new Swiper('.loved', {
      slidesPerView: 1,
      spaceBetween: 65,
      slidesPerGroup: 1,
      loop: true,
      loopFillGroupWithBlank: true,
      navigation: {
        nextEl: '.loved-next',
        prevEl: '.loved-prev',
      },
      breakpoints:{
         1025:{
            slidesPerView: 4,
            spaceBetween: 65,
            slidesPerGroup: 1,
         },
         770:{
            slidesPerView: 3,
            spaceBetween: 65,
         },
         481:{
            slidesPerView: 2,
            spaceBetween: 35,
         }

      }
    });
  
    $('.marime-element').click(function(){
       $('.marime-element').removeClass('marime-element-active');
       $(this).addClass('marime-element-active');
    })
    $('.wishlist-contianer').click(function(){
      $('.wishlist-contianer .pulse img').attr('src','images/star-full.svg');
    });


    $('.masuratori-container').click(function(){
      if($('.overlay-page').hasClass('overlay-page-active')){
        $('.overlay-page').removeClass('overlay-page-active');
        $('.overlay-container').css('display','none');
      }else{
        $('.overlay-page').addClass('overlay-page-active');
        $('.overlay-container').css('display','flex');
  
      }
    });
  
    $('.inchide-overlay').click(function(){
      $('.overlay-page').removeClass('overlay-page-active');
    })


    $('.informatii-item-title-container').click(function(){
      if($(this).parent().find('.informatii-item-descriere').hasClass('informatii-item-descriere-active')){
         $(this).parent().find('.informatii-item-descriere').removeClass('informatii-item-descriere-active');
         $('.informatii-item-title-sageata').find('.full-width').css('transform','rotate(0deg)');
      }else{
         $('.informatii-item').find('.informatii-item-descriere').removeClass('informatii-item-descriere-active')
         $(this).parent().find('.informatii-item-descriere').addClass('informatii-item-descriere-active');
         $('.informatii-item-title-sageata').find('.full-width').css('transform','rotate(0deg)');
         $(this).find('.informatii-item-title-sageata').find('.full-width').css('transform','rotate(180deg)');
         
      }
    });

    if(screen.width < 1025)
    {
      //  $('.produs-descriere').after($('.marimi-text'));
      //  $('.marimi-text').after($('.marimi-container'));
      //  $('.marimi-container').after($('.produs-butoane'));


       $($('.marimi-text')).appendTo($('#product-container-size'));
       $('.marimi-container').appendTo($('#product-container-size'));
       $('.produs-butoane').appendTo($('#product-container-size'));
    }


 
  });

 
</script>
@endpush