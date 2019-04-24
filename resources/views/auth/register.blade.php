@extends('layouts.guest_app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 mt-5">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">HCI Registration</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="sections" value="">
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="md-form">
                                    <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="firstName" id="firstName" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}" value="{{old('firstName')}}">
                                    <label for="firstName">First Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('firstName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <div class="md-form">
                                    <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="lastName" id="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}" value="{{old('lastName')}}">
                                    <label for="lastName">Last Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('lastName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6">
                                 <div class="md-form">
                                    <input type="email" id="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{old('email')}}">
                                    <label for="email">Email Address <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="md-form">
                            <input type="text" id="username" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{old('username')}}">
                            <label for="username">Username <span class="red-asterisk">*</span></label>
                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form">
                                <input type="password" id="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                                <label for="password" class="label_password">Password <span class="red-asterisk">*</span></label>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                </div>
                            </div>
                        
                        <div class="col-md-6">
                                <div class="md-form">
                                    <input type="text" id="mobileNumber" name="mobileNumber" class="form-control {{$errors->has('mobileNumber') ? 'is-invalid' : ''}}">
                                    <label for="mobileNumber" class="mobileNumber">Mobile Number <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('mobileNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobileNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                                <div class="md-form">
                                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}">
                                    <label for="password-confirm" class="label_confirm">Confirm Password <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif 
                                </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="md-form">
                                 <select class="select-wrapper mdb-select" name="region" id="region">
                                    <option value="" disabled selected>Select Region</option>
                                    <option value="REGION I (Ilocos Region)" {{ old('prob_category') == 'REGION I (Ilocos Region)' ? 'selected' : ''}}>REGION I (Ilocos Region)</option>
                                    <option value="REGION II (Cagayan Valley)" {{ old('prob_category') == 'REGION II (Cagayan Valley)' ? 'selected' : ''}}>REGION II (Cagayan Valley)</option>
                                    <option value=">REGION III (Central Luzon)" {{ old('prob_category') == '>REGION III (Central Luzon)' ? 'selected' : ''}}>REGION III (Central Luzon)</option>
                                    <option value="REGION IV-A (CALABARZON)" {{ old('prob_category') == 'REGION IV-A (CALABARZON)' ? 'selected' : ''}}>REGION IV-A (CALABARZON)</option>
                                    <option value="REGION IV-B (MIMAROPA)" {{ old('prob_category') == 'REGION IV-B (MIMAROPA)' ? 'selected' : ''}}>REGION IV-B (MIMAROPA)</option>
                                    <option value="REGION V (Bicol Region)" {{ old('prob_category') == 'REGION V (Bicol Region)' ? 'selected' : ''}}>REGION V (Bicol Region)</option> 
                                    <option value="REGION VI (Western Visayas)" {{ old('prob_category') == 'REGION VI (Western Visayas)' ? 'selected' : ''}}>REGION VI (Western Visayas)</option>
                                    <option value="REGION VII (Central Visayas)" {{ old('prob_category') == 'REGION VII (Central Visayas)' ? 'selected' : ''}}>REGION VII (Central Visayas)</option>
                                    <option value="REGION VIII (Eastern Visayas)" {{ old('prob_category') == 'REGION VIII (Eastern Visayas)' ? 'selected' : ''}}>REGION VIII (Eastern Visayas)</option>
                                    <option value="REGION IX (Zamboanga Peninsula)" {{ old('prob_category') == 'REGION IX (Zamboanga Peninsula)' ? 'selected' : ''}}>REGION IX (Zamboanga Peninsula)</option>  
                                    <option value="REGION X (Nothern Mindanao)" {{ old('prob_category') == 'REGION X (Nothern Mindanao)' ? 'selected' : ''}}>REGION X (Nothern Mindanao)</option> 
                                    <option value="REGION XI (Davao Region)" {{ old('prob_category') == 'REGION XI (Davao Region)' ? 'selected' : ''}}>REGION XI (Davao Region)</option>  
                                    <option value="REGION XII (Soccsksargen)" {{ old('prob_category') == 'REGION XII (Soccsksargen)' ? 'selected' : ''}}>REGION XII (Soccsksargen)</option>
                                    <option value="REGION XIII (Caraga)" {{ old('prob_category') == 'REGION XIII (Caraga)' ? 'selected' : ''}}>REGION XIII (Caraga)</option> 
                                    <option value="ARMM - Autonomous Region in Muslim Mindanao" {{ old('prob_category') == 'ARMM - Autonomous Region in Muslim Mindanao' ? 'selected' : ''}}>ARMM - Autonomous Region in Muslim Mindanao</option><option value="CAR - Cordillera " {{ old('prob_category') == 'CAR - Cordillera ' ? 'selected' : ''}}>CAR - Cordillera Administrative Region</option>  
                                    <option value="NCR - National Capital Region" {{ old('prob_category') == 'NCR - National Capital Region' ? 'selected' : ''}}>NCR - National Capital Region</option> 
                                    <option value="NIR - Negros Island Region" {{ old('prob_category') == 'NIR - Negros Island Region' ? 'selected' : ''}}>NIR - Negros Island Region</option>
                                  </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form">
                                 <select class="select-wrapper mdb-select" name="province" id="province">
                                    <option value="" disabled selected>Select Province</option>
                                    <option value="ABRA" {{ old('prob_category') == 'ABRA' ? 'selected' : ''}}>ABRA</option>
                                    <option value="AGUSAN DEL NORTE" {{ old('prob_category') == 'AGUSAN DEL NORTE' ? 'selected' : ''}}>AGUSAN DEL NORTE</option>
                                    <option value="AGUSAN DEL SUR" {{ old('prob_category') == 'AGUSAN DEL SUR' ? 'selected' : ''}}>AGUSAN DEL SUR</option>
                                    <option value="AKLAN" {{ old('prob_category') == 'AKLAN' ? 'selected' : ''}}>AKLAN</option>
                                    <option value="ALBAY" {{ old('prob_category') == 'ALBAY' ? 'selected' : ''}}>ALBAY</option>
                                    <option value="ANTIQUE<" {{ old('prob_category') == 'ANTIQUE<' ? 'selected' : ''}}>ANTIQUE</option> 
                                    <option value="APAYAO" {{ old('prob_category') == 'APAYAO' ? 'selected' : ''}}>APAYAO</option>
                                    <option value="AURORA" {{ old('prob_category') == 'AURORA' ? 'selected' : ''}}>AURORA</option>
                                    <option value="BASILAN" {{ old('prob_category') == 'BASILAN' ? 'selected' : ''}}>BASILAN</option>  
                                    <option value="BATAAN" {{ old('prob_category') == 'BATAAN' ? 'selected' : ''}}>BATAAN</option> 
                                    <option value="BATANES" {{ old('prob_category') == 'BATANES' ? 'selected' : ''}}>BATANES</option>  
                                    <option value="BATANGAS" {{ old('prob_category') == 'BATANGAS' ? 'selected' : ''}}>BATANGAS</option>  
                                    <option value="BENGUET" {{ old('prob_category') == 'BENGUET' ? 'selected' : ''}}>BENGUET</option>  
                                    <option value="BILIRAN<" {{ old('prob_category') == 'BILIRAN<' ? 'selected' : ''}}>BILIRAN</option>  
                                    <option value="BOHOL" {{ old('prob_category') == 'BOHOL' ? 'selected' : ''}}>BOHOL</option>  
                                    <option value="BUKIDNON" {{ old('prob_category') == 'BUKIDNON' ? 'selected' : ''}}>BUKIDNON</option>  
                                    <option value="BULACAN" {{ old('prob_category') == 'BULACAN' ? 'selected' : ''}}>BULACAN</option> 
                                    <option value="CAGAYAN" {{ old('prob_category') == 'CAGAYAN' ? 'selected' : ''}}>CAGAYAN</option>
                                    <option value="CAMARINES NORTE" {{ old('prob_category') == 'CAMARINES NORTE' ? 'selected' : ''}}>CAMARINES NORTE</option>
                                    <option value="CAMARINES SUR" {{ old('prob_category') == 'CAMARINES SUR' ? 'selected' : ''}}>CAMARINES SUR</option>
                                    <option value="CAMIGUIN" {{ old('prob_category') == 'CAMIGUIN' ? 'selected' : ''}}>CAMIGUIN</option>  
                                    <option value="CAPIZ" {{ old('prob_category') == 'CAPIZ' ? 'selected' : ''}}>CAPIZ</option>
                                    <option value="CATANDUANES" {{ old('prob_category') == 'CATANDUANES' ? 'selected' : ''}}>CATANDUANES</option>  
                                    <option value="CAVITE" {{ old('prob_category') == 'CAVITE' ? 'selected' : ''}}>CAVITE</option>
                                    <option value="CEBU" {{ old('prob_category') == 'CEBU' ? 'selected' : ''}}>CEBU</option>  
                                    <option value="COMPOSTELA VALLEY" {{ old('prob_category') == 'COMPOSTELA VALLEY' ? 'selected' : ''}}>COMPOSTELA VALLEY</option>
                                    <option value="COTABATO<" {{ old('prob_category') == 'COTABATO<' ? 'selected' : ''}}>COTABATO</option>  
                                    <option value="DAVAO DEL NORTE" {{ old('prob_category') == 'DAVAO DEL NORTE' ? 'selected' : ''}}>DAVAO DEL NORTE</option>
                                    <option value="DAVAO DEL SUR" {{ old('prob_category') == 'DAVAO DEL SUR' ? 'selected' : ''}}>DAVAO DEL SUR</option>  
                                    <option value="DAVAO ORIENTAL" {{ old('prob_category') == 'DAVAO ORIENTAL' ? 'selected' : ''}}>DAVAO ORIENTAL</option>
                                    <option value="DINAGAT ISLANDS" {{ old('prob_category') == 'DINAGAT ISLANDS' ? 'selected' : ''}}>DINAGAT ISLANDS</option>  
                                    <option value="EASTERN SAMAR" {{ old('prob_category') == 'EASTERN SAMAR' ? 'selected' : ''}}>EASTERN SAMAR</option>
                                    <option value="GUIMARAS" {{ old('prob_category') == 'GUIMARAS' ? 'selected' : ''}}>GUIMARAS</option>
                                    <option value="IFUGAO {{ old('prob_category') == 'IFUGAO' ? 'selected' : ''}}>IFUGAO</option>  
                                    <option value="ILOCOS NORTE" {{ old('prob_category') == 'ILOCOS NORTE' ? 'selected' : ''}}>ILOCOS NORTE</option>
                                    <option value="ILOILO" {{ old('prob_category') == 'ILOILO' ? 'selected' : ''}}>ILOILO</option>
                                    <option value="ISABELA" {{ old('prob_category') == 'ISABELA' ? 'selected' : ''}}>ISABELA</option>  
                                    <option value="KALINGA" {{ old('prob_category') == 'KALINGA' ? 'selected' : ''}}>KALINGA</option>
                                    <option value="LA UNION" {{ old('prob_category') == 'LA UNION' ? 'selected' : ''}}>LA UNION</option>  
                                    <option value="LAGUNA" {{ old('prob_category') == 'LAGUNA' ? 'selected' : ''}}>LAGUNA</option>
                                    <option value="LANAO DEL NORTE" {{ old('prob_category') == 'LANAO DEL NORTE' ? 'selected' : ''}}>LANAO DEL NORTE</option>  
                                    <option value="LANAO DEL SUR" {{ old('prob_category') == 'LANAO DEL SUR' ? 'selected' : ''}}>LANAO DEL SUR</option>
                                    <option value="LEYTE" {{ old('prob_category') == 'LEYTE' ? 'selected' : ''}}>LEYTE</option>  
                                    <option value="MAGUINDANAO" {{ old('prob_category') == 'MAGUINDANAO' ? 'selected' : ''}}>MAGUINDANAO</option>
                                    <option value="MANILA, NCR, FIRST DISTRICT" {{ old('prob_category') == 'MANILA, NCR, FIRST DISTRICT' ? 'selected' : ''}}>MANILA, NCR, FIRST DISTRICT</option>  
                                    <option value="MARINDUQUE" {{ old('prob_category') == 'MARINDUQUE' ? 'selected' : ''}}>MARINDUQUE</option>
                                    <option value="MASBATE" {{ old('prob_category') == 'MASBATE' ? 'selected' : ''}}>MASBATE</option>
                                    <option value="MISAMIS OCCIDENTAL" {{ old('prob_category') == 'MISAMIS OCCIDENTAL' ? 'selected' : ''}}>MISAMIS OCCIDENTAL</option>  
                                    <option value="MISAMIS ORIENTAL" {{ old('prob_category') == 'MISAMIS ORIENTAL' ? 'selected' : ''}}>MISAMIS ORIENTAL</option>  
                                    <option value="MOUNTAIN PROVINCE" {{ old('prob_category') == 'MOUNTAIN PROVINCE' ? 'selected' : ''}}>MOUNTAIN PROVINCE</option>
                                    <option value="NCR FOURTH DISTRICT" {{ old('prob_category') == 'NCR FOURTH DISTRICT' ? 'selected' : ''}}>NCR FOURTH DISTRICT</option> 
                                    <option value="NCR SECOND DISTRICT" {{ old('prob_category') == 'NCR SECOND DISTRICT' ? 'selected' : ''}}>NCR SECOND DISTRICT</option>     
                                    <option value="NCR THIRD DISTRICT" {{ old('prob_category') == 'NCR THIRD DISTRICT' ? 'selected' : ''}}>NCR THIRD DISTRICT</option>
                                    <option value="NEGROS OCCIDENTAL" {{ old('prob_category') == 'NEGROS OCCIDENTAL' ? 'selected' : ''}}>NEGROS OCCIDENTAL</option>  
                                    <option value="NEGROS ORIENTAL" {{ old('prob_category') == 'NEGROS ORIENTAL' ? 'selected' : ''}}>NEGROS ORIENTAL</option>
                                    <option value="OCCIDENTAL MINDORO" {{ old('prob_category') == 'OCCIDENTAL MINDORO' ? 'selected' : ''}}>OCCIDENTAL MINDORO</option>  
                                    <option value="ORIENTAL MINDORO" {{ old('prob_category') == 'ORIENTAL MINDORO' ? 'selected' : ''}}>ORIENTAL MINDORO</option>
                                    <option value="PALAWAN" {{ old('prob_category') == 'PALAWAN' ? 'selected' : ''}}>PALAWAN</option>
                                    <option value="PAMPANGA" {{ old('prob_category') == 'PAMPANGA' ? 'selected' : ''}}>PAMPANGA</option>      
                                    <option value="PANGASINAN" {{ old('prob_category') == 'PANGASINAN' ? 'selected' : ''}}>PANGASINAN</option>
                                    <option value="QUEZON" {{ old('prob_category') == 'QUEZON' ? 'selected' : ''}}>QUEZON</option>  
                                    <option value="QUIRINO" {{ old('prob_category') == 'QUIRINO' ? 'selected' : ''}}>QUIRINO</option>
                                    <option value="RIZAL" {{ old('prob_category') == 'RIZAL' ? 'selected' : ''}}>RIZAL</option>  
                                    <option value="ROMBLON" {{ old('prob_category') == 'ROMBLON' ? 'selected' : ''}}>ROMBLON</option>
                                    <option value="SARANGANI" {{ old('prob_category') == 'SARANGANI' ? 'selected' : ''}}>SARANGANI</option>
                                    <option value="SAMAR" {{ old('prob_category') == 'SAMAR' ? 'selected' : ''}}>SAMAR</option> 
                                    <option value="SHARIFF KABUNSUAN" {{ old('prob_category') == 'SHARIFF KABUNSUAN' ? 'selected' : ''}}>SHARIFF KABUNSUAN</option>      
                                    <option value="SIQUIJOR" {{ old('prob_category') == 'SIQUIJOR' ? 'selected' : ''}}>SIQUIJOR</option>
                                    <option value="SORSOGON" {{ old('prob_category') == 'SORSOGON' ? 'selected' : ''}}>SORSOGON</option>  
                                    <option value="SULTAN KUDARAT" {{ old('prob_category') == 'SULTAN KUDARAT' ? 'selected' : ''}}>SULTAN KUDARAT</option>
                                    <option value="SULU" {{ old('prob_category') == 'SULU' ? 'selected' : ''}}>SULU</option>  
                                    <option value="SURIGAO DEL NORTE" {{ old('prob_category') == 'SURIGAO DEL NORTE' ? 'selected' : ''}}>SURIGAO DEL NORTE</option>
                                    <option value="SURIGAO DEL SUR<" {{ old('prob_category') == 'SURIGAO DEL SUR<' ? 'selected' : ''}}>SURIGAO DEL SUR</option>
                                    <option value="TARLAC" {{ old('prob_category') == 'TARLAC' ? 'selected' : ''}}>TARLAC</option>
                                    <option value="TAWI-TAWI" {{ old('prob_category') == 'TAWI-TAWI' ? 'selected' : ''}}>TAWI-TAWI</option>  
                                    <option value="ZAMBALES" {{ old('prob_category') == 'ZAMBALES' ? 'selected' : ''}}>ZAMBALES</option>
                                    <option value="ZAMBOANGA DEL NORTE" {{ old('prob_category') == 'ZAMBOANGA DEL NORTE' ? 'selected' : ''}}>ZAMBOANGA DEL NORTE</option>
                                    <option value="ZAMBOANGA DEL SUR" {{ old('prob_category') == 'ZAMBOANGA DEL SUR4' ? 'selected' : ''}}>ZAMBOANGA DEL SUR</option>      
                                    <option value="ZAMBOANGA SIBUGAY" {{ old('prob_category') == 'ZAMBOANGA SIBUGAY' ? 'selected' : ''}}>ZAMBOANGA SIBUGAY</option>
                                  </select>
                            </div>
                        </div>
                    </div>

                        <div class="form-row">
                        <div class="col-md-6">
                            <div class="md-form">
                                 <select class="select-wrapper mdb-select" name="municipality" id="municipality">
                                    <option value="Select Municipality" disabled selected>Select Municipality</option>
                                    <option value="ABORLAN" {{ old('prob_category') == 'ABORLAN' ? 'selected' : ''}}>ABORLAN</option>
                                    <option value="ABRA DE ILOG" {{ old('prob_category') == 'ABRA DE ILOG' ? 'selected' : ''}}>ABRA DE ILOG</option>
                                    <option value="ABRA DE ILOG" {{ old('prob_category') == 'ABRA DE ILOG' ? 'selected' : ''}}>ABRA DE ILOG</option>
                                    <option value="AGONCILLO" {{ old('prob_category') == 'AGONCILLO' ? 'selected' : ''}}>AGONCILLO</option>
                                    <option value="AGOO" {{ old('prob_category') == 'AGOO' ? 'selected' : ''}}>AGOO</option> 
                                    <option value="AGUINALDO" {{ old('prob_category') == 'AGUINALDO' ? 'selected' : ''}}>AGUINALDO</option>
                                    <option value="AGUTAYA" {{ old('prob_category') == 'AGUTAYA' ? 'selected' : ''}}>AGUTAYA</option>
                                    <option value="AKBAR" {{ old('prob_category') == 'AKBAR' ? 'selected' : ''}}>AKBAR</option>
                                    <option value="ALABEL" {{ old('prob_category') == 'ALABEL' ? 'selected' : ''}}>ALABEL</option>  
                                    <option value="ALAMADA" {{ old('prob_category') == 'ALAMADA' ? 'selected' : ''}}>ALAMADA</option>  
                                    <option value="ALAMINOS CITY" {{ old('prob_category') == 'ALAMINOS CITY' ? 'selected' : ''}}>ALAMINOS CITY</option>  
                                    <option value="ALAYAN" {{ old('prob_category') == 'ALAYAN' ? 'selected' : ''}}>ALAYAN</option>  
                                    <option value="AL-BARKA" {{ old('prob_category') == 'AL-BARKA' ? 'selected' : ''}}>AL-BARKA</option>  
                                    <option value="ALCANTARA" {{ old('prob_category') == 'ALCANTARA' ? 'selected' : ''}}>ALCANTARA</option>  
                                    <option value="ALEGRIA" {{ old('prob_category') == 'ALEGRIA' ? 'selected' : ''}}>ALEGRIA</option>  
                                    <option value="ALEOSAN" {{ old('prob_category') == 'ALEOSAN' ? 'selected' : ''}}>ALEOSAN</option> 
                                    <option value="ALFONSO LISTA (POTIA)" {{ old('prob_category') == 'ALFONSO LISTA (POTIA)' ? 'selected' : ''}}>ALFONSO LISTA (POTIA)</option>
                                    <option value="ALILEM" {{ old('prob_category') == 'ALILEM' ? 'selected' : ''}}>ALILEM</option>
                                    <option value="ALITAGTAG" {{ old('prob_category') == 'ALITAGTAG' ? 'selected' : ''}}>ALITAGTAG</option>
                                    <option value="ALLEN" {{ old('prob_category') == 'ALLEN' ? 'selected' : ''}}>ALLEN</option>
                                    <option value="ALMAGRO" {{ old('prob_category') == 'ALMAGRO' ? 'selected' : ''}}>ALMAGRO</option>
                                    <option value="ALORAN" {{ old('prob_category') == 'ALORAN' ? 'selected' : ''}}>ALORAN</option>
                                    <option value="ALUBIJID" {{ old('prob_category') == 'ALUBIJID' ? 'selected' : ''}}>ALUBIJID</option> 
                                    <option value="AMLAN (AYUQUITAN)" {{ old('prob_category') == 'AMLAN (AYUQUITAN)' ? 'selected' : ''}}>AMLAN (AYUQUITAN)</option>
                                    <option value="AMPATUAN" {{ old('prob_category') == 'AMPATUAN' ? 'selected' : ''}}>AMPATUAN</option>
                                    <option value="ANAO" {{ old('prob_category') == 'ANAO' ? 'selected' : ''}}>ANAO</option>
                                    <option value="ANGAT" {{ old('prob_category') == 'ANGAT' ? 'selected' : ''}}>ANGAT</option>  
                                    <option value="ANTIPAS" {{ old('prob_category') == 'ANTIPAS' ? 'selected' : ''}}>ANTIPAS</option>  
                                    <option value="ANTIPOLO CITY" {{ old('prob_category') == 'ANTIPOLO CITY' ? 'selected' : ''}}>ANTIPOLO CITY</option>  
                                    <option value="ARACELI" {{ old('prob_category') == 'ARACELI' ? 'selected' : ''}}>ARACELI</option>  
                                    <option value="ARAKAN" {{ old('prob_category') == 'ARAKAN' ? 'selected' : ''}}>ARAKAN</option>  
                                    <option value="ARINGAY" {{ old('prob_category') == 'ARINGAY' ? 'selected' : ''}}>ARINGAY</option>  
                                    <option value="ASIPULO" {{ old('prob_category') == 'ASIPULO' ? 'selected' : ''}}>ASIPULO</option>  
                                    <option value="ASUNCION (SAUG)" {{ old('prob_category') == 'ASUNCION (SAUG)' ? 'selected' : ''}}>ASUNCION (SAUG)</option>  
                                    <option value="ATOK" {{ old('prob_category') == 'ATOK' ? 'selected' : ''}}>ATOK</option> 
                                    <option value="AYUNGON" {{ old('prob_category') == 'AYUNGON' ? 'selected' : ''}}>AYUNGON</option>
                                    <option value="BACACAY" {{ old('prob_category') == 'BACACAY' ? 'selected' : ''}}>BACACAY</option>
                                    <option value="BACARRA" {{ old('prob_category') == 'BACARRA' ? 'selected' : ''}}>BACARRA</option>
                                    <option value="BACNOTAN" {{ old('prob_category') == 'BACNOTAN' ? 'selected' : ''}}>BACNOTAN</option>
                                    <option value="BACO" {{ old('prob_category') == 'BACO' ? 'selected' : ''}}>BACO</option>
                                    <option value="BACOLOD" {{ old('prob_category') == 'BACOLOD' ? 'selected' : ''}}>BACOLOD</option>
                                    <option value="BACOLOD CITY" {{ old('prob_category') == 'BACOLOD CITY' ? 'selected' : ''}}>BACOLOD CITY</option> 
                                    <option value="BACOLOD-KALAWI (BACOLOD GRANDE)" {{ old('prob_category') == 'BACOLOD-KALAWI (BACOLOD GRANDE)' ? 'selected' : ''}}>BACOLOD-KALAWI (BACOLOD GRANDE)</option>
                                    <option value="BACOLOR" {{ old('prob_category') == 'BACOLOR' ? 'selected' : ''}}>BACOLOR</option>
                                    <option value="BACONG" {{ old('prob_category') == 'BACONG' ? 'selected' : ''}}>BACONG</option>
                                    <option value="BACOOR" {{ old('prob_category') == 'BACOOR' ? 'selected' : ''}}>BACOOR</option>  
                                    <option value="BACUAG" {{ old('prob_category') == 'BACUAG' ? 'selected' : ''}}>BACUAG</option>  
                                    <option value="BACUNGAN (LEON T. POSTIGO)" {{ old('prob_category') == 'BACUNGAN (LEON T. POSTIGO)' ? 'selected' : ''}}>BACUNGAN (LEON T. POSTIGO)</option>  
                                    <option value="BADOC" {{ old('prob_category') == 'BADOC' ? 'selected' : ''}}>BADOC</option>  
                                    <option value="BAGABAG" {{ old('prob_category') == 'BAGABAG' ? 'selected' : ''}}>BAGABAG</option>  
                                    <option value="BAGAC" {{ old('prob_category') == 'BAGAC' ? 'selected' : ''}}>BAGAC</option>  
                                    <option value="BAGANGA" {{ old('prob_category') == 'BAGANGA' ? 'selected' : ''}}>BAGANGA</option>  
                                    <option value="BAGGAO" {{ old('prob_category') == 'BAGGAO' ? 'selected' : ''}}>BAGGAO</option> 
                                    <option value="BAGO CITY" {{ old('prob_category') == 'BAGO CITY' ? 'selected' : ''}}>BAGO CITY</option>
                                    <option value="BAGUIO CITY" {{ old('prob_category') == 'BAGUIO CITY' ? 'selected' : ''}}>BAGUIO CITY</option>
                                    <option value="BAGULIN" {{ old('prob_category') == 'BAGULIN' ? 'selected' : ''}}>BAGULIN</option>
                                    <option value="BAGUMBAYAN" {{ old('prob_category') == 'BAGUMBAYAN' ? 'selected' : ''}}>BAGUMBAYAN</option>
                                    <option value="BAIS CITY" {{ old('prob_category') == 'BAIS CITY' ? 'selected' : ''}}>BAIS CITY</option>
                                    <option value="BAKUN" {{ old('prob_category') == 'BAKUN' ? 'selected' : ''}}>BAKUN</option>
                                    <option value="BALABAC" {{ old('prob_category') == 'BALABAC' ? 'selected' : ''}}>BALABAC</option> 
                                    <option value="BALABAGAN" {{ old('prob_category') == 'BALABAGAN' ? 'selected' : ''}}>BALABAGAN</option>
                                    <option value="BALAGTAS (BIGAA)" {{ old('prob_category') == 'BALAGTAS (BIGAA)' ? 'selected' : ''}}>BALAGTAS (BIGAA)</option>
                                    <option value="BALANGA CITY" {{ old('prob_category') == 'BALANGA CITY' ? 'selected' : ''}}>BALANGA CITY</option>
                                    <option value="BALAOAN" {{ old('prob_category') == 'BALAOAN' ? 'selected' : ''}}>BALAOAN</option>  
                                    <option value="BALAYAN" {{ old('prob_category') == 'BALAYAN' ? 'selected' : ''}}>BALAYAN</option>  
                                    <option value="BALBALAN" {{ old('prob_category') == 'BALBALAN' ? 'selected' : ''}}>BALBALAN</option>  
                                    <option value="BALER " {{ old('prob_category') == 'BALER ' ? 'selected' : ''}}>BALER </option>  
                                    <option value="BALETE" {{ old('prob_category') == 'BALETE' ? 'selected' : ''}}>BALETE</option>  
                                    <option value="BALIANGAO" {{ old('prob_category') == 'BALIANGAO' ? 'selected' : ''}}>BALIANGAO</option>  
                                    <option value="BALIGUIAN" {{ old('prob_category') == 'BALIGUIAN' ? 'selected' : ''}}>BALIGUIAN</option>  
                                    <option value="BALINDONG (WATU)" {{ old('prob_category') == 'BALINDONG (WATU)' ? 'selected' : ''}}>BALINDONG (WATU)</option> 
                                    <option value="BALINGASAG" {{ old('prob_category') == 'BALINGASAG' ? 'selected' : ''}}>BALINGASAG</option>
                                    <option value="BALINGOAN" {{ old('prob_category') == 'BALINGOAN' ? 'selected' : ''}}>BALINGOAN</option>
                                    <option value="BALIUAG" {{ old('prob_category') == 'BALIUAG' ? 'selected' : ''}}>BALIUAG</option>
                                    <option value="BALLESTEROS" {{ old('prob_category') == 'BALLESTEROS' ? 'selected' : ''}}>BALLESTEROS</option>
                                    <option value="BALOI" {{ old('prob_category') == 'BALOI' ? 'selected' : ''}}>BALOI</option>
                                    <option value="BALUNGAO" {{ old('prob_category') == 'BALUNGAO' ? 'selected' : ''}}>BALUNGAO</option>
                                    <option value="BAMBAN" {{ old('prob_category') == 'BAMBAN' ? 'selected' : ''}}>BAMBAN</option> 
                                    <option value="BAMBANG" {{ old('prob_category') == 'BAMBANG' ? 'selected' : ''}}>BAMBANG</option>
                                    <option value="BANAUE" {{ old('prob_category') == 'BANAUE' ? 'selected' : ''}}>BANAUE</option>
                                    <option value="BANAYBANAY" {{ old('prob_category') == 'BANAYBANAY' ? 'selected' : ''}}>BANAYBANAY</option>
                                    <option value="BANAYOYO" {{ old('prob_category') == 'BANAYOYO' ? 'selected' : ''}}>BANAYOYO</option>  
                                    <option value="BANGA" {{ old('prob_category') == 'BANGA' ? 'selected' : ''}}>BANGA</option>  
                                    <option value="BANGA" {{ old('prob_category') == 'BANGA' ? 'selected' : ''}}>BANGA</option>  
                                    <option value="BANGUED" {{ old('prob_category') == 'BANGUED' ? 'selected' : ''}}>BANGUED</option>  
                                    <option value="BANGUI" {{ old('prob_category') == 'BANGUI' ? 'selected' : ''}}>BANGUI</option>  
                                    <option value="BANI" {{ old('prob_category') == 'BANI' ? 'selected' : ''}}>BANI</option>  
                                    <option value="BANISILAN" {{ old('prob_category') == 'BANISILAN' ? 'selected' : ''}}>BANISILAN</option>  
                                    <option value="BANNA (ESPIRITU)" {{ old('prob_category') == 'BANNA (ESPIRITU)' ? 'selected' : ''}}>BANNA (ESPIRITU)</option> 
                                    <option value="BANSALAN" {{ old('prob_category') == 'BANSALAN' ? 'selected' : ''}}>BANSALAN</option>
                                    <option value="BANSUD" {{ old('prob_category') == 'BANSUD' ? 'selected' : ''}}>BANSUD</option>
                                    <option value="BANTAY" {{ old('prob_category') == 'BANTAY' ? 'selected' : ''}}>BANTAY</option>
                                    <option value="BANTON" {{ old('prob_category') == 'BANTON' ? 'selected' : ''}}>BANTON</option>
                                    <option value="BARAS" {{ old('prob_category') == 'BARAS' ? 'selected' : ''}}>BARAS</option>
                                    <option value="BARIRA" {{ old('prob_category') == 'BARIRA' ? 'selected' : ''}}>BARIRA</option>
                                    <option value="BARLIG" {{ old('prob_category') == 'BARLIG' ? 'selected' : ''}}>BARLIG</option> 
                                    <option value="BAROBO" {{ old('prob_category') == 'BAROBO' ? 'selected' : ''}}>BAROBO</option>
                                    <option value="BAROY" {{ old('prob_category') == 'BAROY' ? 'selected' : ''}}>BAROY</option>
                                    <option value="BASAY" {{ old('prob_category') == 'BASAY' ? 'selected' : ''}}>BASAY</option>
                                    <option value="BASCO" {{ old('prob_category') == 'BASCO' ? 'selected' : ''}}>BASCO</option>  
                                    <option value="BASILISA (RIZAL)" {{ old('prob_category') == 'BASILISA (RIZAL)' ? 'selected' : ''}}>BASILISA (RIZAL)</option>  
                                    <option value="BASISTA" {{ old('prob_category') == 'BASISTA' ? 'selected' : ''}}>BASISTA</option>  
                                    <option value="BASUD" {{ old('prob_category') == 'BASUD' ? 'selected' : ''}}>BASUD</option>  
                                    <option value="BATAC" {{ old('prob_category') == 'BATAC' ? 'selected' : ''}}>BATAC</option>  
                                    <option value="BATANGAS CITY" {{ old('prob_category') == 'BATANGAS CITY' ? 'selected' : ''}}>BATANGAS CITY</option>  
                                    <option value="BATARAZA" {{ old('prob_category') == 'BATARAZA' ? 'selected' : ''}}>BATARAZA</option>  
                                    <option value="BAUAN" {{ old('prob_category') == 'BAUAN' ? 'selected' : ''}}>BAUAN</option> 
                                    <option value="BAUANG" {{ old('prob_category') == 'BAUANG' ? 'selected' : ''}}>BAUANG</option>
                                    <option value="BAUKO" {{ old('prob_category') == 'BAUKO' ? 'selected' : ''}}>BAUKO</option>
                                    <option value="BAUNGON" {{ old('prob_category') == 'BAUNGON' ? 'selected' : ''}}>BAUNGON</option>
                                    <option value="BAUTISTA" {{ old('prob_category') == 'BAUTISTA' ? 'selected' : ''}}>BAUTISTA</option>
                                    <option value="BAY" {{ old('prob_category') == 'BAY' ? 'selected' : ''}}>BAY</option>
                                    <option value="BAYABAS" {{ old('prob_category') == 'BAYABAS' ? 'selected' : ''}}>BAYABAS</option>
                                    <option value="BAYAMBANG" {{ old('prob_category') == 'BAYAMBANG' ? 'selected' : ''}}>BAYAMBANG</option> 
                                    <option value="BAYANG" {{ old('prob_category') == 'BAYANG' ? 'selected' : ''}}>BAYANG</option>
                                    <option value="BAYAWAN CITY(TULONG)" {{ old('prob_category') == 'BAYAWAN CITY(TULONG)' ? 'selected' : ''}}>BAYAWAN CITY(TULONG)</option>
                                    <option value="BAYOMBONG" {{ old('prob_category') == 'BAYOMBONG' ? 'selected' : ''}}>BAYOMBONG</option>
                                    <option value="BAYUGAN CITY" {{ old('prob_category') == 'BAYUGAN CITY' ? 'selected' : ''}}>BAYUGAN CITY</option>  
                                    <option value="BENITO SOLIVEN" {{ old('prob_category') == 'BENITO SOLIVEN' ? 'selected' : ''}}>BENITO SOLIVEN</option>  
                                    <option value="BESAO" {{ old('prob_category') == 'BESAO' ? 'selected' : ''}}>BESAO</option>  
                                    <option value="BINALBAGAN" {{ old('prob_category') == 'BINALBAGAN' ? 'selected' : ''}}>BINALBAGAN</option>  
                                    <option value="BINALONAN" {{ old('prob_category') == 'BINALONAN' ? 'selected' : ''}}>BINALONAN</option>  
                                    <option value="BIÑAN" {{ old('prob_category') == 'BIÑAN' ? 'selected' : ''}}>BIÑAN</option>  
                                    <option value="BINANGONAN" {{ old('prob_category') == 'BINANGONAN' ? 'selected' : ''}}>BINANGONAN</option>  
                                    <option value="BINDOY (PAYABON)" {{ old('prob_category') == 'BINDOY (PAYABON)' ? 'selected' : ''}}>BINDOY (PAYABON)</option> 
                                    <option value="BINIDAYAN" {{ old('prob_category') == 'BINIDAYAN' ? 'selected' : ''}}>BINIDAYAN</option>
                                    <option value="BINMALEY" {{ old('prob_category') == 'BINMALEY' ? 'selected' : ''}}>BINMALEY</option>
                                    <option value="BINONDO" {{ old('prob_category') == 'BINONDO' ? 'selected' : ''}}>BINONDO</option>
                                    <option value="BINUANGAN" {{ old('prob_category') == 'BINUANGAN' ? 'selected' : ''}}>BINUANGAN</option>
                                    <option value="BIRI" {{ old('prob_category') == 'BIRI' ? 'selected' : ''}}>BIRI</option>
                                    <option value="BISLIG CITY" {{ old('prob_category') == 'BISLIG CITY' ? 'selected' : ''}}>BISLIG CITY</option>
                                    <option value="BOAC " {{ old('prob_category') == 'BOAC ' ? 'selected' : ''}}>BOAC </option> 
                                    <option value="BOBON" {{ old('prob_category') == 'BOBON' ? 'selected' : ''}}>BOBON</option>
                                    <option value="BOCAUE" {{ old('prob_category') == 'BOCAUE' ? 'selected' : ''}}>BOCAUE</option>
                                    <option value="BOKOD" {{ old('prob_category') == 'BOKOD' ? 'selected' : ''}}>BOKOD</option>
                                    <option value="BOLINAO" {{ old('prob_category') == 'BOLINAO' ? 'selected' : ''}}>BOLINAO</option>  
                                    <option value="BOLINEY" {{ old('prob_category') == 'BOLINEY' ? 'selected' : ''}}>BOLINEY</option>  
                                    <option value="BONGABON" {{ old('prob_category') == 'BONGABON' ? 'selected' : ''}}>BONGABON</option>  
                                    <option value="BONGABONG" {{ old('prob_category') == 'BONGABONG' ? 'selected' : ''}}>BONGABONG</option>  
                                    <option value="BONGAO" {{ old('prob_category') == 'BONGAO' ? 'selected' : ''}}>BONGAO</option>  
                                    <option value="BONIFACIO" {{ old('prob_category') == 'BONIFACIO' ? 'selected' : ''}}>BONIFACIO</option>  
                                    <option value="BONTOC" {{ old('prob_category') == 'BONTOC' ? 'selected' : ''}}>BONTOC</option>  
                                    <option value="BOSTON" {{ old('prob_category') == 'BOSTON' ? 'selected' : ''}}>BOSTON</option> 
                                    <option value="BOTOLAN" {{ old('prob_category') == 'BOTOLAN' ? 'selected' : ''}}>BOTOLAN</option>
                                    <option value="BRAULIO E. DUJALI" {{ old('prob_category') == 'BRAULIO E. DUJALI' ? 'selected' : ''}}>BRAULIO E. DUJALI</option>
                                    <option value="BROOKE\S POINT" {{ old('prob_category') == 'BROOKE\S POINT' ? 'selected' : ''}}>BROOKE\S POINT</option>
                                    <option value="BUADIPOSO-BUNTONG" {{ old('prob_category') == 'BUADIPOSO-BUNTONG' ? 'selected' : ''}}>BUADIPOSO-BUNTONG</option>
                                    <option value="BUBONG" {{ old('prob_category') == 'BUBONG' ? 'selected' : ''}}>BUBONG</option>
                                    <option value="BUCAY" {{ old('prob_category') == 'BUCAY' ? 'selected' : ''}}>BUCAY</option>
                                    <option value="BUCLOC" {{ old('prob_category') == 'BUCLOC' ? 'selected' : ''}}>BUCLOC</option> 
                                    <option value="BUENAVISTA" {{ old('prob_category') == 'BUENAVISTA' ? 'selected' : ''}}>BUENAVISTA</option>
                                    <option value="BUGALLON" {{ old('prob_category') == 'BUGALLON' ? 'selected' : ''}}>BUGALLON</option>
                                    <option value="BUGUEY" {{ old('prob_category') == 'BUGUEY' ? 'selected' : ''}}>BUGUEY</option>
                                    <option value="BUGUIAS" {{ old('prob_category') == 'BUGUIAS' ? 'selected' : ''}}>BUGUIAS</option>  
                                    <option value="BULACAN" {{ old('prob_category') == 'BULACAN' ? 'selected' : ''}}>BULACAN</option>  
                                    <option value="BULALACAO (SAN PEDRO)" {{ old('prob_category') == 'BULALACAO (SAN PEDRO)' ? 'selected' : ''}}>BULALACAO (SAN PEDRO)</option>  
                                    <option value="BULDON" {{ old('prob_category') == 'BULDON' ? 'selected' : ''}}>BULDON</option>  
                                    <option value="BULUAN" {{ old('prob_category') == 'BULUAN' ? 'selected' : ''}}>BULUAN</option>  
                                    <option value="BUMBARAN" {{ old('prob_category') == 'BUMBARAN' ? 'selected' : ''}}>BUMBARAN</option>  
                                    <option value="BUNAWAN" {{ old('prob_category') == 'BUNAWAN' ? 'selected' : ''}}>BUNAWAN</option>  
                                    <option value="BURDEOS" {{ old('prob_category') == 'BURDEOS' ? 'selected' : ''}}>BURDEOS</option> 
                                    <option value="BURGOS" {{ old('prob_category') == 'BURGOS' ? 'selected' : ''}}>BURGOS</option>
                                    <option value="BUSTOS" {{ old('prob_category') == 'BUSTOS' ? 'selected' : ''}}>BUSTOS</option>
                                    <option value="" disabled selected>Select Facility</option>
                                    <option value="BUSUANGA" {{ old('prob_category') == 'BUSUANGA' ? 'selected' : ''}}>BUSUANGA</option>
                                    <option value="BUTIG" {{ old('prob_category') == 'BUTIG' ? 'selected' : ''}}>BUTIG</option>
                                    <option value="BUTUAN CITY " {{ old('prob_category') == 'BUTUAN CITY ' ? 'selected' : ''}}>BUTUAN CITY </option>
                                    <option value="CABA" {{ old('prob_category') == 'CABA' ? 'selected' : ''}}>CABA</option>
                                    <option value="CABADBARAN CITY" {{ old('prob_category') == 'CABADBARAN CITY' ? 'selected' : ''}}>CABADBARAN CITY</option> 
                                    <option value="CABAGAN" {{ old('prob_category') == 'CABAGAN' ? 'selected' : ''}}>CABAGAN</option>
                                    <option value="CABANATUAN CITY" {{ old('prob_category') == 'CABANATUAN CITY' ? 'selected' : ''}}>CABANATUAN CITY</option>
                                    <option value="CABANGAN" {{ old('prob_category') == 'CABANGAN' ? 'selected' : ''}}>CABANGAN</option>
                                    <option value="CABANGLASAN" {{ old('prob_category') == 'CABANGLASAN' ? 'selected' : ''}}>CABANGLASAN</option>  
                                    <option value="CABARROGUIS" {{ old('prob_category') == 'CABARROGUIS' ? 'selected' : ''}}>CABARROGUIS</option>  
                                    <option value="CABATUAN" {{ old('prob_category') == 'CABATUAN' ? 'selected' : ''}}>CABATUAN</option>  
                                    <option value="CABIAO" {{ old('prob_category') == 'CABIAO' ? 'selected' : ''}}>CABIAO</option>  
                                    <option value="CABUGAO" {{ old('prob_category') == 'CABUGAO' ? 'selected' : ''}}>CABUGAO</option>  
                                    <option value="CABUYAO" {{ old('prob_category') == 'CABUYAO' ? 'selected' : ''}}>CABUYAO</option>  
                                    <option value="CADIZ CITY" {{ old('prob_category') == 'CADIZ CITY' ? 'selected' : ''}}>CADIZ CITY</option>  
                                    <option value="CAGAYAN DE ORO CITY" {{ old('prob_category') == 'CAGAYAN DE ORO CITY' ? 'selected' : ''}}>CAGAYAN DE ORO CITY</option> 
                                    <option value="CAGAYANCILLO" {{ old('prob_category') == 'CAGAYANCILLO' ? 'selected' : ''}}>CAGAYANCILLO</option>
                                    <option value="CAGDIANAO" {{ old('prob_category') == 'CAGDIANAO' ? 'selected' : ''}}>CAGDIANAO</option>
                                    <option value="CAGWAIT" {{ old('prob_category') == 'CAGWAIT' ? 'selected' : ''}}>CAGWAIT</option>
                                    <option value="CAINTA" {{ old('prob_category') == 'CAINTA' ? 'selected' : ''}}>CAINTA</option>
                                    <option value="CAJIDIOCAN" {{ old('prob_category') == 'CAJIDIOCAN' ? 'selected' : ''}}>CAJIDIOCAN</option>
                                    <option value="CALACA" {{ old('prob_category') == 'CALACA' ? 'selected' : ''}}>CALACA</option>
                                    <option value="CALAMBA CITY" {{ old('prob_category') == 'CALAMBA CITY' ? 'selected' : ''}}>CALAMBA CITY</option> 
                                    <option value="CALANASAN (BAYAG)" {{ old('prob_category') == 'CALANASAN (BAYAG)' ? 'selected' : ''}}>CALANASAN (BAYAG)</option>
                                    <option value="CALANOGAS" {{ old('prob_category') == 'CALANOGAS' ? 'selected' : ''}}>CALANOGAS</option>
                                    <option value="CALAPAN CITY" {{ old('prob_category') == 'CALAPAN CITY' ? 'selected' : ''}}>CALAPAN CITY</option>
                                    <option value="CALASIAO" {{ old('prob_category') == 'CALASIAO' ? 'selected' : ''}}>CALASIAO</option>  
                                    <option value="CALATAGAN" {{ old('prob_category') == 'CALATAGAN' ? 'selected' : ''}}>CALATAGAN</option>  
                                    <option value="CALATRAVA" {{ old('prob_category') == 'CALATRAVA' ? 'selected' : ''}}>CALATRAVA</option>  
                                    <option value="CALAUAG" {{ old('prob_category') == 'CALAUAG' ? 'selected' : ''}}>CALAUAG</option>  
                                    <option value="CALAUAN" {{ old('prob_category') == 'CALAUAN' ? 'selected' : ''}}>CALAUAN</option>  
                                    <option value="CALAYAN" {{ old('prob_category') == 'CALAYAN' ? 'selected' : ''}}>CALAYAN</option>  
                                    <option value="CALINTAAN" {{ old('prob_category') == 'CALINTAAN' ? 'selected' : ''}}>CALINTAAN</option>  
                                    <option value="CALUMPIT" {{ old('prob_category') == 'CALUMPIT' ? 'selected' : ''}}>CALUMPIT</option> 
                                    <option value="CAMALANIUGAN" {{ old('prob_category') == 'CAMALANIUGAN' ? 'selected' : ''}}>CAMALANIUGAN</option>
                                    <option value="CAMALIG" {{ old('prob_category') == 'CAMALIG' ? 'selected' : ''}}>CAMALIG</option>
                                    <option value="CAMILING" {{ old('prob_category') == 'CAMILING' ? 'selected' : ''}}>CAMILING</option>
                                    <option value="CAN-AVID" {{ old('prob_category') == 'CAN-AVID' ? 'selected' : ''}}>CAN-AVID</option>
                                    <option value="CANDABA" {{ old('prob_category') == 'CANDABA' ? 'selected' : ''}}>CANDABA</option>
                                    <option value="CANDELARIA" {{ old('prob_category') == 'CANDELARIA' ? 'selected' : ''}}>CANDELARIA</option>
                                    <option value="CANDON CITY" {{ old('prob_category') == 'CANDON CITY' ? 'selected' : ''}}>CANDON CITY</option> 
                                    <option value="CANDONI" {{ old('prob_category') == 'CANDONI' ? 'selected' : ''}}>CANDONI</option>
                                    <option value="CANLAON CITY" {{ old('prob_category') == 'CANLAON CITY' ? 'selected' : ''}}>CANLAON CITY</option>
                                    <option value="CANTILAN" {{ old('prob_category') == 'CANTILAN' ? 'selected' : ''}}>CANTILAN</option>
                                    <option value="CAOAYAN" {{ old('prob_category') == 'CAOAYAN' ? 'selected' : ''}}>CAOAYAN</option>  
                                    <option value="CAPALONGA" {{ old('prob_category') == 'CAPALONGA' ? 'selected' : ''}}>CAPALONGA</option>  
                                    <option value="CAPAS" {{ old('prob_category') == 'CAPAS' ? 'selected' : ''}}>CAPAS</option>  
                                    <option value="CAPUL" {{ old('prob_category') == 'CAPUL' ? 'selected' : ''}}>CAPUL</option>  
                                    <option value="CARAGA" {{ old('prob_category') == 'CARAGA' ? 'selected' : ''}}>CARAGA</option>  
                                    <option value="CARAMORAN" {{ old('prob_category') == 'CARAMORAN' ? 'selected' : ''}}>CARAMORAN</option>  
                                    <option value="CARASI" {{ old('prob_category') == 'CARASI' ? 'selected' : ''}}>CARASI</option>  
                                    <option value="CARDONA" {{ old('prob_category') == 'CARDONA' ? 'selected' : ''}}>CARDONA</option> 
                                    <option value="CARMEN" {{ old('prob_category') == 'CARMEN' ? 'selected' : ''}}>CARMEN</option>
                                    <option value="CARMONA" {{ old('prob_category') == 'CARMONA' ? 'selected' : ''}}>CARMONA</option>
                                    <option value="CARRANGLAN" {{ old('prob_category') == 'CARRANGLAN' ? 'selected' : ''}}>CARRANGLAN</option>
                                    <option value="CARRASCAL" {{ old('prob_category') == 'CARRASCAL' ? 'selected' : ''}}>CARRASCAL</option>
                                    <option value="CASIGURAN" {{ old('prob_category') == 'CASIGURAN' ? 'selected' : ''}}>CASIGURAN</option>
                                    <option value="CASTILLEJOS" {{ old('prob_category') == 'CASTILLEJOS' ? 'selected' : ''}}>CASTILLEJOS</option>
                                    <option value="CATANAUAN" {{ old('prob_category') == 'CATANAUAN' ? 'selected' : ''}}>CATANAUAN</option> 
                                    <option value="CATARMAN" {{ old('prob_category') == 'CATARMAN' ? 'selected' : ''}}>CATARMAN</option>
                                    <option value="CATEEL" {{ old('prob_category') == 'CATEEL' ? 'selected' : ''}}>CATEEL</option>
                                    <option value="CATUBIG" {{ old('prob_category') == 'CATUBIG' ? 'selected' : ''}}>CATUBIG</option>
                                    <option value="CAUAYAN CITY" {{ old('prob_category') == 'CAUAYAN CITY' ? 'selected' : ''}}>CAUAYAN CITY</option>  
                                    <option value="CAVINTI" {{ old('prob_category') == 'CAVINTI' ? 'selected' : ''}}>CAVINTI</option>  
                                    <option value="CAVITE CITY" {{ old('prob_category') == 'CAVITE CITY' ? 'selected' : ''}}>CAVITE CITY</option>  
                                    <option value="CERVANTES" {{ old('prob_category') == 'CERVANTES' ? 'selected' : ''}}>CERVANTES</option>  
                                    <option value="CLARIN" {{ old('prob_category') == 'CLARIN' ? 'selected' : ''}}>CLARIN</option>  
                                    <option value="CLAVER" {{ old('prob_category') == 'CLAVER' ? 'selected' : ''}}>CLAVER</option>  
                                    <option value="CLAVERIA" {{ old('prob_category') == 'CLAVERIA' ? 'selected' : ''}}>CLAVERIA</option>  
                                    <option value="COLUMBIOESPERANZA" {{ old('prob_category') == 'COLUMBIOESPERANZA' ? 'selected' : ''}}>COLUMBIOESPERANZA</option> 
                                    <option value="COMPOSTELA" {{ old('prob_category') == 'COMPOSTELA' ? 'selected' : ''}}>COMPOSTELA</option>
                                    <option value="CONCEPCION" {{ old('prob_category') == 'CONCEPCION' ? 'selected' : ''}}>CONCEPCION</option>
                                    <option value="CONNER" {{ old('prob_category') == 'CONNER' ? 'selected' : ''}}>CONNER</option>
                                    <option value="CORCUERA" {{ old('prob_category') == 'CORCUERA' ? 'selected' : ''}}>CORCUERA</option>
                                    <option value="CORDON" {{ old('prob_category') == 'CORDON' ? 'selected' : ''}}>CORDON</option>
                                    <option value="CORON" {{ old('prob_category') == 'CORON' ? 'selected' : 'CORON'}}></option>
                                    <option value="CORTES" {{ old('prob_category') == 'CORTES' ? 'selected' : ''}}>CORTES</option> 
                                    <option value="COTABATO CITY" {{ old('prob_category') == 'COTABATO CITY' ? 'selected' : ''}}>COTABATO CITY</option>
                                    <option value="CUENCA" {{ old('prob_category') == 'CUENCA' ? 'selected' : ''}}>CUENCA</option>
                                    <option value="CULION" {{ old('prob_category') == 'CULION' ? 'selected' : ''}}>CULION</option>
                                    <option value="CURRIMAO" {{ old('prob_category') == 'CURRIMAO' ? 'selected' : ''}}>CURRIMAO</option>  
                                    <option value="CUYAPO" {{ old('prob_category') == 'CUYAPO' ? 'selected' : ''}}>CUYAPO</option>  
                                    <option value="CUYO" {{ old('prob_category') == 'CUYO' ? 'selected' : ''}}>CUYO</option>  
                                    <option value="DAET" {{ old('prob_category') == 'DAET' ? 'selected' : ''}}>DAET</option>  
                                    <option value="DAGAMI" {{ old('prob_category') == 'DAGAMI' ? 'selected' : ''}}>DAGAMI</option>  
                                    <option value="DAGUIOMAN" {{ old('prob_category') == 'DAGUIOMAN' ? 'selected' : ''}}>DAGUIOMAN</option>  
                                    <option value="DAGUPAN CITY" {{ old('prob_category') == 'DAGUPAN CITY' ? 'selected' : ''}}>DAGUPAN CITY</option>  
                                    <option value="DAMULOG" {{ old('prob_category') == 'DAMULOG' ? 'selected' : ''}}>DAMULOG</option> 
                                    <option value="DANGCAGAN" {{ old('prob_category') == 'DANGCAGAN' ? 'selected' : ''}}>DANGCAGAN</option>
                                    <option value="DANGLAS" {{ old('prob_category') == 'DANGLAS' ? 'selected' : ''}}>DANGLAS</option>
                                    <option value="" disabled selected>Select Facility</option>
                                    <option value="DAPA" {{ old('prob_category') == 'DAPA' ? 'selected' : ''}}>DAPA</option>
                                    <option value="DAPITAN CITY" {{ old('prob_category') == 'DAPITAN CITY' ? 'selected' : ''}}>DAPITAN CITY</option>
                                    <option value="DARAGA (LOCSIN)" {{ old('prob_category') == 'DARAGA (LOCSIN)' ? 'selected' : ''}}>DARAGA (LOCSIN)</option>
                                    <option value="DARAM" {{ old('prob_category') == 'DARAM' ? 'selected' : ''}}>DARAM</option>
                                    <option value="DASMARIÑAS" {{ old('prob_category') == 'DASMARIÑAS' ? 'selected' : ''}}>DASMARIÑAS</option> 
                                    <option value="DASOL" {{ old('prob_category') == 'DASOL' ? 'selected' : ''}}>DASOL</option>
                                    <option value="DATU ABDULLAH SANGKI" {{ old('prob_category') == 'DATU ABDULLAH SANGKI' ? 'selected' : ''}}>DATU ABDULLAH SANGKI</option>
                                    <option value="DATU ANGGAL MIDTIMBANG" {{ old('prob_category') == 'DATU ANGGAL MIDTIMBANG' ? 'selected' : ''}}>DATU ANGGAL MIDTIMBANG</option>
                                    <option value="DATU BLAH T. SINSUAT" {{ old('prob_category') == 'DATU BLAH T. SINSUAT' ? 'selected' : ''}}>DATU BLAH T. SINSUAT</option>  
                                    <option value="DATU ODIN SINSUAT (DINAIG)" {{ old('prob_category') == 'DATU ODIN SINSUAT (DINAIG)' ? 'selected' : ''}}>DATU ODIN SINSUAT (DINAIG)</option>  
                                    <option value="DATU PAGLAS" {{ old('prob_category') == 'DATU PAGLAS' ? 'selected' : ''}}>DATU PAGLAS</option>  
                                    <option value="DATU PIANG" {{ old('prob_category') == 'DATU PIANG' ? 'selected' : ''}}>DATU PIANG</option>  
                                    <option value="DATU SAUDI-AMPATUAN" {{ old('prob_category') == 'DATU SAUDI-AMPATUAN' ? 'selected' : ''}}>DATU SAUDI-AMPATUAN</option>  
                                    <option value="DATU UNSAY" {{ old('prob_category') == 'DATU UNSAY' ? 'selected' : ''}}>DATU UNSAY</option>  
                                    <option value="DAUIN" {{ old('prob_category') == 'DAUIN' ? 'selected' : ''}}>DAUIN</option>  
                                    <option value="DAVAO CITY" {{ old('prob_category') == 'DAVAO CITY' ? 'selected' : ''}}>DAVAO CITY</option> 
                                    <option value="DEL CARMEN" {{ old('prob_category') == 'DEL CARMEN' ? 'selected' : ''}}>DEL CARMEN</option>
                                    <option value="DELFIN ALBANO (MAGSAYSAY)" {{ old('prob_category') == 'DELFIN ALBANO (MAGSAYSAY)' ? 'selected' : ''}}>DELFIN ALBANO (MAGSAYSAY)</option>
                                    <option value="DIADI" {{ old('prob_category') == 'DIADI' ? 'selected' : ''}}>DIADI</option>
                                    <option value="DIFFUN" {{ old('prob_category') == 'DIFFUN' ? 'selected' : ''}}>DIFFUN</option>
                                    <option value="DIGOS CITY" {{ old('prob_category') == 'DIGOS CITY' ? 'selected' : ''}}>DIGOS CITY</option>
                                    <option value="DILASAG" {{ old('prob_category') == 'DILASAG' ? 'selected' : ''}}>DILASAG</option>
                                    <option value="DIMASALANG" {{ old('prob_category') == 'DIMASALANG' ? 'selected' : ''}}>DIMASALANG</option> 
                                    <option value="DINAGAT" {{ old('prob_category') == 'DINAGAT' ? 'selected' : ''}}>DINAGAT</option>
                                    <option value="DINALUNGAN" {{ old('prob_category') == 'DINALUNGAN' ? 'selected' : ''}}>DINALUNGAN</option>
                                    <option value="DINALUPIHAN" {{ old('prob_category') == 'DINALUPIHAN' ? 'selected' : ''}}>DINALUPIHAN</option>
                                    <option value="DINAPIGUE" {{ old('prob_category') == 'DINAPIGUE' ? 'selected' : ''}}>DINAPIGUE</option>  
                                    <option value="DINGALAN" {{ old('prob_category') == 'DINGALAN' ? 'selected' : ''}}>DINGALAN</option>  
                                    <option value="DINGLE" {{ old('prob_category') == 'DINGLE' ? 'selected' : ''}}>DINGLE</option>  
                                    <option value="DINGRAS" {{ old('prob_category') == 'DINGRAS' ? 'selected' : ''}}>DINGRAS</option>  
                                    <option value="DIPACULAO" {{ old('prob_category') == 'DIPACULAO' ? 'selected' : ''}}>DIPACULAO</option>  
                                    <option value="DIPLAHAN" {{ old('prob_category') == 'DIPLAHAN' ? 'selected' : ''}}>DIPLAHAN</option>  
                                    <option value="DIPOLOG CITY " {{ old('prob_category') == 'DIPOLOG CITY ' ? 'selected' : ''}}>DIPOLOG CITY </option>  
                                    <option value="DITSAAN-RAMAIN" {{ old('prob_category') == 'DITSAAN-RAMAIN' ? 'selected' : ''}}>DITSAAN-RAMAIN</option> 
                                    <option value="DIVILICA" {{ old('prob_category') == 'DIVILICA' ? 'selected' : ''}}>DIVILICA</option>
                                    <option value="DOLORES" {{ old('prob_category') == 'DOLORES' ? 'selected' : ''}}>DOLORES</option>
                                    <option value="DON CARLOS" {{ old('prob_category') == 'DON CARLOS' ? 'selected' : ''}}>DON CARLOS</option>
                                    <option value="DON MARCELINO" {{ old('prob_category') == 'DON MARCELINO' ? 'selected' : ''}}>DON MARCELINO</option>
                                    <option value="DON VICTORIANO CHIONGBIAN" {{ old('prob_category') == 'DON VICTORIANO CHIONGBIAN' ? 'selected' : ''}}>DON VICTORIANO CHIONGBIAN</option>
                                    <option value="DOÑA REMEDIOS TRINIDAD" {{ old('prob_category') == 'DOÑA REMEDIOS TRINIDAD' ? 'selected' : ''}}>DOÑA REMEDIOS TRINIDAD</option>
                                    <option value="DONSOL" {{ old('prob_category') == 'DONSOL' ? 'selected' : ''}}>DONSOL</option> 
                                    <option value="DUEÑAS" {{ old('prob_category') == 'DUEÑAS' ? 'selected' : ''}}>DUEÑAS</option>
                                    <option value="DULAG" {{ old('prob_category') == 'DULAG' ? 'selected' : ''}}>DULAG</option>
                                    <option value="DUMAGUETE CITY" {{ old('prob_category') == 'DUMAGUETE CITY' ? 'selected' : ''}}>DUMAGUETE CITY</option>
                                    <option value="DUMALNEG" {{ old('prob_category') == 'DUMALNEG' ? 'selected' : ''}}>DUMALNEG</option>  
                                    <option value="DUMANGAS" {{ old('prob_category') == 'DUMANGAS' ? 'selected' : ''}}>DUMANGAS</option>  
                                    <option value="DUMARAN" {{ old('prob_category') == 'DUMARAN' ? 'selected' : ''}}>DUMARAN</option>  
                                    <option value="DUPAX DEL NORTE" {{ old('prob_category') == 'DUPAX DEL NORTE' ? 'selected' : ''}}>DUPAX DEL NORTE</option>  
                                    <option value="DUPAX DEL SUR" {{ old('prob_category') == 'DUPAX DEL SUR' ? 'selected' : ''}}>DUPAX DEL SUR</option>  
                                    <option value="ECHAGUE" {{ old('prob_category') == 'ECHAGUE' ? 'selected' : ''}}>ECHAGUE</option>  
                                    <option value="EL NIDO (BACUIT)" {{ old('prob_category') == 'EL NIDO (BACUIT)' ? 'selected' : ''}}>EL NIDO (BACUIT)</option>  
                                    <option value="EL SALVADOR" {{ old('prob_category') == 'EL SALVADOR' ? 'selected' : ''}}>EL SALVADOR</option> 
                                    <option value="ENRILE" {{ old('prob_category') == 'ENRILE' ? 'selected' : ''}}>ENRILE</option>
                                    <option value="ENRIQUE B. MAGALONA (SARAVIA)" {{ old('prob_category') == 'ENRIQUE B. MAGALONA (SARAVIA)' ? 'selected' : ''}}>ENRIQUE B. MAGALONA (SARAVIA)</option>
                                    <option value="ENRIQUE VILLANUEVA" {{ old('prob_category') == 'ENRIQUE VILLANUEVA' ? 'selected' : ''}}>ENRIQUE VILLANUEVA</option>
                                    <option value="ERMITA" {{ old('prob_category') == 'ERMITA' ? 'selected' : ''}}>ERMITA</option>
                                    <option value="ESCALANTE CITY" {{ old('prob_category') == 'ESCALANTE CITY' ? 'selected' : ''}}>ESCALANTE CITY</option>
                                    <option value="ESPERANZA" {{ old('prob_category') == 'ESPERANZA' ? 'selected' : ''}}>ESPERANZA</option>
                                    <option value="ESTANCIA" {{ old('prob_category') == 'ESTANCIA' ? 'selected' : ''}}>ESTANCIA</option> 
                                    <option value="FAMY" {{ old('prob_category') == 'FAMY' ? 'selected' : ''}}>FAMY</option>
                                    <option value="FERROL" {{ old('prob_category') == 'FERROL' ? 'selected' : ''}}>FERROL</option>
                                    <option value="FLORA" {{ old('prob_category') == 'FLORA' ? 'selected' : ''}}>FLORA</option>
                                    <option value="FLORIDABLANCA" {{ old('prob_category') == 'FLORIDABLANCA' ? 'selected' : ''}}>FLORIDABLANCA</option>  
                                    <option value="GABALDON (BITULOK & SABANI)" {{ old('prob_category') == 'GABALDON (BITULOK & SABANI)' ? 'selected' : ''}}>GABALDON (BITULOK & SABANI)</option>  
                                    <option value="GAINZA" {{ old('prob_category') == 'GAINZA' ? 'selected' : ''}}>GAINZA</option>  
                                    <option value="GALIMUYOD" {{ old('prob_category') == 'GALIMUYOD' ? 'selected' : ''}}>GALIMUYOD</option>  
                                    <option value="GAMAY" {{ old('prob_category') == 'GAMAY' ? 'selected' : ''}}>GAMAY</option>  
                                    <option value="GAMU" {{ old('prob_category') == 'GAMU' ? 'selected' : ''}}>GAMU</option>  
                                    <option value="GANASSI" {{ old('prob_category') == 'GANASSI' ? 'selected' : ''}}>GANASSI</option>  
                                    <option value="GANDARA" {{ old('prob_category') == 'GANDARA' ? 'selected' : ''}}>GANDARA</option> 
                                    <option value="GAPAN CITY" {{ old('prob_category') == 'GAPAN CITY' ? 'selected' : ''}}>GAPAN CITY</option>
                                    <option value="GARCHITORENA" {{ old('prob_category') == 'GARCHITORENA' ? 'selected' : ''}}>GARCHITORENA</option>
                                    <option value="GARCIA HERNANDEZ" {{ old('prob_category') == 'GARCIA HERNANDEZ' ? 'selected' : ''}}>GARCIA HERNANDEZ</option>
                                    <option value="GASAN" {{ old('prob_category') == 'GASAN' ? 'selected' : ''}}>GASAN</option>
                                    <option value="GATTARAN" {{ old('prob_category') == 'GATTARAN' ? 'selected' : ''}}>GATTARAN</option>
                                    <option value="GEN. MARIANO ALVAREZ" {{ old('prob_category') == 'GEN. MARIANO ALVAREZ' ? 'selected' : ''}}>GEN. MARIANO ALVAREZ</option>
                                    <option value="GEN. S. K. PENDATUN" {{ old('prob_category') == 'GEN. S. K. PENDATUN' ? 'selected' : ''}}>GEN. S. K. PENDATUN</option> 
                                    <option value="GENERAL EMILIO AGUINALDO" {{ old('prob_category') == 'GENERAL EMILIO AGUINALDO' ? 'selected' : ''}}>GENERAL EMILIO AGUINALDO</option>
                                    <option value="GENERAL LUNA" {{ old('prob_category') == 'GENERAL LUNA' ? 'selected' : ''}}>GENERAL LUNA</option>
                                    <option value="GENERAL LUNA" {{ old('prob_category') == 'GENERAL LUNA' ? 'selected' : ''}}>GENERAL LUNA</option>
                                    <option value="GENERAL MACARTHUR" {{ old('prob_category') == 'GENERAL MACARTHUR' ? 'selected' : ''}}>GENERAL MACARTHUR</option>  
                                    <option value="GENERAL MAMERTO NATIVIDAD" {{ old('prob_category') == 'GENERAL MAMERTO NATIVIDAD' ? 'selected' : ''}}>GENERAL MAMERTO NATIVIDAD</option>  
                                    <option value="GENERAL NAKAR" {{ old('prob_category') == 'GENERAL NAKAR' ? 'selected' : ''}}>GENERAL NAKAR</option>  
                                    <option value="GENERAL SANTOS CITY (DADIANGAS)" {{ old('prob_category') == 'GENERAL SANTOS CITY (DADIANGAS)' ? 'selected' : ''}}>GENERAL SANTOS CITY (DADIANGAS)</option>  
                                    <option value="GENERAL TINIO (PAPAYA)" {{ old('prob_category') == 'GENERAL TINIO (PAPAYA)' ? 'selected' : ''}}>GENERAL TINIO (PAPAYA)</option>  
                                    <option value="GENERAL TRIAS" {{ old('prob_category') == 'GENERAL TRIAS' ? 'selected' : ''}}>GENERAL TRIAS</option>  
                                    <option value="GERONA" {{ old('prob_category') == 'GERONA' ? 'selected' : ''}}>GERONA</option>  
                                    <option value="GIGAQUIT" {{ old('prob_category') == 'GIGAQUIT' ? 'selected' : ''}}>GIGAQUIT</option> 
                                    <option value="GIGMOTO" {{ old('prob_category') == 'GIGMOTO' ? 'selected' : ''}}>GIGMOTO</option>
                                    <option value="GINATILAN" {{ old('prob_category') == 'GINATILAN' ? 'selected' : ''}}>GINATILAN</option>
                                    <option value="" disabled selected>Select Facility</option>
                                    <option value="GINGOOG CITY" {{ old('prob_category') == 'GINGOOG CITY' ? 'selected' : ''}}>GINGOOG CITY</option>
                                    <option value="GIPORLOS" {{ old('prob_category') == 'GIPORLOS' ? 'selected' : ''}}>GIPORLOS</option>
                                    <option value="GITAGUM" {{ old('prob_category') == 'GITAGUM' ? 'selected' : ''}}>GITAGUM</option>
                                    <option value="GLAN" {{ old('prob_category') == 'GLAN' ? 'selected' : ''}}>GLAN</option>
                                    <option value="GLORIA" {{ old('prob_category') == 'GLORIA' ? 'selected' : ''}}>GLORIA</option> 
                                    <option value="GOA" {{ old('prob_category') == 'GOA' ? 'selected' : ''}}>GOA</option>
                                    <option value="GODOD" {{ old('prob_category') == 'GODOD' ? 'selected' : ''}}>GODOD</option>
                                    <option value="GONZAGA" {{ old('prob_category') == 'GONZAGA' ? 'selected' : ''}}>GONZAGA</option>
                                    <option value="GOVERNOR GENEROSO" {{ old('prob_category') == 'GOVERNOR GENEROSO' ? 'selected' : ''}}>GOVERNOR GENEROSO</option>  
                                    <option value="GREGORIO DEL PILAR (CONCEPCION)" {{ old('prob_category') == 'GREGORIO DEL PILAR (CONCEPCION)' ? 'selected' : ''}}>GREGORIO DEL PILAR (CONCEPCION)</option>  
                                    <option value="GUAGUA" {{ old('prob_category') == 'GUAGUA' ? 'selected' : ''}}>GUAGUA</option>  
                                    <option value="GUBAT" {{ old('prob_category') == 'GUBAT' ? 'selected' : ''}}>GUBAT</option>  
                                    <option value="GUIGUINTO" {{ old('prob_category') == 'GUIGUINTO' ? 'selected' : ''}}>GUIGUINTO</option>  
                                    <option value="GUIHULNGAN" {{ old('prob_category') == 'GUIHULNGAN' ? 'selected' : ''}}>GUIHULNGAN</option>  
                                    <option value="GUIMBA" {{ old('prob_category') == 'GUIMBA' ? 'selected' : ''}}>GUIMBA</option>  
                                    <option value="GUIMBAL" {{ old('prob_category') == 'GUIMBAL' ? 'selected' : ''}}>GUIMBAL</option> 
                                    <option value="GUINAYANGAN" {{ old('prob_category') == 'GUINAYANGAN' ? 'selected' : ''}}>GUINAYANGAN</option>
                                    <option value="GUINDULMAN" {{ old('prob_category') == 'GUINDULMAN' ? 'selected' : ''}}>GUINDULMAN</option>
                                    <option value="GUINDULUNGAN" {{ old('prob_category') == 'GUINDULUNGAN' ? 'selected' : ''}}>GUINDULUNGAN</option>
                                    <option value="GUINOBATAN" {{ old('prob_category') == 'GUINOBATAN' ? 'selected' : ''}}>GUINOBATAN</option>
                                    <option value="GUINSILIBAN" {{ old('prob_category') == 'GUINSILIBAN' ? 'selected' : ''}}>GUINSILIBAN</option>
                                    <option value="GUIPOS" {{ old('prob_category') == 'GUIPOS' ? 'selected' : ''}}>GUIPOS</option>
                                    <option value="GUIUAN" {{ old('prob_category') == 'GUIUAN' ? 'selected' : ''}}>GUIUAN</option> 
                                    <option value="GUMACA" {{ old('prob_category') == 'GUMACA' ? 'selected' : ''}}>GUMACA</option>
                                    <option value="GUTALAC" {{ old('prob_category') == 'GUTALAC' ? 'selected' : ''}}>GUTALAC</option>
                                    <option value="HADJI MOHAMMAD AJUL" {{ old('prob_category') == 'HADJI MOHAMMAD AJUL' ? 'selected' : ''}}>HADJI MOHAMMAD AJUL</option>
                                    <option value="HADJI MUHTAMAD" {{ old('prob_category') == 'HADJI MUHTAMAD' ? 'selected' : ''}}>HADJI MUHTAMAD</option>  
                                    <option value="HADJI PANGLIMA TAHIL (MARUNGGAS)" {{ old('prob_category') == 'HADJI PANGLIMA TAHIL (MARUNGGAS)' ? 'selected' : ''}}>HADJI PANGLIMA TAHIL (MARUNGGAS)</option>  
                                    <option value="HAGONOY" {{ old('prob_category') == 'HAGONOY' ? 'selected' : ''}}>HAGONOY</option>  
                                    <option value="HAMTIC" {{ old('prob_category') == 'HAMTIC' ? 'selected' : ''}}>HAMTIC</option>  
                                    <option value="HERMOSA" {{ old('prob_category') == 'HERMOSA' ? 'selected' : ''}}>HERMOSA</option>  
                                    <option value="HERNANI" {{ old('prob_category') == 'HERNANI' ? 'selected' : ''}}>HERNANI</option>  
                                    <option value="HILONGOS" {{ old('prob_category') == 'HILONGOS' ? 'selected' : ''}}>HILONGOS</option>  
                                    <option value="HIMAMAYLAN CITY" {{ old('prob_category') == 'HIMAMAYLAN CITY' ? 'selected' : ''}}>HIMAMAYLAN CITY</option> 
                                    <option value="HINABANGAN" {{ old('prob_category') == 'HINABANGAN' ? 'selected' : ''}}>HINABANGAN</option>
                                    <option value="HINATUAN" {{ old('prob_category') == 'HINATUAN' ? 'selected' : ''}}>HINATUAN</option>
                                    <option value="HINDANG" {{ old('prob_category') == 'HINDANG' ? 'selected' : ''}}>HINDANG</option>
                                    <option value="HINGYON" {{ old('prob_category') == 'HINGYON' ? 'selected' : ''}}>HINGYON</option>
                                    <option value="HINIGARAN" {{ old('prob_category') == 'HINIGARAN' ? 'selected' : ''}}>HINIGARAN</option>
                                    <option value="HINOBA-AN (ASIA)" {{ old('prob_category') == 'HINOBA-AN (ASIA)' ? 'selected' : ''}}>HINOBA-AN (ASIA)</option>
                                    <option value="HINUNANGAN" {{ old('prob_category') == 'HINUNANGAN' ? 'selected' : ''}}>HINUNANGAN</option> 
                                    <option value="HINUNDAYAN" {{ old('prob_category') == 'HINUNDAYAN' ? 'selected' : ''}}>HINUNDAYAN</option>
                                    <option value="HUNGDUAN" {{ old('prob_category') == 'HUNGDUAN' ? 'selected' : ''}}>HUNGDUAN</option>
                                    <option value="IBA" {{ old('prob_category') == 'IBA' ? 'selected' : ''}}>IBA</option>
                                    <option value="IBAAN" {{ old('prob_category') == 'IBAAN' ? 'selected' : ''}}>IBAAN</option>  
                                    <option value="IBAJAY" {{ old('prob_category') == 'IBAJAY' ? 'selected' : ''}}>IBAJAY</option>  
                                    <option value="IGBARAS" {{ old('prob_category') == 'IGBARAS' ? 'selected' : ''}}>IGBARAS</option>  
                                    <option value="IGUIG" {{ old('prob_category') == 'IGUIG' ? 'selected' : ''}}>IGUIG</option>  
                                    <option value="ILAGAN" {{ old('prob_category') == 'ILAGAN' ? 'selected' : ''}}>ILAGAN</option>  
                                    <option value="ILIGAN CITY" {{ old('prob_category') == 'ILIGAN CITY' ? 'selected' : ''}}>ILIGAN CITY</option>  
                                    <option value="ILOG" {{ old('prob_category') == 'ILOG' ? 'selected' : ''}}>ILOG</option>  
                                    <option value="ILOILO CITY" {{ old('prob_category') == 'ILOILO CITY' ? 'selected' : ''}}>ILOILO CITY</option> 
                                    <option value="IMELDA" {{ old('prob_category') == 'IMELDA' ? 'selected' : ''}}>IMELDA</option>
                                    <option value="IMPASUG-ONG" {{ old('prob_category') == 'IMPASUG-ONG' ? 'selected' : ''}}>IMPASUG-ONG</option>
                                    <option value="IMUS" {{ old('prob_category') == 'IMUS' ? 'selected' : ''}}>IMUS</option>
                                    <option value="INABANGA" {{ old('prob_category') == 'INABANGA' ? 'selected' : ''}}>INABANGA</option>
                                    <option value="INDANAN" {{ old('prob_category') == 'INDANAN' ? 'selected' : ''}}>INDANAN</option>
                                    <option value="INDANG" {{ old('prob_category') == 'INDANG' ? 'selected' : ''}}>INDANG</option>
                                    <option value="INFANTA" {{ old('prob_category') == 'INFANTA' ? 'selected' : ''}}>INFANTA</option> 
                                    <option value="INITAO" {{ old('prob_category') == 'INITAO' ? 'selected' : ''}}>INITAO</option>
                                    <option value="INOPACAN" {{ old('prob_category') == 'INOPACAN' ? 'selected' : ''}}>INOPACAN</option>
                                    <option value="INTRAMUROS" {{ old('prob_category') == 'INTRAMUROS' ? 'selected' : ''}}>INTRAMUROS</option>
                                    <option value="IPIL" {{ old('prob_category') == 'IPIL' ? 'selected' : ''}}>IPIL</option>  
                                    <option value="IRIGA CITY" {{ old('prob_category') == 'IRIGA CITY' ? 'selected' : ''}}>IRIGA CITY</option>  
                                    <option value="IROSIN" {{ old('prob_category') == 'IROSIN' ? 'selected' : ''}}>IROSIN</option>  
                                    <option value="ISABEL" {{ old('prob_category') == 'ISABEL' ? 'selected' : ''}}>ISABEL</option>  
                                    <option value="ISABELA CITY " {{ old('prob_category') == 'ISABELA CITY ' ? 'selected' : ''}}>ISABELA CITY </option>  
                                    <option value="ISLAND GARDEN CITY OF SAMAL" {{ old('prob_category') == 'ISLAND GARDEN CITY OF SAMAL' ? 'selected' : ''}}>ISLAND GARDEN CITY OF SAMAL</option>  
                                    <option value="ISULAN" {{ old('prob_category') == 'ISULAN' ? 'selected' : ''}}>ISULAN</option>  
                                    <option value="ITBAYAT" {{ old('prob_category') == 'ITBAYAT' ? 'selected' : ''}}>ITBAYAT</option> 
                                    <option value="ITOGON" {{ old('prob_category') == 'ITOGON' ? 'selected' : ''}}>ITOGON</option>
                                    <option value="IVANA" {{ old('prob_category') == 'IVANA' ? 'selected' : ''}}>IVANA</option>
                                    <option value="IVISAN" {{ old('prob_category') == 'IVISAN' ? 'selected' : ''}}>IVISAN</option>
                                    <option value="JABONGA" {{ old('prob_category') == 'JABONGA' ? 'selected' : ''}}>JABONGA</option>
                                    <option value="JAEN" {{ old('prob_category') == 'JAEN' ? 'selected' : ''}}>JAEN</option>
                                    <option value="JAGNA" {{ old('prob_category') == 'JAGNA' ? 'selected' : ''}}>JAGNA</option>
                                    <option value="JALA-JALA" {{ old('prob_category') == 'JALA-JALA' ? 'selected' : ''}}>JALA-JALA</option> 
                                    <option value="JAMINDAN" {{ old('prob_category') == 'JAMINDAN' ? 'selected' : ''}}>JAMINDAN</option>
                                    <option value="JANIUAY" {{ old('prob_category') == 'JANIUAY' ? 'selected' : ''}}>JANIUAY</option>
                                    <option value="JARO" {{ old('prob_category') == 'JARO' ? 'selected' : ''}}>JARO</option>
                                    <option value="JASAAN" {{ old('prob_category') == 'JASAAN' ? 'selected' : ''}}>JASAAN</option>  
                                    <option value="JAVIER (BUGHO)" {{ old('prob_category') == 'JAVIER (BUGHO)' ? 'selected' : ''}}>JAVIER (BUGHO)</option>  
                                    <option value="JETAFE" {{ old('prob_category') == 'JETAFE' ? 'selected' : ''}}>JETAFE</option>  
                                    <option value="JIABONG" {{ old('prob_category') == 'JIABONG' ? 'selected' : ''}}>JIABONG</option>  
                                    <option value="JIMALALUD" {{ old('prob_category') == 'JIMALALUD' ? 'selected' : ''}}>JIMALALUD</option>  
                                    <option value="JIMENEZ" {{ old('prob_category') == 'JIMENEZ' ? 'selected' : ''}}>JIMENEZ</option>  
                                    <option value="JIPAPAD" {{ old('prob_category') == 'JIPAPAD' ? 'selected' : ''}}>JIPAPAD</option>  
                                    <option value="JOLO" {{ old('prob_category') == 'JOLO' ? 'selected' : ''}}>JOLO</option> 
                                    <option value="JOMALIG" {{ old('prob_category') == 'JOMALIG' ? 'selected' : ''}}>JOMALIG</option>
                                    <option value="JONES" {{ old('prob_category') == 'JONES' ? 'selected' : ''}}>JONES</option>
                                    <option value="JOSE ABAD SANTOS (TRINIDAD)" {{ old('prob_category') == 'JOSE ABAD SANTOS (TRINIDAD)' ? 'selected' : ''}}>JOSE ABAD SANTOS (TRINIDAD)</option>
                                    <option value="JOSE DALMAN (PONOT)" {{ old('prob_category') == 'JOSE DALMAN (PONOT)' ? 'selected' : ''}}>JOSE DALMAN (PONOT)</option>
                                    <option value="JOSE PANGANIBAN" {{ old('prob_category') == 'JOSE PANGANIBAN' ? 'selected' : ''}}>JOSE PANGANIBAN</option>
                                    <option value="JOSEFINA" {{ old('prob_category') == 'JOSEFINA' ? 'selected' : ''}}>JOSEFINA</option>
                                    <option value="JOVELLAR" {{ old('prob_category') == 'JOVELLAR' ? 'selected' : ''}}>JOVELLAR</option> 
                                    <option value="JUBAN" {{ old('prob_category') == 'JUBAN' ? 'selected' : ''}}>JUBAN</option>
                                    <option value="JULITA" {{ old('prob_category') == 'JULITA' ? 'selected' : ''}}>JULITA</option>
                                    <option value="KABACAN" {{ old('prob_category') == 'KABACAN' ? 'selected' : ''}}>KABACAN</option>
                                    <option value="KABANKALAN CITY" {{ old('prob_category') == 'KABANKALAN CITY' ? 'selected' : ''}}>KABANKALAN CITY</option>  
                                    <option value="KABASALAN" {{ old('prob_category') == 'KABASALAN' ? 'selected' : ''}}>KABASALAN</option>  
                                    <option value="KABAYAN" {{ old('prob_category') == 'KABAYAN' ? 'selected' : ''}}>KABAYAN</option>  
                                    <option value="KABUGAO" {{ old('prob_category') == 'KABUGAO' ? 'selected' : ''}}>KABUGAO</option>  
                                    <option value="KABUNTALAN (TUMBAO)" {{ old('prob_category') == 'KABUNTALAN (TUMBAO)' ? 'selected' : ''}}>KABUNTALAN (TUMBAO)</option>  
                                    <option value="KADINGILAN" {{ old('prob_category') == 'KADINGILAN' ? 'selected' : ''}}>KADINGILAN</option>  
                                    <option value="KALAMANSIG" {{ old('prob_category') == 'KALAMANSIG' ? 'selected' : ''}}>KALAMANSIG</option>  
                                    <option value="KALAWIT" {{ old('prob_category') == 'KALAWIT' ? 'selected' : ''}}>KALAWIT</option> 
                                    <option value="KALAYAAN" {{ old('prob_category') == 'KALAYAAN' ? 'selected' : ''}}>KALAYAAN</option>
                                    <option value="KALIBO" {{ old('prob_category') == 'KALIBO' ? 'selected' : ''}}>KALIBO</option>
                                    <option value="KALILANGAN" {{ old('prob_category') == 'KALILANGAN' ? 'selected' : ''}}>KALILANGAN</option>
                                    <option value="KALINGALAN CALUANG" {{ old('prob_category') == 'KALINGALAN CALUANG' ? 'selected' : ''}}>KALINGALAN CALUANG</option>
                                    <option value="KALOOKAN CITY" {{ old('prob_category') == 'KALOOKAN CITY' ? 'selected' : ''}}>KALOOKAN CITY</option>
                                    <option value="KANANGA" {{ old('prob_category') == 'KANANGA' ? 'selected' : ''}}>KANANGA</option>
                                    <option value="KAPAI" {{ old('prob_category') == 'KAPAI' ? 'selected' : ''}}>KAPAI</option> 
                                    <option value="KAPALONG" {{ old('prob_category') == 'KAPALONG' ? 'selected' : ''}}>KAPALONG</option>
                                    <option value="KAPANGAN" {{ old('prob_category') == 'KAPANGAN' ? 'selected' : ''}}>KAPANGAN</option>
                                    <option value="KAPATAGAN" {{ old('prob_category') == 'KAPATAGAN' ? 'selected' : ''}}>KAPATAGAN</option>
                                    <option value="KASIBU" {{ old('prob_category') == 'KASIBU' ? 'selected' : ''}}>KASIBU</option>  
                                    <option value="KATIPUNAN" {{ old('prob_category') == 'KATIPUNAN' ? 'selected' : ''}}>KATIPUNAN</option>  
                                    <option value="KAUSWAGAN" {{ old('prob_category') == 'KAUSWAGAN' ? 'selected' : ''}}>KAUSWAGAN</option>  
                                    <option value="KAWAYAN" {{ old('prob_category') == 'KAWAYAN' ? 'selected' : ''}}>KAWAYAN</option>  
                                    <option value="KAWIT" {{ old('prob_category') == 'KAWIT' ? 'selected' : ''}}>KAWIT</option>  
                                    <option value="KAYAPA" {{ old('prob_category') == 'KAYAPA' ? 'selected' : ''}}>KAYAPA</option>  
                                    <option value="KIAMBA" {{ old('prob_category') == 'KIAMBA' ? 'selected' : ''}}>KIAMBA</option>  
                                    <option value="KIANGAN" {{ old('prob_category') == 'KIANGAN' ? 'selected' : ''}}>KIANGAN</option> 
                                    <option value="KIBAWE" {{ old('prob_category') == 'KIBAWE' ? 'selected' : ''}}>KIBAWE</option>
                                    <option value="KIBLAWAN" {{ old('prob_category') == 'KIBLAWAN' ? 'selected' : ''}}>KIBLAWAN</option>
                                    <option value="KIBUNGAN" {{ old('prob_category') == 'KIBUNGAN' ? 'selected' : ''}}>KIBUNGAN</option>
                                    <option value="KIDAPAWAN CITY " {{ old('prob_category') == 'KIDAPAWAN CITY ' ? 'selected' : ''}}>KIDAPAWAN CITY </option>
                                    <option value="KINOGUITAN" {{ old('prob_category') == 'KINOGUITAN' ? 'selected' : ''}}>KINOGUITAN</option>
                                    <option value="KITAOTAO" {{ old('prob_category') == 'KITAOTAO' ? 'selected' : ''}}>KITAOTAO</option>
                                    <option value="KITCHARAO" {{ old('prob_category') == 'KITCHARAO' ? 'selected' : ''}}>KITCHARAO</option> 
                                    <option value="KOLAMBUGAN" {{ old('prob_category') == 'KOLAMBUGAN' ? 'selected' : ''}}>KOLAMBUGAN</option>
                                    <option value="KORONADAL CITY " {{ old('prob_category') == 'KORONADAL CITY ' ? 'selected' : ''}}>KORONADAL CITY </option>
                                    <option value="KUMALARANG" {{ old('prob_category') == 'KUMALARANG' ? 'selected' : ''}}>KUMALARANG</option>
                                    <option value="LA CARLOTA CITY" {{ old('prob_category') == 'LA CARLOTA CITY' ? 'selected' : ''}}>LA CARLOTA CITY</option>  
                                    <option value="LA CASTELLANA" {{ old('prob_category') == 'LA CASTELLANA' ? 'selected' : ''}}>LA CASTELLANA</option>  
                                    <option value="LA LIBERTAD" {{ old('prob_category') == 'LA LIBERTAD' ? 'selected' : ''}}>LA LIBERTAD</option>  
                                    <option value="LA PAZ" {{ old('prob_category') == 'LA PAZ' ? 'selected' : ''}}>LA PAZ</option>  
                                    <option value="LA TRINIDAD (Capital)" {{ old('prob_category') == 'LA TRINIDAD (Capital)' ? 'selected' : ''}}>LA TRINIDAD (Capital)</option>  
                                    <option value="LAAK (SAN VICENTE)" {{ old('prob_category') == 'LAAK (SAN VICENTE)' ? 'selected' : ''}}>LAAK (SAN VICENTE)</option>  
                                    <option value="LABANGAN" {{ old('prob_category') == 'LABANGAN' ? 'selected' : ''}}>LABANGAN</option>  
                                    <option value="LABASON" {{ old('prob_category') == 'LABASON' ? 'selected' : ''}}>LABASON</option> 
                                    <option value="LABO" {{ old('prob_category') == 'LABO' ? 'selected' : ''}}>LABO</option>
                                    <option value="LABRADOR" {{ old('prob_category') == 'LABRADOR' ? 'selected' : ''}}>LABRADOR</option>
                                    <option value="LACUB" {{ old('prob_category') == 'LACUB' ? 'selected' : ''}}>LACUB</option>
                                    <option value="LAGANGILANG" {{ old('prob_category') == 'LAGANGILANG' ? 'selected' : ''}}>LAGANGILANG</option>
                                    <option value="LAGAWE" {{ old('prob_category') == 'LAGAWE' ? 'selected' : ''}}>LAGAWE</option>
                                    <option value="LAGAYAN" {{ old('prob_category') == 'LAGAYAN' ? 'selected' : ''}}>LAGAYAN</option>
                                    <option value="LAGONGLONG" {{ old('prob_category') == 'LAGONGLONG' ? 'selected' : ''}}>LAGONGLONG</option> 
                                    <option value="LAGONOY" {{ old('prob_category') == 'LAGONOY' ? 'selected' : ''}}>LAGONOY</option>
                                    <option value="LAGUINDINGAN" {{ old('prob_category') == 'LAGUINDINGAN' ? 'selected' : ''}}>LAGUINDINGAN</option>
                                    <option value="LAKE SEBU" {{ old('prob_category') == 'LAKE SEBU' ? 'selected' : ''}}>LAKE SEBU</option>
                                    <option value="LAKEWOOD" {{ old('prob_category') == 'LAKEWOOD' ? 'selected' : ''}}>LAKEWOOD</option>  
                                    <option value="LALA" {{ old('prob_category') == 'LALA' ? 'selected' : ''}}>LALA</option>  
                                    <option value="LAL-LO" {{ old('prob_category') == 'LAL-LO' ? 'selected' : ''}}>LAL-LO</option>  
                                    <option value="LAMBAYONG (MARIANO MARCOS)" {{ old('prob_category') == 'LAMBAYONG (MARIANO MARCOS)' ? 'selected' : ''}}>LAMBAYONG (MARIANO MARCOS)</option>  
                                    <option value="LAMBUNAO" {{ old('prob_category') == 'LAMBUNAO' ? 'selected' : ''}}>LAMBUNAO</option>  
                                    <option value="LAMITAN" {{ old('prob_category') == 'LAMITAN' ? 'selected' : ''}}>LAMITAN</option>  
                                    <option value="LAMUT" {{ old('prob_category') == 'LAMUT' ? 'selected' : ''}}>LAMUT</option>  
                                    <option value="LANGIDEN" {{ old('prob_category') == 'LANGIDEN' ? 'selected' : ''}}>LANGIDEN</option> 
                                    <option value="LANGUYAN" {{ old('prob_category') == 'LANGUYAN' ? 'selected' : ''}}>LANGUYAN</option>
                                    <option value="LANTAPAN" {{ old('prob_category') == 'LANTAPAN' ? 'selected' : ''}}>LANTAPAN</option>
                                    <option value="LANTAWAN" {{ old('prob_category') == 'LANTAWAN' ? 'selected' : ''}}>LANTAWAN</option>
                                    <option value="LANUZA" {{ old('prob_category') == 'LANUZA' ? 'selected' : ''}}>LANUZA</option>
                                    <option value="LAOAC" {{ old('prob_category') == 'LAOAC' ? 'selected' : ''}}>LAOAC</option>
                                    <option value="LAOAG CITY" {{ old('prob_category') == 'LAOAG CITY' ? 'selected' : ''}}>LAOAG CITY</option>
                                    <option value="LAOANG" {{ old('prob_category') == 'LAOANG' ? 'selected' : ''}}>LAOANG</option> 
                                    <option value="LAPAZ" {{ old('prob_category') == 'LAPAZ' ? 'selected' : ''}}>LAPAZ</option>
                                    <option value="LAPINIG" {{ old('prob_category') == 'LAPINIG' ? 'selected' : ''}}>LAPINIG</option>
                                    <option value="LAPU-LAPU CITY (OPON)" {{ old('prob_category') == 'LAPU-LAPU CITY (OPON)' ? 'selected' : ''}}>LAPU-LAPU CITY (OPON)</option>
                                    <option value="LAPUYAN" {{ old('prob_category') == 'LAPUYAN' ? 'selected' : ''}}>LAPUYAN</option>  
                                    <option value="LARENA" {{ old('prob_category') == 'LARENA' ? 'selected' : ''}}>LARENA</option>  
                                    <option value="LAS NAVAS" {{ old('prob_category') == 'LAS NAVAS' ? 'selected' : ''}}>LAS NAVAS</option>  
                                    <option value="LAS NIEVES" {{ old('prob_category') == 'LAS NIEVES' ? 'selected' : ''}}>LAS NIEVES</option>  
                                    <option value="LAS PIÑAS CITY" {{ old('prob_category') == 'LAS PIÑAS CITY' ? 'selected' : ''}}>LAS PIÑAS CITY</option>  
                                    <option value="LASAM" {{ old('prob_category') == 'LASAM' ? 'selected' : ''}}>LASAM</option>  
                                    <option value="LAUA-AN" {{ old('prob_category') == 'LAUA-AN' ? 'selected' : ''}}>LAUA-AN</option>  
                                    <option value="LAUR" {{ old('prob_category') == 'LAUR' ? 'selected' : ''}}>LAUR</option> 
                                    <option value="LAUREL" {{ old('prob_category') == 'LAUREL' ? 'selected' : ''}}>LAUREL</option>
                                    <option value="LAVEZARES" {{ old('prob_category') == 'LAVEZARES' ? 'selected' : ''}}>LAVEZARES</option>
                                    <option value="LAWAAN" {{ old('prob_category') == 'LAWAAN' ? 'selected' : ''}}>LAWAAN</option>
                                    <option value="LAZI" {{ old('prob_category') == 'LAZI' ? 'selected' : ''}}>LAZI</option>
                                    <option value="LEBAK" {{ old('prob_category') == 'LEBAK' ? 'selected' : ''}}>LEBAK</option>
                                    <option value="LEGANES" {{ old('prob_category') == 'LEGANES' ? 'selected' : ''}}>LEGANES</option>
                                    <option value="LEGAZPI CITY" {{ old('prob_category') == 'LEGAZPI CITY' ? 'selected' : ''}}>LEGAZPI CITY</option> 
                                    <option value="LEMERY" {{ old('prob_category') == 'LEMERY' ? 'selected' : ''}}>LEMERY</option>
                                    <option value="LEON" {{ old('prob_category') == 'LEON' ? 'selected' : ''}}>LEON</option>
                                    <option value="LEYTE" {{ old('prob_category') == 'LEYTE' ? 'selected' : ''}}>LEYTE</option>
                                    <option value="LEZO" {{ old('prob_category') == 'LEZO' ? 'selected' : ''}}>LEZO</option>  
                                    <option value="LIAN" {{ old('prob_category') == 'LIAN' ? 'selected' : ''}}>LIAN</option>  
                                    <option value="LIANGA" {{ old('prob_category') == 'LIANGA' ? 'selected' : ''}}>LIANGA</option>  
                                    <option value="LIBACAO" {{ old('prob_category') == 'LIBACAO' ? 'selected' : ''}}>LIBACAO</option>  
                                    <option value="LIBAGON" {{ old('prob_category') == 'LIBAGON' ? 'selected' : ''}}>LIBAGON</option>  
                                    <option value="LIBERTAD" {{ old('prob_category') == 'LIBERTAD' ? 'selected' : ''}}>LIBERTAD</option>  
                                    <option value="LIBJO (ALBOR)" {{ old('prob_category') == 'LIBJO (ALBOR)' ? 'selected' : ''}}>LIBJO (ALBOR)</option>  
                                    <option value="LIBMANAN" {{ old('prob_category') == 'LIBMANAN' ? 'selected' : ''}}>LIBMANAN</option> 
                                    <option value="LIBON" {{ old('prob_category') == 'LIBON' ? 'selected' : ''}}>LIBON</option>
                                    <option value="LIBONA" {{ old('prob_category') == 'LIBONA' ? 'selected' : ''}}>LIBONA</option>
                                    <option value="LIBUNGAN" {{ old('prob_category') == 'LIBUNGAN' ? 'selected' : ''}}>LIBUNGAN</option>
                                    <option value="LICAB" {{ old('prob_category') == 'LICAB' ? 'selected' : ''}}>LICAB</option>
                                    <option value="LICUAN-BAAY (LICUAN)" {{ old('prob_category') == 'LICUAN-BAAY (LICUAN)' ? 'selected' : ''}}>LICUAN-BAAY (LICUAN)</option>
                                    <option value="LIDLIDDA" {{ old('prob_category') == 'LIDLIDDA' ? 'selected' : ''}}>LIDLIDDA</option>
                                    <option value="LIGAO CITY" {{ old('prob_category') == 'LIGAO CITY' ? 'selected' : ''}}>LIGAO CITY</option> 
                                    <option value="LILA" {{ old('prob_category') == 'LILA' ? 'selected' : ''}}>LILA</option>
                                    <option value="LILIW" {{ old('prob_category') == 'LILIW' ? 'selected' : ''}}>LILIW</option>
                                    <option value="LILOAN" {{ old('prob_category') == 'LILOAN' ? 'selected' : ''}}>LILOAN</option>
                                    <option value="LILOY" {{ old('prob_category') == 'LILOY' ? 'selected' : ''}}>LILOY</option>  
                                    <option value="LIMASAWA" {{ old('prob_category') == 'LIMASAWA' ? 'selected' : ''}}>LIMASAWA</option>  
                                    <option value="LIMAY" {{ old('prob_category') == 'LIMAY' ? 'selected' : ''}}>LIMAY</option>  
                                    <option value="LINAMON" {{ old('prob_category') == 'LINAMON' ? 'selected' : ''}}>LINAMON</option>  
                                    <option value="LINAPACAN" {{ old('prob_category') == 'LINAPACAN' ? 'selected' : ''}}>LINAPACAN</option>  
                                    <option value="LINGAYEN" {{ old('prob_category') == 'LINGAYEN' ? 'selected' : ''}}>LINGAYEN</option>  
                                    <option value="LINGIG" {{ old('prob_category') == 'LINGIG' ? 'selected' : ''}}>LINGIG</option>  
                                    <option value="LIPA CITY" {{ old('prob_category') == 'LIPA CITY' ? 'selected' : ''}}>LIPA CITY</option> 
                                    <option value="LLANERA" {{ old('prob_category') == 'LLANERA' ? 'selected' : ''}}>LLANERA</option>
                                    <option value="LLORENTE" {{ old('prob_category') == 'LLORENTE' ? 'selected' : ''}}>LLORENTE</option>
                                    <option value="LOAY" {{ old('prob_category') == 'LOAY' ? 'selected' : ''}}>LOAY</option>
                                    <option value="LOBO" {{ old('prob_category') == 'LOBO' ? 'selected' : ''}}>LOBO</option>
                                    <option value="LOBOC" {{ old('prob_category') == 'LOBOC' ? 'selected' : ''}}>LOBOC</option>
                                    <option value="LOOC" {{ old('prob_category') == 'LOOC' ? 'selected' : ''}}>LOOC</option>
                                    <option value="LOON" {{ old('prob_category') == 'LOON' ? 'selected' : ''}}>LOON</option> 
                                    <option value="LOPE DE VEGA" {{ old('prob_category') == 'LOPE DE VEGA' ? 'selected' : ''}}>LOPE DE VEGA</option>
                                    <option value="LOPEZ" {{ old('prob_category') == 'LOPEZ' ? 'selected' : ''}}>LOPEZ</option>
                                    <option value="LOPEZ JAENA" {{ old('prob_category') == 'LOPEZ JAENA' ? 'selected' : ''}}>LOPEZ JAENA</option>
                                    <option value="LORETO" {{ old('prob_category') == 'LORETO' ? 'selected' : ''}}>LORETO</option>  
                                    <option value="LOS BAÑOS" {{ old('prob_category') == 'LOS BAÑOS' ? 'selected' : ''}}>LOS BAÑOS</option>  
                                    <option value="LUBA" {{ old('prob_category') == 'LUBA' ? 'selected' : ''}}>LUBA</option>  
                                    <option value="LUBANG" {{ old('prob_category') == 'LUBANG' ? 'selected' : ''}}>LUBANG</option>  
                                    <option value="LUBAO" {{ old('prob_category') == 'LUBAO' ? 'selected' : ''}}>LUBAO</option>  
                                    <option value="LUBUAGAN" {{ old('prob_category') == 'LUBUAGAN' ? 'selected' : ''}}>LUBUAGAN</option>  
                                    <option value="LUCBAN" {{ old('prob_category') == 'LUCBAN' ? 'selected' : ''}}>LUCBAN</option>  
                                    <option value="LUCENA CITY" {{ old('prob_category') == 'LUCENA CITY' ? 'selected' : ''}}>LUCENA CITY</option> 
                                    <option value="LUGAIT" {{ old('prob_category') == 'LUGAIT' ? 'selected' : ''}}>LUGAIT</option>
                                    <option value="LUGUS" {{ old('prob_category') == 'LUGUS' ? 'selected' : ''}}>LUGUS</option>
                                    <option value="LUISIANA" {{ old('prob_category') == 'LUISIANA' ? 'selected' : ''}}>LUISIANA</option>
                                    <option value="LUMBA-BAYABAO (MAGUING)" {{ old('prob_category') == 'LUMBA-BAYABAO (MAGUING)' ? 'selected' : ''}}>LUMBA-BAYABAO (MAGUING)</option>
                                    <option value="LUMBACA-UNAYAN" {{ old('prob_category') == 'LUMBACA-UNAYAN' ? 'selected' : ''}}>LUMBACA-UNAYAN</option>
                                    <option value="LUMBAN" {{ old('prob_category') == 'LUMBAN' ? 'selected' : ''}}>LUMBAN</option>
                                    <option value="LUMBATAN" {{ old('prob_category') == 'LUMBATAN' ? 'selected' : ''}}>LUMBATAN</option> 
                                    <option value="LUMBAYANAGUE" {{ old('prob_category') == 'LUMBAYANAGUE' ? 'selected' : ''}}>LUMBAYANAGUE</option>
                                    <option value="LUNA" {{ old('prob_category') == 'LUNA' ? 'selected' : ''}}>LUNA</option>
                                    <option value="LUPAO" {{ old('prob_category') == 'LUPAO' ? 'selected' : ''}}>LUPAO</option>
                                    <option value="LUPI" {{ old('prob_category') == 'LUPI' ? 'selected' : ''}}>LUPI</option>  
                                    <option value="LUPON" {{ old('prob_category') == 'LUPON' ? 'selected' : ''}}>LUPON</option>  
                                    <option value="LUTAYAN" {{ old('prob_category') == 'LUTAYAN' ? 'selected' : ''}}>LUTAYAN</option>  
                                    <option value="LUUK" {{ old('prob_category') == 'LUUK' ? 'selected' : ''}}>LUUK</option>  
                                    <option value="M\LANG" {{ old('prob_category') == 'M\LANG' ? 'selected' : ''}}>M\LANG</option>  
                                    <option value="MAASIM" {{ old('prob_category') == 'MAASIM' ? 'selected' : ''}}>MAASIM</option>  
                                    <option value="MAASIN" {{ old('prob_category') == 'MAASIN' ? 'selected' : ''}}>MAASIN</option>  
                                    <option value="MAASIN CITY" {{ old('prob_category') == 'MAASIN CITY' ? 'selected' : ''}}>MAASIN CITY</option> 
                                    <option value="MA-AYON" {{ old('prob_category') == 'MA-AYON' ? 'selected' : ''}}>MA-AYON</option>
                                    <option value="MABALACAT" {{ old('prob_category') == 'MABALACAT' ? 'selected' : ''}}>MABALACAT</option>
                                    <option value="MABINAY" {{ old('prob_category') == 'MABINAY' ? 'selected' : ''}}>MABINAY</option>
                                    <option value="MABINI" {{ old('prob_category') == 'MABINI' ? 'selected' : ''}}>MABINI</option>
                                    <option value="MABINI (DOÑA ALICIA)" {{ old('prob_category') == 'MABINI (DOÑA ALICIA)' ? 'selected' : ''}}>MABINI (DOÑA ALICIA)</option>
                                    <option value="MABITAC" {{ old('prob_category') == 'MABITAC' ? 'selected' : ''}}>MABITAC</option>
                                    <option value="MABUHAY" {{ old('prob_category') == 'MABUHAY' ? 'selected' : ''}}>MABUHAY</option> 
                                    <option value="MACABEBE" {{ old('prob_category') == 'MACABEBE' ? 'selected' : ''}}>MACABEBE</option>
                                    <option value="MACALELON" {{ old('prob_category') == 'MACALELON' ? 'selected' : ''}}>MACALELON</option>
                                    <option value="MACARTHUR" {{ old('prob_category') == 'MACARTHUR' ? 'selected' : ''}}>MACARTHUR</option>
                                    <option value="MACO" {{ old('prob_category') == 'MACO' ? 'selected' : ''}}>MACO</option>  
                                    <option value="MACONACON" MACONACON{ old('prob_category') == 'MACONACON' ? 'selected' : ''}}>MACONACON</option>  
                                    <option value="MACROHON" {{ old('prob_category') == 'MACROHON' ? 'selected' : ''}}>MACROHON</option>  
                                    <option value="MADALAG" {{ old('prob_category') == 'MADALAG' ? 'selected' : ''}}>MADALAG</option>  
                                    <option value="MADALUM" {{ old('prob_category') == 'MADALUM' ? 'selected' : ''}}>MADALUM</option>  
                                    <option value="MADAMBA" {{ old('prob_category') == 'MADAMBA' ? 'selected' : ''}}>MADAMBA</option>  
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option>  
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option> 
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option>
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option>
                                  </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form">
                                 <select class="select-wrapper mdb-select" name="facility" id="facility">
                                    <option value="" disabled selected>Select Facility</option>
                                    <option value="ASSUMPTA MEDICAL HOSPITAL" {{ old('prob_category') == 'ASSUMPTA MEDICAL HOSPITAL' ? 'selected' : ''}}>ASSUMPTA MEDICAL HOSPITAL</option>
                                    <option value="BAESA ADVENT POLYCLINIC & GENERAL HOSPITAL" {{ old('prob_category') == 'BAESA ADVENT POLYCLINIC & GENERAL HOSPITAL' ? 'selected' : ''}}>BAESA ADVENT POLYCLINIC & GENERAL HOSPITAL</option>
                                    <option value="CALAMBA MEDICAL CENTER" {{ old('prob_category') == 'CALAMBA MEDICAL CENTER' ? 'selected' : ''}}>CALAMBA MEDICAL CENTER</option>
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option>
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option> 
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option>
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option>
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option>
                                    <option value="" {{ old('prob_category') == '' ? 'selected' : ''}}></option>  
                                  </select>
                            </div>
                        </div>
                    </div>

                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-check"></i> NEXT</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


<script>
  $(function() {
          $('.mdb-select').material_select();
            $('#mobileNumber').mask('00000000000');
          
           });

            $( "#password" ).focus(function() {
                $('.label_password').addClass('active');
            });

            $( "#password" ).focusout(function() {
                if($( "#password" ).val() == ''){
                    $('.label_password').removeClass('active');
                }
            });

            
            $("#password").passwordValidator({
                // list of qualities to require
                require: ['length', 'lower', 'upper', 'digit'],
                // minimum length requirement
                length: 8
    
 
     });

  </script>
@endsection