<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ($receiveType ) == 1 ? 'Picking Points :: Lockers' : 'Picking Points :: Booth';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picking-point-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6"><?= $this->title ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Picking Point', ['create?receive=' . $receiveType], ['class' => 'btn btn-success btn-xs']) ?>
                </div>
            </div>
        </div>
    </div>
   <!--<p>
    <?//= Html::a('Create Picking Point', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'pickingId',
                'code',
                'title',
                //'description:html',
                //'countryId',
                [ // รวมคอลัมน์
                    'label' => 'Country',
                    'format' => 'html',
                    'value' => function($model, $key, $index, $column) {
                        return isset($model->countrie) ? 'ประเทศ' . $model->countrie->localName : NULL;
                    }
                ],
                //'provinceId',
                [ // รวมคอลัมน์
                    'label' => 'Province',
                    'format' => 'html',
                    'value' => function($model, $key, $index, $column) {
                        //return $model->state->localName;
                        return isset($model->state) ? $model->state->localName : NULL;
                    }
                ],
                //'amphurId',
                [ // รวมคอลัมน์
                    'label' => 'Amphur',
                    'format' => 'html',
                    'value' => function($model, $key, $index, $column) {
                        return isset($model->citie) ? $model->citie->localName : NULL;
                    }
                ],
                'ip',
                'macAddress',
                'authCode',
                [
                    'attribute' => 'mapImages',
                    'format' => 'html',
                    'value' => function($model) {
                        if (isset($model->mapImages)) {
                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . Yii::getAlias('@web') . $model->mapImages)) {
                                $imgBrand = Html::img(Yii::getAlias('@web') . $model->mapImages, ['style' => 'width:164px;height:120px', 'class' => 'img-responsive']);
                            } else {
                                $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:164px;height:120px', 'class' => 'img-responsive']);
                            }
                        } else {
                            $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:164px;height:120px', 'class' => 'img-responsive']);
                        }
                        return $imgBrand;
                    }
                ],
                // 'status',
                // 'type',
                // 'createDateTime',
                // 'updateDateTime',
                /* ['class' => 'yii\grid\ActionColumn'], */
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view} {update} {delete} {items}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fa fa-eye"></i>', $url . '&receive=' . $model->type, [
                                'title' => Yii::t('yii', 'view '),
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<i class = "fa fa-pencil"></i>', $url . '&receive=' . $model->type, [
                                'title' => Yii::t('yii', 'update'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class = "fa fa-trash-o"></i>', $url . '&receive=' . $model->type, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                'data-method' => 'post',
                            ]);
                        },
                        'items' => function($url, $model) {
                            return Html::a('<i class = "fa fa-sign-in"></i> ', Yii::$app->homeUrl . "picking/picking-point-items/index?receive=" . $model->type . "&pickingId=" . $model->pickingId, [
                                'title' => Yii::t('app', 'picking point items'),]);
                        },
                    ],
                ],
            ],
        ]);
        ?>
    </div>
    <script>
        init.push(function () {
            $('#bs-x-editable-username').editable({
                type: 'text',
                name: 'username',
                title: 'Enter username'
            });

            $('#bs-x-editable-firstname').editable({
                validate: function (value) {
                    if ($.trim(value) == '')
                        return 'This field is required';
                }
            });

            $('#bs-x-editable-sex').editable({
                prepend: "not selected",
                source: [
                    {value: 1, text: 'Male'},
                    {value: 2, text: 'Female'}
                ],
                display: function (value, sourceData) {
                    var colors = {"": "gray", 1: "green", 2: "blue"},
                    elem = $.grep(sourceData, function (o) {
                        return o.value == value;
                    });

                    if (elem.length) {
                        $(this).text(elem[0].text).css("color", colors[value]);
                    } else {
                        $(this).empty();
                    }
                }
            });

            $('#bs-x-editable-vacation').editable({
                datepicker: {
                    todayBtn: 'linked'
                }
            });

            $('#bs-x-editable-dob').editable();

            $('#bs-x-editable-event').editable({
                combodate: {
                    firstItem: 'name'
                }
            });

            $('#bs-x-editable-comments').editable({
                showbuttons: 'bottom'
            });

            $('#bs-x-editable-state2').editable({
                value: 'California',
                typeahead: {
                    name: 'state',
                    local: ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"]
                }
            });

            $('#bs-x-editable-fruits').editable({
                limit: 3,
                source: [
                    {value: 1, text: 'banana'},
                    {value: 2, text: 'peach'},
                    {value: 3, text: 'apple'},
                    {value: 4, text: 'watermelon'},
                    {value: 5, text: 'orange'}
                ]
            });

            $('#bs-x-editable-tags').editable({
                select2: {
                    tags: ['html', 'javascript', 'css', 'ajax'],
                    tokenSeparators: [",", " "]
                }
            });

            var countries = [];
            $.each({"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Bartelemey", "BM": "Bermuda", "BN": "Brunei Darussalam", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "O1": "Other Country", "LV": "Latvia", "RW": "Rwanda", "RS": "Serbia", "TL": "Timor-Leste", "RE": "Reunion", "LU": "Luxembourg", "TJ": "Tajikistan", "RO": "Romania", "PG": "Papua New Guinea", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "BZ": "Belize", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "TM": "Turkmenistan", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "RU": "Russian Federation", "EE": "Estonia", "EG": "Egypt", "TK": "Tokelau", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "EU": "Europe", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova, Republic of", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania, United Republic of", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "FX": "France, Metropolitan", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands (Malvinas)", "FM": "Micronesia, Federated States of", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "CI": "Cote d'Ivoire", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos (Keeling) Islands", "CA": "Canada", "CG": "Congo", "CF": "Central African Republic", "CD": "Congo, The Democratic Republic of the", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syrian Arab Republic", "KG": "Kyrgyzstan", "KE": "Kenya", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "Korea, Republic of", "SI": "Slovenia", "KP": "Korea, Democratic People's Republic of", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "Virgin Islands, British", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Lao People's Democratic Republic", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "A1": "Anonymous Proxy", "TO": "Tonga", "LT": "Lithuania", "A2": "Satellite Provider", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libyan Arab Jamahiriya", "VA": "Holy See (Vatican City State)", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "Virgin Islands, U.S.", "IS": "Iceland", "IR": "Iran, Islamic Republic of", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AN": "Netherlands Antilles", "AQ": "Antarctica", "AP": "Asia/Pacific Region", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}, function (k, v) {
                countries.push({id: k, text: v});
            });

            $('#bs-x-editable-country').editable({
                source: countries,
                select2: {
                    width: 200,
                    placeholder: 'Select country',
                    allowClear: true
                }
            });

            $('#bs-x-editable-address').editable({
                value: {
                    city: "Moscow",
                    street: "Lenina",
                    building: "12"
                },
                validate: function (value) {
                    if (value.city == '')
                        return 'city is required!';
                },
                display: function (value) {
                    if (!value) {
                        $(this).empty();
                        return;
                    }
                    var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street).html() + ' st., bld. ' + $('<div>').text(value.building).html();
                    $(this).html(html);
                }
            });
        });
    </script>
</div>
