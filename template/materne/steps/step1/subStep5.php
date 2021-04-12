										<h2 class="no-bottom">Condizione di coabitazione dei genitori</h2>
										<div class="form-step">
											<div class="alert alert-info fade show" role="alert">
												<p>Si intende "coabitante" chi &egrave; presente nello stesso stato di famiglia o chi, pur non risultando nello stesso stato di famiglia, di fatto abita con il bambino o la bambina.</p>
												<p>Ai fini della domanda &egrave; considerato coniugato o coniugata chi non &egrave; legalmente separato o separata n&eacute; ha presentato istanza di separazione.</p>
											</div>
											<div id="richiedente-condizione-coabitazione" class="form-row">
												<template v-if="domanda.minore.residenzaConRichiedente === true">
													<div class="form-group col-md-12">
														<div class="custom-control custom-radio">
															<input type="radio" id="richiedente-condizione-coabitazione-a" key="condizione-coabitazione-a" name="richiedente-condizione-coabitazione" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-condizione-coabitazione')}" value="A" v-model="domanda.richiedente.condizioneCoabitazione" v-validate.disable="'required'" />
															<label class="custom-control-label" for="richiedente-condizione-coabitazione-a">Coabito con l'altro genitore</label>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="custom-control custom-radio">
															<input type="radio" id="richiedente-condizione-coabitazione-b" key="condizione-coabitazione-b" name="richiedente-condizione-coabitazione" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-condizione-coabitazione')}" value="B" v-model="domanda.richiedente.condizioneCoabitazione" v-validate.disable="'required'" />
															<label class="custom-control-label" for="richiedente-condizione-coabitazione-b">Sono coniugato o unito civilmente con l'altro genitore ma non coabito con lui/lei</label>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="custom-control custom-radio">
															<input type="radio" id="richiedente-condizione-coabitazione-c" key="condizione-coabitazione-c" name="richiedente-condizione-coabitazione" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-condizione-coabitazione')}" value="C" v-model="domanda.richiedente.condizioneCoabitazione" v-validate.disable="'required'" />
															<label class="custom-control-label" for="richiedente-condizione-coabitazione-c">Sono coniugato o unito civilmente o ho sottoscritto convivenza di fatto con persona che non &egrave; l'altro genitore</label>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="custom-control custom-radio">
															<input type="radio" id="richiedente-condizione-coabitazione-d" key="condizione-coabitazione-d" name="richiedente-condizione-coabitazione" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-condizione-coabitazione')}" value="D" v-model="domanda.richiedente.condizioneCoabitazione" v-validate.disable="'required'" />
															<label class="custom-control-label" for="richiedente-condizione-coabitazione-d">Non sono in nessuna di queste situazioni</label>
														</div>
													</div>
													<span class="invalid-feedback" v-show="errors.has('richiedente-condizione-coabitazione')">{{ errors.first('richiedente-condizione-coabitazione') }}</span>
												</template>
												<template v-else>
													<div class="form-group col-md-12">
														<div class="custom-control custom-radio">
															<input type="radio" id="richiedente-condizione-coabitazione-g" key="condizione-coabitazione-g" name="richiedente-condizione-coabitazione" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-condizione-coabitazione')}" value="G" v-model="domanda.richiedente.condizioneCoabitazione" v-validate.disable="'required'" />
															<label class="custom-control-label" for="richiedente-condizione-coabitazione-g">Il genitore che coabita con il bambino o la bambina &egrave; coniugato o unito civilmente con il genitore richiedente</label>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="custom-control custom-radio">
															<input type="radio" id="richiedente-condizione-coabitazione-e" key="condizione-coabitazione-e" name="richiedente-condizione-coabitazione" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-condizione-coabitazione')}" value="E" v-model="domanda.richiedente.condizioneCoabitazione" v-validate.disable="'required'" />
															<label class="custom-control-label" for="richiedente-condizione-coabitazione-e">Il genitore che coabita con il bambino o la bambina &egrave; coniugato o unito civilmente o ha sottoscritto convivenza di fatto con persona che non &egrave; l'altro genitore</label>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="custom-control custom-radio">
															<input type="radio" id="richiedente-condizione-coabitazione-f" key="condizione-coabitazione-f" name="richiedente-condizione-coabitazione" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-condizione-coabitazione')}" value="F" v-model="domanda.richiedente.condizioneCoabitazione" v-validate.disable="'required'" />
															<label class="custom-control-label" for="richiedente-condizione-coabitazione-f">Il genitore coabitante non &egrave; coniugato o unito civilmente n&eacute; ha sottoscritto convivenza di fatto (genitore solo)</label>
														</div>
													</div>
													<span class="invalid-feedback" v-show="errors.has('richiedente-condizione-coabitazione')">{{ errors.first('richiedente-condizione-coabitazione') }}</span>
												</template>
											</div>
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
