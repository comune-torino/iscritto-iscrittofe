										<h2 class="no-bottom">Altri soggetti presenti nel nucleo familiare del bambino o bambina</h2>
										<div class="form-step">
											<div class="alert alert-warning fade show" role="alert">
												<p><strong><big>ATTENZIONE</big></strong><br />
												Con il grado di parentela "figlio/figlia" devono essere dichiarati i figli o le figlie delle persone indicate nelle sezioni 1.5 e 1.6</p>
											</div>
											<template v-if="domanda.componentiNucleo.soggetti.length > 0" v-cloak>
												<div v-for="(componenteNucleo, index) in domanda.componentiNucleo.soggetti" :key="'cardComponenteNucleo-'+index" class="card hight col-md-12 mb-4">
													<div class="card-body">
														<div class="form-row">
															<div class="form-group col-md-12">
																<big><strong>{{ componenteNucleo.anagrafica.cognome }} {{ componenteNucleo.anagrafica.nome }}</strong></big><br />
																{{ componenteNucleo.anagrafica.codiceFiscale }}<br />
																<template v-if="componenteNucleo.anagrafica.sesso == 'M'">
																	nato
																</template>
																<template v-else>
																	nata
																</template>
																<template v-if="(componenteNucleo.luogoNascita.codNazione == '000' && componenteNucleo.luogoNascita.descComune == componenteNucleo.luogoNascita.descProvincia)">
																	{{ componenteNucleo.luogoNascita.descComune }}
																</template>
																<template v-else-if="(componenteNucleo.luogoNascita.codNazione == '000' && componenteNucleo.luogoNascita.descComune != componenteNucleo.luogoNascita.descProvincia)">
																	{{ componenteNucleo.luogoNascita.descComune }}, provincia di {{ componenteNucleo.luogoNascita.descProvincia }},
																</template>
																<template v-else-if="componenteNucleo.luogoNascita.codNazione != '000'">
																	{{ componenteNucleo.luogoNascita.descComune }} ({{ componenteNucleo.luogoNascita.descNazione }})
																</template>
																il {{ componenteNucleo.anagrafica.dataNascita }}<br />
																cittadinanza: {{ componenteNucleo.anagrafica.descrizioneCittadinanza }}
																<hr />
															</div>
														</div>
														<grado-parentela v-model="componenteNucleo.relazioneConMinore" target="componenteNucleo" :key="'componenteNucleoRelazione-'+index" :index="index" casistica="nucleo">
															<label class="col-form-label col-md-12">Grado di parentela<sub class="required">*</sub></label>
														</grado-parentela>
														<problemi-salute v-model="componenteNucleo.problemiSalute" target="componenteNucleo" :key="'componenteNucleoSalute-'+index" :index="index">
															<label class="col-form-label col-md-12">Gravi problemi di salute?<sub class="required">*</sub></label>
														</problemi-salute>
													</div>
												</div>
											</template>
											<div class="form-row">
												<div id="altri-componenti" class="form-group col-md-12">
													<label v-if="domanda.minore.presenzaNucleo === true" class="col-form-label label-light col-md-12">Coabitano altri minori in affidamento familiare ai sensi della L.184/83 non compresi nel nucleo anagrafico?<sub class="required">*</sub></label>
													<label v-else class="col-form-label label-light col-md-12">Sono presenti altre persone nel nucleo anagrafico o minori in affidamento familiare ai sensi della legge 184/83?<sub class="required">*</sub></label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="altri-componenti-si" name="altri-componenti" key="altri-componenti-si" :class="{'custom-control-input':true, 'is-invalid': errors.has('altri-componenti')}" :value="true" v-model="domanda.altriComponenti.stato" v-validate.disable="'required'" />
														<label class="custom-control-label" for="altri-componenti-si">Si</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="altri-componenti-no" name="altri-componenti" key="altri-componenti-no" :class="{'custom-control-input':true, 'is-invalid': errors.has('altri-componenti')}" :value="false" v-model="domanda.altriComponenti.stato" />
														<label class="custom-control-label" for="altri-componenti-no">No</label>
													</div>
													<span class="invalid-feedback" v-show="errors.has('altri-componenti')">{{ errors.first('altri-componenti') }}</span>
												</div>
											</div>
											<template v-if="domanda.altriComponenti.stato === true" v-cloak>
												<div v-for="(altroComponente, index) in domanda.altriComponenti.soggetti" :key="'cardAltroComponente-'+index" class="card hight col-md-12 mb-4">
													<div class="card-body">
														<anagrafica v-model="altroComponente.anagrafica" :cittadinanza="cittadinanza" target="altroComponente" :key="'altroComponenteAnagrafica-'+index" :index="index"></anagrafica>
														<luoghi v-model="altroComponente.luogoNascita" :stati="stati" :regioni="regioni" casistica="nascita" target="altroComponente" :key="'altroComponenteNascita-'+index" :index="index"></luoghi>
														<luoghi v-model="altroComponente.residenza" :stati="stati" :regioni="regioni" casistica="residenza" target="altroComponente" :key="'altroComponenteResidenza-'+index" :index="index"></luoghi>
														<grado-parentela v-model="altroComponente.relazioneConMinore" target="altroComponente" :key="'altroComponenteRelazione-'+index" :index="index" :casistica="domanda.minore.presenzaNucleo === true ? 'affido' : 'nucleo'">
															<label class="col-form-label col-md-12">Grado di parentela<sub class="required">*</sub></label>
														</grado-parentela>
														<problemi-salute v-model="altroComponente.problemiSalute" target="altroComponente" :key="'altroComponenteSalute-'+index" :index="index">
															<label class="col-form-label col-md-12">Gravi problemi di salute?<sub class="required">*</sub></label>
														</problemi-salute>
														<div class="form-row pt-4">
															<div class="form-group col-sm-12 text-right">
																<button type="button" class="btn btn-secondary" @click="addAltroComponente(index)"><i class="fa fa-plus-circle" aria-hidden="true"></i> Aggiungi componente</button>
																<button v-show="domanda.altriComponenti.soggetti.length > 1" type="button" class="btn btn-secondary" @click="removeAltroComponente(index)"><i class="fa fa-times-circle" aria-hidden="true"></i> Elimina componente</button>
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
