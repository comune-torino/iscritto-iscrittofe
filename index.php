<?php require_once('auth_tofa.php'); ?>
<!DOCTYPE html>
<html lang="it-it" dir="ltr">
  <head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<!-- META FOR IOS & HANDHELD -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<style type="text/stylesheet"> @-webkit-viewport { width: device-width; } @-moz-viewport { width: device-width; } @-ms-viewport { width: device-width; } @-o-viewport { width: device-width; } @viewport { width: device-width; } </style>
		<script type="text/javascript">
		//<![CDATA[
		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
			var msViewportStyle = document.createElement("style");
			msViewportStyle.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}"));
			document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
		}
		//]]>
		</script>
		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-mobile-web-app-capable" content="YES" />
		<!-- //META FOR IOS & HANDHELD -->
		<link rel="shortcut icon" href="im/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700,400italic:latin" media="all" />
		<link href="css/vuejs-dialog.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="css/iscrizioni.css?<?php echo time(); ?>" media="screen" />
		<link rel="stylesheet" href="css/print.css?<?php echo time(); ?>" media="print" />
		<title>Torino Facile - Iscrizione Servizi 0-6</title>
		<!--[if IE 9]>
			<link href="css/bootstrap-ie9.min.css" rel="stylesheet" media="screen" />
			<link href="css/ie9.min.css" rel="stylesheet" media="screen" />
		<![endif]-->
  </head>
	<body>
    <div id="app">
			<div id="spinner" v-show="showLoading"></div>
			<nav class="navbar-pc">
				<div class="container">
					<div class="row align-items-center">
						<div class="brand-area col">
							<span class="navbar-brand">
								<img src="im/logotorinofacile.png" class="d-inline-block align-top" alt="Logo Torinofacile" />
							</span>
						</div>
						<template v-if="user" v-cloak>
							<div class="user-info col">
								<a class="help" href="https://servizi.torinofacile.it/info/aiuto" role="button" target="_new">
									<i class="icon-help"></i>
									<span>Aiuto</span>
								</a>
								<div class="dropdown user-dropdown show" v-if="user" v-cloak>
									<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="icon-user"></i>
										<span class="txt">{{user.nome}} {{user.cognome}}</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
										<span class="titoli-dropdown user">{{ user.nome }} {{ user.cognome }}</span>
										<div class="user-line dropdown-divider"></div>
										<!---ALL new-->
										<?php if (isset($_SESSION['ISCRIZIONI']['user']['authprovider']) && $_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA'): ?>
											<div class="menuMioFacile">
												<div class="row">
													<div class="col-image"></div>
													<div class="col-menu">
														<a class="dropdown-item" href="?logout=bacheca">Bacheca</a>
														<a class="dropdown-item" href="?logout=servizi">Servizi</a>
														<a class="dropdown-item" href="?logout=comunicazioni">Comunicazioni</a>
														<a class="dropdown-item" href="?logout=impostazioni">Impostazioni</a>
													</div>
												</div>
											</div>
											<div class="dropdown-divider"></div>
											<div class="footer-dropdown">
												<a class="dropdown-item" href="?logout=home">
													Torna all'home di TorinoFacile
												</a>
												<a class="dropdown-item" href="?logout=logout">
													<i class="icon-out"></i> esci
												</a>
											</div>
										<?php else: ?>
											<a class="dropdown-item" href="?logout=logout"><i class="fa fa-sign-out-alt"></i> Esci</a>
										<?php endif; ?>
										<!--FINE ALL NEW -->
									</div> <!--dropdown-menu-->
								</div><!--/user-dropdown-->
							</div>
						</template>
					</div>
				</div>
			</nav>
			<div class="content-page">
				<div :class="['header', {'header-shadow':errore.stato === true || showRicerca === true}]" data-toggle="affix">
					<div class="container">
						<div class="row">
							<h1 class="col-10 col-md-12">Iscrizione Servizi 0-6</h1>
						</div>
					</div>
				</div>
				<template v-if="errore.stato" v-cloak>
					<div class="user-info-all-detail mt-5">
						<div class="container">
							<div class="row">
								<div class="col-12">
									<div :class="'alert fade show alert-'+errore.tipo" role="alert">
										<p v-html="errore.messaggio"></p>
									</div>
								</div><!--/col-->
							</div><!--/container-->
						</div><!--/row-->
					</div><!--/user-info-all-detail-->
				</template>
				<template v-else-if="showRicerca == true" v-cloak>
					<div class="user-info-all-detail mt-5">
						<div class="container">
							<div class="row">
								<div class="col-12">
									<div class="form-row">
										<div class="form-group col-12 mb-7">
											<label for="ricerca-cf" class="col-form-label">Codice fiscale del richiedente<?php if ($_SESSION['ISCRIZIONI']['ENVIRONMENT'] != 'PRD'): ?> <small>(PSNFNC88E57E379J - PRNFNC68R30E379L - AAAAAA00A11V000D)</small><?php endif; ?><sub class="required">*</sub></label>
											<div class="input-group">
												<input maxlength="16" type="text" :class="{'form-control':true,'col-lg-5':true, 'is-invalid': errors.has('ricerca-cf')}" ref="ricercaCf" id="ricerca-cf" name="ricerca-cf" placeholder="inserisci il codice fiscale" v-model="ricercaCf" v-validate.disable="{ required:true,alpha_num:true,length:16,regex:/^[a-zA-Z0-9]{16}$/,check_cf:true }" v-mask="'NNNNNNNNNNNNNNNN'" @keyup.enter="cercaRichiedente" />
												<div class="input-group-append">
													<button class="btn btn-primary" type="button" @click="cercaRichiedente"> <i class="fa fa-search" aria-hidden="true"></i> </button>
												</div>
												<span class="invalid-feedback" v-show="errors.has('ricerca-cf')">{{ errors.first('ricerca-cf') }}</span>
											</div>
										</div>
									</div>
									<template v-if="showRisultatoRicerca">
										<template v-if="famiglia.richiedente.anagrafica.cognome != ''">
											<div class="alert alert-success fade show" role="alert">
												<h3 class="alert-heading">{{ famiglia.richiedente.anagrafica.cognome }} {{ famiglia.richiedente.anagrafica.nome }}</h3>
												<template v-if="famiglia.richiedente.anagrafica.sesso == 'M'">
													nato a
												</template>
												<template v-else>
													nata a
												</template>
												<template v-if="(famiglia.richiedente.luogoNascita.codNazione == '000' && famiglia.richiedente.luogoNascita.descComune == famiglia.richiedente.luogoNascita.descProvincia)">
													{{ famiglia.richiedente.luogoNascita.descComune }}
												</template>
												<template v-else-if="(famiglia.richiedente.luogoNascita.codNazione == '000' && famiglia.richiedente.luogoNascita.descComune != famiglia.richiedente.luogoNascita.descProvincia)">
													{{ famiglia.richiedente.luogoNascita.descComune }}, provincia di {{ famiglia.richiedente.luogoNascita.descProvincia }},
												</template>
												<template v-else-if="famiglia.richiedente.luogoNascita.codNazione != '000'">
													{{ famiglia.richiedente.luogoNascita.descComune }} ({{ famiglia.richiedente.luogoNascita.descNazione }})
												</template>
												il {{ famiglia.richiedente.anagrafica.dataNascita }}<br />
												cittadinanza: {{ famiglia.richiedente.anagrafica.descrizioneCittadinanza }}
											</div>
										</template>
										<template v-else>
											<div class="alert alert-warning fade show" role="alert">
												<p><strong><big>ATTENZIONE</big></strong><br />
												Il codice fiscale indicato non &egrave; presente in anagrafe.<br />
												Verificare la correttezza o proseguire inserendo manualmente tutti i dati.</p>
											</div>
										</template>
										<div class="btn-group row">
											<div class="col-sm-12 col-md-12 col-lg-8"><!--space--></div>
											<div class="col-sm-12 col-md-12 col-lg-4 btn-order-primary">
												<a class="btn btn-primary" href="#" role="button" @click="setRichiedente">Prosegui</a>
											</div>
										</div>
									</template>
								</div><!--/col-->
							</div><!--/row-->
						</div><!--/container-->
					</div><!--/user-info-all-detail-->
				</template>
				<home :famiglia="famiglia" inline-template v-if="(errore.stato === false && showRicerca === false)" v-cloak>
					<div>
						<!--inizio menu mobile-->
						<div class="menuHight col-2 dropdown show">
							<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuHight" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="txt">Menu principale</span>
							</a>
							<div class="dropdown-menuHight dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuHight">
								<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" :style="{cursor: [tipoDomanda != '' ? 'pointer' : '']}" id="pills-domanda-tab" data-toggle="pill" href="#domanda" role="tab" aria-controls="pills-domanda" aria-selected="true" @click.prevent="indice($event)">Nuova domanda</a>
									</li>
									<li class="nav-item active">
										<a class="nav-link" id="pills-elenco-tab" data-toggle="pill" href="#elenco" role="tab" aria-controls="pills-elenco" aria-selected="true" @click.prevent="indice($event)">Le tue domande</a>
									</li>
									<li class="nav-item active">
										<a class="nav-link" id="pills-documenti-tab" data-toggle="pill" href="#documenti" role="tab" aria-controls="pills-documenti" aria-selected="true" @click.prevent="indice($event)">Informazioni e documentazione</a>
									</li>
								</ul>
							</div>
						</div>
						<!--fine menu mobile-->
						<div class="nav-box">
							<div class="container">
								<ul class="row nav nav-pills mb-3" id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" :style="{cursor: [tipoDomanda != '' ? 'pointer' : '']}" id="pills-domanda-tab" data-toggle="pill" href="#domanda" role="tab" aria-controls="pills-domanda" aria-selected="true" @click.prevent="indice($event)">Nuova domanda</a>
									</li>
									<li class="nav-item active">
										<a class="nav-link" id="pills-elenco-tab" data-toggle="pill" href="#elenco" role="tab" aria-controls="pills-elenco" aria-selected="true" @click.prevent="indice($event)">Le tue domande</a>
									</li>
									<li class="nav-item active">
										<a class="nav-link" id="pills-documenti-tab" data-toggle="pill" href="#documenti" role="tab" aria-controls="pills-documenti" aria-selected="true" @click.prevent="indice($event)">Informazioni e documentazione</a>
									</li>
								</ul>
								<!--//nav-pills-->
							</div>
							<!--//container-->
						</div>
						<!--//nav-box-->
						<div class="user-info-all-detail">
							<div class="container">
								<?php if (isset($_SESSION['ISCRIZIONI']['user']['authprovider']) && $_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA'): ?>
									<div class="alert-user mb-7">
										<div class="form-row px-4 py-2">
											<div class="form-group col-sm-12 col-md-10 mt-1">
												<i class="fa fa-user fa-lg fa-2x pr-2"></i>
												<template v-if="famiglia.richiedente.anagrafica.cognome != ''">
													<big><strong>{{ famiglia.richiedente.anagrafica.cognome }} {{ famiglia.richiedente.anagrafica.nome }}</strong></big>
													({{ famiglia.richiedente.anagrafica.codiceFiscale }})
												</template>
												<template v-else>
													<big><strong>{{ famiglia.richiedente.anagrafica.codiceFiscale }}</strong></big>
												</template>
											</div>
											<div class="form-group col-sm-12 col-md-2 text-right">
												<button type="button" class="btn btn-primary btn-sm mt-2" @click="cambia">cambia</button>
											</div>
										</div>
									</div>
								<?php endif; ?>
								<div class="row">
									<div class="tab-content col" id="pills-tabContent">
										<div class="areaTabAccodion tab-pane fade show active" id="domanda" role="tabpanel" aria-labelledby="collapseMobile-01">
											<?php require_once('template/domanda.php'); ?>
										</div>
										<!-- areaTabAccodion -->
										<div class="areaTabAccodion tab-pane fade" id="elenco" role="tabpanel" aria-labelledby="collapseMobile-02">
											<?php require_once('template/domande/domande.php'); ?>
										</div>
										<!-- areaTabAccodion -->
										<div class="areaTabAccodion tab-pane fade" id="documenti" role="tabpanel" aria-labelledby="collapseMobile-03">
											<?php require_once('template/documenti/elenco.php'); ?>
										</div>
										<!-- areaTabAccodion -->
									</div>
									<!-- //col -->
								</div>
								<!--//row-->
							</div>
							<!-- //container-->
						</div>
					</div>
				</home>
			</div> <!--//content-page-->
      <!-- BACK TOP TOP BUTTON -->
      <div id="back-to-top" data-toggle="affix" class="back-to-top">
        <button class="btn btn-primary" title="Back to Top">
          <span class="sr-only">Torna su</span>
        </button>
      </div>
      <!-- BACK TO TOP BUTTON -->
    </div>
		<footer class="Footer">
			<div class="container">
				<div class="row">
					<div class="Footer-info col-sm-6 col-md-6 col-lg-6">
						<p>
							<img class="" src="im/numverde.png" alt="Numero Verde 800 450 900" /> </p>
						<p> Attivo da luned&igrave; a venerd&igrave;
							<br /> dalle ore 8:00 alle 18:00
						</p>
						<p>
							Per assistenza sui servizi compila il <a href="https://servizi.torinofacile.it/assistenza/form/index.php" target="_blank" style="text-decoration:underline">modulo</a>
						</p>
					</div>
					<div class="Footer-loghi col-sm-6 col-md-6 col-lg-6">
						<div class="Grid">
							<div class="logoCell">
								<img alt="Logo Pon Metro" src="https://servizi.torinofacile.it/info/themes/tofacile/lib/agid-tofacile/build/assets/im/logopnmetro.png"> </div>
							<div class="logoCell">
								<img alt="Logo Citta' di Torino" src="https://servizi.torinofacile.it/info/themes/tofacile/lib/agid-tofacile/build/assets/im/logocomtorino.png"> </div>
							<div class="logoCell">
								<img alt="Logo Repubblica italiana" src="https://servizi.torinofacile.it/info/themes/tofacile/lib/agid-tofacile/build/assets/im/logo_repita.png"> </div>
							<div class="logoCell">
								<img class="UE" alt="Logo Unione Europea" src="https://servizi.torinofacile.it/info/themes/tofacile/lib/agid-tofacile/build/assets/im/logoEU.png"> </div>
							<div class="txtCell">
								<p>Progetto cofinanziato dall'Unione Europea - Fondi Strutturali di Investimento Europei</p>
								<p>Programma Operativo Citt&agrave; Metropolitane 2014-2020</p>
							</div>
						</div>
					</div>
				</div>
				<!--//row-->
			</div>
			<!--//container-->
		</footer>
		<script type="text/javascript">
			if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"><\/script>');
		</script>
		<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
		<script src="js/vendor/jquery-3.3.1.min.js"></script>
		<script src="js/vendor/popper.min.js"></script>
		<script src="js/vendor/axios.min.js"></script>
		<script src="js/vendor/vuejs-2.5.17.min.js"></script>
		<script src="js/vendor/vee-validate.js"></script>
		<script src="js/vendor/v-mask.min.js"></script>
		<script src="js/vendor/Sortable.min.js"></script>
		<script src="js/vendor/vuedraggable.min.js"></script>
		<script src="js/vendor/bootstrap.min.js"></script>
		<script src="js/vendor/polyfill.min.js"></script>
		<script src="js/vendor/vuejs-dialog.min.js"></script>
		<script src="js/vendor/vue-scrollto.js"></script>
		<script src="js/custom.js?<?php echo time(); ?>"></script>
		<script src="js/validators.js?<?php echo time(); ?>"></script>
		<script src="js/filters.js?<?php echo time(); ?>"></script>
		<script src="js/components.js?<?php echo time(); ?>"></script>
		<script src="js/materne.js?<?php echo time(); ?>"></script>
		<script src="js/nidi.js?<?php echo time(); ?>"></script>
		<script src="js/domande.js?<?php echo time(); ?>"></script>
		<script src="js/app.js?<?php echo time(); ?>"></script>
	</body>
</html>
