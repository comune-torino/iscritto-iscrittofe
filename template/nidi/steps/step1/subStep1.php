										<div class="alert alert-info fade show" role="alert">												
											<p>Per semplificare la compilazione della domanda, &egrave; usato il termine "nido" per indicare anche le Sezioni primavera</p>
										</div>
										<h2 class="no-bottom">Informativa sulla responsabilit&agrave; genitoriale</h2>
										<div class="form-step space-bottom-standard">
											<div class="txt-consenso">
												<p>Il modulo on line recepisce le nuove disposizioni contenute nel decreto legislativo 28 dicembre 2013, n. 154 che ha apportato modifiche al codice civile in tema di filiazione. Si riportano di seguito le specifiche disposizioni concernenti la responsabilit&agrave; genitoriale.</p>
												<h3>Art. 316 co. 1</h3>
												<p>Responsabilit&agrave; genitoriale.</p>
												<p>Entrambi i genitori hanno la responsabilit&agrave; genitoriale che &egrave; esercitata di comune accordo tenendo conto delle capacit&agrave;, delle inclinazioni naturali e delle aspirazioni del figlio. I genitori di comune accordo stabiliscono la residenza abituale del minore.</p>
												<h3>Art. 337- ter co. 3</h3>
												<p>Provvedimenti riguardo ai figli.</p>
												<p>La responsabilit&agrave; genitoriale &egrave; esercitata da entrambi i genitori. Le decisioni di maggiore interesse per i figli relative all'istruzione, all'educazione, alla salute e alla scelta della residenza abituale del minore sono assunte di comune accordo tenendo conto delle capacit&agrave;, dell'inclinazione naturale e delle aspirazioni dei figli. In caso di disaccordo la decisione &egrave; rimessa al giudice. Limitatamente alle decisioni su questioni di ordinaria amministrazione, il giudice pu&ograve; stabilire che i genitori esercitino la responsabilit&agrave; genitoriale separatamente. Qualora il genitore non si attenga alle condizioni dettate, il giudice valuter&agrave; detto comportamento anche al fine della modifica delle modalit&agrave; di affidamento.</p>
												<h3>Art. 337-quater co. 3</h3>
												<p>Affidamento a un solo genitore e opposizione all'affidamento condiviso.</p>
												<p>Il genitore cui sono affidati i figli in via esclusiva, salva diversa disposizione del giudice, ha l'esercizio esclusivo della responsabilit&agrave; genitoriale su di essi; egli deve attenersi alle condizioni determinate dal giudice. Salvo che non sia diversamente stabilito, le decisioni di maggiore interesse per i figli sono adottate da entrambi i genitori. Il genitore cui i figli non sono affidati ha il diritto ed il dovere di vigilare sulla loro istruzione ed educazione e pu&ograve; ricorrere al giudice quando ritenga che siano state assunte decisioni pregiudizievoli al loro interesse.</p>
											</div>
											<div class="card mb-4">
												<div class="card-body">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" :class="{'custom-control-input':true, 'is-invalid': errors.has('responsabilita-genitoriale')}" id="responsabilita-genitoriale" name="responsabilita-genitoriale" :value="true" v-validate.disable="'required'" v-model="domanda.responsabilitaGenitoriale" />
														<label class="custom-control-label" for="responsabilita-genitoriale">Dichiaro che alla luce delle norme del codice civile sopra richiamate in materia di responsabilit&agrave; genitoriale la richiesta di iscrizione e la scelta dei nidi &egrave; condivisa dai genitori o, nel caso di responsabilit&agrave; genitoriale esclusiva, dichiaro di essere l'unico genitore con responsabilit&agrave; genitoriale<sub class="required">*</sub></label>
														<span class="invalid-feedback" v-show="errors.has('responsabilita-genitoriale')">{{ errors.first('responsabilita-genitoriale') }}</span>
														<small><strong>In mancanza della dichiarazione, la domanda non pu&ograve; essere presentata e la compilazione non pu&ograve; proseguire.</strong></small>
													</div>
												</div>
											</div>
										</div>
										<h2 class="no-bottom">Informativa su Dichiarazioni sostitutive e Protezione dati personali (GDPR)</h2>
										<div class="form-step">
											<div class="txt-consenso">
												<p>La domanda contiene dichiarazioni sostitutive di atto di notoriet&agrave; e di certificazioni rese ai sensi degli artt. 46 e 47 del DPR 28
												dicembre 2000, n&deg;445 (disposizioni legislative e regolamentari sulla documentazione amministrativa).<br />
												Il Comune effettuer&agrave; controlli sulle dichiarazioni contenute nella domanda, anche attraverso la Polizia Municipale.<br />
												Nel caso di dichiarazioni false il punteggio verr&agrave; modificato e il genitore incorrer&agrave; in sanzioni penali.</p>
											</div>
											<div class="form-row">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" :class="{'custom-control-input':true, 'is-invalid': errors.has('info-autocertificazione')}" id="info-autocertificazione" name="info-autocertificazione" :value="true" v-validate.disable="'required'" v-model="domanda.infoAutocertificazione" />
													<label class="custom-control-label" for="info-autocertificazione">Dichiaro di aver preso visione dell'informativa su dichiarazioni sostitutive<sub class="required">*</sub></label>
													<span class="invalid-feedback" v-show="errors.has('info-autocertificazione')">{{ errors.first('info-autocertificazione') }}</span>
												</div>
											</div>
											<div class="txt-consenso mt-5">
												<p>Ai sensi dell'articolo 13 del Regolamento Europeo n. 2016/679 sulla protezione dei dati personali, la Divisione Servizi Educativi, nel rispetto dei principi sanciti dal Regolamento UE n. 2016/679 relativo alla protezione delle persone fisiche con riguardo al Trattamento dei Dati Personali, nonch&eacute; alla libera circolazione di tali dati, ha predisposto l'<a href="http://www.comune.torino.it/servizieducativi/direzione/informativa_privacy.pdf" target="_blank">informativa</a>.</p>
											</div>
											<div class="form-row">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" :class="{'custom-control-input':true, 'is-invalid': errors.has('info-gdpr')}" id="info-gdpr" name="info-gdpr" :value="true" v-validate.disable="'required'" v-model="domanda.infoGdpr" />
													<label class="custom-control-label" for="info-gdpr">Dichiaro di aver preso visione dell'informativa sull'uso dei dati personali (GDPR)<sub class="required">*</sub></label>
													<span class="invalid-feedback" v-show="errors.has('info-gdpr')">{{ errors.first('info-gdpr') }}</span>
												</div>
											</div>
											<div class="form-row mt-8">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" :class="{'custom-control-input':true, 'is-invalid': errors.has('consenso-convenzionata')}" id="consenso-convenzionata" name="consenso-convenzionata" :value="true" v-validate.disable="'required'" v-model="domanda.consensoConvenzionata" />
													<label class="custom-control-label" for="consenso-convenzionata">Dichiaro di consentire il trattamento dei dati da parte del titolare della sezione primavera eventualmente scelta<sub class="required">*</sub></label><br />
													<span class="invalid-feedback" v-show="errors.has('consenso-convenzionata')">{{ errors.first('consenso-convenzionata') }}</span>
													<small><strong>In mancanza della dichiarazione, la domanda non pu&ograve; essere presentata e la compilazione non pu&ograve; proseguire.</strong></small>
												</div>
											</div>
											<div class="btn-group row">
												<div class="col-sm-12 col-md-12 col-lg-8"><!--space--></div>
												<div class="col-sm-12 col-md-12 col-lg-4 btn-order-primary">
													<a class="btn btn-primary" href="#" role="button" @click="nextSubStep">Prosegui</a>
												</div>
											</div>
										</div>
