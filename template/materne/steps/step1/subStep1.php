<h2 class="no-bottom">Anno scolastico della domanda</h2>
<div class="form-step">
	<div class="form-row">
		<div id="annoScolastico" class="form-group col-md-12">
			<label class="col-form-label label-light col-md-12">Anno scolastico al quale si vuole iscrivere il bambino o la bambina<sub class="required">*</sub></label>
			<div class="custom-control custom-radio custom-control mb-3">
				<input type="radio" id="annoScolastico-1" name="annoScolastico" key="annoScolastico-1" :class="{'custom-control-input':true, 'is-invalid': errors.has('annoScolastico')}" :value="Object.keys(famiglia.anniScolasticiMaterna)[0]" v-model="valoriIniziali.annoScolastico" v-validate.disable="'required'" />
				<label class="custom-control-label" for="annoScolastico-1">{{ Object.keys(famiglia.anniScolasticiMaterna)[0] }}</label><br />
				<small v-if="Object.keys(famiglia.anniScolasticiMaterna).length == 1">Stai per compilare una domanda per l'anno scolastico indicato e per le scuole d'infanzia statali, comunali e paritarie convenzionate col Comune.</small>
				<small v-else>Stai per compilare una domanda per l'anno scolastico indicato solo per le scuole d'infanzia paritarie convenzionate col Comune.</small>
			</div>
			<div class="custom-control custom-radio custom-control" v-if="Object.keys(famiglia.anniScolasticiMaterna)[1]">
				<input type="radio" id="annoScolastico-2" name="annoScolastico" key="annoScolastico-2" :class="{'custom-control-input':true, 'is-invalid': errors.has('annoScolastico')}" :value="Object.keys(famiglia.anniScolasticiMaterna)[1]" v-model="valoriIniziali.annoScolastico" />
				<label class="custom-control-label" for="annoScolastico-2">{{ Object.keys(famiglia.anniScolasticiMaterna)[1] }}</label><br />
				<small v-if="Object.keys(famiglia.anniScolasticiMaterna).length > 1">Stai per compilare una domanda per l'anno scolastico indicato e per le scuole d'infanzia statali, comunali e paritarie convenzionate col Comune.</small>
			</div>
			<span class="invalid-feedback" v-show="errors.has('annoScolastico')">{{ errors.first('annoScolastico') }}</span>
		</div>
	</div>
	<div class="btn-group row"> 
		<div class="col-sm-12 col-md-12 col-lg-8"><!--space--></div>
		<div class="col-sm-12 col-md-12 col-lg-4 btn-order-primary">
			<a class="btn btn-primary" href="#" role="button" @click="nextSubStep">Prosegui</a>
		</div>
	</div>
</div>
