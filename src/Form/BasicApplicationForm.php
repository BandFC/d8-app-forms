<?php
/**
 * @file
 * Contains \Drupal\basic_application\Form\BasicApplicationForm
 */
namespace Drupal\basic_application\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class BasicApplicationForm extends FormBase {

  /**
  * Implements hook_mail().
  */
  public function basic_application_mail($key, &$message, $params) {

  $form_info = $params['form_state'];

  $language = \Drupal::languageManager()->getLanguage($message['langcode']);
  $options = array('langcode' => $language->getId());

  switch ($key) {
    case 'form_submitted':
      $message['from'] = \Drupal::config('system.site')->get('mail');
      $message['subject'] = $params['subject'];
      $message['body'][] = $params['body'];
      break;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'basic_application_form';
  }
  
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    //personal details needed for all applications, contained within fieldset set to be first elemenet
    $form['personal'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Personal Details'),
      '#weight' => -10
    ];

    $form['personal']['salutation'] = [
      '#type' => 'select',
      '#title' => $this->t('Title'),
      '#options' => [
        '1' =>  $this->t('Mr'),
        '2' =>  $this->t('Mrs'),
        '3' =>  $this->t('Miss'),
        '4' =>  $this->t('Ms'),
        '5' =>  $this->t('Dr')
      ]
    ];

    $form['personal']['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['personal']['middle_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Middle Name(s)'),
      '#maxlength' => 128,
      '#required' => FALSE
    ];

    $form['personal']['surname_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Surname'),
      '#maxlength' => 128,
      '#required' => TRUE
    ];    

    $form['personal']['gender'] = [
      '#type' => 'select',
      '#title' => $this->t('Gender'),
      '#default_value' => 1,
      '#required' => TRUE,
      '#options' => [
        '1' => $this->t('Male'),
        '2' => $this->t('Female')
      ]
    ];

    $form['personal']['dob'] = [
      '#type' => 'date',
      '#title' => $this->t('Date of Birth'),      
      '#default_value' => '2000-01-01',
      '#required' => TRUE
    ];

    $form['personal']['ni_number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('National Insurance Number (if known)'),
      '#maxlength' => 13,
      '#required' => FALSE
    ];

