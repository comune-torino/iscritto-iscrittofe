										<h2 class="no-bottom">Spostamento residenza o cambiamento di abitazione</h2>
										<div class="form-step">
											<div class="form-row mb-6">
												<div id="spostamento" class="form-group col-md-12">
													<label class="col-form-label label-light col-md-12">
														La domanda &egrave; presentata per un bambino o bambina il cui nucleo familiare:<sub class="required">*</sub>
														<ul>
															<li>non &egrave; residente a Torino ma si chiede l'attribuzione del punteggio di residenza per prossimo trasferimento (consapevole che se la residenza non sar&agrave; effettiva al momento dell'assegnazione del posto l'eventuale punteggio attribuito verr&agrave; tolto)?</li>
															<li>&egrave; residente a Torino e si chiede il punteggio aggiuntivo per la scuola statale, in quanto &egrave; in corso un cambiamento di abitazione nell'ambito dello stesso comune?</li>
														</ul>
													</label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="spostamento-si" name="spostamento" key="spostamento-si" :class="{'custom-control-input':true, 'is-invalid': errors.has('spostamento')}" :value="true" v-model="domanda.minore.spostamento.stato" v-validate.disable="'required'" />
														<label class="custom-control-label" for="spostamento-si">Si</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="spostamento-no" name="isee" key="spostamento-no" :class="{'custom-control-input':true, 'is-invalid': errors.has('spostamento')}" :value="false" v-model="domanda.minore.spostamento.stato" />
														<label class="custom-control-label" for="spostamento-no">No</label>
													</div>
												</div>
												<span class="invalid-feedback" v-show="errors.has('spostamento')">{{ errors.first('spostamento') }}</span>
												<template v-if="domanda.minore.spostamento.stato === true" v-cloak>
													<div class="card hight col-md-12 mb-4">
														<div class="card-body">
															<div id="spostamento-dati" class="form-row">
																<label class="col-form-label col-md-12">Il nucleo familiare del bambino o della bambina<sub class="required">*</sub></label>					
																<div class="form-group col-sm-12">
																	<div class="custom-control custom-radio">
																		<input type="radio" id="spostamento-variazione" key="spostamento-variazione" name="spostamento-dati" :class="{'custom-control-input':true, 'is-invalid': errors.has('spostamento-dati')}" value="VAR_RES" v-model="domanda.minore.spostamento.dati.stato" v-validate.disable="'required'" />
																		<label class="custom-control-label" for="spostamento-variazione">Ha fatto richiesta di variazione online della residenza o cambiamento di abitazione</label>
																	</div>
																</div>
																<template v-if="domanda.minore.spostamento.dati.stato == 'VAR_RES'" v-cloak>
																	<div class="form-group hight col-sm-12 col-md-6">
																		<label for="spostamento-variazione-data" class="col-form-label">Data richiesta<sub class="required">*</sub></label>
																		<input maxlength="10" type="data" :class="{'form-control':true, 'is-invalid': errors.has('spostamento-variazione-data')}" id="spostamento-variazione-data" key="spostamento-variazione-data" name="spostamento-variazione-data" placeholder="Inserisci la data nel formato GG/MM/AAAA"  v-validate.disable="{required:true,date_format:'DD/MM/YYYY',lt_oggi:'eq'}" v-model="domanda.minore.spostamento.dati.dataVariazione" v-mask="'##/##/####'" />
																		<span class="invalid-feedback" v-show="errors.has('spostamento-variazione-data')">{{ errors.first('spostamento-variazione-data') }}</span>
																	</div>
																</template>
																<div class="form-group col-md-12">
																	<div class="custom-control custom-radio">
																		<input type="radio" id="spostamento-appuntamento" key="spostamento-appuntamento" name="spostamento-dati" :class="{'custom-control-input':true, 'is-invalid': errors.has('spostamento-dati')}" value="APP_VAR_RES" v-model="domanda.minore.spostamento.dati.stato" />
																		<label class="custom-control-label" for="spostamento-appuntamento">Ha appuntamento all'anagrafe della Citt&agrave; di Torino per variazione residenza o cambiamento di abitazione</label>
																	</div>
																</div>
																<template v-if="domanda.minore.spostamento.dati.stato == 'APP_VAR_RES'" v-cloak>
																	<div class="form-group hight col-sm-12 col-md-6">
																		<label for="spostamento-appuntamento-data" class="col-form-label">Data appuntamento<sub class="required">*</sub></label>
																		<input maxlength="10" type="data" :class="{'form-control':true, 'is-invalid': errors.has('spostamento-appuntamento-data')}" id="spostamento-appuntamento-data" key="spostamento-appuntamento-data" name="spostamento-appuntamento-data" placeholder="Inserisci la data nel formato GG/MM/AAAA"  v-validate.disable="{required:true,date_format:'DD/MM/YYYY',gt_oggi:'eq'}" v-model="domanda.minore.spostamento.dati.dataAppuntamento" v-mask="'##/##/####'" />
																		<span class="invalid-feedback" v-show="errors.has('spostamento-appuntamento-data')">{{ errors.first('spostamento-appuntamento-data') }}</span>
																	</div>
																</template>
																<div class="form-group col-md-12">
																	<div class="custom-control custom-radio">
																		<input type="radio" id="spostamento-futuro" key="spostamento-futuro" name="spostamento-dati" :class="{'custom-control-input':true, 'is-invalid': errors.has('spostamento-dati')}" value="RES_FUT" v-model="domanda.minore.spostamento.dati.stato"  />
																		<label class="custom-control-label" for="spostamento-futuro">Presenter&agrave; richiesta di cambiamento di abitazione nella Citt&agrave; o di variazione di residenza per trasferimento a Torino</label>
																	</div>
																	<span class="invalid-feedback" v-show="errors.has('spostamento-dati')">{{ errors.first('spostamento-dati') }}</span>
																</div>
																<template v-if="domanda.minore.spostamento.dati.stato == 'RES_FUT'" v-cloak>
																	<div class="form-group hight col-sm-12 col-md-10">
																		<label for="spostamento-residenza-futura">
																			Motivazione trasferimento<sub class="required">*</sub>
																		</label>
																		<textarea id="spostamento-residenza-futura" key="spostamento-residenza-futura" name="spostamento-residenza-futura" :class="{'form-control':true, 'is-invalid': errors.has('spostamento-residenza-futura')}" rows="3" cols="60" placeholder="Inserisci motivazione" v-model="domanda.minore.spostamento.dati.residenzaFutura" v-validate.disable="'required'"></textarea>
																		<span class="invalid-feedback" v-show="errors.has('spostamento-residenza-futura')">{{ errors.first('spostamento-residenza-futura') }}</span>
																	</div>
																</template>
																<div class="form-group col-sm-12 col-md-6">
																	<label for="spostamento-indirizzo">Indirizzo futuro<sub class="required">*</sub></label>
																	<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('spostamento-indirizzo')}" id="spostamento-indirizzo" key="spostamento-indirizzo" name="spostamento-indirizzo" placeholder="inserisci l'indirizzo" v-model="domanda.minore.spostamento.dati.indirizzo" v-validate.disable="'required'" />
																	<span class="invalid-feedback" v-show="errors.has('spostamento-indirizzo')">{{ errors.first('spostamento-indirizzo') }}</span>
																</div>
															</div>
														</div>
													</div>
												</template>
											</div>		
											<h2>Cambio della scuola di frequenza</h2>	
											<div class="form-row mb-6">
												<div id="trasferimento" class="form-group col-md-12">
													<label class="col-form-label label-light col-md-12">La domanda &egrave; presentata perch&eacute; il bambino o la bambina sta frequentando una scuola dell'infanzia comunale, convenzionata o statale di Torino e si richiede il cambio della scuola di frequenza perch&eacute; &egrave; variato l'indirizzo di residenza?<sub class="required">*</sub></label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="trasferimento-si" name="trasferimento" key="trasferimento-si" :class="{'custom-control-input':true, 'is-invalid': errors.has('trasferimento')}" :value="true" v-model="domanda.minore.trasferimento.stato" v-validate.disable="'required'" @change="domanda.minore.cinqueAnniNonFrequentante = anni5 ? 'S' : ''" />
														<label class="custom-control-label" for="trasferimento-si">Si</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="trasferimento-no" name="trasferimento" key="trasferimento-no" :class="{'custom-control-input':true, 'is-invalid': errors.has('trasferimento')}" :value="false" v-model="domanda.minore.trasferimento.stato" @change="domanda.minore.cinqueAnniNonFrequentante = ''" />
														<label class="custom-control-label" for="trasferimento-no">No</label>
													</div>
												</div>
												<span class="invalid-feedback" v-show="errors.has('trasferimento')">{{ errors.first('trasferimento') }}</span>
												<template v-if="domanda.minore.trasferimento.stato === true" v-cloak>
													<div class="card hight col-md-12 mb-4">
														<div class="card-body">
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label for="trasferimento-indirizzo-vecchio">Indirizzo precedente residenza<sub class="required">*</sub></label>
																	<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('trasferimento-indirizzo-vecchio')}" id="trasferimento-indirizzo-vecchio" key="trasferimento-indirizzo-vecchio" name="trasferimento-indirizzo-vecchio" placeholder="Inserisci l'indirizzo" v-model="domanda.minore.trasferimento.dati.indirizzoVecchio" v-validate.disable="'required'" />
																	<span class="invalid-feedback" v-show="errors.has('trasferimento-indirizzo-vecchio')">{{ errors.first('trasferimento-indirizzo-vecchio') }}</span>
																</div>
																<div class="form-group col-md-6">
																	<label for="trasferimento-indirizzo-nuovo" class="col-form-label">Indirizzo nuova residenza<sub class="required">*</sub></label>
																	<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('trasferimento-indirizzo-nuovo')}" id="trasferimento-indirizzo-nuovo" key="trasferimento-indirizzo-nuovo" name="trasferimento-indirizzo-nuovo" placeholder="Inserisci l'indirizzo" v-model="domanda.minore.trasferimento.dati.indirizzoNuovo" v-validate.disable="'required'" />
																	<span class="invalid-feedback" v-show="errors.has('trasferimento-indirizzo-nuovo')">{{ errors.first('trasferimento-indirizzo-nuovo') }}</span>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label for="trasferimento-data" class="col-form-label">Data cambio residenza<sub class="required">*</sub></label>
																	<input maxlength="10" type="text" :class="{'form-control':true, 'is-invalid': errors.has('trasferimento-data')}" id="trasferimento-data" key="trasferimento-data" name="trasferimento-data" placeholder="Inserisci la data nel formato GG/MM/AAAA"  v-validate.disable="'required|date_format:DD/MM/YYYY|lt_oggi:eq'" v-model="domanda.minore.trasferimento.dati.data" v-mask="'##/##/####'" />
																	<span class="invalid-feedback" v-show="errors.has('trasferimento-data')">{{ errors.first('trasferimento-data') }}</span>
																</div>
																<div class="form-group col-md-6">
																	<label for="trasferimento-indirizzo-scuola" class="col-form-label">Indirizzo della scuola di provenienza<sub class="required">*</sub></label>
																	<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('trasferimento-indirizzo-scuola')}" id="trasferimento-indirizzo-scuola" key="trasferimento-indirizzo-scuola" name="trasferimento-indirizzo-scuola" placeholder="Inserisci l'indirizzo" v-model="domanda.minore.trasferimento.dati.indirizzo" v-validate.disable="'required'" />
																	<span class="invalid-feedback" v-show="errors.has('trasferimento-indirizzo-scuola')">{{ errors.first('trasferimento-indirizzo-scuola') }}</span>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label for="trasferimento-dal" class="col-form-label">Frequenza nella scuola di provenienza dal<sub class="required">*</sub></label>
																	<input maxlength="10" type="text" :class="{'form-control':true, 'is-invalid': errors.has('trasferimento-dal')}" id="trasferimento-dal" key="trasferimento-dal" name="trasferimento-dal" placeholder="Inserisci la data nel formato GG/MM/AAAA"  v-validate.disable="'required|date_format:DD/MM/YYYY|lt_oggi:eq'" v-model="domanda.minore.trasferimento.dati.dataDal" v-mask="'##/##/####'" ref="trasferimento-dal" />
																	<span class="invalid-feedback" v-show="errors.has('trasferimento-dal')">{{ errors.first('trasferimento-dal') }}</span>
																</div>
															</div>
														</div>
													</div>
												</template>
												<template v-else-if="(domanda.minore.trasferimento.stato === false && anni5)">
													<div class="card hight col-md-12">
														<div class="card-body">
															<div class="form-row">
																<div id="minoreAnni5" class="form-group col-md-12">
																	<label class="col-form-label col-md-12">Il bambino o la bambina<sub class="required">*</sub></label>
																	<div class="custom-control custom-radio custom-control-inline">
																		<input type="radio" id="minoreAnni5-n" name="minoreAnni5" key="minoreAnni5-n" :class="{'custom-control-input':true, 'is-invalid': errors.has('minoreAnni5')}" value="N" v-model="domanda.minore.cinqueAnniNonFrequentante" v-validate.disable="'required'"/>
																		<label class="custom-control-label" for="minoreAnni5-n">Ha frequentato una scuola dell'infanzia di Torino nell'anno scolastico <strong>{{ domanda.annoScolastico | annoPrec }}</strong> e si &egrave; ritirato o ritirata</label>
																	</div>
																	<div class="custom-control custom-radio custom-control-inline">
																		<input type="radio" id="minoreAnni5-f" name="minoreAnni5" key="minoreAnni5-f" :class="{'custom-control-input':true, 'is-invalid': errors.has('minoreAnni5')}" value="F" v-model="domanda.minore.cinqueAnniNonFrequentante" />
																		<label class="custom-control-label" for="minoreAnni5-f">Ha accettato il posto per una scuola dell'infanzia di Torino nell'anno scolastico <strong>{{ domanda.annoScolastico }}</strong> e si &egrave; ritirato o ritirata</label>
																	</div>
																	<div class="custom-control custom-radio custom-control-inline">
																		<input type="radio" id="minoreAnni5-s" name="minoreAnni5" key="minoreAnni5-s" :class="{'custom-control-input':true, 'is-invalid': errors.has('minoreAnni5')}" value="S" v-model="domanda.minore.cinqueAnniNonFrequentante" />
																		<label class="custom-control-label" for="minoreAnni5-s">Non si trova in alcuna delle precedenti situazioni</label>
																	</div>
																</div>
																<span class="invalid-feedback" v-show="errors.has('minoreAnni5')">{{ errors.first('minoreAnni5') }}</span>
															</div>
														</div>				
													</div>
												</template>
											</div>
											<template v-if="(anni4 || anni5)">
												<h2>Lista d'attesa</h2>
												<div class="form-row">
													<div id="lista-attesa" class="form-group col-md-12">
														<label class="col-form-label label-light col-md-12">La domanda di iscrizione &egrave; rimasta in lista d'attesa in precedenti graduatorie delle scuole dell'infanzia comunali, convenzionate e statali?<sub class="required">*</sub></label>
														<div class="custom-control custom-radio custom-control-inline">
															<input type="radio" id="lista-attesa-si" name="lista-attesa" key="lista-attesa-si" :class="{'custom-control-input':true, 'is-invalid': errors.has('lista-attesa')}" :value="true" v-model="domanda.minore.listaAttesa.stato" v-validate.disable="'required'" />
															<label class="custom-control-label" for="lista-attesa-si">Si</label>
														</div>
														<div class="custom-control custom-radio custom-control-inline">
															<input type="radio" id="lista-attesa-no" name="lista-attesa" key="lista-attesa-no" :class="{'custom-control-input':true, 'is-invalid': errors.has('lista-attesa')}" :value="false" v-model="domanda.minore.listaAttesa.stato" />
															<label class="custom-control-label" for="lista-attesa-no">No</label>
														</div>
													</div>
													<span class="invalid-feedback" v-show="errors.has('lista-attesa')">{{ errors.first('lista-attesa') }}</span>					
													<template v-if="domanda.minore.listaAttesa.stato === true">
														<div class="card hight col-md-12">
															<div class="card-body">
																<div class="alert alert-info fade show" role="alert">
																	<p>E' obbligatorio completare almeno un anno scolastico inserendo il relativo nome della scuola.<br />
																	Per ogni anno scolastico &egrave; sufficiente indicare una sola scuola, anche se la domanda &egrave; stata in lista d'attesa in pi&ugrave; scuole.</p>
																</div>
																<div class="form-row">
																	<div class="form-group col-sm-12 col-md-6">
																		<label for="lista-attesa-1">Anno scolastico {{ domanda.annoScolastico | annoPrec }}</label>
																		<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('lista-attesa-1')}" id="lista-attesa-1" key="lista-attesa-1" name="lista-attesa-1" placeholder="inserisci la scuola" v-model="domanda.minore.listaAttesa.dati.primoAnno.scuola" v-validate.disable="{required: domanda.minore.listaAttesa.dati.secondoAnno.scuola == ''}" @input="domanda.minore.listaAttesa.dati.primoAnno.annoScolastico = domanda.minore.listaAttesa.dati.primoAnno.scuola != '' ? $options.filters.annoPrec(domanda.annoScolastico) : ''" />
																		<span class="invalid-feedback" v-show="errors.has('lista-attesa-1')">{{ errors.first('lista-attesa-1') }}</span>
																	</div>
																	<div class="form-group col-sm-12 col-md-6">
																		<label for="lista-attesa-2">Anno scolastico {{ domanda.annoScolastico | annoPrecPrec }}</label>
																		<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('lista-attesa-2')}" id="lista-attesa-2" key="lista-attesa-2" name="lista-attesa-2" placeholder="inserisci la scuola" v-model="domanda.minore.listaAttesa.dati.secondoAnno.scuola" v-validate.disable="{required: domanda.minore.listaAttesa.dati.primoAnno.scuola == ''}" @input="domanda.minore.listaAttesa.dati.secondoAnno.annoScolastico = domanda.minore.listaAttesa.dati.secondoAnno.scuola != '' ? $options.filters.annoPrecPrec(domanda.annoScolastico) : ''" />
																		<span class="invalid-feedback" v-show="errors.has('lista-attesa-1')">{{ errors.first('lista-attesa-2') }}</span>
																	</div>
																</div>
															</div>				
														</div>
													</template>
												</div>
											</template>
											<div class="btn-group row">
												<div class="col-sm-12 col-md-12 col-lg-4">
													<a class="btn btn-secondary" href="#" role="button" @click="prevSubStep">Indietro</a>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-4"><!--space--></div>
												<div class="col-sm-12 col-md-12 col-lg-4 btn-order-primary">
													<a class="btn btn-primary" href="#" role="button" @click="nextSubStep">Prosegui</a>
												</div>
											</div>
										</div>
