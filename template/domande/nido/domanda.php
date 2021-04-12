												<div>
													<h2 class="titleMobile">
														Preferenze
													</h2>
													<div class="form-step" v-if="domanda">
														<div class="list-link list-link-domanda">
															<p :class="domanda.codStatoDomanda">
																<span class="sr-only">Stato: </span>
																{{domanda.codStatoDomanda | statoDomanda}}
															</p>
															<h3>{{domanda.cognomeMinore}} {{domanda.nomeMinore}}</h3>
															<p>
																<span class="badge badge-scuola">{{domanda.codOrdineScuola | ordineScuola}}</span><br />
																<strong>Anno scolastico</strong>: {{domanda.annoScolastico}}<br />
																<strong>Domanda n&deg;</strong>: {{domanda.protocollo}}<br />
																<strong>Data invio</strong>: {{domanda.dataInvio}}
															</p>
															<hr class="my-5">
															<h4><a class="open-detail" data-toggle="collapse" href="#collapse-detailDomanda" role="button" aria-expanded="false" aria-controls="collapse-detailDomanda">Condizioni di punteggio <span class="sr-only">Visualizza dettagli</span></a></h4>															
															<div class="detail collapse" id="collapse-detailDomanda">
																<dl>
																	<template v-for="condizione in domanda.elencoCondizioniPunteggio">
																		<dt>{{condizione.descrizione}}</dt>
																		<dd v-if="condizione.occorrenze > 0">
																			Considerata per il punteggio
																			<template v-if="condizione.occorrenze < condizione.maxOccorrenze">
																				<strong>{{condizione.occorrenze}}</strong>
																				<template v-if="condizione.occorrenze == 1">
																					volta
																				</template>
																				<template v-else>
																					volte
																				</template>
																			</template>
																		</dd>
																		<dd v-else>Non considerata per il punteggio</dd>														
																		<dd v-if="condizione.note != ''"><strong>Note</strong>: {{condizione.note}}</dd>
																	</template>
																</dl>
															</div>
														</div>
														<h3 class="titleMobile">Elenco posti <small><a href="http://www.comune.torino.it/graduatoriescuole/" target="_blank">Consulta graduatoria</a></small></h3>
														<div :id="posto.codStatoScuola == 'AMM' ? 'ammesso' : ''" :class="['list-link', 'list-link-nidi', {'ammesso': posto.codStatoScuola == 'AMM'}]" v-for="(posto, index) in domanda.elencoPreferenze" :key="index">
															<div class="choice"><p>
																<strong>{{ index+1 }}&deg; scelta</strong>
															</p></div>
															<div class="detail">
																<p :class="posto.codStatoScuola">
																	<span class="sr-only">Stato: </span>
																	{{posto.codStatoScuola | statoPreferenzaNido}}
																</p>
																<h3>{{ posto.descrizione }} <span class="badge badge-scuola" v-if="['C','P'].indexOf(posto.codCategoriaScuola) !== -1">{{ posto.codCategoriaScuola | categoriaScuola }}</span></h3>
																<p>
																	<strong>Indirizzo</strong>: {{ posto.indirizzo }}<br />
																	<strong>Tempo frequenza</strong>: {{ posto.codTipoFrequenza | tipoFrequenza }}<br />																																	
																	<strong>Ultimo cambio stato</strong>: {{ posto.dataUltimoCambioStato }}<br />
																	<strong>Punteggio</strong>: {{ posto.punteggio }}
																</p>
															</div>
															<div class="btn-group-col" v-if="posto.codStatoScuola == 'AMM'">
																<div class="btn-row">
																	<div class="col">
																		<a href="#" role="button" class="btn btn-primary" @click="accetta(domanda, index, 'nido')">Accetta</a>
																	</div>
																	<div class="col">
																		<a href="#" role="button" class="btn btn-secondary" @click="rinuncia(domanda, index, 'nido')">Rinuncia</a>
																	</div>
																</div>
															</div>
														</div>
														<div class="btn-group row">
															<div class="col-btn"></div>
															<div class="col-btn"></div>
															<div class="col-btn btn-order-primary">
																<a href="#" role="button" class="btn btn-primary" @click="reloadDomande">Torna alle tue domande</a>
															</div>
														</div>
													</div>
												</div>