    $form['personal']['nationality'] = [
      '#type' => 'select',
      '#title' => $this->t('Nationality'),
      '#required' => TRUE,
      '#default_value' => 'GB',
      '#options' => [
        'GB' => $this->t('UNITED KINGDOM'),
        'AF' => $this->t('AFGHANISTAN'),
        'AL' => $this->t('ALBANIA'),
        'DZ' => $this->t('ALGERIA'),
        'AS' => $this->t('AMERICAN SAMOA'),
        'AD' => $this->t('ANDORRA'),
        'AO' => $this->t('ANGOLA'),
        'AI' => $this->t('ANGUILLA'),
        'AQ' => $this->t('ANTARCTICA'),
        'AG' => $this->t('ANTIGUA AND BARBUDA'),
        'AR' => $this->t('ARGENTINA'),
        'AM' => $this->t('ARMENIA'),
        'AW' => $this->t('ARUBA'),
        'AU' => $this->t('AUSTRALIA'),
        'AT' => $this->t('AUSTRIA'),
        'AZ' => $this->t('AZERBAIJAN'),
        'BS' => $this->t('BAHAMAS'),
        'BH' => $this->t('BAHRAIN'),
        'BD' => $this->t('BANGLADESH'),
        'BB' => $this->t('BARBADOS'),
        'BY' => $this->t('BELARUS'),
        'BE' => $this->t('BELGIUM'),
        'BZ' => $this->t('BELIZE'),
        'BJ' => $this->t('BENIN'),
        'BM' => $this->t('BERMUDA'),
        'BT' => $this->t('BHUTAN'),
        'BO' => $this->t('BOLIVIA'),
        'BQ' => $this->t('BONAIRE SINT EUSTATIUS & SABA'),
        'BA' => $this->t('BOSNIA AND HERZEGOVINA'),
        'BW' => $this->t('BOTSWANA'),
        'BV' => $this->t('BOUVET ISLAND'),
        'BR' => $this->t('BRAZIL'),
        'IO' => $this->t('BRITISH INDIAN OCEAN TERRITORY'),
        'VG' => $this->t('BRITISH VIRGIN ISLANDS'),
        'BN' => $this->t('BRUNEI'),
        'BG' => $this->t('BULGARIA'),
        'BF' => $this->t('BURKINA'),
        'MM' => $this->t('BURMA'),
        'BI' => $this->t('BURUNDI'),
        'KH' => $this->t('CAMBODIA'),
        'CM' => $this->t('CAMEROON'),
        'CA' => $this->t('CANADA'),
        'IC' => $this->t('CANARY ISLANDS'),
        'CV' => $this->t('CAPE VERDE'),
        'KY' => $this->t('CAYMAN ISLANDS'),
        'CF' => $this->t('CENTRAL AFRICAN REPUBLIC'),
        'TD' => $this->t('CHAD'),
        'XK' => $this->t('CHANNEL ISLANDS'),
        'CL' => $this->t('CHILE'),
        'CN' => $this->t('CHINA'),
        'TW' => $this->t('CHINA (TAIWAN)'),
        'CX' => $this->t('CHRISTMAS ISLAND'),
        'CC' => $this->t('COCOS (KEELING) ISLANDS'),
        'CO' => $this->t('COLOMBIA'),
        'KM' => $this->t('COMOROS'),
        'CG' => $this->t('CONGO'),
        'CD' => $this->t('CONGO (DEMOCRATIC REPUBLIC)'),
        'CK' => $this->t('COOK ISLANDS'),
        'CR' => $this->t('COSTA RICA'),
        'HR' => $this->t('CROATIA'),
        'CU' => $this->t('CUBA'),
        'CW' => $this->t('CURAÇAO'),
        'XA' => $this->t('CYPRUS (EUROPEAN UNION)'),
        'CZ' => $this->t('CZECH REPUBLIC'),
        'DK' => $this->t('DENMARK'),
        'DJ' => $this->t('DJIBOUTI'),
        'DM' => $this->t('DOMINICA'),
        'DO' => $this->t('DOMINICAN REPUBLIC'),
        'TL' => $this->t('EAST TIMOR'),
        'EC' => $this->t('ECUADOR'),
        'EG' => $this->t('EGYPT'),
        'SV' => $this->t('EL SALVADOR'),
        'GQ' => $this->t('EQUATORIAL GUINEA'),
        'ER' => $this->t('ERITREA'),
        'EE' => $this->t('ESTONIA'),
        'ET' => $this->t('ETHIOPIA'),
        'FK' => $this->t('FALKLAND ISLANDS'),
        'FO' => $this->t('FAROE ISLANDS'),
        'FJ' => $this->t('FIJI'),
        'FI' => $this->t('FINLAND'),
        'FR' => $this->t('FRANCE'),
        'GF' => $this->t('FRENCH GUIANA'),
        'PF' => $this->t('FRENCH POLYNESIA'),
        'TF' => $this->t('FRENCH SOUTHERN TERRITORIES'),
        'GA' => $this->t('GABON'),
        'GM' => $this->t('GAMBIA'),
        'GE' => $this->t('GEORGIA'),
        'DE' => $this->t('GERMANY'),
        'GH' => $this->t('GHANA'),
        'GI' => $this->t('GIBRALTAR'),
        'GR' => $this->t('GREECE'),
        'GL' => $this->t('GREENLAND'),
        'GD' => $this->t('GRENADA'),
        'GP' => $this->t('GUADELOUPE'),
        'GU' => $this->t('GUAM'),
        'GT' => $this->t('GUATEMALA'),
        'GG' => $this->t('GUERNSEY'),
        'GN' => $this->t('GUINEA'),
        'GW' => $this->t('GUINEA-BISSAU'),
        'GY' => $this->t('GUYANA'),
        'HT' => $this->t('HAITI'),
        'HM' => $this->t('HEARD & MCDONALD ISLANDS'),
        'HN' => $this->t('HONDURAS'),
        'HK' => $this->t('HONG KONG (SPECIAL ADMINISTRATIVE REGION)'),
        'HU' => $this->t('HUNGARY'),
        'IS' => $this->t('ICELAND'),
        'IN' => $this->t('INDIA'),
        'ID' => $this->t('INDONESIA'),
        'IR' => $this->t('IRAN'),
        'IQ' => $this->t('IRAQ'),
        'IE' => $this->t('IRELAND'),
        'IM' => $this->t('ISLE OF MAN'),
        'IL' => $this->t('ISRAEL'),
        'IT' => $this->t('ITALY'),
        'CI' => $this->t('IVORY COAST'),
        'JM' => $this->t('JAMAICA'),
        'JP' => $this->t('JAPAN'),
        'JE' => $this->t('JERSEY'),
        'JO' => $this->t('JORDAN'),
        'KZ' => $this->t('KAZAKHSTAN'),
        'KE' => $this->t('KENYA'),
        'KI' => $this->t('KIRIBATI'),
        'KP' => $this->t('KOREA (NORTH)'),
        'KR' => $this->t('KOREA (SOUTH)'),
        'QO' => $this->t('KOSOVO'),
        'KW' => $this->t('KUWAIT'),
        'KG' => $this->t('KYRGYZSTAN'),
        'LA' => $this->t('LAOS'),
        'LV' => $this->t('LATVIA'),
        'LB' => $this->t('LEBANON'),
        'LS' => $this->t('LESOTHO'),
        'LR' => $this->t('LIBERIA'),
        'LY' => $this->t('LIBYA'),
        'LI' => $this->t('LIECHTENSTEIN'),
        'LT' => $this->t('LITHUANIA'),
        'LU' => $this->t('LUXEMBOURG'),
        'MO' => $this->t('MACAO (SPECIAL ADMINISTRATIVE REGION OF)'),
        'MK' => $this->t('MACEDONIA'),
        'MG' => $this->t('MADAGASCAR'),
        'MW' => $this->t('MALAWI'),
        'MY' => $this->t('MALAYSIA'),
        'MV' => $this->t('MALDIVES'),
        'ML' => $this->t('MALI'),
        'MT' => $this->t('MALTA'),
        'MH' => $this->t('MARSHALL ISLANDS'),
        'MQ' => $this->t('MARTINIQUE'),
        'MR' => $this->t('MAURITANIA'),
        'MU' => $this->t('MAURITIUS'),
        'YT' => $this->t('MAYOTTE'),
        'MX' => $this->t('MEXICO'),
        'FM' => $this->t('MICRONESIA'),
        'MD' => $this->t('MOLDOVA'),
        'MC' => $this->t('MONACO'),
        'MN' => $this->t('MONGOLIA'),
        'ME' => $this->t('MONTENEGRO'),
        'MS' => $this->t('MONTSERRAT'),
        'MA' => $this->t('MOROCCO'),
        'MZ' => $this->t('MOZAMBIQUE'),
        'NA' => $this->t('NAMIBIA'),
        'NR' => $this->t('NAURU'),
        'NP' => $this->t('NEPAL'),
        'NL' => $this->t('NETHERLANDS'),
        'NC' => $this->t('NEW CALEDONIA'),
        'NZ' => $this->t('NEW ZEALAND'),
        'NI' => $this->t('NICARAGUA'),
        'NE' => $this->t('NIGER'),
        'NG' => $this->t('NIGERIA'),
        'NU' => $this->t('NIUE'),
        'NF' => $this->t('NORFOLK ISLAND'),
        'MP' => $this->t('NORTHERN MARIANA ISLANDS'),
        'NO' => $this->t('NORWAY'),
        'ZZ' => $this->t('NOT KNOWN'),
        'OM' => $this->t('OMAN'),
        'PK' => $this->t('PAKISTAN'),
        'PW' => $this->t('PALAU'),
        'PA' => $this->t('PANAMA'),
        'PG' => $this->t('PAPUA NEW GUINEA'),
        'PY' => $this->t('PARAGUAY'),
        'PE' => $this->t('PERU'),
        'PH' => $this->t('PHILIPPINES'),
        'PN' => $this->t('PITCAIRN HENDERSON DUCIE & OENO ISLAND'),
        'PL' => $this->t('POLAND'),
        'PT' => $this->t('PORTUGAL'),
        'PR' => $this->t('PUERTO RICO'),
        'QA' => $this->t('QATAR'),
        'RE' => $this->t('RENION'),
        'RO' => $this->t('ROMANIA'),
        'RU' => $this->t('RUSSIA'),
        'RW' => $this->t('RWANDA'),
        'WS' => $this->t('SAMOA'),
        'SM' => $this->t('SAN MARINO'),
        'ST' => $this->t('SAO TOME AND PRINCIPE'),
        'SA' => $this->t('SAUDI ARABIA'),
        'SN' => $this->t('SENEGAL'),
        'RS' => $this->t('SERBIA'),
        'SC' => $this->t('SEYCHELLES'),
        'SL' => $this->t('SIERRA LEONE'),
        'SG' => $this->t('SINGAPORE'),
        'SX' => $this->t('SINT MAARTEN (DUTCH PART)'),
        'SK' => $this->t('SLOVAKIA'),
        'SI' => $this->t('SLOVENIA'),
        'SB' => $this->t('SOLOMON ISLANDS'),
        'SO' => $this->t('SOMALIA'),
        'ZA' => $this->t('SOUTH AFRICA'),
        'GS' => $this->t('SOUTH GEORGIA AND THE SOUTH SANDWICH ISL'),
        'SS' => $this->t('SOUTH SUDAN'),
        'ES' => $this->t('SPAIN'),
        'LK' => $this->t('SRI LANKA'),
        'BL' => $this->t('ST BARTHÉLEMY'),
        'SH' => $this->t('ST HELENA'),
        'KN' => $this->t('ST KITTS AND NEVIS'),
        'LC' => $this->t('ST LUCIA'),
        'MF' => $this->t('ST MARTIN'),
        'PM' => $this->t('ST PIERRE AND MIQUELON'),
        'VC' => $this->t('ST VINCENT AND THE GRENADINES'),
        'SD' => $this->t('SUDAN'),
        'SR' => $this->t('SURINAM'),
        'SJ' => $this->t('SVALBARD AND JAN MAYEN'),
        'SZ' => $this->t('SWAZILAND'),
        'SE' => $this->t('SWEDEN'),
        'CH' => $this->t('SWITZERLAND'),
        'SY' => $this->t('SYRIA'),
        'TJ' => $this->t('TAJIKISTAN'),
        'TZ' => $this->t('TANZANIA'),
        'TH' => $this->t('THAILAND'),
        'TG' => $this->t('TOGO'),
        'TK' => $this->t('TOKELAU'),
        'TO' => $this->t('TONGA'),
        'TT' => $this->t('TRINIDAD AND TOBAGO'),
        'TN' => $this->t('TUNISIA'),
        'TR' => $this->t('TURKEY'),
        'TM' => $this->t('TURKMENISTAN'),
        'TC' => $this->t('TURKS AND CAICOS ISLANDS'),
        'TV' => $this->t('TUVALU'),
        'UG' => $this->t('UGANDA'),
        'UA' => $this->t('UKRAINE'),
        'AE' => $this->t('UNITED ARAB EMIRATES'),
        'US' => $this->t('UNITED STATES'),
        'UY' => $this->t('URUGUAY'),
        'UM' => $this->t('US MINOR OUTLYING ISLANDS'),
        'VI' => $this->t('US VIRGIN ISLANDS'),
        'UZ' => $this->t('UZBEKISTAN'),
        'VU' => $this->t('VANUATU'),
        'VA' => $this->t('VATICAN CITY'),
        'VE' => $this->t('VENEZUELA'),
        'VN' => $this->t('VIETNAM'),
        'WF' => $this->t('WALLIS AND FUTUNA'),
        'PS' => $this->t('WEST BANK (INCLUDING EAST JERUSALEM)'),
        'EH' => $this->t('WESTERN SAHARA'),
        'YE' => $this->t('YEMEN'),
        'ZM' => $this->t('ZAMBIA'),
        'ZW' => $this->t('ZIMBABWE'),
        'AX' => $this->t('ALAND ISLANDS')
      ]
    ];

