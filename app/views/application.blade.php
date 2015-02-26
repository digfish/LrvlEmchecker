
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Euromillions Checker</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


        <!-- Bootstrap -->

        {{ HTML::style('css/bootstrap.min.css',array('media' => 'screen')) }}
        {{ HTML::style('css/bootstrap-responsive.min.css')}}
        <!--         {{ HTML::style('css/my.css')}} -->

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        {{ HTML::script('js/jquery/jquery-1.9.0/jquery.min.js')}}



    </head>
    <body>
        <div class="container">
            <ul class="nav nav-tabs">
                <li>{{ link_to('/','Shots') }}</li>
                <li>{{ link_to("withdrawals",'Withdrawals') }}</li>
            </ul>

            @section('contents')
            Please fill in something over here...
            @show

            {{ link_to('register/form','Register your new shot',array('class' => 'btn btn-primary')) }}
            {{ link_to('fetcher/fetch_and_compare','Last withdrawal',array('class' => 'btn btn-primary')) }}
            {{ link_to('fetcher/next_withdrawal','Next withdrawal',array('class' => 'btn btn-primary')) }}


        </div>
        <!-- Defaut Js Bootsrap
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        {{ HTML::script('js/bootstrap-transition.js') }}
        {{ HTML::script('js/bootstrap-alert.js') }}
        {{ HTML::script('js/bootstrap-modal.js') }}
        {{ HTML::script('js/bootstrap-dropdown.js') }}
        {{ HTML::script('js/bootstrap-scrollspy.js') }}
        {{ HTML::script('js/bootstrap-tab.js') }}
        {{ HTML::script('js/bootstrap-tooltip.js') }}
        {{ HTML::script('js/bootstrap-popover.js') }}
        {{ HTML::script('js/bootstrap-button.js') }}
        {{ HTML::script('js/bootstrap-collapse.js') }}
        {{ HTML::script('js/bootstrap-carousel.js') }}
        {{ HTML::script('js/bootstrap-typeahead.js') }}

    </body>
</html>
