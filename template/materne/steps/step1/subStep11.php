										<h2 class="no-bottom">Insegnamento religione cattolica</h2>
										<div class="form-step">
											<div class="alert alert-info fade show" role="alert">
												<p><strong>Legge n.121 del 25 marzo 1985, Art.9.2</strong><br />
													<small>"La Repubblica Italiana, riconoscendo il valore della cultura religiosa e tenendo conto che i principi del cattolicesimo fanno parte del patrimonio storico del popolo italiano, continuer&agrave; ad assicurare, nel quadro delle finalit&agrave; della scuola, l'insegnamento della religione cattolica nelle scuole pubbliche non universitarie di ogni ordine e grado.<br />
													Nel rispetto della libert&agrave; di coscienza e della responsabilit&agrave; educativa dei genitori, &egrave; garantito a ciascuno il diritto di scegliere se avvalersi o non avvalersi di detto insegnamento.<br />
													All'atto dell'iscrizione gli studenti o i loro genitori eserciteranno tale diritto, su richiesta dell'autorit&agrave; scolastica, senza che la loro scelta possa dar luogo ad alcuna forma di discriminazione".</small>
												</p>
											</div>
											<div class="form-row mb-6">
												<div id="irc" class="form-group col-md-12">
													<label class="col-form-label label-light col-md-12">Intende avvalersi dell'insegnamento della religione cattolica?<sub class="required">*</sub></label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="irc-si" name="irc" key="irc-si" :class="{'custom-control-input':true, 'is-invalid': errors.has('irc')}" value="S" v-model="domanda.flIrc" v-validate.disable="'required'" />
														<label class="custom-control-label" for="irc-si">Si</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="irc-no" name="isee" key="irc-no" :class="{'custom-control-input':true, 'is-invalid': errors.has('irc')}" value="N" v-model="domanda.flIrc" />
														<label class="custom-control-label" for="irc-no">No</label>
													</div>
												</div>
												<span class="invalid-feedback" v-show="errors.has('irc')">{{ errors.first('irc') }}</span>
											</div>
											<div class="card my-8 mx-2">
												<div class="card-body p-2">
													<small>Premesso che lo Stato assicura l'insegnamento della religione cattolica nelle scuole di ogni ordine e grado in conformit&agrave; all'Accordo che apporta modifiche al Concordato Lateranense (art. 9.2), il presente modulo costituisce richiesta delle autorit&agrave; scolastiche Statale e Comunale in ordine all'esercizio del diritto di scegliere se avvalersi o non avvalersi dell'insegnamento della religione cattolica. La scelta operata all'atto dell'iscrizione ha effetto per l'intero anno scolastico cui si riferisce e per i successivi anni di corso in cui sia prevista l'iscrizione d'ufficio, fermo restando, anche nelle modalit&agrave; di applicazione, il diritto di scegliere ogni anno se avvalersi o non avvalersi dell'insegnamento della religione cattolica.</small>
												</div>
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
