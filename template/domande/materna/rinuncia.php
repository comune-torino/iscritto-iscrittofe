												<h2 class="titleMobile" v-html="conferma === true ? 'Conferma rinuncia al posto' : 'Rinuncia al posto'"></h2>	
												<div class="form-step">
													<div class="list-link list-link-domanda">
														<p :class="preferenza.domanda.codStatoDomanda">
															<span class="sr-only">Stato: </span>
															{{preferenza.domanda.codStatoDomanda | statoDomanda}}
														</p>
														<h3>{{preferenza.domanda.cognomeMinore}} {{preferenza.domanda.nomeMinore}}</h3>
														<p>
															<span class="badge badge-scuola">{{preferenza.domanda.codOrdineScuola | ordineScuola}}</span><br />
															<strong>Anno scolastico</strong>: {{preferenza.domanda.annoScolastico}}<br />
															<strong>Domanda n&deg;</strong>: {{preferenza.domanda.protocollo}}<br />
															<strong>Data invio</strong>: {{preferenza.domanda.dataInvio}}
														</p>
													</div>												
													<template v-if="conferma === true" v-cloak>
														<div class="alert fade show alert-info" role="alert">
															<p>
																<strong><big>OPERAZIONE CONFERMATA</big></strong><br />
																Rinuncia al posto per la domanda n&deg; <strong>{{preferenza.domanda.protocollo}}</strong> effettuata il <span v-html="$options.filters.dataOraRicevuta(preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].dataUltimoCambioStato)"></span>
															</p>
														</div>
														<div class="btn-group-top row">
															<div class="col-sm-12 col-md-12 col-lg-6">
																<a class="btn btn-secondary" href="#" role="button" @click="stampaRicevuta"><i class="fas fa-print"></i> Stampa</a>
															</div>
														</div>
														<p>Hai <strong>rinunciato</strong> al posto nella scuola d'infanzia</p>
														<div class="detail">
															<h3>{{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].descrizione }} <span class="badge badge-scuola">{{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola | categoriaScuola('MAT') }}</span></h3>
															<p>
																<strong>Indirizzo</strong>: {{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].indirizzo }}
															</p>
														</div>
														<div class="btn-group row">
															<div class="col-btn"></div>
															<div class="col-btn"></div>
															<div class="col-btn btn-order-primary">
																<a href="#" role="button" class="btn btn-primary" @click="gestioneDomandaMaterna(preferenza.domanda.idDomandaIscrizione)">Torna alle preferenze</a>
															</div>
														</div>														
													</template>
													<template v-else v-cloak>
														<div class="alert alert-warning fade show" role="alert">
															<p>
																<strong><big>ATTENZIONE</big></strong><br />
																<template v-if="preferenza.posto == 0">La rinuncia al posto di 1&deg; scelta comporta la cancellazione dalla graduatoria cittadina.</template>
																<template v-else-if="rinunce == 2">La terza rinuncia comporta la cancellazione dalla graduatoria cittadina.</template>
																<template v-else>&Egrave; possibile rinunciare e restare in lista d'attesa per due volte. La terza rinuncia comporter&agrave; la cancellazione dalla graduatoria cittadina.</template>																
															</p>
														</div>
														<p>Stai <strong>rinunciando</strong> al posto nella scuola d'infanzia</p>
														<div class="detail">
															<h3>{{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].descrizione }} <span class="badge badge-scuola">{{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola | categoriaScuola }}</span></h3>
															<p>
																<strong>Indirizzo</strong>: {{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].indirizzo }}																
															</p>
														</div>
														<div class="btn-group row">
															<div class="col-btn">
																<a href="#" role="button" class="btn btn-secondary" @click="gestioneDomandaMaterna(preferenza.domanda.idDomandaIscrizione)">Indietro</a>
															</div>
															<div class="col-btn"></div>
															<div class="col-btn btn-order-primary">
																<a href="#" role="button" class="btn btn-primary" @click="rinuncia">Rinuncia</a>
															</div>
														</div>
													</template>														
												</div>