@extends('parts.template')

@section('title', 'Termeni si conditii - Nighters')

@section('content')
<div id="termeni_page">
   
   
    <section>
        <div class="container same-ref">
            <div>
                    <?php
                        foreach($politica as $pl)
                        {
                            echo $pl->descriere;
                        }
                    ?>
            </div>
        </div>
    </section>

    <a href="#" class="go-top">  </a>
</div>
@endsection

