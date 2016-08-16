@extends('layouts.app')

<?php

date_default_timezone_set("Jamaica");

?>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default" style="padding-bottom: 0;margin-bottom: 0;">

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button onclick="window.location.href = 'http://buildingcostinfojamaica.com'" type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Your Building Cost Estimate</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Your estimate has been calculated and is as follows : $<span id="calculatedEstimate"></span><br><br>

                                        Comments : <span id="subtypeBlurb"></span>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button onclick="window.location.href = 'http://buildingcostinfojamaica.com/app'" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel-heading" style="text-align: center;"><h3 style="padding-top:0;padding-bottom:0;margin-top:0;margin-bottom:0;">Dashboard</h3></div>

                    <ul class="nav nav-pills">
                        <li id="notification_tab" class="active"><a data-toggle="pill" href="#">Notifications</a></li>
                        <li id="registration_tab"><a data-toggle="pill" href="#">View Registration</a></li>
                        <li id="estimates_tab"><a data-toggle="pill" href="#">Building Cost Estimates</a></li>
                        <li id="rates_tab"><a data-toggle="pill" href="#">Rates, Prices & Analyses</a></li>
                        <li id="history_tab"><a data-toggle="pill" href="#">History</a></li>

                        @if ($user->state == "Admin")
                            <li id="admin_tab"><a data-toggle="pill" href="#">Admin Panel</a></li>
                        @endif

                    </ul>

                    <!--<div class="panel-body">-->
                    <div class="panels" id="notifications">
                        <table class="table table-striped" style="padding-bottom: 0;margin-bottom: 0;">
                            <tr><td style="width:35%;"><b>Subject</b></td><td style="width:35%;"><b>Message</b></td><td style="width:35%;"><b>Date</b></td><td></td><td></td></tr>

                            @foreach ($notifications as $notification)

                                @if (strtotime($notification->scheduledate) < time())
                                    <tr><td style="width:35%;">{{ $notification->title }}</td><td style="width:35%;">{{ $notification->content }}</td><td style="width:30%;">{{ date('M j Y g:i A', strtotime($notification->scheduledate)) }}</td> <td>

                                            @if ($user->state == "Admin")
                                                <span><a href="notification/edit/{{$notification->id}}" class="btn btn-success" data-placement="left" role="button"><b>Update</b></a></span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($user->state == "Admin")

                                                <span><a href="notification/delete/{{$notification->id}}" class="btn btn-danger" data-toggle="confirmation" data-placement="left" role="button"><b>Delete</b></a></span>

                                            @endif

                                        </td></tr>

                                @endif

                            @endforeach


                        </table>

                    </div>

                    <div class="panels" id="history" style="display:none;">

                        <table class="table table-striped" style="padding-bottom: 0;margin-bottom: 0;">

                            <tr><td><b>Date & Time</b></td><td><b>Type</b></td><td><b>Area</b></td><td><b>Units</b></td><td><b>Estimate</b></td></tr>

                            @foreach ($calculations as $calculation)

                                @if ($calculation->user_id == $user->id)

                                    <tr><td>{{ date('M j Y g:i A', strtotime($calculation->created_at)) }}</td><td>{{ $calculation->type }}</td><td>{{ $calculation->area }}</td><td>{{ $calculation->units }} squared</td><td>{{ $calculation->estimate }} </td></tr>

                                @endif

                            @endforeach

                        </table>

                    </div>

                    <div class="panels" id="viewregistration" style="display:none;">
                        <div class="panel-body">
                            <!--<div class="btn-group">-->

                            @if($user->state == "New")
                                Your account is new - please contact bces.burrowesandwallace@gmail.com to be activated!
                            @endif

                            @if($user->state == "Admin")
                                You are an administrator! You can do whatever you like!
                            @endif

                            @if($user->state == "Use-Based")
                                Your account is use-based and you have {{ $user->uses }} uses remaining!
                            @endif

                            @if($user->state == "Time-Based")
                                Your account is time-based and you have until {{ date('M j Y g:i A', strtotime($user->scheduledenddate)) }}!
                            @endif

                            {{ Form::open(array('url' => 'user/update/' . $user->id)) }}

                            <div class="form-group">
                                <label class="col-md-4 control-label">First Name </label>

                                <div class="col-md-6">
                                    {{ Form::text('fname', $user->fname, array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Last Name </label>

                                <div class="col-md-6">
                                    {{ Form::text('lname', $user->lname, array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Address Line 1 </label>

                                <div class="col-md-6">
                                    {{ Form::text('address1', $user->address1, array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Address Line 2 </label>

                                <div class="col-md-6">
                                    {{ Form::text('address2', $user->address2, array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Zip Code </label>

                                <div class="col-md-6">
                                    {{ Form::text('zipcode', $user->zipcode, array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Country </label>

                                <div class="col-md-6">
                                    {{ Form::select('country', array(
        'AF'=>'AFGHANISTAN',
        'AL'=>'ALBANIA',
        'DZ'=>'ALGERIA',
        'AS'=>'AMERICAN SAMOA',
        'AD'=>'ANDORRA',
        'AO'=>'ANGOLA',
        'AI'=>'ANGUILLA',
        'AQ'=>'ANTARCTICA',
        'AG'=>'ANTIGUA AND BARBUDA',
        'AR'=>'ARGENTINA',
        'AM'=>'ARMENIA',
        'AW'=>'ARUBA',
        'AU'=>'AUSTRALIA',
        'AT'=>'AUSTRIA',
        'AZ'=>'AZERBAIJAN',
        'BS'=>'BAHAMAS',
        'BH'=>'BAHRAIN',
        'BD'=>'BANGLADESH',
        'BB'=>'BARBADOS',
        'BY'=>'BELARUS',
        'BE'=>'BELGIUM',
        'BZ'=>'BELIZE',
        'BJ'=>'BENIN',
        'BM'=>'BERMUDA',
        'BT'=>'BHUTAN',
        'BO'=>'BOLIVIA',
        'BA'=>'BOSNIA AND HERZEGOVINA',
        'BW'=>'BOTSWANA',
        'BV'=>'BOUVET ISLAND',
        'BR'=>'BRAZIL',
        'IO'=>'BRITISH INDIAN OCEAN TERRITORY',
        'BN'=>'BRUNEI DARUSSALAM',
        'BG'=>'BULGARIA',
        'BF'=>'BURKINA FASO',
        'BI'=>'BURUNDI',
        'KH'=>'CAMBODIA',
        'CM'=>'CAMEROON',
        'CA'=>'CANADA',
        'CV'=>'CAPE VERDE',
        'KY'=>'CAYMAN ISLANDS',
        'CF'=>'CENTRAL AFRICAN REPUBLIC',
        'TD'=>'CHAD',
        'CL'=>'CHILE',
        'CN'=>'CHINA',
        'CX'=>'CHRISTMAS ISLAND',
        'CC'=>'COCOS (KEELING) ISLANDS',
        'CO'=>'COLOMBIA',
        'KM'=>'COMOROS',
        'CG'=>'CONGO',
        'CD'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
        'CK'=>'COOK ISLANDS',
        'CR'=>'COSTA RICA',
        'CI'=>'COTE D IVOIRE',
        'HR'=>'CROATIA',
        'CU'=>'CUBA',
        'CY'=>'CYPRUS',
        'CZ'=>'CZECH REPUBLIC',
        'DK'=>'DENMARK',
        'DJ'=>'DJIBOUTI',
        'DM'=>'DOMINICA',
        'DO'=>'DOMINICAN REPUBLIC',
        'TP'=>'EAST TIMOR',
        'EC'=>'ECUADOR',
        'EG'=>'EGYPT',
        'SV'=>'EL SALVADOR',
        'GQ'=>'EQUATORIAL GUINEA',
        'ER'=>'ERITREA',
        'EE'=>'ESTONIA',
        'ET'=>'ETHIOPIA',
        'FK'=>'FALKLAND ISLANDS (MALVINAS)',
        'FO'=>'FAROE ISLANDS',
        'FJ'=>'FIJI',
        'FI'=>'FINLAND',
        'FR'=>'FRANCE',
        'GF'=>'FRENCH GUIANA',
        'PF'=>'FRENCH POLYNESIA',
        'TF'=>'FRENCH SOUTHERN TERRITORIES',
        'GA'=>'GABON',
        'GM'=>'GAMBIA',
        'GE'=>'GEORGIA',
        'DE'=>'GERMANY',
        'GH'=>'GHANA',
        'GI'=>'GIBRALTAR',
        'GR'=>'GREECE',
        'GL'=>'GREENLAND',
        'GD'=>'GRENADA',
        'GP'=>'GUADELOUPE',
        'GU'=>'GUAM',
        'GT'=>'GUATEMALA',
        'GN'=>'GUINEA',
        'GW'=>'GUINEA-BISSAU',
        'GY'=>'GUYANA',
        'HT'=>'HAITI',
        'HM'=>'HEARD ISLAND AND MCDONALD ISLANDS',
        'VA'=>'HOLY SEE (VATICAN CITY STATE)',
        'HN'=>'HONDURAS',
        'HK'=>'HONG KONG',
        'HU'=>'HUNGARY',
        'IS'=>'ICELAND',
        'IN'=>'INDIA',
        'ID'=>'INDONESIA',
        'IR'=>'IRAN, ISLAMIC REPUBLIC OF',
        'IQ'=>'IRAQ',
        'IE'=>'IRELAND',
        'IL'=>'ISRAEL',
        'IT'=>'ITALY',
        'JM'=>'JAMAICA',
        'JP'=>'JAPAN',
        'JO'=>'JORDAN',
        'KZ'=>'KAZAKSTAN',
        'KE'=>'KENYA',
        'KI'=>'KIRIBATI',
        'KP'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF',
        'KR'=>'KOREA REPUBLIC OF',
        'KW'=>'KUWAIT',
        'KG'=>'KYRGYZSTAN',
        'LA'=>'LAO PEOPLES DEMOCRATIC REPUBLIC',
        'LV'=>'LATVIA',
        'LB'=>'LEBANON',
        'LS'=>'LESOTHO',
        'LR'=>'LIBERIA',
        'LY'=>'LIBYAN ARAB JAMAHIRIYA',
        'LI'=>'LIECHTENSTEIN',
        'LT'=>'LITHUANIA',
        'LU'=>'LUXEMBOURG',
        'MO'=>'MACAU',
        'MK'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
        'MG'=>'MADAGASCAR',
        'MW'=>'MALAWI',
        'MY'=>'MALAYSIA',
        'MV'=>'MALDIVES',
        'ML'=>'MALI',
        'MT'=>'MALTA',
        'MH'=>'MARSHALL ISLANDS',
        'MQ'=>'MARTINIQUE',
        'MR'=>'MAURITANIA',
        'MU'=>'MAURITIUS',
        'YT'=>'MAYOTTE',
        'MX'=>'MEXICO',
        'FM'=>'MICRONESIA, FEDERATED STATES OF',
        'MD'=>'MOLDOVA, REPUBLIC OF',
        'MC'=>'MONACO',
        'MN'=>'MONGOLIA',
        'MS'=>'MONTSERRAT',
        'MA'=>'MOROCCO',
        'MZ'=>'MOZAMBIQUE',
        'MM'=>'MYANMAR',
        'NA'=>'NAMIBIA',
        'NR'=>'NAURU',
        'NP'=>'NEPAL',
        'NL'=>'NETHERLANDS',
        'AN'=>'NETHERLANDS ANTILLES',
        'NC'=>'NEW CALEDONIA',
        'NZ'=>'NEW ZEALAND',
        'NI'=>'NICARAGUA',
        'NE'=>'NIGER',
        'NG'=>'NIGERIA',
        'NU'=>'NIUE',
        'NF'=>'NORFOLK ISLAND',
        'MP'=>'NORTHERN MARIANA ISLANDS',
        'NO'=>'NORWAY',
        'OM'=>'OMAN',
        'PK'=>'PAKISTAN',
        'PW'=>'PALAU',
        'PS'=>'PALESTINIAN TERRITORY, OCCUPIED',
        'PA'=>'PANAMA',
        'PG'=>'PAPUA NEW GUINEA',
        'PY'=>'PARAGUAY',
        'PE'=>'PERU',
        'PH'=>'PHILIPPINES',
        'PN'=>'PITCAIRN',
        'PL'=>'POLAND',
        'PT'=>'PORTUGAL',
        'PR'=>'PUERTO RICO',
        'QA'=>'QATAR',
        'RE'=>'REUNION',
        'RO'=>'ROMANIA',
        'RU'=>'RUSSIAN FEDERATION',
        'RW'=>'RWANDA',
        'SH'=>'SAINT HELENA',
        'KN'=>'SAINT KITTS AND NEVIS',
        'LC'=>'SAINT LUCIA',
        'PM'=>'SAINT PIERRE AND MIQUELON',
        'VC'=>'SAINT VINCENT AND THE GRENADINES',
        'WS'=>'SAMOA',
        'SM'=>'SAN MARINO',
        'ST'=>'SAO TOME AND PRINCIPE',
        'SA'=>'SAUDI ARABIA',
        'SN'=>'SENEGAL',
        'SC'=>'SEYCHELLES',
        'SL'=>'SIERRA LEONE',
        'SG'=>'SINGAPORE',
        'SK'=>'SLOVAKIA',
        'SI'=>'SLOVENIA',
        'SB'=>'SOLOMON ISLANDS',
        'SO'=>'SOMALIA',
        'ZA'=>'SOUTH AFRICA',
        'GS'=>'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
        'ES'=>'SPAIN',
        'LK'=>'SRI LANKA',
        'SD'=>'SUDAN',
        'SR'=>'SURINAME',
        'SJ'=>'SVALBARD AND JAN MAYEN',
        'SZ'=>'SWAZILAND',
        'SE'=>'SWEDEN',
        'CH'=>'SWITZERLAND',
        'SY'=>'SYRIAN ARAB REPUBLIC',
        'TW'=>'TAIWAN, PROVINCE OF CHINA',
        'TJ'=>'TAJIKISTAN',
        'TZ'=>'TANZANIA, UNITED REPUBLIC OF',
        'TH'=>'THAILAND',
        'TG'=>'TOGO',
        'TK'=>'TOKELAU',
        'TO'=>'TONGA',
        'TT'=>'TRINIDAD AND TOBAGO',
        'TN'=>'TUNISIA',
        'TR'=>'TURKEY',
        'TM'=>'TURKMENISTAN',
        'TC'=>'TURKS AND CAICOS ISLANDS',
        'TV'=>'TUVALU',
        'UG'=>'UGANDA',
        'UA'=>'UKRAINE',
        'AE'=>'UNITED ARAB EMIRATES',
        'GB'=>'UNITED KINGDOM',
        'US'=>'UNITED STATES',
        'UM'=>'UNITED STATES MINOR OUTLYING ISLANDS',
        'UY'=>'URUGUAY',
        'UZ'=>'UZBEKISTAN',
        'VU'=>'VANUATU',
        'VE'=>'VENEZUELA',
        'VN'=>'VIET NAM',
        'VG'=>'VIRGIN ISLANDS, BRITISH',
        'VI'=>'VIRGIN ISLANDS, U.S.',
        'WF'=>'WALLIS AND FUTUNA',
        'EH'=>'WESTERN SAHARA',
        'YE'=>'YEMEN',
        'YU'=>'YUGOSLAVIA',
        'ZM'=>'ZAMBIA',
        'ZW'=>'ZIMBABWE',
      ), $user->country, array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Phone # </label>

                                <div class="col-md-6">
                                    {{ Form::text('phone', $user->phone, array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Email </label>

                                <div class="col-md-6">
                                    {{ Form::text('email', $user->email, array("class" => "form-control")) }}
                                </div>
                            </div>

                            <br>

                            <div class="form-group" >
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">
                                        <i class="fa fa-btn fa-user"></i>Update Registration!
                                    </button>
                                </div>
                            </div>

                            {{ Form::close() }}

                            <br><br><br><br>

                            {{ Form::open(array('url' => 'user/passwordchange/' . $user->id)) }}

                            <div class="form-group">
                                <label class="col-md-4 control-label">New Password : </label>

                                <div class="col-md-6">
                                    {{ Form::password('password', array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">New Password (again) </label>

                                <div class="col-md-6">
                                    {{ Form::password('password_confirm', array("class" => "form-control")) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Update Password!
                                    </button>
                                </div>
                            </div>


                            {{ Form::close() }}




                            <!--</div>-->
                        </div>
                    </div>


                    <div class="panels" id="estimate" style="display:none;">
                        <div class="panel-body">

                            @if ($user->state != "New")

                                @if ($user->state != "Use-Based" || $user->uses > 0)

                                    @if ($user->state != "Time-Based" || strtotime($user->scheduledenddate) > time())

                                        <!--<div class="btn-group">-->

                                        <div id="area-container" class="form-group has-error has-feedback">
                                            <div class="">

                                                <input type="text" class="form-control" id="usr" placeholder="Enter the area">

                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>

                                            </div>

                                        </div>

                                        <sup><b>(GROSS EXTERNAL AREA)</b></sup>

                                        <br>

                                        <label class="radio-inline"><input checked id="meters" value="metres" type="radio" name="units">Square Meters</label>

                                        <label class="radio-inline"><input id="feet" value="feet" type="radio" name="units">Square Feet</label>

                                        <br><br>

                                        <div id="tree"></div>

                                        <div class="panel panel-danger" id="confirmationBox">
                                            <div class="panel-body" style="color:#990000;font-weight:bold;">Please double-check that you want to calculate <span id="area">0</span> <span id="units">m</span><sup>2</sup> (gross external area) with the <span id="buildingtype"></span> option!</div>
                                        </div>

                                        <div class="col-md-12 text-center">

                                            <button onclick="doEstimate()" id="doEstimateBtn" type="button" class="disabled btn btn-success btn-block disableClick" data-toggle="modal" data-target="#myModal">Calculate Estimate!</button>

                                            <input style="visibility:hidden;" type="text" id="priceholder"/>

                                            <input style="visibility:hidden;" type="text" id="blurbholder"/>

                                            <input style="visibility:hidden;" value="{{ $user->id }}" type="text" id="user_id"/>

                                            <input style="visibility:hidden;" type="text" id="node_id"/>

                                        </div>

                                    @else

                                        Your time-based subscription has expired! Please contact us at bces.burrowesandwallace@gmail.com or call (876) 929-2805  or (876) 925 - 5298 to renew your subscription!

                                    @endif

                                @else

                                    Your use-based subscription has expired! Please contact us at bces.burrowesandwallace@gmail.com or call (876) 929-2805  or (876) 925 - 5298 to renew your subscription!

                                @endif

                            @else

                                Please contact us at bces.burrowesandwallace@gmail.com or call (876) 929-2805  or (876) 925 - 5298 to have your account activated!

                                @endif

                                        <!--</div>-->
                        </div>
                    </div>

                    <div class="panels" id="administration" style="display:none;">
                        <div class="panel-body">
                            <!--<div class="btn-group">-->
                            <a href="notification/form" class="btn btn-success" role="button">Create A Notification!</a>
                            <a href="users/manage" class="btn btn-danger" role="button">Manage Users!</a>
                            <!--<a href="notification/form" class="btn btn-primary" role="button">Manage/Create Usage Plans!</a>-->
                            <a href="prices/form" class="btn btn-info" role="button">Update Subtypes!</a>
                            <!--</div>-->
                        </div>
                    </div>

                    <div class="panels" id="ratespricesanalyses" style="display:none;">
                        <div class="panel-body">
                            <!--<div class="btn-group">-->

                            @if ($user->state == "Admin" || $user->state == "Time-Based")

                                <button id="ratesbtn" type="button" class="btn btn-info">Rates</button>

                                <button id="analysisbtn" type="button" class="btn btn-info">Prices</button>

                                <button id="pricesbtn"  type="button" class="btn btn-info">Analysis</button>

                                <br><br>

                                <iframe class="docs" id="ratesdoc" style="width:100%;height:80vh;" src="https://docs.google.com/spreadsheets/d/1YrAB_2wsQ_bKwF9gwbBrToKwFm8RPbNe0F2FlFL2EvQ/pubhtml?widget=true&amp;headers=false"></iframe>


                                <iframe class="docs" id="analysisdoc" style="width:100%;height:80vh;" src="https://docs.google.com/document/d/1LuC8PrhUITz_ZFJb0TBezzWSffInWmZKJGP75OAFbj8/pub?widget=true&amp;headers=false&embedded=true"></iframe>


                                <iframe class="docs" id="pricesdoc" style="width:100%;height:80vh;" src="https://docs.google.com/spreadsheets/d/1bx26BasUdUk4PSZmjaKUsaRPCDeGF25O5Aa9gyo20PY/pubhtml?widget=true&amp;headers=false"></iframe>

                            @else

                                Please contact us at bces.burrowesandwallace@gmail.com to access this feature!

                                @endif

                                        <!--</div>-->
                        </div>
                    </div>
                    <!--</div>-->

                </div>

                <div style="text-align: center;padding-top:30px;">&copy; 2016 Burrowes & Wallace. All Rights Reserved.</div>

            </div>
        </div>
    </div>
@endsection



