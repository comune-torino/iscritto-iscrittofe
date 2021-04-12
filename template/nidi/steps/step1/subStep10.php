<div class="form-step">
	<h2 class="no-bottom">Spostamento residenza a Torino</h2>
	<div class="form-row mb-6">
		<div id="spostamento" class="form-group col-md-12">
			<label class="col-form-label label-light col-md-12">La domanda &egrave; presentata per un bambino o bambina il cui nucleo familiare non &egrave; residente a Torino ma si chiede l'attribuzione del punteggio di residenza per prossimo trasferimento (consapevole che se la residenza non sar&agrave; effettiva al momento dell'assegnazione del posto l'eventuale punteggio attribuito verr&agrave; tolto)?<sub class="required">*</sub></label>
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
								<label class="custom-control-label" for="spostamento-variazione">Ha fatto richiesta di variazione residenza</label>
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
								<label class="custom-control-label" for="spostamento-appuntamento">Ha appuntamento all'anagrafe della Citt&agrave; di Torino per variazione residenza</label>
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
								<label class="custom-control-label" for="spostamento-futuro">Si trasferir&agrave; a Torino e presenter&agrave; richiesta di variazione di residenza</label>
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
					</div>
				</div>
			</div>
		</template>
	</div>
	<h2 class="no-bottom">Cambio del nido di frequenza</h2>
	<div class="form-row">
		<div id="trasferimento" class="form-group col-md-12">
			<label class="col-form-label label-light col-md-12">La domanda &egrave presentata perch&eacute il bambino o la bambina sta frequentando un nido d'infanzia comunale o convenzionato di Torino e si richiede il cambio del nido di frequenza perch&eacute &egrave variato l'indirizzo di residenza?<sub class="required">*</sub></label>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="trasferimento-si" name="trasferimento" key="trasferimento-si" :class="{'custom-control-input':true, 'is-invalid': errors.has('trasferimento')}" :value="true" v-model="domanda.minore.trasferimento.stato" v-validate.disable="'required'" />
				<label class="custom-control-label" for="trasferimento-si">Si</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="trasferimento-no" name="trasferimento" key="trasferimento-no" :class="{'custom-control-input':true, 'is-invalid': errors.has('trasferimento')}" :value="false" v-model="domanda.minore.trasferimento.stato" />
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
							<label for="trasferimento-indirizzo-nido" class="col-form-label">Indirizzo del nido di provenienza<sub class="required">*</sub></label>
							<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('trasferimento-indirizzo-nido')}" id="trasferimento-indirizzo-nido" key="trasferimento-indirizzo-nido" name="trasferimento-indirizzo-nido" placeholder="Inserisci l'indirizzo" v-model="domanda.minore.trasferimento.dati.indirizzo" v-validate.disable="'required'" />
							<span class="invalid-feedback" v-show="errors.has('trasferimento-indirizzo-nido')">{{ errors.first('trasferimento-indirizzo-nido') }}</span>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="trasferimento-dal" class="col-form-label">Frequenza nel nido di provenienza dal<sub class="required">*</sub></label>
							<input maxlength="10" type="text" :class="{'form-control':true, 'is-invalid': errors.has('trasferimento-dal')}" id="trasferimento-dal" key="trasferimento-dal" name="trasferimento-dal" placeholder="Inserisci la data nel formato GG/MM/AAAA"  v-validate.disable="'required|date_format:DD/MM/YYYY|lt_oggi:eq'" v-model="domanda.minore.trasferimento.dati.dataDal" v-mask="'##/##/####'" ref="trasferimento-dal" />
							<span class="invalid-feedback" v-show="errors.has('trasferimento-dal')">{{ errors.first('trasferimento-dal') }}</span>
						</div>
					</div>
				</div>
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
