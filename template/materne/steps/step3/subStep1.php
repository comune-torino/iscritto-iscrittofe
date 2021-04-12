										<h2 :class="domanda.statoDomanda == 'BOZ' ? 'no-bottom' : 'titleMobile'">{{ domanda.statoDomanda == 'BOZ' ? 'Riepilogo domanda' : 'Dati domanda' }} <span class="badge badge-light border border-dark">A.S. {{ domanda.annoScolastico }}</span></h2>
										<div class="form-step form-step-detail">
											<template v-if="domanda.statoDomanda != 'BOZ'">
												<div :class="['alert', { 'alert-success': ['INV','ACC'].indexOf(domanda.statoDomanda) !== -1, 'alert-danger': ['ANN','CAN'].indexOf(domanda.statoDomanda) !== -1, 'alert-info': ['INV','ACC','ANN','CAN'].indexOf(domanda.statoDomanda) == -1}]" role="alert">
													<span class="badge badge-scuola mb-1" v-if="domanda.statoDomanda != 'BOZ'">{{ domanda.ordineScuola | ordineScuola }}</span><br />
													<strong>Stato domanda</strong>: {{domanda.statoDomanda | statoDomanda}}<br />
													<strong>Domanda n&deg;</strong>: {{domanda.protocollo}}<br />
													<strong>Data invio</strong>: {{domanda.dataInserimento}}
												</div>
											</template>
											<div class="btn-group-top row">
												<div class="col-sm-12 col-md-12 col-lg-6">
													<a class="btn btn-secondary" href="#" role="button" @click="stampaDomanda"><i class="fas fa-print"></i> Stampa</a>
												</div>
											</div>
											<div id="accordion-richiedente" class="box-accordion">
												<div class="card">
													<div class="card-header" id="richiedente">
														<div class="accordion-action" data-toggle="collapse" data-target="#dati-richiedente" aria-expanded="true" aria-controls="dati-richiedente">
															<strong>Dati del richiedente</strong>
														</div>
													</div>
													<div id="dati-richiedente" class="collapse show" aria-labelledby="richiedente">
														<div class="card-body">
															<div class="form-row">
																<riepilogo-anagrafica :soggetto="domanda.richiedente.anagrafica" :luogo-nascita="domanda.richiedente.luogoNascita"></riepilogo-anagrafica>
																<riepilogo-residenza :residenza="domanda.richiedente.residenza"></riepilogo-residenza>
																<div class="form-group col-md-12">
																	<strong>Cellulare</strong>: {{ domanda.richiedente.telefono }}
																</div>
																<div class="form-group col-md-12">
																	<strong>Relazione con il bambino o bambina da iscrivere</strong>: {{ domanda.richiedente.relazioneConMinore | relazioneConBambino }}
																</div>
																<div v-if="domanda.richiedente.recapitoNoResidenza != ''" class="form-group col-md-12">
																	<strong>Eventuale recapito diverso dalla residenza</strong>: <br />{{ domanda.richiedente.recapitoNoResidenza }}
																</div>
																<div class="form-group col-md-12">
																	<hr />
																	<strong>Condizione di coabitazione</strong>:<br /><span v-html="$options.filters.condizioneCoabitazione(domanda.richiedente.condizioneCoabitazione)"></span>
																</div>
																<template v-if="(domanda.richiedente.condizioneCoabitazione != 'E' && domanda.richiedente.condizioneCoabitazione != 'F')">
																	<riepilogo-documenti :soggetto="domanda.soggetto1.gravidanza" v-if="domanda.soggetto1.anagrafica.sesso == 'F'">
																		Stato di gravidanza
																	</riepilogo-documenti>
																	<riepilogo-documenti :soggetto="domanda.soggetto1.problemiSalute">
																		Gravi problemi di salute
																	</riepilogo-documenti>
																	<riepilogo-condizione-occupazionale :occupazione="domanda.soggetto1.condizioneOccupazionale"></riepilogo-condizione-occupazionale>
																</template>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-minore" class="box-accordion">
												<div class="card">
													<div class="card-header" id="minore">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-minore" aria-expanded="false" aria-controls="dati-minore">
															<strong>Dati bambino o bambina da iscrivere</strong>
														</div>
													</div>
													<div id="dati-minore" class="collapse" aria-labelledby="minore">
														<div class="card-body">
															<div class="form-row">
																<riepilogo-anagrafica :soggetto="domanda.minore.anagrafica" :luogo-nascita="domanda.minore.luogoNascita">
																	alle ore {{domanda.minore.anagrafica.oraMinutiNascita}}
																</riepilogo-anagrafica>
																<riepilogo-residenza :residenza="domanda.minore.residenza"></riepilogo-residenza>
																<div class="form-group col-md-12">
																	<strong>Coabita con il richiedente</strong>: {{ domanda.minore.residenzaConRichiedente | siNo }}
																</div>
																<riepilogo-documenti :soggetto="domanda.minore.disabilita">
																	Disabilit&agrave;
																</riepilogo-documenti>
																<riepilogo-documenti :soggetto="domanda.minore.problemiSalute">
																	Gravi problemi di salute
																</riepilogo-documenti>
																<div class="form-group col-md-12">
																	<hr />
																	<strong>Famiglia seguita dai Servizi Sociali del Comune di Torino o del Ministero di Giustizia</strong>: {{ domanda.minore.serviziSociali.stato | siNo }}
																</div>
																<div class="form-group col-md-12 ml-3" v-if="domanda.minore.serviziSociali.stato === true">
																	<strong>Assistente sociale</strong>: {{domanda.minore.serviziSociali.dati.assistente}}<br />
																	<strong>Servizio in cui opera</strong>: {{domanda.minore.serviziSociali.dati.nome}}<br />
																	<strong>Indirizzo</strong>: {{domanda.minore.serviziSociali.dati.indirizzo}}<br />
																	<strong>Telefono</strong>: {{domanda.minore.serviziSociali.dati.telefono}}
																</div>
																<riepilogo-documenti :soggetto="domanda.minore.serviziSociali"></riepilogo-documenti>
															</div>
														</div>
													</div>
												</div>
											</div>
											<template v-if="(domanda.richiedente.condizioneCoabitazione == 'E' || domanda.richiedente.condizioneCoabitazione == 'F')">
												<div id="accordion-soggetto1" class="box-accordion">
													<div class="card">
														<div class="card-header" id="soggetto1">
															<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-soggetto1" aria-expanded="false" aria-controls="dati-soggetto1">
																<strong>Genitore che coabita con il bambino o la bambina</strong>
															</div>
														</div>
														<div id="dati-soggetto1" class="collapse" aria-labelledby="soggetto1">
															<div class="card-body">
																<div class="form-row">
																	<riepilogo-anagrafica :soggetto="domanda.soggetto1.anagrafica" :luogo-nascita="domanda.soggetto1.luogoNascita"></riepilogo-anagrafica>
																	<riepilogo-residenza :residenza="domanda.minore.residenza"></riepilogo-residenza>
																	<riepilogo-documenti :soggetto="domanda.soggetto1.gravidanza" v-if="domanda.soggetto1.anagrafica.sesso == 'F'">
																		Stato di gravidanza
																	</riepilogo-documenti>
																	<riepilogo-documenti :soggetto="domanda.soggetto1.problemiSalute">
																		Gravi problemi di salute
																	</riepilogo-documenti>
																	<riepilogo-condizione-occupazionale :occupazione="domanda.soggetto1.condizioneOccupazionale"></riepilogo-condizione-occupazionale>
																</div>
															</div>
														</div>
													</div>
												</div>
											</template>
											<template v-if="(domanda.richiedente.condizioneCoabitazione != 'D' && domanda.richiedente.condizioneCoabitazione != 'F')">
												<div id="accordion-soggetto2" class="box-accordion">
													<div class="card">
														<div class="card-header" id="soggetto2">
															<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-soggetto2" aria-expanded="false" aria-controls="dati-soggetto2">
																<strong>{{ domanda.richiedente.condizioneCoabitazione | tipoSoggetto2 }}</strong>
															</div>
														</div>
														<div id="dati-soggetto2" class="collapse" aria-labelledby="soggetto2">
															<div class="card-body">
																<div class="form-row">
																	<riepilogo-anagrafica :soggetto="domanda.soggetto2.anagrafica" :luogo-nascita="domanda.soggetto2.luogoNascita"></riepilogo-anagrafica>
																	<riepilogo-residenza :residenza="domanda.soggetto2.residenza"></riepilogo-residenza>
																	<riepilogo-documenti :soggetto="domanda.soggetto2.gravidanza" v-if="domanda.soggetto2.anagrafica.sesso == 'F'">
																		Stato di gravidanza
																	</riepilogo-documenti>
																	<riepilogo-documenti :soggetto="domanda.soggetto2.problemiSalute">
																		Gravi problemi di salute
																	</riepilogo-documenti>
																	<riepilogo-condizione-occupazionale :occupazione="domanda.soggetto2.condizioneOccupazionale"></riepilogo-condizione-occupazionale>
																</div>
															</div>
														</div>
													</div>
												</div>
											</template>
											<template v-else-if="(domanda.richiedente.condizioneCoabitazione == 'D' || domanda.richiedente.condizioneCoabitazione == 'F')">
												<div id="accordion-genitore-solo" class="box-accordion">
													<div class="card">
														<div class="card-header" id="genitore-solo">
															<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-genitore-solo" aria-expanded="false" aria-controls="dati-genitore-solo">
																<strong>Dichiarazione relativa all'unico genitore coabitante con il bambino o la bambina</strong>
															</div>
														</div>
														<div id="dati-genitore-solo" class="collapse" aria-labelledby="genitore-solo">
															<div class="card-body">
																<div class="form-row">
																	<div class="form-group col-md-12">
																		<strong v-html="$options.filters.dichiarazioneGenitoreSolo(domanda.soggetto1.genitoreSolo.stato)"></strong>
																		<i class="fas fa-check text-success"></i>
																	</div>
																	<div class="ml-3">
																		<riepilogo-sentenza :sentenza="domanda.soggetto1.genitoreSolo.sentenza" v-if="domanda.soggetto1.genitoreSolo.sentenza.numero != ''"></riepilogo-sentenza>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</template>
											<template v-if="(domanda.minore.residenzaConRichiedente === true && (domanda.richiedente.condizioneCoabitazione == 'C' || (domanda.richiedente.condizioneCoabitazione == 'D' && ['NUB_CEL_RIC','DIV','IST_SEP','SEP'].indexOf(domanda.soggetto1.genitoreSolo.stato) !== -1)))">
												<div id="accordion-soggetto3" class="box-accordion">
													<div class="card">
														<div class="card-header" id="soggetto3">
															<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-soggetto3" aria-expanded="false" aria-controls="dati-soggetto3">
																<strong>Altro genitore del bambino o bambina</strong>
															</div>
														</div>
														<div id="dati-soggetto3" class="collapse" aria-labelledby="soggetto3">
															<div class="card-body">
																<div class="form-row">
																	<div class="form-group col-md-12">
																		<strong><big>{{ domanda.soggetto3.anagrafica.cognome }} {{ domanda.soggetto3.anagrafica.nome }}</big></strong><br />
																		<div class="ml-3">
																			<span v-if="domanda.soggetto3.anagrafica.codiceFiscale != ''"><strong>Codice fiscale</strong>: {{ domanda.soggetto3.anagrafica.codiceFiscale }}<br /></span>
																			<span v-if="domanda.soggetto3.anagrafica.sesso != ''"><strong>Sesso</strong>: {{domanda.soggetto3.anagrafica.sesso | decodeSesso}}<br /></span>
																			<span v-if="domanda.soggetto3.anagrafica.dataNascita != ''"><strong>Data di nascita</strong>: {{domanda.soggetto3.anagrafica.dataNascita}}<br /></span>
																			<span v-if="domanda.soggetto3.luogoNascita.descNazione != ''"><strong>Stato di nascita</strong>: {{domanda.soggetto3.luogoNascita.descNazione}}<br /></span>
																			<span v-if="domanda.soggetto3.luogoNascita.descProvincia != ''"><strong>Provincia di nascita</strong>: {{domanda.soggetto3.luogoNascita.descProvincia}}<br /></span>
																			<span v-if="domanda.soggetto3.luogoNascita.descComune != ''"><strong>Comune di nascita</strong>: {{domanda.soggetto3.luogoNascita.descComune}}<br /></span>
																			<span v-if="domanda.soggetto3.residenza.descNazione != ''"><strong>Stato di residenza</strong>: {{domanda.soggetto3.residenza.descNazione}}<br /></span>
																			<span v-if="domanda.soggetto3.residenza.descProvincia != ''"><strong>Provincia di residenza</strong>: {{domanda.soggetto3.residenza.descProvincia}}<br /></span>
																			<span v-if="domanda.soggetto3.residenza.descComune != ''"><strong>Comune di residenza</strong>: {{domanda.soggetto3.residenza.descComune}}<br /></span>
																			<span v-if="domanda.soggetto3.residenza.cap != ''"><strong>CAP di residenza</strong>: {{domanda.soggetto3.residenza.cap}}<br /></span>
																			<span v-if="domanda.soggetto3.residenza.indirizzo != ''"><strong>Indirizzo di residenza</strong>: {{domanda.soggetto3.residenza.indirizzo}}<br /></span>
																			<span v-if="domanda.soggetto3.anagrafica.descrizioneCittadinanza != ''"><strong>Cittadinanza</strong>: {{domanda.soggetto3.anagrafica.descrizioneCittadinanza}}</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</template>
											<div id="accordion-componenti-nucleo" class="box-accordion">
												<div class="card">
													<div class="card-header" id="componenti-nucleo">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-componenti-nucleo" aria-expanded="false" aria-controls="dati-componenti-nucleo">
															<strong>Altri soggetti presenti nel nucleo familiare del bambino o bambina</strong>
														</div>
													</div>
													<div id="dati-componenti-nucleo" class="collapse" aria-labelledby="componenti-nucleo">
														<div class="card-body">
															<div v-for="(componenteNucleo, index) in domanda.componentiNucleo.soggetti" :key="'componente-'+index" :class="['form-row', 'pb-4', 'mb-4', 'border-dark', 'border-bottom']">
																<riepilogo-anagrafica :soggetto="componenteNucleo.anagrafica" :luogo-nascita="componenteNucleo.luogoNascita"></riepilogo-anagrafica>
																<div class="form-group col-md-12">
																	<hr />
																	<strong>Grado di parentela</strong>: {{componenteNucleo.relazioneConMinore | relazioneConMinore}}
																</div>
																<riepilogo-documenti :soggetto="componenteNucleo.problemiSalute">
																	Gravi problemi di salute
																</riepilogo-documenti>
															</div>
															<div class="form-row">
																<div v-if="domanda.componentiNucleo.soggetti.length > 0" class="form-group col-md-12">
																	<strong>Altri minori coabitanti in affidamento familiare ai sensi della L.184/83 non compresi nel nucleo anagrafico</strong>: {{ domanda.altriComponenti.stato | siNo }}
																</div>
																<div v-else class="form-group col-md-12">
																	<strong>Altre persone presenti nel nucleo anagrafico o minori in affidamento familiare ai sensi della legge 184/83</strong>: {{ domanda.altriComponenti.stato | siNo }}
																</div>
															</div>
															<template v-if="domanda.altriComponenti.stato === true">
																<div v-for="(altroComponente, index) in domanda.altriComponenti.soggetti" :key="'altroComponente-'+index" :class="['form-row', 'pb-4', 'ml-3', 'border-dark', {'border-bottom': index < domanda.altriComponenti.soggetti.length-1, 'pt-4':index > 0}]">
																	<riepilogo-anagrafica :soggetto="altroComponente.anagrafica" :luogo-nascita="altroComponente.luogoNascita"></riepilogo-anagrafica>
																	<riepilogo-residenza :residenza="altroComponente.residenza"></riepilogo-residenza>
																	<div class="form-group col-md-12">
																		<hr />
																		<strong>Grado di parentela</strong>: {{ altroComponente.relazioneConMinore | relazioneConMinore }}
																	</div>
																	<riepilogo-documenti :soggetto="altroComponente.problemiSalute">
																		Gravi problemi di salute
																	</riepilogo-documenti>
																</div>
															</template>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-affido" class="box-accordion">
												<div class="card">
													<div class="card-header" id="affido">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-affido" aria-expanded="false" aria-controls="dati-affido">
															<strong>Figli o figlie in affidamento condiviso</strong>
														</div>
													</div>
													<div id="dati-affido" class="collapse" aria-labelledby="affido">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<strong>Figli o figlie in affidamento condiviso non compresi nel nucleo anagrafico del bambino o bambina</strong>: {{ domanda.affido.stato | siNo }}
																</div>
															</div>
															<template v-if="domanda.affido.stato === true">
																<div v-for="(affido, index) in domanda.affido.soggetti" :key="index" :class="['form-row', 'pb-4', 'ml-3', 'border-dark', {'border-bottom': index < domanda.affido.soggetti.length-1, 'pt-4':index > 0}]">
																	<riepilogo-anagrafica :soggetto="affido.anagrafica" :luogo-nascita="affido.luogoNascita"></riepilogo-anagrafica>
																	<riepilogo-residenza :residenza="affido.residenza"></riepilogo-residenza>
																	<riepilogo-sentenza :sentenza="affido.sentenza"><hr /></riepilogo-sentenza>
																	<riepilogo-documenti :soggetto="affido.problemiSalute">
																		Gravi problemi di salute
																	</riepilogo-documenti>
																</div>
															</template>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-spostamento" class="box-accordion">
												<div class="card">
													<div class="card-header" id="spostamento">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-spostamento" aria-expanded="false" aria-controls="dati-spostamento">
															<strong>Spostamento residenza o cambiamento abitazione</strong>
														</div>
													</div>
													<div id="dati-spostamento" class="collapse" aria-labelledby="spostamento">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<strong>Richiesta attribuzione del punteggio come famiglia residente a Torino o del punteggio aggiuntivo per scuola statale</strong>: {{ domanda.minore.spostamento.stato | siNo }}
																</div>
																<template v-if="domanda.minore.spostamento.stato === true">
																	<div class="form-group col-md-12">
																		<template v-if="domanda.minore.spostamento.dati.stato == 'VAR_RES'">
																			<strong>Fatta richiesta di variazione online residenza o cambiamento abitazione in data</strong>:<br />
																			{{ domanda.minore.spostamento.dati.dataVariazione }}
																		</template>
																		<template v-else-if="domanda.minore.spostamento.dati.stato == 'APP_VAR_RES'">
																			<strong>Preso appuntamento all'anagrafe della Citt&agrave; di Torino per variazione residenza o cambiamento di abitazione in data</strong>:<br />
																			{{ domanda.minore.spostamento.dati.dataAppuntamento }}
																		</template>
																		<template v-else-if="domanda.minore.spostamento.dati.stato == 'RES_FUT'">
																			<strong>Presenter&agrave; richiesta di cambiamento di abitazione nella Citt&agrave; o di variazione di residenza per trasferimento a Torino per i seguenti motivi</strong>:<br />
																			{{ domanda.minore.spostamento.dati.residenzaFutura }}
																		</template>
																	</div>
																	<div class="form-group col-md-12">
																		<strong>Indirizzo futuro</strong>:<br />
																		{{ domanda.minore.spostamento.dati.indirizzo }}
																	</div>
																</template>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-trasferimento" class="box-accordion">
												<div class="card">
													<div class="card-header" id="trasferimento">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-trasferimento" aria-expanded="false" aria-controls="dati-trasferimento">
															<strong>Cambio della scuola di frequenza</strong>
														</div>
													</div>
													<div id="dati-trasferimento" class="collapse" aria-labelledby="trasferimento">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<strong>Cambio della scuola perch&eacute; variato l'indirizzo di residenza del bambino o bambina</strong>: {{ domanda.minore.trasferimento.stato | siNo }}
																</div>
																<div class="form-group col-md-12 ml-3" v-if="domanda.minore.trasferimento.stato === true">
																	<strong>Precendente residenza</strong>: {{domanda.minore.trasferimento.dati.indirizzoVecchio}}<br />
																	<strong>Nuova residenza</strong>: {{domanda.minore.trasferimento.dati.indirizzoNuovo}}<br />
																	<strong>Data cambio residenza</strong>: {{domanda.minore.trasferimento.dati.data}}<br />
																	<strong>Indirizzo scuola di provenienza</strong>: {{domanda.minore.trasferimento.dati.indirizzo}}<br />
																	<strong>Frequenza scuola di provenienza dal</strong>: {{domanda.minore.trasferimento.dati.dataDal}}<br />
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-cinqueAnniNonFrequentante" class="box-accordion" v-if="(domanda.minore.trasferimento.stato === false && anni5)">
												<div class="card">
													<div class="card-header" id="cinqueAnniNonFrequentante">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-cinqueAnniNonFrequentante" aria-expanded="false" aria-controls="dati-cinqueAnniNonFrequentante">
															<strong>Bambino o bambina di 5 anni non frequentante</strong>
														</div>
													</div>
													<div id="dati-cinqueAnniNonFrequentante" class="collapse" aria-labelledby="cinqueAnniNonFrequentante">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-12" v-if="domanda.minore.cinqueAnniNonFrequentante === 'N'">
																	Ha frequentato una scuola dell'infanzia di Torino nell'anno scolastico <strong>{{ domanda.annoScolastico | annoPrec }}</strong> e si &egrave; ritirato o ritirata
																</div>
																<div class="form-group col-md-12" v-else-if="domanda.minore.cinqueAnniNonFrequentante === 'F'">
																	Ha accettato il posto per una scuola dell'infanzia di Torino nell'anno scolastico <strong>{{ domanda.annoScolastico }}</strong> e si &egrave; ritirato o ritirata
																</div>
																<div class="form-group col-md-12" v-else-if="domanda.minore.cinqueAnniNonFrequentante === 'S'">
																	<strong>Nessuna delle situazioni elencate</strong>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-listaAttesa" class="box-accordion" v-if="(anni4 || anni5)">
												<div class="card">
													<div class="card-header" id="listaAtesa">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-listaAttesa" aria-expanded="false" aria-controls="dati-listaAttesa">
															<strong>Lista d'attesa</strong>
														</div>
													</div>
													<div id="dati-listaAttesa" class="collapse" aria-labelledby="listaAttesa">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<strong>Presenza di domande in lista d'attesa in precedenti graduatorie</strong>: {{ domanda.minore.listaAttesa.stato | siNo }}
																</div>
																<div class="form-group col-md-12 ml-3" v-if="domanda.minore.listaAttesa.stato === true">
																	<template v-if="domanda.minore.listaAttesa.dati.primoAnno.annoScolastico != ''">
																		<strong>Anno scolastico {{ domanda.minore.listaAttesa.dati.primoAnno.annoScolastico }}</strong>: {{ domanda.minore.listaAttesa.dati.primoAnno.scuola }}<br />
																	</template>
																	<template v-if="domanda.minore.listaAttesa.dati.secondoAnno.annoScolastico != ''">
																		<strong>Anno scolastico {{ domanda.minore.listaAttesa.dati.secondoAnno.annoScolastico }}</strong>: {{ domanda.minore.listaAttesa.dati.secondoAnno.scuola }}
																	</template>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-irc" class="box-accordion">
												<div class="card">
													<div class="card-header" id="irc">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-irc" aria-expanded="false" aria-controls="dati-irc">
															<strong>Insegnamento religione cattolica</strong>
														</div>
													</div>
													<div id="dati-irc" class="collapse" aria-labelledby="irc">
														<div class="card-body">
															<div class="form-group col-md-12">
																<strong>Intenzione di avvalersi dell'insegnamento della religione cattolica</strong>: {{ domanda.flIrc | siNo }}
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-elenco-materne" class="box-accordion">
												<div class="card">
													<div class="card-header" id="elenco-materne">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-elenco-materne" aria-expanded="false" aria-controls="dati-elenco-materne">
															<strong>Scuole d'infanzia selezionate</strong>
														</div>
													</div>
													<div id="dati-elenco-materne" class="collapse" aria-labelledby="elenco-materne">
														<div class="card-body">
															<div v-for="(materna, index) in domanda.elencoMaterne" :key="index" :class="['form-row', 'border-dark', 'pb-4', {'border-bottom': index < domanda.elencoMaterne.length-1, 'pt-4':index > 0}]">
																<div class="form-group col-md-12">
																	{{ index+1 }}&deg; scelta<br />
																	<big><strong>{{ materna.descrizione }}</strong></big> <span class="badge badge-scuola">{{ materna.codCategoriaScuola | categoriaScuola('MAT') }}</span><br />
																	{{ materna.indirizzo }}<br />
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-fratello" class="box-accordion">
												<div class="card">
													<div class="card-header" id="accordion-fratello">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-fratello" aria-expanded="false" aria-controls="dati-fratello">
															<strong>Figli o figlie frequentanti o in corso di iscrizione</strong>
														</div>
													</div>
													<div id="dati-fratello" class="collapse" aria-labelledby="accordion-fratello">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<strong>Altri figli o figlie frequentanti o in corso di iscrizione</strong>: {{ domanda.minore.fratelloFrequentante.stato | siNo }}
																</div>
																<template v-if="domanda.minore.fratelloFrequentante.stato === true">
																	<div class="form-group col-md-12 ml-3">
																		<strong><big>{{ domanda.minore.fratelloFrequentante.anagrafica.cognome }} {{ domanda.minore.fratelloFrequentante.anagrafica.nome }}</big></strong><br />
																		{{ domanda.minore.fratelloFrequentante.anagrafica.codiceFiscale }}<br />
																		<template v-if="domanda.minore.fratelloFrequentante.anagrafica.sesso == 'M'">
																			nato
																		</template>
																		<template v-else>
																			nata
																		</template>
																		il {{ domanda.minore.fratelloFrequentante.anagrafica.dataNascita }}
																		<template v-if="domanda.minore.fratelloFrequentante.anagrafica.descrizioneCittadinanza != ''">
																			<br />cittadinanza: {{ domanda.minore.fratelloFrequentante.anagrafica.descrizioneCittadinanza }}
																		</template>
																	</div>
																	<div class="form-group col-md-12 ml-3">
																		<template v-if="domanda.minore.fratelloFrequentante.anagrafica.sesso == 'M'">
																			<strong>Figlio</strong>:
																			<template v-if="domanda.minore.fratelloFrequentante.tipo == 'FREQ'">frequentante</template>
																			<template v-if="domanda.minore.fratelloFrequentante.tipo == 'ISCR'">iscrivendo</template>
																		</template>
																		<template v-if="domanda.minore.fratelloFrequentante.anagrafica.sesso == 'F'">
																			<strong>Figlia</strong>:
																			<template v-if="domanda.minore.fratelloFrequentante.tipo == 'FREQ'">frequentante</template>
																			<template v-if="domanda.minore.fratelloFrequentante.tipo == 'ISCR'">iscrivenda</template>
																		</template>
																	</div>
																</template>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-fratelloContiguo" class="box-accordion" v-if="(elencoFigliFrequentantiContiguo.length > 0 && domanda.elencoMaterne[0].contiguo.descrizione !== '')">
												<div class="card">
													<div class="card-header" id="accordion-fratelloContiguo">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#dati-fratelloContiguo" aria-expanded="false" aria-controls="dati-fratello">
															<strong>Figli o figlie frequentanti un nido comunale contiguo</strong>
														</div>
													</div>
													<div id="dati-fratelloContiguo" class="collapse" aria-labelledby="accordion-fratelloContiguo">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-12">
																	Figli o figlie frequentanti il nido di <strong>{{ domanda.elencoMaterne[0].contiguo.indirizzo }}</strong>: {{ domanda.minore.fratelloNidoContiguo.stato | siNo }}
																</div>
																<template v-if="domanda.minore.fratelloNidoContiguo.stato === true">
																	<div class="form-group col-md-12 ml-3">
																		<strong><big>{{ domanda.minore.fratelloNidoContiguo.anagrafica.cognome }} {{ domanda.minore.fratelloNidoContiguo.anagrafica.nome }}</big></strong><br />
																		{{ domanda.minore.fratelloNidoContiguo.anagrafica.codiceFiscale }}<br />
																		<template v-if="domanda.minore.fratelloNidoContiguo.anagrafica.sesso == 'M'">
																			nato
																		</template>
																		<template v-else>
																			nata
																		</template>
																		il {{ domanda.minore.fratelloNidoContiguo.anagrafica.dataNascita }}
																	</div>
																</template>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="accordion-visione" class="box-accordion box-bb">
												<div class="card">
													<div class="card-header" id="visione-informative">
														<div class="accordion-action collapsed" data-toggle="collapse" data-target="#presa-visione" aria-expanded="false" aria-controls="presa-visione">
															<strong>Dichiarazioni e Presa visione informative</strong>
														</div>
													</div>
													<div id="presa-visione" class="collapse" aria-labelledby="visione-informative">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<strong>Dichiarazione sulla responsabilità genitoriale</strong> <i class="fas fa-check text-success"></i>
																</div>
																<div class="form-group col-md-12">
																	<strong>Presa visione dell'informativa su dichiarazioni sostitutive</strong> <i class="fas fa-check text-success"></i>
																</div>
																<div class="form-group col-md-12">
																	<strong>Presa visione dell'informativa sull'uso dei dati personali (GDPR)</strong> <i class="fas fa-check text-success"></i>
																</div>
																<div class="form-group col-md-12">
																	<strong>Dichiarazione sul consenso al trattamento dei dati da parte del gestore della scuola convenzionata eventualmente scelta</strong> <i class="fas fa-check text-success"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php if (isset($_SESSION['ISCRIZIONI']['user']['authprovider']) && $_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA'): ?>
												<div class="card mt-9">
													<div class="card-body">
														<p><small>Dichiaro che alla luce delle norme del codice civile in materia di responsabilit&agrave; genitoriale la richiesta di iscrizione 
														e la scelta delle scuole &egrave; condivisa dai genitori o, nel caso di responsabilit&agrave; genitoriale esclusiva, dichiaro di essere l'unico 
														genitore con responsabilit&agrave; genitoriale.</small></p>
														<p><small>Dichiaro che quanto sopra riportato &egrave; conforme a quanto espresso e sono consapevole che la domanda
														contiene dichiarazioni sostitutive di atto di notoriet&agrave; e di certificazioni rese ai sensi degli artt.
														46 e 47 del DPR 28 dicembre 2000, n&deg; 445 (disposizioni legislative e regolamentari sulla documentazione amministrativa),
														che il Comune effettuer&agrave; controlli sulle dichiarazioni contenute nella domanda, anche attraverso la Polizia Municipale,
														e che nel caso di dichiarazioni false il punteggio verr&agrave; modificato e il dichiarante incorrer&agrave; in sanzioni penali.</small></p>
														<p><small>Dichiaro di consentire al trattamento dei dati da parte del titolare della scuola convenzionata eventualmente scelta.</small></p>
														<p><small>Autorizzo inoltre l'invio delle comunicazioni al numero di telefono indicato nella domanda.</small></p>
													</div>
												</div>
											<?php endif; ?>
											<div  v-if="domanda.statoDomanda == 'BOZ'" class="btn-group row">
												<div class="col-sm-12 col-md-12 col-lg-6">
													<a class="btn btn-secondary" href="#" role="button" @click="prevStep">Indietro</a>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-6 btn-order-primary">
													<a class="btn btn-primary" href="#" role="button" @click="nextStep">Conferma dati e invia</a>
												</div>
											</div>
											<div v-else class="btn-group row">
												<div class="col-sm-12 col-md-12 col-lg-8"><!--space--></div>
												<div class="col-sm-12 col-md-12 col-lg-4 btn-order-primary">
													<a class="btn btn-primary" href="#" role="button" @click.prevent.stop="showElencoDomande">Torna alle tue domande</a>
												</div>
											</div>
										</div>
