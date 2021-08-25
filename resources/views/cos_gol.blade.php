@extends('parts.template')
@section('title','Cosul meu - Nighters')
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
<div id="cos_gol_page">
    <div class="my-container">
        <div class="row mt-4 mb-5">
            <div class="col-lg-12 text-center">
                <h2>Nu ai niciun produs in cos.</h2>
                <img src="img/404-patura.jpg" alt="" class="img-fluid"> 
            </div>
        </div>  <!-- end row-->

       

        @if(count($produse_recomandate) > 0)
          <div class="row mt-3 mt-5">
              <div class="col-lg-12 text-center mt-3">
                  <h2>Recomandarile noastre</h2>
              </div>
          </div> <!-- end row-->
          <div class="row mb-2">
              <div class="col-md-12 d-flex justify-content-center">
                  <ul class="category-list">
                      <?php
                           foreach($categorii as $categorierec)
                           {
                              ?>
                                  <li><a style="color:black;" href="/categorii/<?php echo $categorierec->slug;?>"><?php echo $categorierec->nume;?></a></li>
                              <?php
                           }
                      ?>
                  </ul>
              </div>
          </div> <!-- end row -->
          <div class="swiper-container rec-swiper">
                <div class="swiper-wrapper">
                  @foreach($produse_recomandate as $produs)
                    @php
                      $preturi = $produs->preturi;
                      $preturi = reset($preturi);
                      $poze = $produs->poze;
                      $poze = reset($poze);
                    @endphp

                    <div class="swiper-slide produs-box" onClick="redirect_produs_mobile('{{$produs->link}}');">
                        <img src="/storage/<?php echo $poze;?>" alt="">
                        <p class="nume"><?php echo $produs->nume;?></p>
                        <?php
                               if($produs->promitie == 'da' || $produs->oferta == 'da')
                               {
                                   ?>
                                    <p class="pret-vechi"><?php echo $preturi['pret_vechi'];?> lei</p>
                                   <?php
                               }
                        ?>
                        <p class="pret mt-0"><?php echo $preturi['price'];?> lei</p>
                        <?php
                            if($produs->promitie == 'da')
                            {
                                ?>
                                    <div class="promotie-tag">PROMOTIE</div>
                                <?php
                            }
                            if($produs->nou == 'da' && $produs->promitie == 'da')
                            {
                                ?>
                                     <div class="new-tag mt51">NOU</div>
                                <?php
                            }
                            if($produs->nou == 'da' && $produs->promitie == 'nu')
                            {
                                ?>
                                     <div class="new-tag">NOU</div>
                                <?php
                            }
                        ?>
                        <div class="optiuni-box">
                            <a class="optiune see-more" onclick="redirect_produs('{{$produs->link}}');">
                                <img src="/img/visibility-b.svg" alt="" class="img-fluid">
                            </a>

                            @if(Session::has('user'))
                              <div class="optiune favorite addRemoveWishlist" product_id="{{$produs->id}}" @if(in_array($produs->id, $wishlist_prod_ids)) type="remove" @else type="add" @endif>
                                @if(in_array($produs->id, $wishlist_prod_ids))
                                  <img src="/img/heart-red.svg" alt="" class="img-fluid">
                                @else
                                  <img src="/img/heart.svg" alt="" class="img-fluid">
                                @endif
                              </div>
                            @endif

                            <a class="optiune buy" onClick="setParams('{{$produs->preturi[0]['size']}}',{{$produs->preturi[0]['price']}}, {{$produs->preturi[0]['pret_vechi']}}, '{{$poze}}');adauga_in_cos({{$produs->id}},true);">
                                <img src="/img/shopping-bag-grey.svg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div><!-- end produs-box-->
                  @endforeach
                </div> <!-- end swiper-wrapper -->
              <div class="swiper-pagination rec-pagination"> </div>
          </div> <!-- end swiper-->
        @endif
    </div> <!--end my-container -->
</div>

@push('scripts')
<script>
      var swiper3 = new Swiper('.rec-swiper', {
        slidesPerView: 2,
        spaceBetween: 10,
        slidesPerGroup: 2,
        loop: true,
        loopFillGroupWithBlank: true,
        breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 10,
                slidesPerGroup: 4,
            }
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.rec-pagination',
            clickable: true
        },
    });
</script>

@endpush
@endsection