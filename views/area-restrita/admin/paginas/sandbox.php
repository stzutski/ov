<?php 

//~ function iTxt($id='',$title='informe',$value='',$pk=1){
  //~ $tag = 'SEM ID';
  //~ if($id!=''){
    //~ if($title!=''){$placeHolder=' data-placeholder="'.$title.'"';}
    //~ $tag = '<a href="#" id="'.$id.'" data-type="text" data-pk="'.$pk.'"'.$placeHolder.' data-title="'.$title.'">'.$value.'</a>';
  //~ }
  //~ return $tag;
//~ }

?>

<div class="fpercent">
<?php echo $percentual.'%';?>
</div>

<div class="card">
  <div class="card-header">
    <div id="statusFicha">
    <div class="progress">
      <?php $_formProgress=$percentual;?>
    <div class="progress-bar" role="progressbar" style="width: <?php echo $_formProgress;?>%;" aria-valuenow="<?php echo $_formProgress;?>" aria-valuemin="0" aria-valuemax="100">Preenchido <?php echo $_formProgress;?>%</div>
    </div>  
    </div>
  </div>
  <div class="card-body form-ficha">

  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">01 - REDES SOCIAIS</div>
  </div>

  <div class="row row-ficha">
  <div class="col-md-6">Seu facebook: <?php echo $dt_ficha['1'];?></div>
  <div class="col-md-6">Seu Instagram: <?php echo $dt_ficha['2'];?></div>
  <div class="col-md-6">Seu Twitter: <?php echo $dt_ficha['3'];?></div>
  </div>

  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">02 - DADOS PESSOAIS</div>
  </div>
  
  <div class="row">
  <div class="col-md-12">Consulado onde quer aplicar o visto: <?php echo $dt_ficha['4'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-4">Nome completo: <?php echo $dt_ficha['5'];?></div>
  <div class="col-md-4">CPF: <?php echo $dt_ficha['6'];?></div>
  <div class="col-md-4">Data de Nascimento: <?php echo $dt_ficha['7'];?></div>
  <div class="col-md-12">Estado civil: <?php echo $dt_ficha['8'];?></div>
  </div>

  <div class="row">
  <div class="col-md-12">Se divorciado, qual o motivo?  <?php echo $dt_ficha['9'];?> </div>
  </div>

  <div class="row">
  <div class="col-md-4">País de nascimento: <?php echo $dt_ficha['10'];?></div>
  <div class="col-md-4">Estado: <?php echo $dt_ficha['11'];?></div>
  <div class="col-md-4">Cidade: <?php echo $dt_ficha['12'];?></div>
  </div>

  <div class="row">
  <div class="col-md-4">Possui outra nacionalidade: <?php echo $dt_ficha['13'];?></div>
  <div class="col-md-4">Se sim qual? <?php echo $dt_ficha['14'];?></div> 
  <div class="col-md-4">Sexo: <?php echo $dt_ficha['15'];?></div>
  </div>

  <div class="row">
  <div class="col-md-6">Nome do Pai, ou Responsável (Masculino): <?php echo $dt_ficha['16'];?></div>
  <div class="col-md-6">Data Nasc. do Pai, ou responsável <?php echo $dt_ficha['17'];?></div>
  </div>

  <div class="row">
  <div class="col-md-6">Nome da Mãe, ou responsável (Feminino): <?php echo $dt_ficha['18'];?></div>
  <div class="col-md-6">Data Nasc. da Mãe, ou responsável <?php echo $dt_ficha['19'];?></div>
  </div>

  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">03 - PASSAPORTE</div>
  </div>

  <div class="row">
  <div class="col-md-4">Possui passaporte?: <?php echo $dt_ficha['20'];?></div>
  <div class="col-md-4">Qual o número?: <?php echo $dt_ficha['21'];?></div>
  <div class="col-md-4">País de emissão?: <?php echo $dt_ficha['22'];?></div>
  <div class="col-md-4">Cidade da emissão?:  <?php echo $dt_ficha['23'];?></div>
  <div class="col-md-4">Estado emissor?:  <?php echo $dt_ficha['24'];?></div>
  <div class="col-md-4">Data de Emissão (retirada): <?php echo $dt_ficha['25'];?></div>
  <div class="col-md-12">Data de Expiração (vencimento): <?php echo $dt_ficha['26'];?></div>
  </div>
    
  <div class="row">
  <div class="col-md-6">Já teve algum passaporte Roubado ou Extraviado?: <?php echo $dt_ficha['27'];?></div>
  <div class="col-md-6">Se sim explique: <?php echo $dt_ficha['28'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-12">Nome completo <b>COMO ESTA NO PASSAPORTE ou RG</b>:  <?php echo $dt_ficha['29'];?></div>
  </div>  
  
  <div class="row">
  <div class="col-md-6">Já usou algum sobrenome que não esta no passaporte ou RG?: <?php echo $dt_ficha['30'];?></div>
  <div class="col-md-6">Se sim, descreva: <?php echo $dt_ficha['31'];?></div>
  </div>  
  
  <div class="row">
  <div class="col-md-4">Já viajou para fora do País? <?php echo $dt_ficha['32'];?></div>
  <div class="col-md-4">para onde?:  <?php echo $dt_ficha['33'];?></div>
  <div class="col-md-4">Motivo da sua viagem? <?php echo $dt_ficha['34'];?>
  </div>
  </div>  

  <div class="row">
  <div class="col-md-6">Possui U.S. Social Security Number (CPF americano): <?php echo $dt_ficha['35'];?></div>
  <div class="col-md-6">Se, sim. Qual o número do seu Social Security? <?php echo $dt_ficha['36'];?></div>
  </div>

  <div class="row">
  <div class="col-md-12"><b>Qual o endereço de entrega do seu passaporte com o visto?</b></div>
  <div class="col-md-6">Rua e Número: <?php echo $dt_ficha['37'];?></div>
  <div class="col-md-6">Complemento: <?php echo $dt_ficha['38'];?></div>
  </div>

  <div class="row">
  <div class="col-md-4">Bairro: <?php echo $dt_ficha['39'];?></div>
  <div class="col-md-4">Cidade: <?php echo $dt_ficha['40'];?></div>
  <div class="col-md-4">CEP:  <?php echo $dt_ficha['41'];?></div>
  <div class="col-md-4">Informe tel. para contato: <?php echo $dt_ficha['42'];?></div>
  </div>

  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">04 - DADOS DA VIAGEM</div>
  </div>

  <div class="row">
  <div class="col-md-4">Qual a data prevista (uma base) para sua viagem:</div>
  <div class="col-md-4"><?php echo $dt_ficha['43'];?></div>
  <div class="col-md-4">É urgente!?  <?php echo $dt_ficha['44'];?></div>
  <div class="col-md-12">Descreva sua necessidade: <?php echo $dt_ficha['45'];?></div>
  </div>

  <div class="row">
  <div class="col-md-6">Quanto tempo pretende ficar? <?php echo $dt_ficha['46'];?></div>
  <div class="col-md-6">Em qual local pretende se hospedar? <?php echo $dt_ficha['47'];?></div>
  <div class="col-md-12"><b>**Hotel, Hostel, Airbnb, nos cuidaremos da sua reserva 😊</b></div>
  </div>

  <div class="row">
  <div class="col-md-4">Já tem um plano de viagem? <?php echo $dt_ficha['48'];?></div>
  <div class="col-md-8">Se sim, detalhe para nós os lugares que sonha conhecer ou estudar: <?php echo $dt_ficha['49'];?></div>
  </div>

  <div class="row">
  <div class="col-md-6">Viaja: <?php echo $dt_ficha['50'];?></div>
  <div class="col-md-6">Se acompanhado, quem:  <?php echo $dt_ficha['51'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-6">Nome Completo: <?php echo $dt_ficha['52'];?></div>
  <div class="col-md-6">Qual o vinculo? (Parente, amigo, etc):  <?php echo $dt_ficha['53'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-6">Você tem filhos (as)? <?php echo $dt_ficha['54'];?></div>
  <div class="col-md-6">Qual a idade deles? Descreva: <?php echo $dt_ficha['55'];?></div>
  </div>

  
  <div class="row">
  <div class="col-md-6">Qual o CPF dos seus filhos? <?php echo $dt_ficha['56'];?></div>
  <div class="col-md-6">Quem esta pagando (patrocinando) sua viagem? <?php echo $dt_ficha['57'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-6">Qual a renda da pessoa que irá custear sua viagem? <?php echo $dt_ficha['58'];?></div>
  <div class="col-md-6">Ela(e) declara Imposto de Renda? <?php echo $dt_ficha['59'];?></div>
  </div>
  
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">05 - HISTÓRICO</div>
  </div>  
  
  <div class="row">
  <div class="col-md-4">Já esteve nos Estados Unidos? <?php echo $dt_ficha['60'];?></div>
  <div class="col-md-4">Quando? <?php echo $dt_ficha['61'];?></div>
  <div class="col-md-4">Entrada: <?php echo $dt_ficha['62'];?> e Saída: <?php echo $dt_ficha['63'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-4">Possui visto Americano? <?php echo $dt_ficha['64'];?></div>
  <div class="col-md-4">Qual o número? <?php echo $dt_ficha['65'];?></div>
  <div class="col-md-4">Validade <?php echo $dt_ficha['66'];?> </div>
  </div>
  
  <div class="row">
  <div class="col-md-6">Já teve o pedido do visto negado? <?php echo $dt_ficha['67'];?></div>
  <div class="col-md-6">Detalhe um motivo possivel da recusa: <?php echo $dt_ficha['68'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-6">Já teve preenchido alguma petição de imigração e cidadania nos Estados Unidos <?php echo $dt_ficha['69'];?></div>
  <div class="col-md-6">quando: <?php echo $dt_ficha['70'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-6">Tem algum contato direto com cidadão Americano? <?php echo $dt_ficha['71'];?></div>
  <div class="col-md-6">nome completo: <?php echo $dt_ficha['72'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-6">Possui algum relacionamento nos EUA: <?php echo $dt_ficha['73'];?></div>
  <div class="col-md-6">nome completo: <?php echo $dt_ficha['74'];?></div>
  </div>
  
  <div class="row">
  <div class="col-md-6">Seu pai ou mãe ou parentes esta nos EUA: <?php echo $dt_ficha['75'];?></div>
  <div class="col-md-6">Possui algum relacionamento próximo aos EUA: <?php echo $dt_ficha['76'];?></div>
  </div>
  
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">06 - DADOS PROFISSIONAIS</div>
  </div>    
  
  <div class="row">
  <div class="col-md-6">Qual sua profissão? <?php echo $dt_ficha['77'];?></div>
  <div class="col-md-6">É empregado de alguma empresa, qual? <?php echo $dt_ficha['78'];?></div>
  </div>  
  
  <div class="row">
  <div class="col-md-4">Endereço: <?php echo $dt_ficha['79'];?></div>
  <div class="col-md-4">Data de início: <?php echo $dt_ficha['80'];?></div>
  <div class="col-md-4">Salário Bruto recebido: <?php echo $dt_ficha['81'];?></div>
  </div>  
  
  <div class="row">
  <div class="col-md-4">Telefone Comercial atualizado da empresa? <?php echo $dt_ficha['82'];?></div>
  <div class="col-md-8">Você tem uma empresa (MEI, ME, LTDA, EIRELLI, SA) em seu nome? <?php echo $dt_ficha['83'];?></div>
  <div class="col-md-4">Qual é o CNPJ? <?php echo $dt_ficha['84'];?></div>
  <div class="col-md-4">Sua empresa encontra-se ativa? <?php echo $dt_ficha['85'];?></div>
  <div class="col-md-4">Tem contador? <?php echo $dt_ficha['86'];?></div>
  <div class="col-md-12">O endereço e telefone do CNPJ, é o mesmo que consta na Receita Federal? <?php echo $dt_ficha['87'];?></div>
  </div>  
  
  <div class="row">
  <div class="col-md-12"><b>Favor, nos passe os dados atualizados:</b></div>
  </div>  
  
  <div class="row">
  <div class="col-md-3">Endereço: <?php echo $dt_ficha['88'];?></div>
  <div class="col-md-3">Telefone: <?php echo $dt_ficha['89'];?></div>
  <div class="col-md-6">Qual é o seu Pró-labore (retirada) mensal deste negócio? <?php echo $dt_ficha['90'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Já teve alguma empresa ou profissão anterior a esta? <?php echo $dt_ficha['91'];?></div>
  <div class="col-md-6">Favor, nos forneça os dados: <?php echo $dt_ficha['92'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Forneça o CNPJ: <?php echo $dt_ficha['93'];?></div>
  <div class="col-md-6">Endereço: <?php echo $dt_ficha['94'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-4">Data de Contratação: <?php echo $dt_ficha['95'];?></div>
  <div class="col-md-4">Data de Saída: <?php echo $dt_ficha['96'];?></div>
  <div class="col-md-4">Motivo da Saída: <?php echo $dt_ficha['97'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Salário Bruto recebido na época: <?php echo $dt_ficha['98'];?></div>
  <div class="col-md-6">Telefone Comercial atualizado da empresa? <?php echo $dt_ficha['99'];?></div>
  </div>   
  
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">07 - DADOS FINANCEIROS</div>
  </div>    
  
  <div class="row">
  <div class="col-md-6">Você declara Imposto de Renda? <?php echo $dt_ficha['100'];?></div>
  <div class="col-md-6">Tem conta em banco? <?php echo $dt_ficha['101'];?></div>
  </div>   
  
  
  <div class="row">
  <div class="col-md-6">Obteve boa movimentação desta conta nos últimos 90 dias? <?php echo $dt_ficha['102'];?></div>
  <div class="col-md-6">Sim, qual valor médio? <?php echo $dt_ficha['103'];?><br /><small>Desculpe, são dados necessários para montarmos o seu perfil</small></div>
  <div class="col-md-6">Possui saldo em conta para viajar se for necessário comprovar? <?php echo $dt_ficha['104'];?></div>
  <div class="col-md-6">Qual valor? <?php echo $dt_ficha['105'];?><br /><small>Desculpe, são dados necessários para montarmos o seu perfil</small></div>
  </div>   
  
  <div class="row">
  </div>   
  
  <div class="row">
  <div class="col-md-12">Você ou seu Patrocinador(a) Já cairam na malha fina da Receita Federal por sonegação de imposto ou algum crime financeiro contra o estado?</div>
  </div>   
  
  <div class="row">
  <div class="col-md-6"><?php echo $dt_ficha['106'];?></div>
  <div class="col-md-6">Descreva com datas: <?php echo $dt_ficha['107'];?></div>
  </div>   
    
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">08 - CURSOS E GRADUAÇÕES</div>
  </div>    
    
  <div class="row">
  <div class="col-md-12">Você possui curso profissionalizante, técnico, superior ou pós? <?php echo $dt_ficha['108'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-12"><b>Dados da faculdade ou Curso</b></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Endereço completo: <?php echo $dt_ficha['109'];?></div>
  <div class="col-md-6">Telefone: <?php echo $dt_ficha['110'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Qual o curso ou Especialização: <?php echo $dt_ficha['111'];?></div>
  <div class="col-md-6">Data de início das aulas: <?php echo $dt_ficha['112'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-12">Data de Término do curso: <?php echo $dt_ficha['113'];?><br /><small>Se estiver cursando a data será até o último semestre cursado</small></div>
  </div>   
  
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">09 - HISTÓRICO CÍVICO MILITAR</div>
  </div>      
  
  <div class="row">
  <div class="col-md-6">Já serviu o Exército? <?php echo $dt_ficha['114'];?></div>
  <div class="col-md-6">Qual Cia? <?php echo $dt_ficha['115'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Seu Cargo: <?php echo $dt_ficha['116'];?></div>
  <div class="col-md-6">Descreva suas Funções: <?php echo $dt_ficha['117'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Tem Experiência com explosivo ou arma de fogo? <?php echo $dt_ficha['118'];?></div>
  <div class="col-md-6">Descreva: <?php echo $dt_ficha['119'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Já prestou serviço para empresa, organizações sem fins lucrativos?  <?php echo $dt_ficha['120'];?></div>
  <div class="col-md-6">Qual? <?php echo $dt_ficha['121'];?></div>
  </div>   
  
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">10 - HISTÓRICO PROCESSUAL</div>
  </div>      
  
  <div class="row">
  <div class="col-md-6">Já esteve preso? <?php echo $dt_ficha['122'];?></div>
  <div class="col-md-6">Qual motivo? <?php echo $dt_ficha['123'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Já respondeu ou responde processo civil, criminal ou trabalhista? <?php echo $dt_ficha['124'];?></div>
  <div class="col-md-3">Qual? <?php echo $dt_ficha['125'];?></div>
  <div class="col-md-3">Faz quanto tempo? <?php echo $dt_ficha['126'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Já esteve envolvido com terrorismo, atos ou grupos extremos?  <?php echo $dt_ficha['127'];?></div>
  <div class="col-md-6">Descreva: <?php echo $dt_ficha['128'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Possui algum problema de saúde? <?php echo $dt_ficha['129'];?></div>
  <div class="col-md-6">Descreva: <?php echo $dt_ficha['130'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Tem experiência com arma de fogo, ou faz uso da mesma? <?php echo $dt_ficha['131'];?></div>
  <div class="col-md-6">Descreva: <?php echo $dt_ficha['132'];?></div>
  </div>   
  
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">11 - DADOS MÉDICOS</div>
  </div>      
  
  <div class="row">
  <div class="col-md-6">Possui exame para viajar assinado pelo médico? <?php echo $dt_ficha['133'];?><br /><small>Caso Tenha algum tipo de problema</small></div>
  <div class="col-md-6">Descreva: <?php echo $dt_ficha['134'];?></div>
  </div>   
  
  <div class="row">
  <div class="col-md-6">Encontra-se grávida: <?php echo $dt_ficha['135'];?></div>
  <div class="col-md-6">Quanto tempo: <?php echo $dt_ficha['136'];?></div>
  </div>   
  
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">12 - BENS & PATRIMÔNIOS</div>
  </div>      
  
  <div class="row">
  <div class="col-md-6">Possuí bens próprios (carro, imóvel, terreno) <?php echo $dt_ficha['137'];?></div>
  <div class="col-md-6">Quanto tempo: <?php echo $dt_ficha['138'];?></div>
  <div class="col-md-12">Favor descreva o(s) ben(s) e seu valor para se necessário incluir na declaração de renda - Caso jà tenha feito a declaração, desconsidere este item e nos envie foto, ou PDF da mesma</div>
  </div>
  
  <div class="row">
  <div class="col-md-12">
    <small style="text-align:left!important;">
    <b>Exemplo (veículo):</b> <br />
    Carro Ford modelo Rally, Renavan: 00123456789 Placa: VGT3344 Valor em 2017 R$ xx, Valor em 2018 R$ ZZ, Vendedor Zezinho, CPF 000.123.123-00<br />
    <b>Exemplo (imóvel):</b> <br />
    Casa ou terreno, Localizado a Rua XX, Nº Z, Metragem Frente XX, Fundos Y, Matricula do Imovel XXXX, No Cartório de notas QZYW....... etc. (Máximo de informação possivel)    
    </small>
  </div>  
  </div>

  <div class="row">
    <div class="col-md-6"><b>Bem 01:</b> <?php echo $dt_ficha['139'];?></div>
    <div class="col-md-6"><b>Bem 02:</b> <?php echo $dt_ficha['140'];?></div>
    <div class="col-md-6"><b>Bem 03:</b> <?php echo $dt_ficha['141'];?></div>
    <div class="col-md-6"><b>Bem 04:</b> <?php echo $dt_ficha['142'];?></div>
    <div class="col-md-6"><b>Bem 05:</b> <?php echo $dt_ficha['143'];?></div>
    <div class="col-md-6"><b>Bem 06:</b> <?php echo $dt_ficha['144'];?></div>
    <div class="col-md-6"><b>Bem 07:</b> <?php echo $dt_ficha['145'];?></div>
    <div class="col-md-6"><b>Bem 08:</b> <?php echo $dt_ficha['146'];?></div>
    <div class="col-md-6"><b>Bem 09:</b> <?php echo $dt_ficha['147'];?></div>
    <div class="col-md-6"><b>Bem 10:</b> <?php echo $dt_ficha['148'];?></div>
  </div>
  
  <div class="row row-ficha">
  <div class="col-md-12 row-subheader-ficha">13 - GASTOS COM EDUCAÇÃO & SAÚDE</div>
  </div>  
  
  <div class="row">
    <div class="col-md-12">
      <b>Abaixo coloque Informações de:</b>
    </div>
  </div>   
  
  <div class="row">
  <div class="col-md-12">Escola Particular adulto ou infantil: <?php echo $dt_ficha['149'];?></div>
  <div class="col-md-12">Plano de Saúde (CNPJ, endereço, telefone, valor pago mensal e anual): <?php echo $dt_ficha['150'];?></div>
  <div class="col-md-12">Plano Odontologico (CNPJ, endereço, telefone, valor pago mensal e anual): <?php echo $dt_ficha['151'];?></div>
  <div class="col-md-12"><small>Lembrando: Caso já tenha feito a declaração, desconsidere este item e nos envie foto, ou PDF da mesma</small></div>
  </div>   
  
  
  
</div>
<div class="card-footer"></div>
</div>
