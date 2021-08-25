

@extends('parts.template')
@section('title','Cautare - Nighters')

@section('content')
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
        <div class = "ordoneaza-element {{$price_order == 'asc' ? 'ordoneaza-element-selected' : ''}}" onclick="put_to_order('asc','price_order','price');">Pret ascendent</div>
        <div class = "ordoneaza-element {{$price_order == 'desc' ? 'ordoneaza-element-selected' : ''}}" onclick="put_to_order('desc','price_order','price');" >Pret descendent</div>
        <div class = "ordoneaza-element {{$noi_order != 'nada' ? 'ordoneaza-element-selected' : ''}}" onclick="put_to_order('noi','noi_order','latest');">Cele mai noi</div>
        <div class = "ordoneaza-element {{$cele_mai_order != 'nada' ? 'ordoneaza-element-selected' : ''}}" onclick="put_to_order('sold','cele_mai_order','sold');">Cele mai vandute</div>
    </div>

    <div class = "ordoneaza-container" id = "filtreaza">
        <div class = "filtreaza-container">
            <div class = "filtreaza-title">Filtreaza dupa</div>
            <div class = "inchide-filtru"></div>
            <div class = "inchide-filtru-text">Inchide</div>
        </div>
        <div class = "filtru-container">
            <div>
                <div class = "filtru-container-title-container">
                    <div class = "filtru-container-title">Culoare</div>
                    <div class = "filtru-container-sageata"><img src = "images/right-arrow.svg" class = "full-width"></div>
                </diV>
                <div class = "filtru-elemente">
                    <?php
                    foreach($colors as $color){
                    
                            ?>
                                <div class = "filtru-element-container {{$culoare_order == $color->id ? 'ordoneaza-element-selected' : ''}}" onclick="put_to_order(<?php echo $color->id;?>,'culoare_order','color');">
                                <?php
                                if($color->color == '#ffffff'){
                                    ?>
                                        <div class = "filtru-culoare" style = "border:1px solid black;background-color:<?php echo $color->color;?>"></div>
                                    <?php
                                }else{
                                    ?>
                                        <div class = "filtru-culoare" style = "background-color:<?php echo $color->color;?>"></div>
                                    <?php
                                }
                                ?>
                                    <div class = "filtru-nume"><?php echo $color->nume;?></div>
                                </div>
                            <?php
                    
                    }
                    ?>
                </div>
            </div>
            <div>
                <div class = "filtru-container-title-container">
                    <div class = "filtru-container-title">Marime</div>
                    <div class = "filtru-container-sageata"><img src = "images/right-arrow.svg" class = "full-width"></div>
                </diV>
                <div class = "filtru-elemente">
                <?php
                    foreach ($marimi as $marime) {
                        ?>
                            <div class = "filtru-element-container {{$marime_order == $marime->id ? 'ordoneaza-element-selected' : ''}}" onclick="put_to_order(<?php echo $marime->id;?>,'marime_order','marime');">
                                <div class = "filtru-culoare" style = "border:1px solid black;background-color:#000000;"></div>
                                <div class = "filtru-nume"><?php echo $marime->marime;?></div>
                            </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class = "container">
    <div class = "big-title" id="produse-big-title">rezultatele cautarii dupa: "{{$text}}"</div>

  <div class = "produse-container">

  </div>
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

<input type="hidden" value="{{$price_order}}" id="price_order" />
<input type="hidden" value="{{$noi_order}}" id="noi_order" />
<input type="hidden" value="{{$cele_mai_order}}" id="cele_mai_order" />
<input type="hidden" value="{{$discount_order}}" id="discount_order" />
<input type="hidden" value="{{$culoare_order}}" id="culoare_order" />
<input type="hidden" value="{{$marime_order}}" id="marime_order" />
<input type="hidden" value="{{Request::url()}}" id="url" />
<input type="hidden" value="1" id="total_number_input" />
<input type="hidden" value="{{$page_number}}" id="page_number" />


@endsection
@push('scripts')
<script>
  page_size = 12;
    $(document).ready(function(){
        // get_cautare_data();
        get_total_number();
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

    var split_url = document.URL.split('?');
        var datasource2 = '';
        if(split_url[1] !== undefined ){
            datasource2 = datasource2 + '?' + split_url[1];
        }
        var datasource = '/cautare/'+datasource2;

    function get_total_number(){
        $.ajax({
            url: datasource,
            type: "GET",
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (resp) {
                get_cautare_data(resp.total_number);
            }
        });
    }
    
    function get_cautare_data(tt){
        var split_url = document.URL.split('?');
       
        $tb_response = $('.produse-container');
        $targets = '';
        $('#pagination_container').pagination({
            dataSource: datasource,
            pageSize: page_size,
            locator: 'produse',
            totalNumber: tt,
            pageNumber:$('#page_number').val(),
            callback: function(data, pagination){
                render_targets(data);
                $('#total_number_input').val(pagination.pageNumber);
            },
            alias:{ pageNumber: 'offset',pageSize: 'limit'},
            beforePageOnClick: function(event){
                event.preventDefault();
                put_to_order(event.target.innerHTML,'total_number_input','page');
            },
        });
    }

    function get_data_by_color(id_culoare){
        $tb_response = $('.produse-container');
        $targets = '';
        datasource = '/produsee/culoare?culoare=' + id_culoare + '&cautare=<?= $text ?>';

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
        datasource = '/produsee/filtru?filtru=' + filtru + '&cautare=<?= $text ?>';

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
                  $html += '<div class = "swiper-produs-pret-container">' + value.pret + '<div class = "swiper-produs-lei">LEI</div></div>'
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
    var url = location.href;
    function addQSParm(name, value) {
        var re = new RegExp("([?&]" + name + "=)[^&]+", "i");
        function add(sep){ url += sep + name + "=" + encodeURIComponent(value);}
        function change(){ url = url.replace(re, "$1" + encodeURIComponent(value));}
        function remove(){url = url.replace(new RegExp("("+name+"=[^&]+&?)", 'i'), "");}
        if (url.indexOf("?") === -1) {
            add("?");
        } else {
            if (re.test(url)) {
                if(value == 'nada'){remove();} 
                else { change(); }
            } else {
                add("&");
            }
        }
    }

    function put_to_order(value,type,sent){
        var old_val_price = $('#' + type).val();
        $('#' + type).val(value);
        if($('#price_order').val() !== 'nada'){ addQSParm('price', $('#price_order').val()); } 
        if($('#noi_order').val() !== 'nada'){ addQSParm("latest",  $('#noi_order').val());}
        if($('#cele_mai_order').val() !== 'nada'){addQSParm("sold",  $('#cele_mai_order').val());}
        if($('#discount_order').val() !== 'nada'){addQSParm("discount",  $('#discount_order').val());}
        if($('#culoare_order').val() !== 'nada'){addQSParm("color",  $('#culoare_order').val());}
        if($('#marime_order').val() !== 'nada'){addQSParm("marime",  $('#marime_order').val());}
        addQSParm('page',$('#total_number_input').val());
        if(value == old_val_price){addQSParm(sent,'nada');}
        location.href=url;
    }
</script>
@endpush
