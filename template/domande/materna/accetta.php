												<h2 class="titleMobile" v-html="conferma === true ? 'Conferma accettazione del posto' : 'Accetta il posto'"></h2>
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
														<div class="alert fade show alert-success" role="alert">
															<p>
																<strong><big>OPERAZIONE CONFERMATA</big></strong><br />
																Accettazione del posto per la domanda n&deg; <strong>{{preferenza.domanda.protocollo}}</strong> effettuata il <span v-html="$options.filters.dataOraRicevuta(preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].dataUltimoCambioStato)"></span>
															</p>
														</div>
														<div class="btn-group-top row">
															<div class="col-sm-12 col-md-12 col-lg-6">
																<!-- a class="btn btn-secondary" href="#" role="button" @click="stampaRicevuta"><i class="fas fa-print"></i> Stampa</a -->
																<a class="btn btn-secondary" href="#" role="button" @click.prevent="downloadRicevuta(preferenza.domanda.idDomandaIscrizione)"><i class="fa fa-file-pdf" aria-hidden="true"></i> Ricevuta accettazione</a>
															</div>
														</div>
														<p>Hai <strong>accettato</strong> il posto nella scuola d'infanzia</p>
														<div class="detail">
															<h3>{{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].descrizione }} <span class="badge badge-scuola">{{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola | categoriaScuola('MAT') }}</span></h3>
															<p>
																<strong>Indirizzo</strong>: {{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].indirizzo }}
															</p>
															<p v-if="['M','S','A'].indexOf(preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola) !== -1">Sei invitato/a a contattare telefonicamente la scuola entro 3 giorni per fissare un appuntamento in cui ti saranno fornite le informazioni necessarie per iniziare la frequenza del bambino o della bambina.</p>
															<p v-else>Entro 3 giorni sarai contattato dalla Divisione Servizi Educativi della Citt&agrave; di Torino per fissare un appuntamento in cui ti saranno fornite tutte le informazioni necessarie per iniziare la frequenza del bambino o della bambina.</p>
															<p>L'adempimento degli obblighi vaccinali &egrave; indispensabile per frequentare la scuola d'infanzia.</p>
														</div>
														<div class="info-accettazione">
															<h3>Informazioni utili</h3>
															<template v-if="['M','S','A'].indexOf(preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola) !== -1">
																<h4>Tipologia pasto</h4>
																<p>La tipologia di pasto scelta &egrave; quella "<strong>{{ preferenza.domanda.codiceTipoPasto | tipoPasto }}</strong>".<br />
																Potrai cambiarla in ogni momento accedendo da domani al servizio <a href="https://servizi.torinofacile.it/info/scelta-pasti-alternativi" target="_blank"><strong>Scelta pasti alternativi</strong></a> del Portale Torinofacile con le stesse credenziali che hai usato per inserire la domanda.</p>
																<p><strong>NB:</strong> In caso di allergie o intolleranze alimentari per le quali &egrave; necessaria una dieta personalizzata, rivolgiti all'<a href="http://www.comune.torino.it/servizieducativi/ristorazionescolastica/menualternativi" target="_blank"><strong>ufficio Diete</strong></a> (011 01127556).</p>
															</template>
															<h4>Pagamento del servizio</h4>
															<template v-if="['M','S'].indexOf(preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola) !== -1">
																<p>Il pagamento del servizio avviene tramite addebito mensile sul Borsellino elettronico, a te intestato, accessibile tramite le stesse credenziali che hai usato per inserire la domanda.
																Nei prossimi mesi riceverai una comunicazione da SORIS, societ&agrave; di riscossione incaricata dell'incasso delle quote dovute per la fruizione del servizio.</p>
															</template>
															<template v-else>
																<p>Il pagamento del servizio avviene versando direttamente al gestore la quota dovuta.</p>
															</template>
															<h4>Tariffa</h4>
															<p>Con l'iscrizione al servizio viene assegnata la tariffa completa. I residenti a Torino possono fruire delle tariffe agevolate.<br />
															Per fruire della tariffa agevolata, devi avere un ISEE valido e presentare richiesta di <a href="https://servizi.torinofacile.it/info/richiesta-prestazioni-agevolate-collegate-isee" target="_blank"><strong>Prestazione agevolata ISEE</strong></a> compilandola sul portale Torinofacile o recandoti presso un <a href="http://www.comune.torino.it/servizieducativi/ristorazionescolastica/tariffe/doc/caf.pdf" target="_blank"><strong>CAF convenzionato</strong></a> con la Citt&agrave;.</p>
															<p v-if="preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola == 'C'">Devi presentare la copia della richiesta e dell'attestazione ISEE alla scuola d'infanzia convenzionato.</p>
															<!-- template v-if="['M','S','A'].indexOf(preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola) !== -1">
																<h4>Buono Servizi Prima Infanzia</h4>
																<p>Nel caso tu sia in possesso di un ISEE valido con indicatore uguale o inferiore a &euro;15.000, la presentazione della richiesta di prestazione agevolata varr&agrave; come richiesta di accesso al <a href="https://www.regione.piemonte.it/web/temi/istruzione-formazione-lavoro/istruzione/0-6-anni-servizi-contributi/buono-servizi-prima-infanzia" target="_blank"><strong>Buono Servizi Prima Infanzia</strong></a> della Regione Piemonte detto anche Buono Nidi.<br />
																Possono accedere al <strong>Buono Servizi Prima Infanzia</strong> bambini e bambine residenti in Piemonte che frequentano una scuola d'infanzia comunale.</p>
															</template -->
															<template v-if="['S','N'].indexOf(preferenza.domanda.irc) !== -1">
																<h4>Insegnamento religione cattolica</h4>
																<p v-if="preferenza.domanda.irc == 'S'">&Egrave; stato scelto di avvalersi dell'insegnamento della religione cattolica.</p>
																<p v-else>&Egrave; stato scelto di non avvalersi dell'insegnamento della religione cattolica.</p>
															</template>
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
															<p><strong><big>ATTENZIONE</big></strong><br />
																Dopo l'accettazione, la domanda non sar&agrave; presa in considerazione per l'assegnazione di altri posti.</p>
														</div>
														<p>Stai <strong>accettando</strong> il posto nella scuola d'infanzia</p>
														<div class="detail">
															<h3>{{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].descrizione }} <span class="badge badge-scuola">{{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola | categoriaScuola('MAT') }}</span></h3>
															<p>
																<strong>Indirizzo</strong>: {{ preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].indirizzo }}
															</p>
														</div>
														<div class="form-row mt-8">
															<div class="form-group col-sm-12 col-md-6">
															  <label for="n-telefono" class="col-form-label">Numero di telefono</label><sub class="required">*</sub>
																<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('n-telefono')}" id="n-telefono" name="n-telefono" placeholder="Inserisci un solo n. di telefono" v-validate.disable="{required:true,regex:/^\+?[0-9]{6,16}$/}" v-mask="'X###############'" v-model="preferenza.domanda.telefonoRichiedente" aria-describedby="telefonoHelp" />
																<span class="invalid-feedback" v-show="errors.has('n-telefono')">{{ errors.first('n-telefono') }}</span>
																<small id="telefonoHelp" class="form-text text-muted">il numero inserito &egrave; quello sul quale accetto di ricevere comunicazioni scuola/famiglia</small>
															</div>
														</div>
														<template v-if="['M','S','A'].indexOf(preferenza.domanda.elencoPreferenzeMaterna[preferenza.posto].codCategoriaScuola) !== -1">
															<div class="form-row mt-5">
																<div id="tipo-pasto" class="form-group col-sm-12 col-md-6">
																	<label class="col-form-label col-md-12">Seleziona la tipologia di pasto<sub class="required">*</sub></label>
																	<div class="custom-control custom-radio">
																		<input type="radio" id="tipo-pasto-1" name="tipo-pasto" :class="{'custom-control-input':true, 'is-invalid': errors.has('tipo-pasto')}" value="TP1" v-model="preferenza.domanda.codiceTipoPasto" v-validate.disable="'required'" />
																		<label class="custom-control-label" for="tipo-pasto-1">Normale</label>
																	</div>
																	<div class="custom-control custom-radio">
																		<input type="radio" id="tipo-pasto-2" name="tipo-pasto" :class="{'custom-control-input':true, 'is-invalid': errors.has('tipo-pasto')}" value="TP2" v-model="preferenza.domanda.codiceTipoPasto" />
																		<label class="custom-control-label" for="tipo-pasto-2">Senza carne</label>
																	</div>
																	<div class="custom-control custom-radio">
																		<input type="radio" id="tipo-pasto-3" name="tipo-pasto" :class="{'custom-control-input':true, 'is-invalid': errors.has('tipo-pasto')}" value="TP3" v-model="preferenza.domanda.codiceTipoPasto" />
																		<label class="custom-control-label" for="tipo-pasto-3">Senza carne di maiale</label>
																	</div>
																	<div class="custom-control custom-radio">
																		<input type="radio" id="tipo-pasto-4" name="tipo-pasto" :class="{'custom-control-input':true, 'is-invalid': errors.has('tipo-pasto')}" value="TP4" v-model="preferenza.domanda.codiceTipoPasto" />
																		<label class="custom-control-label" for="tipo-pasto-4">Senza carne e pesce</label>
																	</div>
																	<div class="custom-control custom-radio">
																		<input type="radio" id="tipo-pasto-8" name="tipo-pasto" :class="{'custom-control-input':true, 'is-invalid': errors.has('tipo-pasto')}" value="TP8" v-model="preferenza.domanda.codiceTipoPasto" />
																		<label class="custom-control-label" for="tipo-pasto-8">Senza proteine animali</label>
																	</div>
																	<span class="invalid-feedback" v-show="errors.has('tipo-pasto')">{{ errors.first('tipo-pasto') }}</span>
																</div>
																<small class="form-text text-muted">
																	Potrai cambiare in ogni momento la scelta effettuata, dal giorno successivo all'accettazione, accedendo al servizio <a href="https://servizi.torinofacile.it/info/scelta-pasti-alternativi" target="_blank"><strong>Scelta pasti alternativi</strong></a> del Portale Torinofacile con le stesse credenziali che hai usato per inserire la domanda.
																</small>
																<small class="form-text text-muted">
																	<strong>NB:</strong> In caso di allergie o intolleranze alimentari per le quali &egrave; necessaria una dieta personalizzata, rivolgiti all'<a href="http://www.comune.torino.it/servizieducativi/ristorazionescolastica/menualternativi" target="_blank"><strong>ufficio Diete</strong></a> (011 01127556).
																</small>
															</div>
														</template>
														<div class="btn-group row">
															<div class="col-btn">
																<a href="#" role="button" class="btn btn-secondary" @click="gestioneDomandaMaterna(preferenza.domanda.idDomandaIscrizione)">Indietro</a>
															</div>
															<div class="col-btn"></div>
															<div class="col-btn btn-order-primary">
																<a href="#" role="button" class="btn btn-primary" @click="accetta">Accetta</a>
															</div>
														</div>
													</template>
												</div>