    $form['personal']['country_of_birth'] = [
      '#type' => 'select',
      '#title' => $this->t('Country of Birth'),
      '#required' => TRUE,
      '#default_value' => 'GB',
      '#options' => [
        'GB' => $this->t('UNITED KINGDOM'),
        'AF' => $this->t('AFGHANISTAN'),
        'AL' => $this->t('ALBANIA'),
        'DZ' => $this->t('ALGERIA'),
        'AS' => $this->t('AMERICAN SAMOA'),
        'AD' => $this->t('ANDORRA'),
        'AO' => $this->t('ANGOLA'),
        'AI' => $this->t('ANGUILLA'),
        'AQ' => $this->t('ANTARCTICA'),
        'AG' => $this->t('ANTIGUA AND BARBUDA'),
        'AR' => $this->t('ARGENTINA'),
        'AM' => $this->t('ARMENIA'),
        'AW' => $this->t('ARUBA'),
        'AU' => $this->t('AUSTRALIA'),
        'AT' => $this->t('AUSTRIA'),
        'AZ' => $this->t('AZERBAIJAN'),
        'BS' => $this->t('BAHAMAS'),
        'BH' => $this->t('BAHRAIN'),
        'BD' => $this->t('BANGLADESH'),
        'BB' => $this->t('BARBADOS'),
        'BY' => $this->t('BELARUS'),
        'BE' => $this->t('BELGIUM'),
        'BZ' => $this->t('BELIZE'),
        'BJ' => $this->t('BENIN'),
        'BM' => $this->t('BERMUDA'),
        'BT' => $this->t('BHUTAN'),
        'BO' => $this->t('BOLIVIA'),
        'BQ' => $this->t('BONAIRE SINT EUSTATIUS & SABA'),
        'BA' => $this->t('BOSNIA AND HERZEGOVINA'),
        'BW' => $this->t('BOTSWANA'),
        'BV' => $this->t('BOUVET ISLAND'),
        'BR' => $this->t('BRAZIL'),
        'IO' => $this->t('BRITISH INDIAN OCEAN TERRITORY'),
        'VG' => $this->t('BRITISH VIRGIN ISLANDS'),
        'BN' => $this->t('BRUNEI'),
        'BG' => $this->t('BULGARIA'),
        'BF' => $this->t('BURKINA'),
        'MM' => $this->t('BURMA'),
        'BI' => $this->t('BURUNDI'),
        'KH' => $this->t('CAMBODIA'),
        'CM' => $this->t('CAMEROON'),
        'CA' => $this->t('CANADA'),
        'IC' => $this->t('CANARY ISLANDS'),
        'CV' => $this->t('CAPE VERDE'),
        'KY' => $this->t('CAYMAN ISLANDS'),
        'CF' => $this->t('CENTRAL AFRICAN REPUBLIC'),
        'TD' => $this->t('CHAD'),
        'XK' => $this->t('CHANNEL ISLANDS'),
        'CL' => $this->t('CHILE'),
        'CN' => $this->t('CHINA'),
        'TW' => $this->t('CHINA (TAIWAN)'),
        'CX' => $this->t('CHRISTMAS ISLAND'),
        'CC' => $this->t('COCOS (KEELING) ISLANDS'),
        'CO' => $this->t('COLOMBIA'),
        'KM' => $this->t('COMOROS'),
        'CG' => $this->t('CONGO'),
        'CD' => $this->t('CONGO (DEMOCRATIC REPUBLIC)'),
        'CK' => $this->t('COOK ISLANDS'),
        'CR' => $this->t('COSTA RICA'),
        'HR' => $this->t('CROATIA'),
        'CU' => $this->t('CUBA'),
        'CW' => $this->t('CURAÇAO'),
        'XA' => $this->t('CYPRUS (EUROPEAN UNION)'),
        'CZ' => $this->t('CZECH REPUBLIC'),
        'DK' => $this->t('DENMARK'),
        'DJ' => $this->t('DJIBOUTI'),
        'DM' => $this->t('DOMINICA'),
        'DO' => $this->t('DOMINICAN REPUBLIC'),
        'TL' => $this->t('EAST TIMOR'),
        'EC' => $this->t('ECUADOR'),
        'EG' => $this->t('EGYPT'),
        'SV' => $this->t('EL SALVADOR'),
        'GQ' => $this->t('EQUATORIAL GUINEA'),
        'ER' => $this->t('ERITREA'),
        'EE' => $this->t('ESTONIA'),
        'ET' => $this->t('ETHIOPIA'),
        'FK' => $this->t('FALKLAND ISLANDS'),
        'FO' => $this->t('FAROE ISLANDS'),
        'FJ' => $this->t('FIJI'),
        'FI' => $this->t('FINLAND'),
        'FR' => $this->t('FRANCE'),
        'GF' => $this->t('FRENCH GUIANA'),
        'PF' => $this->t('FRENCH POLYNESIA'),
        'TF' => $this->t('FRENCH SOUTHERN TERRITORIES'),
        'GA' => $this->t('GABON'),
        'GM' => $this->t('GAMBIA'),
        'GE' => $this->t('GEORGIA'),
        'DE' => $this->t('GERMANY'),
        'GH' => $this->t('GHANA'),
        'GI' => $this->t('GIBRALTAR'),
        'GR' => $this->t('GREECE'),
        'GL' => $this->t('GREENLAND'),
        'GD' => $this->t('GRENADA'),
        'GP' => $this->t('GUADELOUPE'),
        'GU' => $this->t('GUAM'),
        'GT' => $this->t('GUATEMALA'),
        'GG' => $this->t('GUERNSEY'),
        'GN' => $this->t('GUINEA'),
        'GW' => $this->t('GUINEA-BISSAU'),
        'GY' => $this->t('GUYANA'),
        'HT' => $this->t('HAITI'),
        'HM' => $this->t('HEARD & MCDONALD ISLANDS'),
        'HN' => $this->t('HONDURAS'),
        'HK' => $this->t('HONG KONG (SPECIAL ADMINISTRATIVE REGION)'),
        'HU' => $this->t('HUNGARY'),
        'IS' => $this->t('ICELAND'),
        'IN' => $this->t('INDIA'),
        'ID' => $this->t('INDONESIA'),
        'IR' => $this->t('IRAN'),
        'IQ' => $this->t('IRAQ'),
        'IE' => $this->t('IRELAND'),
        'IM' => $this->t('ISLE OF MAN'),
        'IL' => $this->t('ISRAEL'),
        'IT' => $this->t('ITALY'),
        'CI' => $this->t('IVORY COAST'),
        'JM' => $this->t('JAMAICA'),
        'JP' => $this->t('JAPAN'),
        'JE' => $this->t('JERSEY'),
        'JO' => $this->t('JORDAN'),
        'KZ' => $this->t('KAZAKHSTAN'),
        'KE' => $this->t('KENYA'),
        'KI' => $this->t('KIRIBATI'),
        'KP' => $this->t('KOREA (NORTH)'),
        'KR' => $this->t('KOREA (SOUTH)'),
        'QO' => $this->t('KOSOVO'),
        'KW' => $this->t('KUWAIT'),
        'KG' => $this->t('KYRGYZSTAN'),
        'LA' => $this->t('LAOS'),
        'LV' => $this->t('LATVIA'),
        'LB' => $this->t('LEBANON'),
        'LS' => $this->t('LESOTHO'),
        'LR' => $this->t('LIBERIA'),
        'LY' => $this->t('LIBYA'),
        'LI' => $this->t('LIECHTENSTEIN'),
        'LT' => $this->t('LITHUANIA'),
        'LU' => $this->t('LUXEMBOURG'),
        'MO' => $this->t('MACAO (SPECIAL ADMINISTRATIVE REGION OF)'),
        'MK' => $this->t('MACEDONIA'),
        'MG' => $this->t('MADAGASCAR'),
        'MW' => $this->t('MALAWI'),
        'MY' => $this->t('MALAYSIA'),
        'MV' => $this->t('MALDIVES'),
        'ML' => $this->t('MALI'),
        'MT' => $this->t('MALTA'),
        'MH' => $this->t('MARSHALL ISLANDS'),
        'MQ' => $this->t('MARTINIQUE'),
        'MR' => $this->t('MAURITANIA'),
        'MU' => $this->t('MAURITIUS'),
        'YT' => $this->t('MAYOTTE'),
        'MX' => $this->t('MEXICO'),
        'FM' => $this->t('MICRONESIA'),
        'MD' => $this->t('MOLDOVA'),
        'MC' => $this->t('MONACO'),
        'MN' => $this->t('MONGOLIA'),
        'ME' => $this->t('MONTENEGRO'),
        'MS' => $this->t('MONTSERRAT'),
        'MA' => $this->t('MOROCCO'),
        'MZ' => $this->t('MOZAMBIQUE'),
        'NA' => $this->t('NAMIBIA'),
        'NR' => $this->t('NAURU'),
        'NP' => $this->t('NEPAL'),
        'NL' => $this->t('NETHERLANDS'),
        'NC' => $this->t('NEW CALEDONIA'),
        'NZ' => $this->t('NEW ZEALAND'),
        'NI' => $this->t('NICARAGUA'),
        'NE' => $this->t('NIGER'),
        'NG' => $this->t('NIGERIA'),
        'NU' => $this->t('NIUE'),
        'NF' => $this->t('NORFOLK ISLAND'),
        'MP' => $this->t('NORTHERN MARIANA ISLANDS'),
        'NO' => $this->t('NORWAY'),
        'ZZ' => $this->t('NOT KNOWN'),
        'OM' => $this->t('OMAN'),
        'PK' => $this->t('PAKISTAN'),
        'PW' => $this->t('PALAU'),
        'PA' => $this->t('PANAMA'),
        'PG' => $this->t('PAPUA NEW GUINEA'),
        'PY' => $this->t('PARAGUAY'),
        'PE' => $this->t('PERU'),
        'PH' => $this->t('PHILIPPINES'),
        'PN' => $this->t('PITCAIRN HENDERSON DUCIE & OENO ISLAND'),
        'PL' => $this->t('POLAND'),
        'PT' => $this->t('PORTUGAL'),
        'PR' => $this->t('PUERTO RICO'),
        'QA' => $this->t('QATAR'),
        'RE' => $this->t('RENION'),
        'RO' => $this->t('ROMANIA'),
        'RU' => $this->t('RUSSIA'),
        'RW' => $this->t('RWANDA'),
        'WS' => $this->t('SAMOA'),
        'SM' => $this->t('SAN MARINO'),
        'ST' => $this->t('SAO TOME AND PRINCIPE'),
        'SA' => $this->t('SAUDI ARABIA'),
        'SN' => $this->t('SENEGAL'),
        'RS' => $this->t('SERBIA'),
        'SC' => $this->t('SEYCHELLES'),
        'SL' => $this->t('SIERRA LEONE'),
        'SG' => $this->t('SINGAPORE'),
        'SX' => $this->t('SINT MAARTEN (DUTCH PART)'),
        'SK' => $this->t('SLOVAKIA'),
        'SI' => $this->t('SLOVENIA'),
        'SB' => $this->t('SOLOMON ISLANDS'),
        'SO' => $this->t('SOMALIA'),
        'ZA' => $this->t('SOUTH AFRICA'),
        'GS' => $this->t('SOUTH GEORGIA AND THE SOUTH SANDWICH ISL'),
        'SS' => $this->t('SOUTH SUDAN'),
        'ES' => $this->t('SPAIN'),
        'LK' => $this->t('SRI LANKA'),
        'BL' => $this->t('ST BARTHÉLEMY'),
        'SH' => $this->t('ST HELENA'),
        'KN' => $this->t('ST KITTS AND NEVIS'),
        'LC' => $this->t('ST LUCIA'),
        'MF' => $this->t('ST MARTIN'),
        'PM' => $this->t('ST PIERRE AND MIQUELON'),
        'VC' => $this->t('ST VINCENT AND THE GRENADINES'),
        'SD' => $this->t('SUDAN'),
        'SR' => $this->t('SURINAM'),
        'SJ' => $this->t('SVALBARD AND JAN MAYEN'),
        'SZ' => $this->t('SWAZILAND'),
        'SE' => $this->t('SWEDEN'),
        'CH' => $this->t('SWITZERLAND'),
        'SY' => $this->t('SYRIA'),
        'TJ' => $this->t('TAJIKISTAN'),
        'TZ' => $this->t('TANZANIA'),
        'TH' => $this->t('THAILAND'),
        'TG' => $this->t('TOGO'),
        'TK' => $this->t('TOKELAU'),
        'TO' => $this->t('TONGA'),
        'TT' => $this->t('TRINIDAD AND TOBAGO'),
        'TN' => $this->t('TUNISIA'),
        'TR' => $this->t('TURKEY'),
        'TM' => $this->t('TURKMENISTAN'),
        'TC' => $this->t('TURKS AND CAICOS ISLANDS'),
        'TV' => $this->t('TUVALU'),
        'UG' => $this->t('UGANDA'),
        'UA' => $this->t('UKRAINE'),
        'AE' => $this->t('UNITED ARAB EMIRATES'),
        'US' => $this->t('UNITED STATES'),
        'UY' => $this->t('URUGUAY'),
        'UM' => $this->t('US MINOR OUTLYING ISLANDS'),
        'VI' => $this->t('US VIRGIN ISLANDS'),
        'UZ' => $this->t('UZBEKISTAN'),
        'VU' => $this->t('VANUATU'),
        'VA' => $this->t('VATICAN CITY'),
        'VE' => $this->t('VENEZUELA'),
        'VN' => $this->t('VIETNAM'),
        'WF' => $this->t('WALLIS AND FUTUNA'),
        'PS' => $this->t('WEST BANK (INCLUDING EAST JERUSALEM)'),
        'EH' => $this->t('WESTERN SAHARA'),
        'YE' => $this->t('YEMEN'),
        'ZM' => $this->t('ZAMBIA'),
        'ZW' => $this->t('ZIMBABWE'),
        'AX' => $this->t('ALAND ISLANDS')
      ]
    ];

