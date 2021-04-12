										<h2 class="no-bottom">Altri figli o figlie frequentanti o in corso di iscrizione</h2>
										<div class="form-step">
											<div class="alert alert-warning fade show" role="alert">
												<p><strong><big>ATTENZIONE</big></strong><br />
												Se ci sono pi&ugrave; figli o figlie, inserirne comunque uno solo</p>
												<p>Nella sezione vanno selezionati:</p>
												<ul>
													<li>eventuali figli gi&agrave; frequentanti il nido selezionato come prima scelta che continueranno la frequenza nell'anno scolastico per il quale viene presentata la domanda;</li>
													<li>eventuali altri figli per i quali si presenta la domanda di iscrizione per gli stessi nidi.</li>
												</ul>
											</div>
											<div class="form-row">
												<template v-if="elencoFigliFrequentanti.length > 0">
													<div id="fratello-frequentante" class="form-group col-md-12">
														<label class="col-form-label label-light col-md-12">Esistono altri figli o figlie frequentanti o in corso di iscrizione?<sub class="required">*</sub></label>
														<div class="custom-control custom-radio custom-control-inline">
															<input type="radio" id="fratello-frequentante-si" name="fratello-frequentante" :class="{'custom-control-input':true, 'is-invalid': errors.has('fratello-frequentante')}" :value="true" v-model="domanda.minore.fratelloFrequentante.stato" v-validate.disable="'required'" :disabled="elencoFigliFrequentanti.length < 1" />
															<label class="custom-control-label" for="fratello-frequentante-si">Si</label>
														</div>
														<div class="custom-control custom-radio custom-control-inline">
															<input type="radio" id="fratello-frequentante-no" name="fratello-frequentante" :class="{'custom-control-input':true, 'is-invalid': errors.has('fratello-frequentante')}" :value="false" v-model="domanda.minore.fratelloFrequentante.stato" :disabled="elencoFigliFrequentanti.length < 1" />
															<label class="custom-control-label" for="fratello-frequentante-no">No</label>
														</div>
														<span class="invalid-feedback" v-show="errors.has('fratello-frequentante')">{{ errors.first('fratello-frequentante') }}</span>
													</div>
													<template v-if="domanda.minore.fratelloFrequentante.stato === true">
														<div id="figlio-frequentante" class="form-group col-md-12">
															<label class="col-form-label label-light col-md-12">Scegli un figlio o una figlia tra quelli dichiarati in precedenza<sub class="required">*</sub></label>
															<hr />
															<div v-for="(figlio, index) in elencoFigliFrequentanti" :key="index" class="custom-control custom-radio">
																<input type="radio" :id="'figlio-frequentante'+index" name="figlio-frequentante" :class="{'custom-control-input':true, 'is-invalid': errors.has('figlio-frequentante')}" :value="figlio.codiceFiscale" v-model="domanda.minore.fratelloFrequentante.anagrafica.codiceFiscale" v-validate.disable="'required'" @change="setFigliFrequentanti" />
																<label class="custom-control-label" :for="'figlio-frequentante'+index">
																	<big><strong>{{ figlio.cognome }} {{ figlio.nome }}</strong></big><br />
																	{{ figlio.codiceFiscale }}<br />
																	<template v-if="figlio.sesso == 'M'">
																		nato
																	</template>
																	<template v-else>
																		nata
																	</template>
																	il {{ figlio.dataNascita }}<br />
																	cittadinanza: {{ figlio.descrizioneCittadinanza }}
																</label>
																<hr />
															</div>
															<span v-show="errors.has('figlio-frequentante')" class="invalid-feedback ml-4">{{ errors.first('figlio-frequentante') }}</span>
															<div class="form-row">
																<div id="fratello-frequentante-tipo" class="form-group col-md-6">
																	<label class="col-form-label col-md-12">Figlio o figlia<sub class="required">*</sub></label>
																	<div class="custom-control custom-radio custom-control-inline">
																		<input type="radio" id="fratello-frequentante-tipo-frequentante" name="fratello-frequentante-tipo" :class="{'custom-control-input':true, 'is-invalid': errors.has('fratello-frequentante-tipo')}" value="FREQ" v-model="domanda.minore.fratelloFrequentante.tipo" v-validate.disable="'required'" />
																		<label class="custom-control-label" for="fratello-frequentante-tipo-frequentante">Frequentante</label>
																	</div>
																	<div class="custom-control custom-radio custom-control-inline">
																		<input type="radio" id="fratello-frequentante-tipo-iscrivendo" name="fratello-frequentante-tipo" :class="{'custom-control-input':true, 'is-invalid': errors.has('fratello-frequentante-tipo')}" value="ISCR" v-model="domanda.minore.fratelloFrequentante.tipo" />
																		<label class="custom-control-label" for="fratello-frequentante-tipo-iscrivendo">Iscrivendo/a</label>
																	</div>
																	<span class="invalid-feedback" v-show="errors.has('fratello-frequentante-tipo')">{{ errors.first('fratello-frequentante-tipo') }}</span>
																</div>
															</div>					
														</div>
													</template>
												</template>													
												<template v-else>
													<div class="alert alert-info fade show" role="alert">
														<p>In base ai dati inseriti non risultano figli o figlie indicabili in questa sezione.</p>
													</div>
												</template>
											</div>												
											<div class="btn-group row">
												<div class="col-sm-12 col-md-12 col-lg-4">
													<a class="btn btn-secondary" href="#" role="button" @click="prevSubStep">Indietro</a>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-4 text-center">
													<a class="btn btn-secondary" href="#" role="button" @click="invioBozza">Salva bozza</a>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-4 btn-order-primary">
													<a class="btn btn-primary" href="#" role="button" @click="nextStep">Prosegui</a>
												</div>
											</div>
										</div>
