<?php
function campoSelect($dados=array(),$campo='',$valor='',$selected=''){

  $option       = '<option value="">Selecione</option>'."\n";
  $att_selected = '';

  if(count($dados)>0 && $campo!='' && $valor!=''){
      for ($i = 0; $i < count($dados); $i++)
      {
          $dataRow =  $dados[$i];
          $opt_valor = $dataRow[$valor];
          $opt_campo = $dataRow[$campo];
          $att_selected = '';
          if($selected!='' && $selected==$opt_valor){$att_selected=' SELECTED';}
          $option = $option.'<option '.$att_selected.' value="'.$opt_valor.'">'.$opt_campo.'</option>'."\n";
      }
  }

  return $option;
}



/*
funcao para SETAR a notificação
*/
function notificacaoJs($type='log',$message='MSG NAO INFORMADA',$location=''){

  if($type!=''){
    $not = array('type'=>$type,'message'=>$message);
    $_SESSION['notify'] = $not;
  }
  if($location!=''){
    header('location: '.URLAPP.$location);
  }

}



/*
 * funcao para gerar a tag script de notificacao JS
 * */
function notifyJs(){
    $scriptTag = '';
    $_notify = sessionVar('notify');

    if( ($_notify['type']=='error' && postVar('do')!='') || ( $_notify['type']!='error' && postVar('do')=='' ) )
    {
      if($_notify['type']!=''){
      $scriptTag  = '<script type="text/javascript">'."\n";
      //$scriptTag .= 'setTimeout(function (){'."\n";
      $scriptTag .= "alertify.".$_notify['type']."(\"".addslashes($_notify['message'])."\");";
      //$scriptTag .= "\n}, 1000);";
      $scriptTag .= "\n</script>";
      }
      unset($_SESSION['notify']);
    }
    return $scriptTag;
    var_dump($scriptTag);
    exit;
}

/*
 * funcao para imprimir title do error do campo no formulario
 * */
function titleError($campoId=''){
  global $_erroForm;
  if(arrayVar($_erroForm,$campoId)){
      return "title=\"$_erroForm[$campoId]\"";
  }
}


/*
 * funcao para exibir o box com msgs de erros da submissao do formulario
 * */
function boxPostErrors($_erroForm=array())
{
  //global $_erroForm;
  $_errorBox='';
  if(count($_erroForm)>0){
    //$_errorBox  = '<div class="alert-danger alert dark alert-dismissible fade show" role="alert">';
    $_errorBox  = '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color:#BD2130!important;">';
    $_errorBox  .= '<h6>ERROS ENCONTRADOS!</h6><br />';
    $_errorBox  .= "<ul class=\"frm-erro-notify\">\n";
    $ne=1;
    foreach ($_erroForm as $key => $value) {
      $_errorBox .= "<li>$value</li>\n";
      $ne++;
    }

    $_errorBox .= "</ul>";
    $_errorBox .= '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
    $_errorBox .= '</div>';
  }
  return $_errorBox;
}



/*
 * funcao para mascaras em JS dos campos do formulario
 * */
function jsMask($tipo='',$max='')
{
  $mask = '';
  if($max!=''){$max = "maxlength=\"$max\"";}
  if($tipo=='inteiro')
  {
  $mask = 'onKeyDown="Mascara(this,Integer);" onKeyPress="Mascara(this,Integer);" onKeyUp="Mascara(this,Integer);"';
  }
  if($tipo=='cep')
  {
  $mask = 'onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);"';
  }
  if($tipo=='cnpj')
  {
  $mask = 'onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);"';
  }
  if($tipo=='cpf')
  {
  $mask = 'onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);"';
  }
  if($tipo=='data')
  {
  $mask = 'onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data);"';
  }
  if($tipo=='hora')
  {
  $mask = 'onKeyDown="Mascara(this,Hora);" onKeyPress="Mascara(this,Hora);" onKeyUp="Mascara(this,Hora);"';
  }
  if($tipo=='valor')
  {
  $mask = 'onKeyDown="Mascara(this,Valor);" onKeyPress="Mascara(this,Valor);" onKeyUp="Mascara(this,Valor);"';
  }
  if($tipo=='telefone')
  {
  $mask = 'onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);"';
  }
  if($tipo=='website')
  {
  $mask = 'onKeyDown="Mascara(this,Site);" onKeyPress="Mascara(this,Site);" onKeyUp="Mascara(this,Site);"';
  }
  if($tipo=='email')
  {
  $mask = 'onKeyDown="Mascara(this,Email);" onKeyPress="Mascara(this,Email);" onKeyUp="Mascara(this,Email);"';
  }

  $mask = "$mask $max";

  return $mask;
}


