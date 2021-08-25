@extends('parts.template')

@section('title', $meta->title)
@section('description', $meta->description)
@section('keywords', $meta->keywords)

@section('content')
<?php
    
        if(count($swiper) > 1)
        {
            ?>
<div class="video-banner">
    <div class="swiper-container home-swiper deskop-swiper">
        <div class="swiper-wrapper">
            <?php
                    foreach($swiper as $swipe)
                    {
                        if($swipe->device == 'desktop')
                        {
                            if(Storage::disk('public')->getMimeType($swipe->imagine) == 'video/mp4'){
                                ?>
            <a href="/<?php echo $swipe->link;?>" class="swiper-slide">
                <video autoplay muted loop playsInline>
                    <source src="/storage/<?php echo $swipe->imagine;?>" type="video/mp4">
                </video>
            </a>
            <?php
                             }
                             else{
                                ?>
            <a href="/<?php echo $swipe->link;?>" class="swiper-slide"
                style="background-image:url({{ thumb('width:1800', $swipe->imagine) }})"></a>
            <?php
                             }
                        }
                    }
                    ?>
        </div>
    </div>
    <div class="swiper-container home-swiper mobile-swiper">
        <div class="swiper-wrapper">
            <?php
                    foreach($swiper as $swipe)
                    {  
                    if($swipe->device == 'mobile'){
                        if(Storage::disk('public')->getMimeType($swipe->imagine) == 'video/mp4'){
                            ?>
            <a href="/<?php echo $swipe->link;?>" class="swiper-slide">
                <video autoplay muted loop playsInline>
                    <source src="/storage/<?php echo $swipe->imagine;?>" type="video/mp4">
                </video>
            </a>
            <?php
                         }
                         else{
                            ?>
            <a href="/<?php echo $swipe->link;?>" class="swiper-slide"
                style="background-image:url({{ thumb('width:1000', $swipe->imagine) }})"></a>
            <?php
                         }
                    }
                    }
                    ?>
        </div>
    </div>
</div>
<?php
        }else{
            if(Storage::disk('public')->getMimeType($swiper[0]->imagine) == 'video/mp4'){
                ?>
<video autoplay muted loop>
    <source src="/storage/<?php echo $swiper[0]->imagine;?>" type="video/mp4">
</video>
<?php
             }else{
                ?>

<a href="/<?php echo $swiper[0]->link;?>">
    <div class="video-banner" style="background-image:url(/storage/<?php echo $swiper[0]->imagine;?>)" loading="lazy">
    </div>
</a>
<?php
             }
        }
        ?>

<div class="container">
    <div class="small-title">Noutati</div>
    <div class="big-title">Descopera noile pijamale nighters</div>
</div>

