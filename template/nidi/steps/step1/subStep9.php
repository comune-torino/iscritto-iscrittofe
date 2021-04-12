										<h2 class="no-bottom">Dati relativi all'ISEE</h2>
										<div class="form-step">
											<div class="alert alert-info fade show" role="alert">
												<p>Indicare il valore ISEE per "PRESTAZIONI AGEVOLATE RIVOLTE A MINORENNI O A FAMIGLIE CON MINORENNI"
												reperibile nella seconda pagina dell'attestazione e riferito al bambino o alla bambina da iscrivere.</p>
												<p>L'ISEE deve essere valido al momento dell'inserimento della domanda.</p>
												<p>La data di fine validit&agrave; dell'ISEE &egrave; reperibile sulla prima pagina dell'attestazione, ultima riga, prima della firma del Direttore Generale.</p>
												<p>La presente dichiarazione &egrave; considerata solo ai fini della graduatoria e non per l'attribuzione della tariffa.</p>
											</div>
											<div class="form-row">
												<div id="isee" class="form-group col-md-12">
													<label class="col-form-label label-light col-md-12">Il nucleo del bambino o bambina &egrave; in possesso di un indicatore ISEE?<sub class="required">*</sub></label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="isee-si" name="isee" key="isee-si" :class="{'custom-control-input':true, 'is-invalid': errors.has('isee')}" :value="true" v-model="domanda.isee.stato" v-validate.disable="'required'" />
														<label class="custom-control-label" for="isee-si">Si</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="isee-no" name="isee" key="isee-no" :class="{'custom-control-input':true, 'is-invalid': errors.has('isee')}" :value="false" v-model="domanda.isee.stato" />
														<label class="custom-control-label" for="isee-no">No</label>
													</div>
													<span class="invalid-feedback" v-show="errors.has('isee')">{{ errors.first('isee') }}</span>
												</div>
											</div>
											<template v-if="domanda.isee.stato === true" v-cloak>
												<div class="card hight col-md-12 mb-4">
													<div class="card-body">
														<div class="form-row">
															<div class="form-group col-md-6">
																<label for="isee-valore" class="col-form-label">Valore ISEE<sub class="required">*</sub></label>
																<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('isee-valore')}" id="isee-valore" key="isee-valore" name="isee-valore" placeholder="Inserisci il valore nel formato 0,00" v-validate.disable="{required:true,regex:/^[0-9]+\,[0-9]{2}$/}" v-model="domanda.isee.dati.valore" />
																<span class="invalid-feedback" v-show="errors.has('isee-valore')">{{ errors.first('isee-valore') }}</span>
															</div>
															<div class="form-group col-md-6">
																<label for="isee-data" class="col-form-label">Valido fino al<sub class="required">*</sub></label>
																<input maxlength="10" type="text" :class="{'form-control':true, 'is-invalid': errors.has('isee-data')}" id="isee-data" key="isee-data" name="isee-data" placeholder="Inserisci la data nel formato GG/MM/AAAA"  v-validate.disable="'required|date_format:DD/MM/YYYY|gt_oggi:eq|isee_data'" v-model="domanda.isee.dati.dataAttestazione" v-mask="'##/##/####'" />
																<span class="invalid-feedback" v-show="errors.has('isee-data')">{{ errors.first('isee-data') }}</span>
															</div>
														</div>
													</div>
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