/*
 * funcao para destacar erros no formulario
 * */
function showErrorForms($errors=array())
{
  $_erros = '';
  foreach ($errors as $key => $value) {
    $_erros .= "$('#$key').css(\"border\",\"1px solid red\");\n";
  }
  $tag_realce = "<script type=\"text/javascript\">\n".$_erros."</script>\n";
  if($_erros!=''){
      return $tag_realce;
  }
}


/*
 * funcao para selecionar option em campo select
 * */
function selselr($a='',$b=''){
    $selected='';
    if($a!=''&&$b!=''){
      if($a==$b){$selected = ' selected';}
    }
    return $selected;
}


/*
 * funcao para retornar select de paises ou o pais selecionado
 * */
function listaPais($cod='',$select=false){

    $_pais['AFG'] = "Afghanistan";
    $_pais['ALB'] = "Albania";
    $_pais['DZA'] = "Algeria";
    $_pais['ASM'] = "American Samoa";
    $_pais['AND'] = "Andorra";
    $_pais['AGO'] = "Angola";
    $_pais['AIA'] = "Anguilla";
    $_pais['ATG'] = "Antigua and Barbuda";
    $_pais['ARG'] = "Argentina";
    $_pais['ARM'] = "Armenia";
    $_pais['ABW'] = "Aruba";
    $_pais['AUS'] = "Australia";
    $_pais['AUT'] = "Austria";
    $_pais['AZE'] = "Azerbaijan";
    $_pais['BHS'] = "Bahamas";
    $_pais['BHR'] = "Bahrain";
    $_pais['BGD'] = "Bangladesh";
    $_pais['BRB'] = "Barbados";
    $_pais['BLR'] = "Belarus";
    $_pais['BEL'] = "Belgium";
    $_pais['BLZ'] = "Belize";
    $_pais['BEN'] = "Benin";
    $_pais['BMU'] = "Bermuda";
    $_pais['BTN'] = "Bhutan";
    $_pais['BOL'] = "Bolivia";
    $_pais['BIH'] = "Bosnia and Herzegovina";
    $_pais['BWA'] = "Botswana";
    $_pais['BRA'] = "Brazil";
    $_pais['VGB'] = "British Virgin Islands";
    $_pais['BRN'] = "Brunei Darussalam";
    $_pais['BGR'] = "Bulgaria";
    $_pais['BFA'] = "Burkina Faso";
    $_pais['BDI'] = "Burundi";
    $_pais['KHM'] = "Cambodia";
    $_pais['CMR'] = "Cameroon";
    $_pais['CAN'] = "Canada";
    $_pais['CPV'] = "Cape Verde";
    $_pais['CYM'] = "Cayman Islands";
    $_pais['CAF'] = "Central African Republic";
    $_pais['TCD'] = "Chad";
    $_pais['CHL'] = "Chile";
    $_pais['CHN'] = "China";
    $_pais['HKG'] = "Hong Kong Special Administrative";
    $_pais['COL'] = "Colombia";
    $_pais['COM'] = "Comoros";
    $_pais['COG'] = "Congo";
    $_pais['COK'] = "Cook Islands";
    $_pais['CRI'] = "Costa Rica";
    $_pais['CIV'] = "Cote d'Ivoire";
    $_pais['HRV'] = "Croatia";
    $_pais['CUB'] = "Cuba";
    $_pais['CYP'] = "Cyprus";
    $_pais['CZE'] = "Czech Republic";
    $_pais['COD'] = "Democratic Republic of the Congo";
    $_pais['DNK'] = "Denmark";
    $_pais['DJI'] = "Djibouti";
    $_pais['DMA'] = "Dominica";
    $_pais['DOM'] = "Dominican Republic";
    $_pais['TMP'] = "East Timor";
    $_pais['ECU'] = "Ecuador";
    $_pais['EGY'] = "Egypt";
    $_pais['SLV'] = "El Salvador";
    $_pais['GNQ'] = "Equatorial Guinea";
    $_pais['ERI'] = "Eritrea";
    $_pais['EST'] = "Estonia";
    $_pais['ETH'] = "Ethiopia";
    $_pais['FRO'] = "Faeroe Islands";
    $_pais['FLK'] = "Falkland Islands (Malvinas)";
    $_pais['FJI'] = "Fiji";
    $_pais['FIN'] = "Finland";
    $_pais['FRA'] = "France";
    $_pais['GUF'] = "French Guiana";
    $_pais['PYF'] = "French Polynesia";
    $_pais['GAB'] = "Gabon";
    $_pais['GMB'] = "Gambia";
    $_pais['GEO'] = "Georgia";
    $_pais['DEU'] = "Germany";
    $_pais['GHA'] = "Ghana";
    $_pais['GIB'] = "Gibraltar";
    $_pais['GRC'] = "Greece";
    $_pais['GRL'] = "Greenland";
    $_pais['GRD'] = "Grenada";
    $_pais['GLP'] = "Guadeloupe";
    $_pais['GUM'] = "Guam";
    $_pais['GTM'] = "Guatemala";
    $_pais['GIN'] = "Guinea";
    $_pais['GNB'] = "Guinea-Bissau";
    $_pais['GUY'] = "Guyana";
    $_pais['HTI'] = "Haiti";
    $_pais['VAT'] = "Holy See";
    $_pais['HND'] = "Honduras";
    $_pais['HUN'] = "Hungary";
    $_pais['ISL'] = "Iceland";
    $_pais['IND'] = "India";
    $_pais['IDN'] = "Indonesia";
    $_pais['IRN'] = "Iran (Islamic Republic of)";
    $_pais['IRQ'] = "Iraq";
    $_pais['IRL'] = "Ireland";
    $_pais['IMY'] = "Isle of Man";
    $_pais['ISR'] = "Israel";
    $_pais['ITA'] = "Italy";
    $_pais['JAM'] = "Jamaica";
    $_pais['JPN'] = "Japan";
    $_pais['JOR'] = "Jordan";
    $_pais['KAZ'] = "Kazakhstan";
    $_pais['KEN'] = "Kenya";
    $_pais['KIR'] = "Kiribati";
    $_pais['KWT'] = "Kuwait";
    $_pais['KGZ'] = "Kyrgyzstan";
    $_pais['LAO'] = "Lao People's Democratic Republic";
    $_pais['LVA'] = "Latvia";
    $_pais['LBN'] = "Lebanon";
    $_pais['LSO'] = "Lesotho";
    $_pais['LBR'] = "Liberia";
    $_pais['LBY'] = "Libyan Arab Jamahiriya";
    $_pais['LIE'] = "Liechtenstein";
    $_pais['LTU'] = "Lithuania";
    $_pais['LUX'] = "Luxembourg";
    $_pais['MAC'] = "Macau";
    $_pais['MDG'] = "Madagascar";
    $_pais['MWI'] = "Malawi";
    $_pais['MYS'] = "Malaysia";
    $_pais['MDV'] = "Maldives";
    $_pais['MLI'] = "Mali";
    $_pais['MLT'] = "Malta";
    $_pais['MHL'] = "Marshall Islands";
    $_pais['MTQ'] = "Martinique";
    $_pais['MRT'] = "Mauritania";
    $_pais['MUS'] = "Mauritius";
    $_pais['MEX'] = "Mexico";
    $_pais['FSM'] = "Micronesia, Federated States of";
    $_pais['MCO'] = "Monaco";
    $_pais['MNG'] = "Mongolia";
    $_pais['MSR'] = "Montserrat";
    $_pais['MAR'] = "Morocco";
    $_pais['MOZ'] = "Mozambique";
    $_pais['MMR'] = "Myanmar";
    $_pais['NAM'] = "Namibia";
    $_pais['NRU'] = "Nauru";
    $_pais['NPL'] = "Nepal";
    $_pais['NLD'] = "Netherlands";
    $_pais['ANT'] = "Netherlands Antilles";
    $_pais['NCL'] = "New Caledonia";
    $_pais['NZL'] = "New Zealand";
    $_pais['NIC'] = "Nicaragua";
    $_pais['NER'] = "Niger";
    $_pais['NGA'] = "Nigeria";
    $_pais['NIU'] = "Niue";
    $_pais['NFK'] = "Norfolk Island";
    $_pais['MNP'] = "Northern Mariana Islands";
    $_pais['NOR'] = "Norway";
    $_pais['OMN'] = "Oman";
    $_pais['PAK'] = "Pakistan";
    $_pais['PLW'] = "Palau";
    $_pais['PAN'] = "Panama";
    $_pais['PNG'] = "Papua New Guinea";
    $_pais['PRY'] = "Paraguay";
    $_pais['PER'] = "Peru";
    $_pais['PHL'] = "Philippines";
    $_pais['PCN'] = "Pitcairn";
    $_pais['POL'] = "Poland";
    $_pais['PRT'] = "Portugal";
    $_pais['PRI'] = "Puerto Rico";
    $_pais['QAT'] = "Qatar";
    $_pais['KOR'] = "Republic of Korea";
    $_pais['MDA'] = "Republic of Moldova";
    $_pais['REU'] = "Réunion";
    $_pais['ROM'] = "Romania";
    $_pais['RUS'] = "Russian Federation";
    $_pais['RWA'] = "Rwanda";
    $_pais['SHN'] = "Saint Helena";
    $_pais['KNA'] = "Saint Kitts and Nevis";
    $_pais['LCA'] = "Saint Lucia";
    $_pais['SPM'] = "Saint Pierre and Miquelon";
    $_pais['VCT'] = "Saint Vincent and the Grenadines";
    $_pais['WSM'] = "Samoa";
    $_pais['SMR'] = "San Marino";
    $_pais['STP'] = "Sao Tome and Principe";
    $_pais['SAU'] = "Saudi Arabia";
    $_pais['SEN'] = "Senegal";
    $_pais['SYC'] = "Seychelles";
    $_pais['SLE'] = "Sierra Leone";
    $_pais['SGP'] = "Singapore";
    $_pais['SVK'] = "Slovakia";
    $_pais['SVN'] = "Slovenia";
    $_pais['SLB'] = "Solomon Islands";
    $_pais['SOM'] = "Somalia";
    $_pais['ZAF'] = "South Africa";
    $_pais['ESP'] = "Spain";
    $_pais['LKA'] = "Sri Lanka";
    $_pais['SDN'] = "Sudan";
    $_pais['SUR'] = "Suriname";
    $_pais['SJM'] = "Svalbard and Jan Mayen Islands";
    $_pais['SWZ'] = "Swaziland";
    $_pais['SWE'] = "Sweden";
    $_pais['CHE'] = "Switzerland";
    $_pais['SYR'] = "Syrian Arab Republic";
    $_pais['TWN'] = "Taiwan Province of China";
    $_pais['TJK'] = "Tajikistan";
    $_pais['THA'] = "Thailand";
    $_pais['MKD'] = "The former Yugoslav Republic of Macedonia";
    $_pais['TGO'] = "Togo";
    $_pais['TKL'] = "Tokelau";
    $_pais['TON'] = "Tonga";
    $_pais['TTO'] = "Trinidad and Tobago";
    $_pais['TUN'] = "Tunisia";
    $_pais['TUR'] = "Turkey";
    $_pais['TKM'] = "Turkmenistan";
    $_pais['TCA'] = "Turks and Caicos Islands";
    $_pais['TUV'] = "Tuvalu";
    $_pais['UGA'] = "Uganda";
    $_pais['UKR'] = "Ukraine";
    $_pais['ARE'] = "United Arab Emirates";
    $_pais['GBR'] = "United Kingdom";
    $_pais['TZA'] = "United Republic of Tanzania";
    $_pais['USA'] = "United States";
    $_pais['VIR'] = "United States Virgin Islands";
    $_pais['URY'] = "Uruguay";
    $_pais['UZB'] = "Uzbekistan";
    $_pais['VUT'] = "Vanuatu";
    $_pais['VEN'] = "Venezuela";
    $_pais['VNM'] = "Viet Nam";
    $_pais['WLF'] = "Wallis and Futuna Islands";
    $_pais['ESH'] = "Western Sahara";
    $_pais['YEM'] = "Yemen";
    $_pais['YUG'] = "Yugoslavia";
    $_pais['ZMB'] = "Zambia";
    $_pais['ZWE'] = "Zimbabwe";

    $tag='';
    $selected='';

    if($select==true){
      foreach ($_pais as $key => $value) {
        if($cod!=''){
          if($cod==$key){$selected='selected ';}else{$selected='';}
        }
        $tag .= "<option ${selected}value=\"$key\">$value</option>\n";
      }  
      return $tag;
    }

    if($select==false && $cod!=''){
      if(!is_array($_pais[$cod]) || $_pais[$cod]==''){
        return false;
      }else{
        return $_pais[$cod];
      }
    }
      
  
}


