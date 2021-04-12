										<h2 class="no-bottom">Dati del richiedente</h2>
										<p>(Persona che esercita la responsabilit&agrave; genitoriale)</p>
										<div class="form-step">
											<anagrafica v-model="domanda.richiedente.anagrafica" :soggetto="famiglia.richiedente.anagrafica" :cittadinanza="cittadinanza" target="richiedente" key="richiedenteAnagrafica"></anagrafica>
											<luoghi v-model="domanda.richiedente.luogoNascita" :soggetto="famiglia.richiedente.luogoNascita" :stati="stati" :regioni="regioni" casistica="nascita" target="richiedente" key="richiedenteNascita"></luoghi>
											<luoghi v-model="domanda.richiedente.residenza" :soggetto="famiglia.residenza" :stati="stati" :regioni="regioni" casistica="residenza" target="richiedente" key="richiedenteResidenza"></luoghi>
											<div class="form-row">
												<div class="form-group col-sm-12 col-md-6">
													<label for="richiedente-telefono" class="col-form-label">Cellulare<sub class="required">*</sub></label>
													<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('richiedente-telefono')}" id="richiedente-telefono" name="richiedente-telefono" placeholder="Inserisci un solo n. di cellulare" v-validate.disable="{required:true,regex:/^\+?[0-9]{6,16}$/}" v-mask="'X###############'" v-model="domanda.richiedente.telefono" :disabled="famiglia.richiedente.telefono != ''" aria-describedby="cellulareHelp" />
													<small id="cellulareHelp" class="form-text text-muted">sul quale accetto che vengano inviate comunicazioni relative alla domanda di iscrizione</small>
													<span class="invalid-feedback" v-show="errors.has('richiedente-telefono')">{{ errors.first('richiedente-telefono') }}</span>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-sm-12 col-md-12">
													<label for="richiedente-recapito-noresidenza">Eventuale recapito diverso dalla residenza</label>
													<textarea id="recapito" class="form-control" rows="5" cols="40" placeholder="inserisci l'eventuale recapito" v-model="domanda.richiedente.recapitoNoResidenza"></textarea>
												</div>
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
