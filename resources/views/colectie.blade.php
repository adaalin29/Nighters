@extends('parts.template')
@section('title','Colectie - Nighters')

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
        <div class = "ordoneaza-element" onclick="ordoneaza_colectie('asc','<?php echo $colectie->slug;?>');">Pret ascendent</div>
        <div class = "ordoneaza-element" onclick="ordoneaza_colectie('desc','<?php echo $colectie->slug;?>');" >Pret descendent</div>
        <div class = "ordoneaza-element" onclick="ordoneaza_colectie('nou','<?php echo $colectie->slug;?>');">Cele mai noi</div>
        <div class = "ordoneaza-element" onclick="ordoneaza_colectie('vandute','<?php echo $colectie->slug;?>');">Cele mai vandute</div>
        <div class = "ordoneaza-element" onclick="ordoneaza_colectie('promotie','<?php echo $colectie->slug;?>');">Promotii</div>
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
                        <div class = "filtru-element-container" onclick="get_colectie_by_color(<?php echo $color->id?>,'<?php echo $colectie->slug;?>');">
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
    <div class = "big-title" id="produse-big-title"><?php echo $colectie->titlu;?></div>   
  <div class = "produse-container">
        <?php
        foreach($colectie->produse as $produs)
        {
            ?>
                <a class = "produs" href="/produs/<?php echo $produs->link;?>">
                            <?php
                              if($produs->nou =='da'){
                                ?>
                                    <div class = "produs-nou">NOU</div>
                                <?php
                                }
                                $k = 0;
                                foreach($produs->poze as $poza){
                                
                                if($k == 0)
                                {
                                    ?>
                                        <img class = "full-width first-image" src = "{{ thumb('width:350', $poza) }}"  loading="lazy"/>
                                <?php
                                }
                                if($k == 1)
                                {
                                    ?>
                                        <img class = "full-width second-image" src = "{{ thumb('width:350', $poza) }}"  loading="lazy"/>
                                    <?php
                                }
                                $k++;
                            }
                            ?>

                            <div class = "swiper-produs-descriere"><?php echo $produs->nume;?></div>
                            <?php
                            if($produs->promotie == 'da')
                            {
                                ?>
                                <div class = "produs-nou"><img src = "images/percentage.svg"></div>
                                <div class = "reducere-pret-container">
                                    <div class = "swiper-produs-pret-container" style = "color:red;"><?php echo $produs->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                                    <div class = "swiper-produs-pret-container pret-container-reducere"><?php echo $produs->pretvechi;?> </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                    <div class = "swiper-produs-pret-container"><?php echo $produs->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                                <?php
                            }
                            ?>
                        </a>
            <?php
        }
        ?>
  </div>
</div>

  <div class = "pagination-container" id="pagination_container">
  </div>

  <div class = "newsletter-container">
    <div class = "small-title">Newsletter</div>
    <div class = "big-title no-bottom-bar">Fii la curent cu ultimele noutati!</div>
    <input type = "email" class = "newsletter-input" placeholder = "Introduceti aici adresa dvs. de e-mail.">
    <button type = "submit" class = "newsletter-btn">Aboneaza-te</button>
  </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
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

@endpush