<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="All your marketing in one place!">
        <meta name="author" content="Dallas Matthews Ltd">
        <link rel="shortcut icon" href="{{ URL::to('/assets/img/favicon.png') }}">

        <title>Client Area | CampaignDashboard.co.uk</title>

        {{-- HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') --}}
        {{ HTML::style('/assets/css/bootstrap/bootstrap.css') }}
        {{-- HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css') --}}
        {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css') }}

        {{ HTML::style('/assets/css/client.css') }}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            {{ HTML::script('/assets/js/others/html5shiv.js') }}  
          <script src="<?php // echo site_url('assets/bootstrap-3/js/respond.min.js'); ?>"></script>
        <![endif]-->
        
    </head>

    <body>
        
        <div class="container">
                
            <!-- Content -->
            <div class="row" id="clientLogin">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @section('content')
                        <h2>Add your content in the views/{route}/{method}.blade.php file</h2>
                    @show    
                </div>
            </div>
            <!-- / Content -->

        </div>
        <!-- / Container -->
    
        <!-- Footer -->
        <div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <p class="navbar-text text-muted credit">Copyright <a href="http://DallasMatthews.co.uk" target="_blank">Dallas Matthews Ltd</a> <?= date('Y'); ?></p>
            </div>
        </div>
        <!-- / Footer -->

        <!-- Call all scripts -->
        {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js') }}
        {{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js') }}

        <!-- Call all datatables JS -->
        {{ HTML::script('assets/js/datatables/jquery.dataTables.min.js') }}
        {{ HTML::script('assets/js/datatables/dataTables.bootstrapPagination.js') }}
        {{ HTML::script('assets/js/datatables/datatables.custom.js') }}

        <!-- Call Other JS -->
        {{ HTML::script('assets/js/others/client.js') }}
        
    </body>
</html>