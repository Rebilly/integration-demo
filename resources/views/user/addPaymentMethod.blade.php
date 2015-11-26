<?php
    use Rebilly\Util\RebillySignature;
    $auth = RebillySignature::generateSignature(getenv('REBILLY_API_USER'), getenv('REBILLY_API_KEY'));
    $rangeMonth = range(1, 12);
    $rangeYear = range(date('Y'), date('Y') + 20);
?>
@section('layoutType', 'user')
@section('title', 'User Profile')
@section('content')
    <div class="ui stackable grid centered container user">
        <div class="eleven wide column">
            <h2 class="ui header title color brand">Add new payment method</h2>
            <div class="ui segment management">
                <div class="ui error message error-summary hidden">
                    <strong>Please check the following errors:</strong>
                    <ul></ul>
                </div>
                <?php if (isset($errors)): ?>
                <div class="ui error message">
                    <strong>Please check the following errors:</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <?php endif ?>
                <form class="ui form" id="form-billing" method="post">
                    <input type="hidden" data-rebilly="auth" value="<?= $auth ?>">
                    <div class="fields">
                        <div class="eight wide field">
                            <label>First Name</label>
                            <input type="text" name="Billing[firstName]" placeholder="John" data-rebilly="firstName">
                        </div>
                        <div class="eight wide field">
                            <label>Last Name</label>
                            <input type="text" name="Billing[lastName]" placeholder="Doe" data-rebilly="lastName">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="five wide required field">
                            <label>Postal Code / ZIP</label>
                            <input type="text" name="Billing[postalCode]" data-rebilly="postalCode">
                        </div>
                        <div class="eleven wide required field">
                            <label>Country</label>
                            <select twolettercode="ddCountryValue" name="Billing[country]" data-rebilly="country">
                                <option value="US">US - United States</option>
                                <option value="CA">CA - Canada</option>
                                <option value="AF">AF - Afghanistan</option>
                                <option value="AX">AX - Åland Islands</option>
                                <option value="AL">AL - Albania</option>
                                <option value="DZ">DZ - Algeria</option>
                                <option value="AS">AS - American Samoa</option>
                                <option value="AD">AD - Andorra</option>
                                <option value="AO">AO - Angola</option>
                                <option value="AI">AI - Anguilla</option>
                                <option value="AQ">AQ - Antarctica</option>
                                <option value="AG">AG - Antigua and Barbuda</option>
                                <option value="AR">AR - Argentina</option>
                                <option value="AM">AM - Armenia</option>
                                <option value="AW">AW - Aruba</option>
                                <option value="AU">AU - Australia</option>
                                <option value="AT">AT - Austria</option>
                                <option value="AZ">AZ - Azerbaijan</option>
                                <option value="BS">BS - Bahamas</option>
                                <option value="BH">BH - Bahrain</option>
                                <option value="BD">BD - Bangladesh</option>
                                <option value="BB">BB - Barbados</option>
                                <option value="BY">BY - Belarus</option>
                                <option value="BE">BE - Belgium</option>
                                <option value="BZ">BZ - Belize</option>
                                <option value="BJ">BJ - Benin</option>
                                <option value="BM">BM - Bermuda</option>
                                <option value="BT">BT - Bhutan</option>
                                <option value="BO">BO - Bolivia</option>
                                <option value="BA">BA - Bosnia and Herzegovina</option>
                                <option value="BW">BW - Botswana</option>
                                <option value="BV">BV - Bouvet Island</option>
                                <option value="BR">BR - Brazil</option>
                                <option value="IO">IO - British Indian Ocean Territory</option>
                                <option value="VG">VG - British Virgin Islands</option>
                                <option value="BN">BN - Brunei</option>
                                <option value="BG">BG - Bulgaria</option>
                                <option value="BF">BF - Burkina Faso</option>
                                <option value="MM">MM - Burma</option>
                                <option value="BI">BI - Burundi</option>
                                <option value="KH">KH - Cambodia</option>
                                <option value="CM">CM - Cameroon</option>
                                <option value="CV">CV - Cape Verde</option>
                                <option value="KY">KY - Cayman Islands</option>
                                <option value="CF">CF - Central African Republic</option>
                                <option value="TD">TD - Chad</option>
                                <option value="CL">CL - Chile</option>
                                <option value="CN">CN - China</option>
                                <option value="CX">CX - Christmas Island</option>
                                <option value="CC">CC - Cocos (Keeling) Islands</option>
                                <option value="CO">CO - Colombia</option>
                                <option value="KM">KM - Comoros</option>
                                <option value="CG">CG - Congo</option>
                                <option value="CK">CK - Cook Islands</option>
                                <option value="CR">CR - Costa Rica</option>
                                <option value="CI">CI - Côte d'Ivoire</option>
                                <option value="HR">HR - Croatia</option>
                                <option value="CU">CU - Cuba</option>
                                <option value="CW">CW - Curaçao</option>
                                <option value="CY">CY - Cyprus</option>
                                <option value="CZ">CZ - Czech Republic</option>
                                <option value="CD">CD - Democratic Republic of the Congo</option>
                                <option value="DK">DK - Denmark</option>
                                <option value="DJ">DJ - Djibouti</option>
                                <option value="DM">DM - Dominica</option>
                                <option value="DO">DO - Dominican Republic</option>
                                <option value="TL">TL - East Timor</option>
                                <option value="EC">EC - Ecuador</option>
                                <option value="EG">EG - Egypt</option>
                                <option value="SV">SV - El Salvador</option>
                                <option value="GQ">GQ - Equatorial Guinea</option>
                                <option value="ER">ER - Eritrea</option>
                                <option value="EE">EE - Estonia</option>
                                <option value="ET">ET - Ethiopia</option>
                                <option value="FK">FK - Falkland Islands</option>
                                <option value="FO">FO - Faroe Islands</option>
                                <option value="FM">FM - Federated States of Micronesia</option>
                                <option value="FJ">FJ - Fiji</option>
                                <option value="FI">FI - Finland</option>
                                <option value="FR">FR - France</option>
                                <option value="GF">GF - French Guiana</option>
                                <option value="PF">PF - French Polynesia</option>
                                <option value="TF">TF - French Southern Territories</option>
                                <option value="GA">GA - Gabon</option>
                                <option value="GM">GM - Gambia</option>
                                <option value="GE">GE - Georgia</option>
                                <option value="DE">DE - Germany</option>
                                <option value="GH">GH - Ghana</option>
                                <option value="GI">GI - Gibraltar</option>
                                <option value="GR">GR - Greece</option>
                                <option value="GL">GL - Greenland</option>
                                <option value="GD">GD - Grenada</option>
                                <option value="GP">GP - Guadeloupe</option>
                                <option value="GU">GU - Guam</option>
                                <option value="GT">GT - Guatemala</option>
                                <option value="GG">GG - Guernsey</option>
                                <option value="GN">GN - Guinea</option>
                                <option value="GW">GW - Guinea-Bissau</option>
                                <option value="GY">GY - Guyana</option>
                                <option value="HT">HT - Haiti</option>
                                <option value="HM">HM - Heard Island and McDonald Islands</option>
                                <option value="HN">HN - Honduras</option>
                                <option value="HK">HK - Hong Kong</option>
                                <option value="HU">HU - Hungary</option>
                                <option value="IS">IS - Iceland</option>
                                <option value="IN">IN - India</option>
                                <option value="ID">ID - Indonesia</option>
                                <option value="IR">IR - Iran</option>
                                <option value="IQ">IQ - Iraq</option>
                                <option value="IE">IE - Ireland</option>
                                <option value="IM">IM - Isle of Man</option>
                                <option value="IL">IL - Israel</option>
                                <option value="IT">IT - Italy</option>
                                <option value="JM">JM - Jamaica</option>
                                <option value="JP">JP - Japan</option>
                                <option value="JE">JE - Jersey</option>
                                <option value="JO">JO - Jordan</option>
                                <option value="KZ">KZ - Kazakhstan</option>
                                <option value="KE">KE - Kenya</option>
                                <option value="KI">KI - Kiribati</option>
                                <option value="KW">KW - Kuwait</option>
                                <option value="KG">KG - Kyrgyzstan</option>
                                <option value="LA">LA - Laos</option>
                                <option value="LV">LV - Latvia</option>
                                <option value="LB">LB - Lebanon</option>
                                <option value="LS">LS - Lesotho</option>
                                <option value="LR">LR - Liberia</option>
                                <option value="LY">LY - Libya</option>
                                <option value="LI">LI - Liechtenstein</option>
                                <option value="LT">LT - Lithuania</option>
                                <option value="LU">LU - Luxembourg</option>
                                <option value="MO">MO - Macau</option>
                                <option value="MK">MK - Macedonia</option>
                                <option value="MG">MG - Madagascar</option>
                                <option value="MW">MW - Malawi</option>
                                <option value="MY">MY - Malaysia</option>
                                <option value="MV">MV - Maldives</option>
                                <option value="ML">ML - Mali</option>
                                <option value="MT">MT - Malta</option>
                                <option value="MH">MH - Marshall Islands</option>
                                <option value="MQ">MQ - Martinique</option>
                                <option value="MR">MR - Mauritania</option>
                                <option value="MU">MU - Mauritius</option>
                                <option value="YT">YT - Mayotte</option>
                                <option value="MX">MX - Mexico</option>
                                <option value="MD">MD - Moldova</option>
                                <option value="MC">MC - Monaco</option>
                                <option value="MN">MN - Mongolia</option>
                                <option value="ME">ME - Montenegro</option>
                                <option value="MS">MS - Montserrat</option>
                                <option value="MA">MA - Morocco</option>
                                <option value="MZ">MZ - Mozambique</option>
                                <option value="NA">NA - Namibia</option>
                                <option value="NR">NR - Nauru</option>
                                <option value="NP">NP - Nepal</option>
                                <option value="NL">NL - Netherlands</option>
                                <option value="NC">NC - New Caledonia</option>
                                <option value="NZ">NZ - New Zealand</option>
                                <option value="NI">NI - Nicaragua</option>
                                <option value="NE">NE - Niger</option>
                                <option value="NG">NG - Nigeria</option>
                                <option value="NU">NU - Niue</option>
                                <option value="NF">NF - Norfolk Island</option>
                                <option value="KP">KP - North Korea</option>
                                <option value="MP">MP - Northern Mariana Islands</option>
                                <option value="NO">NO - Norway</option>
                                <option value="OM">OM - Oman</option>
                                <option value="PK">PK - Pakistan</option>
                                <option value="PW">PW - Palau</option>
                                <option value="PS">PS - Palestinian territories</option>
                                <option value="PA">PA - Panama</option>
                                <option value="PG">PG - Papua New Guinea</option>
                                <option value="PY">PY - Paraguay</option>
                                <option value="PE">PE - Peru</option>
                                <option value="PH">PH - Philippines</option>
                                <option value="PN">PN - Pitcairn Islands</option>
                                <option value="PL">PL - Poland</option>
                                <option value="PT">PT - Portugal</option>
                                <option value="PR">PR - Puerto Rico</option>
                                <option value="QA">QA - Qatar</option>
                                <option value="RE">RE - Réunion</option>
                                <option value="RO">RO - Romania</option>
                                <option value="RU">RU - Russia</option>
                                <option value="RW">RW - Rwanda</option>
                                <option value="BL">BL - Saint Barthélemy</option>
                                <option value="SH">SH - Saint Helena, Ascension and Tristan da Cunha</option>
                                <option value="KN">KN - Saint Kitts and Nevis</option>
                                <option value="LC">LC - Saint Lucia</option>
                                <option value="MF">MF - Saint Martin</option>
                                <option value="PM">PM - Saint Pierre and Miquelon</option>
                                <option value="VC">VC - Saint Vincent and the Grenadines</option>
                                <option value="WS">WS - Samoa</option>
                                <option value="SM">SM - San Marino</option>
                                <option value="ST">ST - São Tomé and Príncipe</option>
                                <option value="SA">SA - Saudi Arabia</option>
                                <option value="SN">SN - Senegal</option>
                                <option value="RS">RS - Serbia</option>
                                <option value="SC">SC - Seychelles</option>
                                <option value="SL">SL - Sierra Leone</option>
                                <option value="SG">SG - Singapore</option>
                                <option value="BQ">BQ - Sint Eustatius</option>
                                <option value="SX">SX - Sint Maarten</option>
                                <option value="SK">SK - Slovakia</option>
                                <option value="SI">SI - Slovenia</option>
                                <option value="SB">SB - Solomon Islands</option>
                                <option value="SO">SO - Somalia</option>
                                <option value="ZA">ZA - South Africa</option>
                                <option value="GS">GS - South Georgia and the South Sandwich Islands</option>
                                <option value="KR">KR - South Korea</option>
                                <option value="SS">SS - South Sudan</option>
                                <option value="ES">ES - Spain</option>
                                <option value="LK">LK - Sri Lanka</option>
                                <option value="SD">SD - Sudan</option>
                                <option value="SR">SR - Suriname</option>
                                <option value="SJ">SJ - Svalbard and Jan Mayen</option>
                                <option value="SZ">SZ - Swaziland</option>
                                <option value="SE">SE - Sweden</option>
                                <option value="CH">CH - Switzerland</option>
                                <option value="SY">SY - Syria</option>
                                <option value="TW">TW - Taiwan</option>
                                <option value="TJ">TJ - Tajikistan</option>
                                <option value="TZ">TZ - Tanzania</option>
                                <option value="TH">TH - Thailand</option>
                                <option value="TG">TG - Togo</option>
                                <option value="TK">TK - Tokelau</option>
                                <option value="TO">TO - Tonga</option>
                                <option value="TT">TT - Trinidad and Tobago</option>
                                <option value="TN">TN - Tunisia</option>
                                <option value="TR">TR - Turkey</option>
                                <option value="TM">TM - Turkmenistan</option>
                                <option value="TC">TC - Turks and Caicos Islands</option>
                                <option value="TV">TV - Tuvalu</option>
                                <option value="UG">UG - Uganda</option>
                                <option value="UA">UA - Ukraine</option>
                                <option value="AE">AE - United Arab Emirates</option>
                                <option value="GB">GB - United Kingdom</option>
                                <option value="UM">UM - United States Minor Outlying Islands</option>
                                <option value="VI">VI - United States Virgin Islands</option>
                                <option value="UY">UY - Uruguay</option>
                                <option value="UZ">UZ - Uzbekistan</option>
                                <option value="VU">VU - Vanuatu</option>
                                <option value="VA">VA - Vatican City</option>
                                <option value="VE">VE - Venezuela</option>
                                <option value="VN">VN - Vietnam</option>
                                <option value="WF">WF - Wallis and Futuna</option>
                                <option value="EH">EH - Western Sahara</option>
                                <option value="YE">YE - Yemen</option>
                                <option value="ZM">ZM - Zambia</option>
                                <option value="ZW">ZW - Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="eleven wide required field ">
                            <label>Credit Card Number</label>
                            <input type="text" data-rebilly="pan">
                        </div>
                        <div class="five wide required field">
                            <label class="cvv" data-html='
                                <div class="credit-card" style="display: block;">
                                    <div class="cc-cvv2">123</div>
                                    <div class="cc-mb"></div>
                                    <div class="cc-signature"></div>
                                    <div class="cc-pan-holder">
                                    <span class="cc-pan">0000 1111 2222 3333 444</span>
                                </div>
                            </div>'>CVV</label>
                            <input type="text" data-rebilly="cvv">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="eight wide required field">
                            <label>Expiry Month</label>
                            <select data-rebilly="expMonth">
                                <?php foreach ($rangeMonth as $month): ?>
                                <option value="<?= $month ?>"><?= $month ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="eight wide required field">
                            <label>Expiry Year</label>
                            <select data-rebilly="expYear">
                                <?php foreach ($rangeYear as $year): ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="ui hidden divider"></div>
                    <div class="ui divider"></div>
                    <a href="<?= url('/manage-payment-methods') ?>" class="ui negative cancel button">Cancel</a>
                    <button class="ui positive approve button" type="submit">Submit</button>
                </form>
            </div>
            <div class="ui tiny grey center aligned header footer">
                Copyright&copy; All rights reserved.
            </div>
        </div>
    </div>
@endsection
@section('extraScript')
    <script type="text/javascript" src="<?= getenv('REBILLY_JS_URL') ?>"></script>
    <script src="<?= url('assets/js/rebilly.js') ?>"></script>
@endsection
