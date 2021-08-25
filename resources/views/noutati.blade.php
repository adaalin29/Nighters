@extends('parts.template')
@section('title','Noutati - Nighters')

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

<div class = "filtre" id="desktop-filtre">
    <div class = "order-products-container" id = "ordoneaza-buton">
        <div class = "order-products-title-container">
          <div class = "order-products-title">Ordoneaza</div>
          <img src = "images/right-arrow.svg" class = "full-width">
        </div>
        <div class = "order-bar"></div>
    </div>

    <div class = "order-products-container" id = "filtreaza-buton">
        <div class = "order-products-title-container">
          <div class = "order-products-title">Filtreaza</div>
          <img src = "images/right-arrow.svg" class = "full-width">
        </div>
        <div class = "order-bar"></div>
    </div>  

    <div class = "ordoneaza-container" id = "ordoneaza">
        <div class = "filtreaza-container">
            <div class = "filtreaza-title">Ordoneaza dupa</div>
            <div class = "inchide-filtru"></div>
            <div class = "inchide-filtru-text">Inchide</div>
        </div>
        <div class = "ordoneaza-element" onclick="ordoneaza('asc');">Pret ascendent</div>
        <div class = "ordoneaza-element" onclick="ordoneaza('desc');" >Pret descendent</div>
        <div class = "ordoneaza-element" onclick="ordoneaza('vandute');">Cele mai vandute</div>
        <div class = "ordoneaza-element" onclick="ordoneaza('reducere');">Discount</div>
    </div>

    <div class = "ordoneaza-container" id = "filtreaza">
        <div class = "filtreaza-container">
            <div class = "filtreaza-title">Filtreaza dupa</div>
            <div class = "inchide-filtru"></div>
            <div class = "inchide-filtru-text">Inchide</div>
        </div>
        <div class = "filtru-container">
            <div class = "filtru-container-title-container">
                <div class = "filtru-container-title">Culoare</div>
                <div class = "filtru-container-sageata"><img src = "images/right-arrow.svg" class = "full-width"></div>
            </diV>
            <div class = "filtru-elemente">
                <?php
                foreach($colors as $color)
                {
                    ?>
                        <div class = "filtru-element-container" onclick="get_data_by_color(<?php echo $color->id?>);">
                            <div class = "filtru-culoare" style = "border:1px solid black;background-color:<?php echo $color->color;?>"></div>
                            <div class = "filtru-nume"><?php echo $color->nume;?></div>
                        </div>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>

<div class = "container">
    <div class = "big-title" id="produse-big-title">NOUTATI</div>   
  <div class = "produse-container"></div>
</div>

  <div class = "pagination-container" id="pagination_container">
  </div>

  <div class = "newsletter-container">
    <div class = "small-title">Newsletter</div>
    <div class = "big-title no-bottom-bar">Fii la curent cu ultimele noutati!</div>
    <input type = "email" class = "newsletter-input" id="newsletter_email" placeholder = "Introduceti aici adresa dvs. de e-mail.">
    <button type = "submit" class = "newsletter-btn" onclick="subscribe();">Aboneaza-te</button>
  </div>
</div>

<input type="hidden" id="categorie" value="<?php echo $cat->id;?>">
@endsection
@push('scripts')
<script>
    page_size = 12;
   
  
    $(document).ready(function(){
        get_noutati_data();
        $('.filtru-container-title-container').click(function(){
            if($(this).parent().find('.filtru-elemente').hasClass('filtru-elemente-active')){
                $(this).parent().find('.filtru-elemente').removeClass('filtru-elemente-active');
                $(this).find('.filtru-container-sageata').css('transform','rotate(180deg)');
            }else{
                $(this).parent().find('.filtru-elemente').addClass('filtru-elemente-active');
                $(this).find('.filtru-container-sageata').css('transform','rotate(0deg)');
            }
        });

        $('#ordoneaza-buton').click(function(){
            if($('#ordoneaza').hasClass('ordoneaza-container-active')){
                $('#ordoneaza').removeClass('ordoneaza-container-active');
                $(this).find('.order-products-title-container').find('.full-width').css({'transform':'rotate(0deg)','transition':'0.3s ease'});
            }else{
                $('#ordoneaza').addClass('ordoneaza-container-active');
                $('#filtreaza').removeClass('ordoneaza-container-active');
                $(this).find('.order-products-title-container').find('.full-width').css({'transform':'rotate(180deg)','transition':'0.3s ease'});
            }
        });

        $('#filtreaza-buton').click(function(){
            if($('#filtreaza').hasClass('ordoneaza-container-active')){
                $('#filtreaza').removeClass('ordoneaza-container-active');
                $(this).find('.order-products-title-container').find('.full-width').css({'transform':'rotate(0deg)','transition':'0.3s ease'});
            }else{
                $('#filtreaza').addClass('ordoneaza-container-active');
                $('#ordoneaza').removeClass('ordoneaza-container-active');
                $(this).find('.order-products-title-container').find('.full-width').css({'transform':'rotate(180deg)','transition':'0.3s ease'});
            }
        });

        $('.inchide-filtru-text').click(function(){
            if($('#ordoneaza').hasClass('ordoneaza-container-active')){
                $('#ordoneaza').removeClass('ordoneaza-container-active');
                $('#ordoneaza-buton').find('.order-products-title-container').find('.full-width').css({'transform':'rotate(0deg)','transition':'0.3s ease'});
            }
            if($('#filtreaza').hasClass('ordoneaza-container-active')){
                $('#filtreaza').removeClass('ordoneaza-container-active');
                $('#filtreaza-buton').find('.order-products-title-container').find('.full-width').css({'transform':'rotate(0deg)','transition':'0.3s ease'});
            }

        });

        if(screen.width < 1025)
        {
            $('#produse-big-title').after($('.filtre'));
            $('.filtru-elemente').addClass('filtru-elemente-active');
            $('.filtru-container-title-container .filtru-container-sageata').find('.full-width').css({'transform':'rotate(180deg)','transition':'0.3s ease'});
        }

        $('.filtru-element-container').click(function(){
            $('.filtru-element-container').removeClass('filtru-element-container-active');
            $(this).addClass('filtru-element-container-active');
           
        });
        $('.ordoneaza-element').click(function(){
            $('.ordoneaza-element').removeClass('ordoneaza-element-selected');
            $(this).addClass('ordoneaza-element-selected');
            $('#ordoneaza').removeClass('ordoneaza-container-active',1000);
        });
    });
</script>
<script>
    $categorie   = $('#categorie').val();
    
    function get_noutati_data(){
        $tb_response = $('.produse-container');
        $targets = '';
        datasource = '/noutatiii/categorie?categorie=' +  $categorie;
        $('#pagination_container').pagination({
            dataSource: datasource,
            pageSize: page_size,
            locator: 'produse',
            totalNumberLocator: function(response){
                return response.total_number;
            },
            callback: function(data, pagination){
                render_targets(data);
            },
            alias:{ pageNumber: 'offset',pageSize: 'limit'}
        });
    }

    function get_data_by_color(id_culoare){
        $tb_response = $('.produse-container');
        $targets = '';
        datasource = '/produsee/culoare?culoare=' + id_culoare +'&noutati=1' + '/categorie=' + $categorie; ;

        $('#pagination_container').pagination({
            dataSource: datasource,
            pageSize: page_size,
            locator: 'produse',
            totalNumberLocator: function(response){
                return response.total_number;
            },
            callback: function(data, pagination){
                $('#filtreaza').removeClass('ordoneaza-container-active',1000);
                render_targets(data);
            },
            alias:{ pageNumber: 'offset',pageSize: 'limit'}
        });
    }

    function ordoneaza(filtru){
        $tb_response = $('.produse-container');
        $targets = '';
        datasource = '/produsee/filtru?filtru=' + filtru +'&noutati=1';

        $('#pagination_container').pagination({
            dataSource: datasource,
            pageSize: page_size,
            locator: 'produse',
            totalNumberLocator: function(response){
                return response.total_number;
            },
            callback: function(data, pagination){
                $('#ordoneaza').removeClass('ordoneaza-container-active',1000);
                render_targets(data);
            },
            alias:{ pageNumber: 'offset',pageSize: 'limit'}
        });
    }

    function render_targets(products){
        $tb_response.empty();
        var $html = '';
        $.each(products, function(key, value)
        {
            $html += '<a href = "/produs/'+value.link+'" class = "produs">';
               if(value.nou == 'da'){
                   $html += '<div class = "produs-nou">NOU</div>';
               }
  
               $.each(value.poze, function(key, value2){
                    if(key == 0){
                        $html += '<img class="full-width first-image" src="/storage/thumb/width:350/' + value2 + '" alt="Imagine" loading="lazy"/>';
                        }
                    if(key == 1){
                        $html += '<img class="full-width second-image" src="/storage/thumb/width:350/' + value2 + '" alt="Imagine" loading="lazy"/>';
                    }
                    if(key > 1){
                        return false;
                    }
               });
               $html += '<div class = "swiper-produs-descriere">'+value.nume+'</div>';
               if(value.promotie == 'da')
                  {
                  $html += '<div class = "produs-nou"><img src = "images/percentage.svg"></div>';
                  $html += '<div class = "reducere-pret-container">';
                  $html += '<div class = "swiper-produs-pret-container" style = "color:red;">' + value.pret + '<div class = "swiper-produs-lei">LEI</div></div>'
                  $html += ' <div class = "swiper-produs-pret-container pret-container-reducere">'+value.pretvechi+ '</div>'
                  $html += '</div>';
                } else {
                  $html += ' <div class = "swiper-produs-pret-container">' + value.pret +'<div class = "swiper-produs-lei">LEI</div></div>'
                  }
            $html += '</a>';
        });
        $tb_response.append($html);
        $("html, body").animate({scrollTop: 0,}, 700);
    }
</script>
@endpush