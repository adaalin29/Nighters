@extends('parts.template')
@section('title', $categoriia->title)
@section('site_description',$categoriia->description)
@section('keywords',$categoriia->keywords)
@section('content')
<div id="produse_page">
    <div class="small-banner">
        <img src="img/produs-banner.jpg" alt="">
        <div class="grey-overlay"></div>
        <div class="message">
            <h2><?php echo $categoriia->nume;?></h2>
        </div> <!-- end message -->
    </div> <!-- end banner-->
    <div class="my-container">
        <div class="row" style="margin-top:50px;">
        <?php
            foreach($subcategorii as $cat)
            {
                ?>
                      <div class="col-6 col-lg-4 col-xl-3">
                        <div class="produs-box" onclick="redirect_produs('<?php echo $cat->link;?>');">
                            <img src="/storage/<?php echo $cat->imagine;?>" alt="allgrey">
                            <p class="nume"><?php echo $cat->name;?></p>
                        </div><!-- end produs-box-->
                    </div><!-- end col-->
                <?php
            }
        ?>
        </div> <!-- end row-->
    </div> <!-- end container-->
    <a href="#" class="go-top"></a>
</div>
@push('scripts')
<script>
    AOS.init();
    function redirect_produs(link)
    {
        location.href='/produse/' + link;
    }
</script>
@endpush
@endsection