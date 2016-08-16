<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Building Cost Estimator</title>

    <script type="text/javascript" src="{{ asset('js/pdf.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('css/jquery.datetimepicker.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bci.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        .help-link {

            cursor: pointer;
            cursor: hand;
            padding-top:10px;

        }

    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Building Cost Estimator
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">Home</a></li>
                <li><a data-toggle="modal" data-target="#helpModal" href="#mode">Help</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Modal -->
<div id="helpModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Building Cost Estimator Help</h4>
            </div>
            <div class="modal-body">

                <p>Thanks for using our Building Cost Estimator application! Please familiarize yourself with the various features provided as detailed below : <br><br></p>

                <b><a class="help-link" data-toggle="collapse" data-target="#notification-help">Notifications</a></b><br><br>

                <div id="notification-help" class="collapse">
                    In the <b>Notifications</b> tab, you will find a listing of notices from the system administrators (if any are available). These will keep you informed of recent and upcoming events as well as features that will be added to the system.<br><br>

                    <img src="http://www.argentmac.com/delvertassets/img/notiff2.png" style="width:100%;margin:0;padding:0;"/>

                    <br><br>
                </div>

                <b><a class="help-link" data-toggle="collapse" data-target="#registration-help">Account Management</a></b><br><br>

                <div id="registration-help" class="collapse">
                    On the <b>View Registration</b> tab, you will find options for updating your account information (name, address, contact details, etc.). You should use this section to keep your information up to date and ensure that we have the most current information.<br><br>You can also update your account password from this panel using the simple form functionality provided. Be sure to use a secure password that only you know and do not write it down or share it with anyone else.<br><br>

                    <img src="http://www.argentmac.com/delvertassets/img/reg.png" style="width:100%;margin:0;padding:0;"/>

                    <br><br>

                </div>

                <b><a class="help-link" data-toggle="collapse" data-target="#calculation-help">Calculations</a></b><br><br>

                <div id="calculation-help" class="collapse">
                    As its name suggests, you will carry out your calculations on this tab by submitting the required information for the application to do its work. The process for doing this entails 3 simple steps.<br><br>

                    <img src="http://www.argentmac.com/delvertassets/img/calc.png" style="width:100%;margin:0;padding:0;"/><br><br>

                    <b>Step 1 : </b> Enter the gross external area in square feet or metres in the text box provided.<br><br>

                    <b>Step 2 : </b> Select the unit of measurement (i.e. metres or feet squared) using the radio buttons (circles) provided.<br><br>

                    <b>Step 3 : </b> Using the drop-down tree structure, select the building type that you are calculating the estimate for. Please note that you will not be able to use the button to submit a calculation request until you have selected an appropriate item from the tree, i.e. you need to proceed through the categories using the "plus signs" until you select the roofing type.<br><br>

                    <b>Step 4 : </b> Once you have selected an appropriate building type, the "Calculate Estimate" button will be activated and you will be able to select it and view your results.

                    <br><br>
                </div>

                <b><a class="help-link" data-toggle="collapse" data-target="#rates-help">Rates, Prices, and Analysis</a></b><br><br>

                <div id="rates-help" class="collapse">
                    The <b>Rates, Prices, & Analysis</b> tab gives you access to premium documents prepared by Burrowes & Wallace Chartered Quantity Surveyors with valuable information to assist with building costing. You can switch between the documents using the tabs provided and navigate them as you would a normal Word document or Excel spreadsheet. You will not, however, be able to save the documents as they are hosted online and updated periodically.<br><br>

                    <img src="http://www.argentmac.com/delvertassets/img/rpa.png" style="width:100%;margin:0;padding:0;"/>

                    <br><br>

                </div>

                <b><a class="help-link" data-toggle="collapse" data-target="#history-help">History</a></b><br><br>

                <div id="history-help" class="collapse">
                    The <b>View History</b> tab lets you review your past calculations. It lists the calculations you've done including the building type, the building cost that was assessed, and the time and date that the calculation was carried out.<br><br>



                    <img src="http://www.argentmac.com/delvertassets/img/hist.png" style="width:100%;margin:0;padding:0;"/>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

<script type="text/javascript" src="{{ asset('js/bootstrap-confirmation.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery.datetimepicker.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/bci.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/bootstrap-treeview.js') }}"></script>

</body>
</html>