<div class="contaienr-overflow">
    <div class="swiper-container noi-pijamale">
        <div class="swiper-wrapper">
            <?php
                foreach($produse_noi as $produs_vandut){
                    ?>
            <div class="swiper-slide">
                <a class="swiper-produs" href="/produs/<?php echo $produs_vandut->link;?>">
                    <?php
                              if($produs_vandut->nou =='da'){
                                ?>
                    <div class="produs-nou">NOU</div>
                    <?php
                                }
                                $k = 0;
                                foreach($produs_vandut->poze as $poza){
                                
                                if($k == 0)
                                {
                                    ?>
                    <img class="full-width first-image" src="{{ thumb('width:350', $poza) }}" loading="lazy" />
                    <?php
                                }
                                if($k == 1)
                                {
                                    ?>
                    <img class="full-width second-image" src="{{ thumb('width:350', $poza) }}" loading="lazy" />
                    <?php
                                }
                                $k++;
                            }
                            ?>

                    <div class="swiper-produs-descriere"><?php echo $produs_vandut->nume;?></div>
                    <?php
                            if($produs_vandut->promotie == 'da')
                            {
                                ?>
                    <div class="reducere-pret-container">
                        <div class="swiper-produs-pret-container"><?php echo $produs_vandut->pret;?> <div
                                class="swiper-produs-lei">LEI</div>
                        </div>
                        <div class="swiper-produs-pret-container pret-container-reducere">
                            <?php echo $produs_vandut->pretvechi;?> </div>
                    </div>
                    <?php
                            }else{
                                ?>
                    <div class="swiper-produs-pret-container"><?php echo $produs_vandut->pret;?> <div
                            class="swiper-produs-lei">LEI</div>
                    </div>
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
    <div class="swiper-button-next pijamale-noi-next"></div>
    <div class="swiper-button-prev pijamale-noi-prev"></div>
</div>
<div class="boxes-container">
    <?php
    $len = count($colectii);

    $firsthalf = array_slice(json_decode($colectii), 0, $len / 2);
    $secondhalf = array_slice(json_decode($colectii), $len / 2);

    $a = 0;
    foreach($firsthalf as $first)
    {
        
        if($a%2 == 0)
        {
        ?>
    <div class="boxes">
        <a href="/<?php echo $first->slug;?>">
            <div class="box-item">
                <div class="overlay"></div>
                <img src="{{ thumb('width:900', $first->imagine) }}" class="full-width-cover">
            </div>
        </a>

        <div class="box-item box-item-padding">
            <div class="box-item-category"><?php echo $first->subtitlu;?></div>
            <div class="box-item-text"><?php echo $first->titlu;?><div class="box-linie"></div>
            </div>
            <a href="/<?php echo $first->slug;?>" class="box-item-descopera">Descopera</a>
        </div>
    </div>
    <?php
        }
        if($a%2 == 1){
            ?>
    <div class="boxes boxes-reverse">
        <div class="box-item box-item-padding">
            <div class="box-item-category box-item-category-reverse"><?php echo $first->subtitlu;?></div>
            <div class="box-item-text box-item-text-reverse"><?php echo $first->titlu;?><div class="box-linie"></div>
            </div>
            <a href="/<?php echo $first->slug;?>" class="box-item-descopera box-item-descopera-reverse">Descopera</a>
        </div>
        <a href="/<?php echo $first->slug;?>">
            <div class="box-item">
                <div class="overlay"></div>
                <img src="{{ thumb('width:900', $first->imagine) }}" class="full-width-cover">
            </div>
        </a>
    </div>
    <?php
        }
       
        $a++;
    }
    ?>

</div>
<div class="container">
    <div class="small-title">promotii</div>
    <div class="big-title">Descopera promotii la colectia de primavara - vara</div>
</div>

<div class="contaienr-overflow">
    <div class="swiper-container promotii">
        <div class="swiper-wrapper">
            <?php
                foreach($produse as $produs){
                    if($produs->promotie == 'da' && $produs->pretvechi > 0)
                    {
                        ?>
            <div class="swiper-slide">
                <a class="swiper-produs" href="/produs/<?php echo $produs->link;?>">
                    <div class="produs-nou">
                        -<?php echo round(($produs->pretvechi - $produs->pret)*100/$produs->pretvechi);?>%</div>
                    <?php
                                    if($produs->nou =='da'){
                                    ?>
                    <div class="produs-nou">NOU</div>
                    <?php
                                    }
                                    $k = 0;
                                    foreach($produs->poze as $poza){
                                    
                                    if($k == 0)
                                    {
                                        ?>
                    <img class="full-width first-image" src="{{ thumb('width:350', $poza) }}" />
                    <?php
                                    }
                                    if($k == 1)
                                    {
                                        ?>
                    <img class="full-width second-image" src="{{ thumb('width:350', $poza) }}" />
                    <?php
                                    }
                                    $k++;
                                    }
                                ?>

                    <div class="swiper-produs-descriere"><?php echo $produs->nume;?></div>
                    <div class="reducere-pret-container">
                        <div class="swiper-produs-pret-container"><?php echo $produs->pret;?> <div
                                class="swiper-produs-lei">LEI</div>
                        </div>
                        <div class="swiper-produs-pret-container pret-container-reducere">
                            <?php echo $produs->pretvechi;?> </div>
                    </div>
                </a>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
    <div class="swiper-button-next promotii-next"></div>
    <div class="swiper-button-prev promotii-prev"></div>
</div>
<?php
       $a = 0;
    foreach($secondhalf as $second)
    {
        if($a%2 == 0 )
        {
        ?>

<div class="boxes">
    <a href="/<?php echo $second->slug;?>">
        <div class="box-item">
            <div class="overlay"></div>
            <img src="{{ thumb('width:900', $second->imagine) }}" class="full-width-cover">
        </div>
    </a>

    <div class="box-item box-item-padding">
        <div class="box-item-category"><?php echo $second->subtitlu;?></div>
        <div class="box-item-text"><?php echo $second->titlu;?><div class="box-linie"></div>
        </div>
        <a href="/<?php echo $second->slug;?>" class="box-item-descopera">Descopera</a>
    </div>
</div>


<?php
        }
        if($a%2 == 1){
            ?>
<div class="boxes boxes-reverse">
    <div class="box-item box-item-padding">
        <div class="box-item-category box-item-category-reverse"><?php echo $second->subtitlu;?></div>
        <div class="box-item-text box-item-text-reverse"><?php echo $second->titlu;?><div class="box-linie"></div>
        </div>
        <a href="/<?php echo $second->slug;?>" class="box-item-descopera box-item-descopera-reverse">Descopera</a>
    </div>
    <a href="/<?php echo $second->slug;?>">
        <div class="box-item">
            <div class="overlay"></div>
            <img src="{{ thumb('width:900', $second->imagine) }}" class="full-width-cover">
        </div>
    </a>
</div>
<?php
        }
       
        $a++;
    }
    ?>

<div class="contaienr-overflow">
    <div class="big-title big-title-margin-top no-bottom-bar">Most loved</div>
    <div class="promotii-category-container">
        <?php
            $j = 0;
            foreach($categorii as $categorie_sort)
            {
                if($j == 0)
                {
                    ?>
        <div class="promotii-category-item" onclick="sort_promotii_category(<?php echo $categorie_sort->id;?>)">
            <?php echo $categorie_sort->nume;?>
            <div class="promotii-category-linie"></div>
        </div>
        <?php
                }else{
                    ?>
        <div class="promotii-category-item" onclick="sort_promotii_category(<?php echo $categorie_sort->id;?>)">
            <?php echo $categorie_sort->nume;?></div>
        <?php
                }
                $j++;
            ?>

        <?php
            }
            ?>
    </div>

    <div class="swiper-container loved">
        <div class="swiper-wrapper">
            <?php
                foreach($produse_vandute as $produs_vandut){
                    ?>
            <div class="swiper-slide swiper-produs produs">
                <a href="/produs/<?php echo $produs_vandut->link;?>">
                    <?php
                            if($produs_vandut->nou =='da'){
                                ?>
                    <div class="produs-nou">NOU</div>
                    <?php
                            }
                            ?>
                    <?php
                                $k = 0;
                                foreach($produs_vandut->poze as $poza){
                                    
                                if($k == 0)
                                {
                                    ?>
                    <img class="full-width first-image" src="{{ thumb('width:350', $poza) }}" />
                    <?php
                                }
                                if($k == 1)
                                {
                                    ?>
                    <img class="full-width second-image" src="{{ thumb('width:350', $poza) }}" />
                    <?php
                                }
                                $k++;
                                }
                            ?>
                    <div class="swiper-produs-descriere"><?php echo $produs_vandut->nume;?></div>
                    <?php
                            if($produs_vandut->promotie =='da' && $produs_vandut->pretvechi > 0)
                            {
                                ?>
                    <div class="produs-nou">
                        -<?php echo round(($produs_vandut->pretvechi - $produs_vandut->pret)*100/$produs_vandut->pretvechi);?>%
                    </div>
                    <div class="reducere-pret-container">
                        <div class="swiper-produs-pret-container"><?php echo $produs_vandut->pret;?> <div
                                class="swiper-produs-lei">LEI</div>
                        </div>
                        <div class="swiper-produs-pret-container pret-container-reducere">
                            <?php echo $produs_vandut->pretvechi;?> </div>
                    </div>
                    <?php
                            }else{
                                ?>
                    <div class="swiper-produs-pret-container"><?php echo $produs_vandut->pret;?> <div
                            class="swiper-produs-lei">LEI</div>
                    </div>
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

<div class="container">
    <div class="newsletter-container">
        <div class="small-title">Newsletter</div>
        <div class="big-title no-bottom-bar">Fii la curent cu ultimele noutati!</div>
        <input type="email" class="newsletter-input" id="newsletter_email"
            placeholder="Introduceti aici adresa dvs. de e-mail.">
        <button class="newsletter-btn" onclick="subscribe();">Aboneaza-te</button>
    </div>
</div>

<div class="inspired-instagram">
    <div class="inspired-text">be inspired by our influencers lookbook</div>

    <div class="swiper-container inspired-instagram-container">
        <div class="swiper-wrapper">
            <?php
            foreach($influenceri as $influencer)
            {
                ?>
            <div class="swiper-slide">
                <a data-fancybox="gallery" href="/storage/<?php echo $influencer->imagine;?>" class="instagram-image">
                    <img src="{{ thumb('width:300', $influencer->imagine) }}" class="full-width-cover">
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
$(document).ready(function() {
    var Instagram = new Swiper('.inspired-instagram-container', {
        slidesPerView: 2,
        spaceBetween: 16,
        loop: true,
        centeredSlides: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            1025: {
                slidesPerView: 6,
                spaceBetween: 16,
                loop: true,
                centeredSlides: false,

            },
            770: {
                slidesPerView: 4,
                spaceBetween: 16,
                loop: false,
                centeredSlides: false,
            },
            560: {
                slidesPerView: 3,
                spaceBetween: 16,
                loop: false,
                centeredSlides: false,
            }
        }
    });


    var PijamaleNoi = new Swiper('.noi-pijamale', {
        slidesPerView: 1,
        spaceBetween: 20,
        slidesPerGroup: 1,
        loop: true,
        navigation: {
            nextEl: '.pijamale-noi-next',
            prevEl: '.pijamale-noi-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            1025: {
                slidesPerView: 4,
                spaceBetween: 65,
            },
            770: {
                slidesPerView: 3,
                spaceBetween: 65,
            },
            481: {
                slidesPerView: 2,
                spaceBetween: 45,
            }
        }
    });

    var Promotii = new Swiper('.promotii', {
        slidesPerView: 1,
        spaceBetween: 20,
        slidesPerGroup: 1,
        loop: true,
        navigation: {
            nextEl: '.promotii-next',
            prevEl: '.promotii-prev',
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            1025: {
                slidesPerView: 4,
                spaceBetween: 65,
            },
            770: {
                slidesPerView: 3,
                spaceBetween: 65,
            },
            481: {
                slidesPerView: 2,
                spaceBetween: 45,
            }
        }
    });

    var Loved = new Swiper('.loved', {
        slidesPerView: 1,
        spaceBetween: 0,
        slidesPerGroup: 1,
        loop: true,
        observer: true,
        navigation: {
            nextEl: '.loved-next',
            prevEl: '.loved-prev',
        },
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        breakpoints: {
            1025: {
                slidesPerView: 4,
                spaceBetween: 65,
            },
            770: {
                slidesPerView: 3,
                spaceBetween: 65,
            },
            481: {
                slidesPerView: 2,
                spaceBetween: 45,
            }
        }
    });
    var home = new Swiper('.home-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        slidesPerGroup: 1,
        // autoplay: {
        //     delay: 3500,
        //     disableOnInteraction: false,
        // },
    });


    $('.promotii-category-item').click(function() {
        $('.promotii-category-item').find('.promotii-category-linie').remove();
        $(this).append('<div class = "promotii-category-linie"></div>');
    });
});
</script>
@endpush