    //contact details needed for all applications, contained within fieldset and set to be second grouping        
    $form['contact'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Contact Details'),
      '#weight' => -5
    ];

    $form['contact']['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#maxlength' => 255,
      '#required' => TRUE
    ];

    $form['contact']['confirm_email'] = [
      '#type' => 'email',
      '#title' => $this->t('Confirm Email'),
      '#maxlength' => 255,
      '#required' => TRUE
    ];

    $form['contact']['phone_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#maxlength' => 15,
      '#required' => TRUE
    ];

    $form['contact']['postcode'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Postcode'),
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['contact']['house'] = [
      '#type' => 'textfield',
      '#title' => $this->t('House Name/Number'),
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['contact']['street'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Street Address'),
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['contact']['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Town/City'),
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['contact']['county'] = [
      '#type' => 'textfield',
      '#title' => $this->t('County'),
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    //minimum required course information for tracking in admissions
    $form['course'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Course Details'),
      '#weight' => 0
    ];

    $form['course']['course_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Course Code'),
      '#default_value' => '',
      '#required' => TRUE,
      '#disabled' => TRUE
    ];

    $form['course']['course_id'] = [      
      '#type' => 'hidden',
      '#title' => $this->t('Course ID'),
      '#default_value' => '',
      '#required' => TRUE,
      '#disabled' => TRUE
    ];

    $form['course']['course_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Course Title'),      
      '#default_value' => '',
      '#maxlength' => 255,
      '#required' => TRUE,
      '#disabled' => TRUE
    ];

    //declaration checkboxes and radio buttons required for all application, set to appear before submit button
    $form['declarations'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Declarations'),
      '#weight' => 5
    ];

    $form['declarations']['resident'] = [
      '#type' => 'select',
      '#title' => $this->t('Have you been a permanent resident of the UK for the last three years'),
      '#default_value' => '1',
      '#required' => TRUE,
      '#options' => [
        '1' => $this->t('Yes'),
        '2' => $this->t('No')
      ]
    ];

    $form['declarations']['doe'] = [
      '#type' => 'date',
      '#title' => $this->t('If \'No\' please select the date you first entered the UK to live'),
    ];

    $form['declarations']['disability'] = [
      '#type' => 'select',
      '#title' => $this->t('Do you have a disability, medical condition or learning difficulty?'),
      '#default_value' => '2',
      '#required' => TRUE,
      '#options' => [
        '1' => $this->t('Yes'),
        '2' => $this->t('No')
      ]
    ];

    $form['declarations']['care'] = [
      '#type' => 'select',
      '#title' => $this->t('Have you ever been in foster care, care of the Local Authority or supported by the Leaving Care Team?'),
      '#default_value' => '2',
      '#required' => TRUE,
      '#options' => [
        '1' => $this->t('Yes'),
        '2' => $this->t('No')
      ]
    ];

    $form['declarations']['criminal'] = [
      '#type' => 'select',
      '#title' => $this->t('Have you ever been convicted of a criminal offence (not including motoring offences) or have any ongoing?'),
      '#default_value' => '2',
      '#required' => TRUE,
      '#options' => [
        '1' => $this->t('Yes'),
        '2' => $this->t('No')
      ]
    ];

    $form['declarations']['data_protection_header'] = [      
      '#type' => 'html_tag',
      '#tag' => 'h4',
      '#value' => $this->t('Data Protection'),
    ];

     $form['declarations']['data_protection_copy'] = [      
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $this->t('Blackpool and The Fylde College is registered under the Data Protection Act 1988. Information we process about you may be used for planning, analysis, marketing and any other purpose deemed necessary. Your information may also be shared with other official organisations, such as your school and Local Education Authorities. Please contact the College Data Protection Officer (Tel: 01253 504 064) if you have any concerns about the use or accuracy of your information'),
    ];

    $form['declarations']['confirm'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I confirm the information given is correct')
    ];

    //always place the submission button at the end of the form with the heaviest weight (10)
    $form['show'] = [
      '#type' => 'submit',
      '#value' => $this->t('Apply'),
      '#weight' => 10
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // retreive values from form state object
    $firstname = $form_state->getValue('first_name');
    $surname = $form_state->getValue('surname');
    $ni_number = $form_state->getValue('ni_number');
    $email = $form_state->getValue('email');
    $confirm_email = $form_state->getValue('confirm_email');
    $phone_number = $form_state->getValue('phone_number');
    $uio_id = $form_state->getValue('course_id');


    if (strlen(trim($firstname)) > 0 && !preg_match('/^[a-z A-Z\'\-]+$/', $firstname)) {
      $form_state->setErrorByName('first_name', $this->t('First name contains invalid characters. Only letters are allowed!'));
    }

    if (strlen(trim($surname)) > 0 && !preg_match('/^[a-z A-Z\'\-]+$/', $surname)) {
      $form_state->setErrorByName('surname', $this->t('Surname contains invalid characters. Only letters are allowed!'));
    }

    if (strlen(trim($ni_number)) > 0){
      if (!preg_match('/^[a-zA-Z]{2}[0-9]{6}[a-zA-Z]{1}$/', $ni_number)){
        $form_state->setErrorByName('ni_number', $this->t('National Insurance number must be in the format AB123456C'));
      }
    }  

    // check emails address are in valid format and match
    if(!valid_email_address($email)){
      $form_state->setErrorByName('email', $this->t('Sorry the email address you entered is not valid'));
    }

    if(!valid_email_address($confirm_email)){
      $form_state->setErrorByName('confirm_email', $this->t('Sorry the email address you entered is not valid'));
    }

    if(strcmp($email,$confirm_email) != 0){
      $form_state->setErrorByName('confirm_email', $this->t('Sorry the email addresses you entered do not match'));
    }

    if (strlen($phone_number) > 0) {
      $chars = array(' ','-','(',')','[',']','{','}');
      $phone_number = str_replace($chars,'',$phone_number);

      if (preg_match('/^(\+)[\s]*(.*)$/',$phone_number)){
        $form_state->setErrorByName('phone_number', $this->t('UK telephone number without the country code, please'));
      }

      if (!preg_match('/^[0-9]{10,11}$/',$phone_number)) {
        $form_state->setErrorByName('phone_number', $this->t('UK telephone numbers should contain 10 or 11 digits'));
      }

      if (!preg_match('/^0[0-9]{9,10}$/',$phone_number)) {
        $form_state->setErrorByName('phone_number', $this->t('The telephone number should start with a 0'));
      }
    }

    if(strlen(trim($uio_id)) == 0){
      $form_state->setErrorByName('course_code', $this->t('No course ID value is being submitted, you should only navigate to this form directly from the course which you wish to apply for'));
    }
  }
  
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    drupal_set_message($this->t('Thank you for you\'re application. You will receive an email confirming your application shortly'));
    
  }
}