/*
 * funcao para retornar a lista de estados(UFs) ou o estado selecionado
 * */
function listaUF($cod='',$select=false){

  $_UF["AC"] = "Acre";
  $_UF["AL"] = "Alagoas";
  $_UF["AP"] = "Amapá";
  $_UF["AM"] = "Amazonas";
  $_UF["BA"] = "Bahia";
  $_UF["CE"] = "Ceará";
  $_UF["DF"] = "Distrito Federal";
  $_UF["ES"] = "Espírito Santo";
  $_UF["GO"] = "Goiás";
  $_UF["MA"] = "Maranhão";
  $_UF["MT"] = "Mato Grosso";
  $_UF["MS"] = "Mato Grosso do Sul";
  $_UF["MG"] = "Minas Gerais";
  $_UF["PA"] = "Pará";
  $_UF["PB"] = "Paraíba";
  $_UF["PR"] = "Paraná";
  $_UF["PE"] = "Pernambuco";
  $_UF["PI"] = "Piauí";
  $_UF["RJ"] = "Rio de Janeiro";
  $_UF["RN"] = "Rio Grande do Norte";
  $_UF["RS"] = "Rio Grande do Sul";
  $_UF["RO"] = "Rondônia";
  $_UF["RR"] = "Roraima";
  $_UF["SC"] = "Santa Catarina";
  $_UF["SP"] = "São Paulo";
  $_UF["SE"] = "Sergipe";
  $_UF["TO"] = "Tocantins";  
  
    $tag='';
    $selected='';

    if($select==true){
      foreach ($_UF as $key => $value) {
        if($cod!=''){
          if(strtoupper($cod)==$key){$selected='selected ';}else{$selected='';}
        }
        $tag .= "<option ${selected}value=\"$key\">$value</option>\n";
      }  
      return $tag;
    }

    if($select==false && $cod!=''){
      if(!is_array($_UF[$cod]) || $_UF[$cod]==''){
        return false;
      }else{
        return $_UF[$cod];
      }
    }  

  
}


?>
