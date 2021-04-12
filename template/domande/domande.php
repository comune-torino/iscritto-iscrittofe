<div class="areaAccodion" id="collapseMobile-02">
	<domande :richiedente="famiglia.richiedente.anagrafica.codiceFiscale" inline-template v-if="showDomande === true" v-cloak>
		<div>
			<template v-if="erroreDomande.stato">
				<div :class="'alert fade show alert-'+erroreDomande.tipo" role="alert">
					<p v-html="erroreDomande.messaggio"></p>
				</div>
			</template>
			<domanda-nido v-else-if="gestioneDomanda == 'nido'" :richiedente="richiedente" :id="idDomanda" inline-template v-cloak>
				<?php if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' || ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA' && $_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] === true)) : ?>
					<?php require_once('template/domande/nido/domanda.php'); ?>
				<?php else: ?>
					<div class="alert fade show alert-warning" role="alert">
						<p><strong><big>ATTENZIONE</big></strong><br />
						<?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] ?></p>
					</div>
				<?php endif; ?>
			</domanda-nido>
			<domanda-materna v-else-if="gestioneDomanda == 'materna'" :richiedente="richiedente" :id="idDomanda" inline-template v-cloak>
				<?php if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' || ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA' && $_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] === true)) : ?>
					<?php require_once('template/domande/materna/domanda.php'); ?>
				<?php else: ?>
					<div class="alert fade show alert-warning" role="alert">
						<p><strong><big>ATTENZIONE</big></strong><br />
						<?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] ?></p>
					</div>
				<?php endif; ?>
			</domanda-materna>
			<accetta-rinuncia-nido v-else-if="preferenza.tipo == 'nido'" :richiedente="richiedente" :preferenza="preferenza" inline-template v-cloak>
				<?php if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' || ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA' && $_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] === true)) : ?>
					<?php require_once('template/domande/nido/azioni.php'); ?>
				<?php else: ?>
					<div class="alert fade show alert-warning" role="alert">
						<p><strong><big>ATTENZIONE</big></strong><br />
						<?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] ?></p>
					</div>
				<?php endif; ?>
			</accetta-rinuncia-nido>
			<accetta-rinuncia-materna v-else-if="preferenza.tipo == 'materna'" :richiedente="richiedente" :preferenza="preferenza" inline-template v-cloak>
				<?php if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' || ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA' && $_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] === true)) : ?>
					<?php require_once('template/domande/materna/azioni.php'); ?>
				<?php else: ?>
					<div class="alert fade show alert-warning" role="alert">
						<p><strong><big>ATTENZIONE</big></strong><br />
						<?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] ?></p>
					</div>
				<?php endif; ?>
			</accetta-rinuncia-materna>
			<elenco-domande v-else :richiedente="richiedente" inline-template v-cloak>
				<div>
					<h2 class="titleMobile">
						Le tue domande
					</h2>
					<template v-if="$root.showLoading === false">
						<div class="form-step">
							<template v-if="domande.length">
								<div class="form-row justify-content-sm-center">
									<div class="form-group col-sm-12 col-md-6 col-lg-5">
										<label for="filtroScuole" class="col-form-label">Anno scolastico</label>
										<select id="filtroScuole" class="form-control" v-model="ricerca">
											<option value="">- Tutti gli anni -</option>
											<option v-for="anno in anni" :value="anno">{{anno}}</option>
										</select>
									</div>
								</div>
								<?php if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' || ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA' && $_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] === true && $_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] === true)) : ?>
									<div class="form-row justify-content-sm-center">								
										<div class="form-group col-sm-12 col-md-6 col-lg-5">
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" id="scuolaNido" name="scuolaNido" class="custom-control-input" value="true" v-model="scuolaNido"  />
												<label class="custom-control-label" for="scuolaNido">Nido d'infanzia</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline" >
												<input type="checkbox" id="scuolaMaterna" name="scuolaMaterna" class="custom-control-input" value="true" v-model="scuolaMaterna" />
												<label class="custom-control-label" for="scuolaMaterna">Scuola d'infanzia</label>
											</div>
										</div>
									</div>
								<?php endif; ?>
								<div class="form-row">
									<div class="col-sm-12 col-md-10"><!--space--></div>
									<div class="col-sm-12 col-md-2 btn-order-primary">
										<a class="btn btn-primary" href="#" role="button" @click.prevent="resetRicerca()">Annulla filtri</a>
									</div>
								</div>
								<hr />
								<div class="list-link list-link-domande" v-for="domanda in filtroDomande" :key="domanda.idDomandaIscrizione">																			
									<div class="detail">
										<p :class="domanda.statoDomanda">
											<span class="sr-only">Stato: </span>
											{{domanda.statoDomanda | statoDomanda}}
										</p>
										<h3>{{domanda.cognome}} {{domanda.nome}}</h3>
										<p>
											<span class="badge badge-scuola">{{domanda.ordineScuola | ordineScuola}}</span><br />
											<strong>Anno scolastico</strong>: {{domanda.annoScolastico}}<br />
											<template v-if="domanda.statoDomanda == 'BOZ'">
												<strong>Ultimo aggiornamento</strong>: {{domanda.dataInvio}}
											</template>
											<template v-else>
												<strong>Domanda n&deg;</strong>: {{domanda.protocollo}}<br />
												<strong>Data invio</strong>: {{domanda.dataInvio}}
											</template>
										</p>
									</div>
									<div class="btn-group-col">
										<div class="btn-row">
											<div v-if="domanda.statoDomanda == 'ACC'" class="col">
												<a href="#" role="button" class="btn btn-primary" @click.prevent="downloadRicevuta(domanda.idDomandaIscrizione)"><i class="fa fa-file-pdf" aria-hidden="true"></i> Ricevuta accettazione</a>
											</div>
											<div v-if="['BOZ','INV','ANN','CAN'].indexOf(domanda.statoDomanda) === -1" class="col">
												<a href="#" role="button" :class="['btn', {'btn-primary': domanda.statoDomanda != 'ACC', 'btn-secondary': domanda.statoDomanda == 'ACC'}]" @click="domanda.ordineScuola == 'NID' ? gestioneDomandaNido(domanda.idDomandaIscrizione) : gestioneDomandaMaterna(domanda.idDomandaIscrizione)">{{ domanda.statoDomanda != 'AMM' ? 'Preferenze' : 'Accetta o Rinuncia' }}</a>
											</div>
											<div class="col">
												<a v-if="domanda.statoDomanda != 'BOZ'" href="#" role="button" :class="['btn', {'btn-primary': ['INV','ANN','CAN'].indexOf(domanda.statoDomanda) !== -1, 'btn-secondary': ['INV','ANN','CAN'].indexOf(domanda.statoDomanda) === -1}]" @click="domanda.ordineScuola == 'NID' ? getDomandaNido(domanda.idDomandaIscrizione) : getDomandaMaterna(domanda.idDomandaIscrizione)">Visualizza dati domanda</a>
												<a v-else href="#" role="button" class="btn btn-primary" @click="domanda.ordineScuola == 'NID' ? getDomandaNido(domanda.idDomandaIscrizione, domanda.statoDomanda) : getDomandaMaterna(domanda.idDomandaIscrizione, domanda.statoDomanda)">Modifica bozza</a>
											</div>
											<div v-if="['BOZ','INV','GRA'].indexOf(domanda.statoDomanda) !== -1" class="col">
												<a href="#" role="button" class="btn btn-secondary" @click.prevent="eliminaDomanda(domanda.idDomandaIscrizione, domanda.statoDomanda, domanda.protocollo)"><i class="fa fa-times-circle" aria-hidden="true"></i> {{ domanda.statoDomanda == 'BOZ' ? 'Cancella' : 'Annulla' }} domanda</a>
											</div>	
										</div>
									</div>
								</div>
								<div class="alert alert-warning fade show" v-if="!filtroDomande.length">
									<p>Nessun risultato!</p>
								</div>
							</template>
							<div v-else class="alert alert-warning fade show">
								<p>Nessuna domanda presente!</p>
							</div>
						</div>
					</template>
				</div>
			</elenco-domande>
		</div>															
	</domande>
</div>