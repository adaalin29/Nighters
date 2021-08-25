@extends('parts.template')

@section('title', $meta->title)
@section('description', $meta->description)
@section('keywords', $meta->keywords)

@section('content')

<div class = "container">
    <div class = "big-title">Influenceri</div>
    <div class = "influenceri-container">
        <?php
        foreach($influenceri as $influencer)
        {
            ?>
                <div class = "influencer">
                    <a href="/produs/<?php echo $influencer->link?>"><div class = "influencer-poza"><img src = "{{ thumb('width:350', $influencer->imagine) }}" class = "full-width-cover"></div></a>
                    
                    <?php 
                    if($influencer->link != ""){
                        ?>
                            <div class="influencer-text"><?php echo $influencer->text?></div>
                        <?php
                    }else{
                        ?>
                            <div class = "influencer-text"><?php echo $influencer->text?></div>
                        <?php
                    }
                    ?>
                </div>
            <?php
        }
        ?>   
    </div>
    <div class = "newsletter-container">
        <div class = "small-title">Newsletter</div>
        <div class = "big-title no-bottom-bar">Fii la curent cu ultimele noutati!</div>
        <input type = "email" class = "newsletter-input" id="newsletter_email" placeholder = "Introduceti aici adresa dvs. de e-mail.">
        <button type = "submit" class = "newsletter-btn" onclick="subscribe();">Aboneaza-te</button>
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
                $(this).find('.order-products-title-container').find('.full-width').css('transform','rotate(0deg)');
            }else{
                $('#ordoneaza').addClass('ordoneaza-container-active');
                $('#filtreaza').removeClass('ordoneaza-container-active');
                $(this).find('.order-products-title-container').find('.full-width').css('transform','rotate(180deg)');
            }
        });

        $('#filtreaza-buton').click(function(){
            if($('#filtreaza').hasClass('ordoneaza-container-active')){
                $('#filtreaza').removeClass('ordoneaza-container-active');
                $(this).find('.order-products-title-container').find('.full-width').css('transform','rotate(0deg)');
            }else{
                $('#filtreaza').addClass('ordoneaza-container-active');
                $('#ordoneaza').removeClass('ordoneaza-container-active');
                $(this).find('.order-products-title-container').find('.full-width').css('transform','rotate(180deg)');
            }
        });

        $('.inchide-filtru-text').click(function(){
            if($('#ordoneaza').hasClass('ordoneaza-container-active')){
                $('#ordoneaza').removeClass('ordoneaza-container-active');
                $('#ordoneaza-buton').find('.order-products-title-container').find('.full-width').css('transform','rotate(0deg)');
            }
            if($('#filtreaza').hasClass('ordoneaza-container-active')){
                $('#filtreaza').removeClass('ordoneaza-container-active');
                $('#filtreaza-buton').find('.order-products-title-container').find('.full-width').css('transform','rotate(0deg)');
            }

        });
    });
</script>
@endpush