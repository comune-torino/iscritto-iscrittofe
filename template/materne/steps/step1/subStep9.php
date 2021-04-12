										<h2 class="no-bottom">Figli e figlie in affidamento condiviso</h2>
										<p>(si intendono i figli o le figlie delle persone indicate nelle sezioni 1.5 e 1.6)</p>
										<div class="form-step">
											<div class="form-row">
												<div id="affido" class="form-group col-md-12">
													<label class="col-form-label label-light col-md-12">Ci sono figli o figlie in affidamento condiviso non compresi nel nucleo anagrafico del bambino o bambina?<sub class="required">*</sub></label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="affido-si" name="affido" key="affido-si" :class="{'custom-control-input':true, 'is-invalid': errors.has('affido')}" :value="true" v-model="domanda.affido.stato" v-validate.disable="'required'" />
														<label class="custom-control-label" for="affido-si">Si</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="affido-no" name="affido" key="affido-no" :class="{'custom-control-input':true, 'is-invalid': errors.has('affido')}" :value="false" v-model="domanda.affido.stato" />
														<label class="custom-control-label" for="affido-no">No</label>
													</div>
													<span class="invalid-feedback" v-show="errors.has('affido')">{{ errors.first('affido') }}</span>
												</div>
											</div>
											<template v-if="domanda.affido.stato === true" v-cloak>
												<div v-for="(affido, index) in domanda.affido.soggetti" :key="'cardAffido-'+index" class="card hight col-md-12 mb-4">
													<div class="card-body">
														<h3>Dati anagrafici</h3>
														<anagrafica v-model="affido.anagrafica" :cittadinanza="cittadinanza" target="affido" :key="'affidoAnagrafica-'+index" :index="index"></anagrafica>
														<luoghi v-model="affido.luogoNascita" :stati="stati" :regioni="regioni" casistica="nascita" target="affido" :key="'affidoNascita-'+index" :index="index"></luoghi>
														<luoghi v-model="affido.residenza" :stati="stati" :regioni="regioni" casistica="residenza" target="affido" :key="'affidoResidenza-'+index" :index="index"></luoghi>
														<dati-sentenza v-model="affido.sentenza" :id="'id'+index" :key="'affidoSentenza-'+index" :required="false">
															<h3>Provvedimento di affidamento</h3>
														</dati-sentenza>
														<problemi-salute v-model="affido.problemiSalute" target="affido" :key="'affidoSalute-'+index" :index="index">
															<label class="col-form-label col-md-12">Gravi problemi di salute?<sub class="required">*</sub></label>
														</problemi-salute>
														<div class="form-row pt-4">
															<div class="form-group col-sm-12 text-right">
																<button type="button" class="btn btn-secondary" @click="addAffido(index)"><i class="fa fa-plus-circle" aria-hidden="true"></i> Aggiungi figlio/a in affido</button>
																<button v-show="domanda.affido.soggetti.length > 1" type="button" class="btn btn-secondary" @click="removeAffido(index)"><i class="fa fa-times-circle" aria-hidden="true"></i> Elimina figlio/a in affido</button>
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
