const dictionary = {
  it: {
    messages: {
			_default: () => `valore non corretto`,
			after: (field, [target, inclusion]) => {
				if (inclusion) {
					return `le date devono essere uguali o consecutive`
				}
				return `le date devono essere consecutive`
			},
			alpha_num: () => `valore non corretto (solo numeri e lettere)`,
			date_format: (field, [format]) => `valore non corretto (formato ${format})`,
			digits: (field, [length]) => `valore non corretto (numerico di ${length} cifre)`,
			email: () => `e-mail non corretta`,
			length: (field, [length, max]) => {
				if (max) {
					return `lunghezza non corretta (min ${length} e max ${max} caratteri)`;
				}
				return `lunghezza non corretta (${length} caratteri)`;
			},
			mimes: () => `tipo file non corretto (formato PDF o immagine)`,
			min_value: (field, [min]) => `il valore deve essere maggiore o uguale a ${min}`,
			regex: () => `formato non corretto`,
			required: () => `campo obbligatorio`,
			size: () => `dimensione del file non corretta (max 2Mb)`,
			is: () => `campi non corrispondenti`,
			check_cf: () => `codice fiscale non corretto`,
			data_nascita_cf: (field, [cf]) => {
				return `la data non corrisponde al codice fiscale indicato`;
			},
			nidi_data_nascita: (field, [annoLimite]) => {
				var limite = annoLimite - 2;
				return `la data deve essere successiva o uguale al 01/01/${limite}`;
			},			
			materne_data_nascita: (field, [annoLimite]) => {
				var limite = annoLimite -2;
				var limite_2 = annoLimite -6;
				return `la data deve essere successiva al 31/12/${limite_2} e inferiore al 01/05/${limite}`;
			},
			disoccupazione_data: () => {
				var limite = new Date();
				limite.setMonth(limite.getMonth()-3);
				var anno = limite.getFullYear();
				var mese = limite.getMonth() < 9 ? "0" + (limite.getMonth() + 1) : (limite.getMonth() + 1);
				var giorno  = limite.getDate() < 10 ? "0" + limite.getDate() : limite.getDate();
				limite = giorno+'/'+mese+'/'+anno;
				return `la data deve essere precedente al ${limite}`;
			},
			isee_data: () => {
				var limite = new Date();
				limite.setFullYear(limite.getFullYear()+1);
				var anno = limite.getFullYear();
				var mese = limite.getMonth() < 9 ? "0" + (limite.getMonth() + 1) : (limite.getMonth() + 1);
				var giorno  = limite.getDate() < 10 ? "0" + limite.getDate() : limite.getDate();
				limite = giorno+'/'+mese+'/'+anno;				
				return `la data deve essere precedente o uguale al ${limite}`;
			},			
			gt_data: (field, [data, uguale]) => {
				uguale = uguale == 'eq' ? 'o uguale ' : '';
				return `la data deve essere successiva ${uguale}al ${data}`;
			},
			gt_oggi: (field, [uguale]) => {
				var oggi = new Date();
				var anno = oggi.getFullYear();
				var mese = oggi.getMonth() < 9 ? "0" + (oggi.getMonth() + 1) : (oggi.getMonth() + 1);
				var giorno  = oggi.getDate() < 10 ? "0" + oggi.getDate() : oggi.getDate();
				var data = giorno+'/'+mese+'/'+anno;			
				uguale = uguale == 'eq' ? 'o uguale ' : '';
				return `la data deve essere successiva ${uguale}alla data odierna`;
			},
			lt_data: (field, [data, uguale]) => {
				uguale = uguale == 'eq' ? 'o uguale ' : '';
				return `la data deve essere precedente ${uguale}al ${data}`;
			},
			lt_oggi: (field, [uguale]) => {
				var oggi = new Date();
				var anno = oggi.getFullYear();
				var mese = oggi.getMonth() < 9 ? "0" + (oggi.getMonth() + 1) : (oggi.getMonth() + 1);
				var giorno  = oggi.getDate() < 10 ? "0" + oggi.getDate() : oggi.getDate();
				var data = giorno+'/'+mese+'/'+anno;
				uguale = uguale == 'eq' ? 'o uguale ' : '';
				return `la data deve essere precedente ${uguale}alla data odierna`;
			},
			min_3: () => `nel caso di disabilit&agrave;, disagio sociale o gravi problemi di salute del bambino o bambina, indicare almeno 3 preferenze`,
    }
  },
};
VeeValidate.Validator.localize(dictionary);

VeeValidate.Validator.extend('data_nascita_cf', {
	getMessage: field => '',
	validate: (value, cf) => {
		if (/^[a-zA-Z]{6}\d{2}[a-zA-Z]\d{2}[a-zA-Z]\d{3}[a-zA-Z]$/i.test(cf)) {
			var MESI = { A: '01', B: '02', C: '03', D: '04', E: '05', H: '06', L: '07', M: '08', P: '09', R: '10', S: '11', T: '12' };
			var [anno, giorno] = [cf.toString().substring(6, 8), cf.toString().substring(9, 11)];
			if (parseInt(giorno) > 40) {
				giorno = '0' + (giorno - 40).toString();
				giorno = giorno.substring(giorno.length - 2);
			}
			var currYear = new Date().getFullYear().toString().substr(-2);
			var dataCF = giorno + '/' + MESI[cf.toString().substring(8, 9).toUpperCase()] + '/' + (parseInt(anno) <= parseInt(currYear) ? "20" : "19" ) + anno;
			if (value !== dataCF) {
				return false;
			}
		}
		return true;
	}
});

VeeValidate.Validator.extend('nidi_data_nascita', {
	getMessage: field => '',
	validate: (value, annoLimite) => {
		var res = value.split("/");
		res[2] = Math.abs(res[2])+3; // aggiungo 3 anni
		var data = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
		var limite = new Date('12/31/'+annoLimite);
		if (limite.getTime() < data.getTime()) {
			return true;
		}
		return false;
	}
});

VeeValidate.Validator.extend('materne_data_nascita', {
	getMessage: field => '',
	validate: (value, annoLimite) => {
		var res = value.split("/");
		var data = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
		var limite = new Date('12/31/'+(annoLimite-6));
		var limite_2 = new Date ('04/30/'+(annoLimite-2));
		if ( limite.getTime()<data.getTime()  && data.getTime()<= limite_2.getTime()) {
			
			return true;
		}
		return false;
	}
});

VeeValidate.Validator.extend('disoccupazione_data', {
	getMessage: field => '',
	validate: (value) => {
		var res = value.split("/");
		var disoccupazione = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
		var limite = new Date();
		limite.setHours(0, 0, 0, 0);
		limite.setMonth(limite.getMonth()-3);
		if (disoccupazione.getTime() >= limite.getTime()) {
			return false;
		}
		return true;
	}
});

VeeValidate.Validator.extend('isee_data', {
	getMessage: field => '',
	validate: (value) => {
		var res = value.split("/");
		var data = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
		var limite = new Date();
		limite.setHours(0, 0, 0, 0);	
		limite.setFullYear(limite.getFullYear()+1);
		if (data.getTime() <= limite.getTime()) {
			return true;
		}
		return false;
	}
});

VeeValidate.Validator.extend('gt_data', {
	getMessage: field => '',
	validate: (value, [data, uguale]) => {
		if (data != '') {
			var res = value.split("/");
			var toValidate = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
			var param = data.toString().split("/");
			var toCompare = new Date(Math.abs(param[1])+'/'+Math.abs(param[0])+'/'+Math.abs(param[2]));
			if (uguale == 'eq') {
				if (toValidate.getTime() >= toCompare.getTime()) {
					return true;
				}
			}
			else {
				if (toValidate.getTime() > toCompare.getTime()) {
					return true;
				}
			}
			return false;
		}
		return true;
	}
});

VeeValidate.Validator.extend('gt_oggi', {
	getMessage: field => '',
	validate: (value, uguale) => {
		var res = value.split("/");
		var toValidate = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
		var oggi = new Date();
		oggi.setHours(0, 0, 0, 0);	
		if (uguale == 'eq') {
			if (toValidate.getTime() >= oggi.getTime()) {
				return true;
			}
		}
		else {
			if (toValidate.getTime() > oggi.getTime()) {
				return true;
			}
		}
		return false;
	}
});

VeeValidate.Validator.extend('lt_data', {
	getMessage: field => '',
	validate: (value, [data, uguale]) => {
		if (data != '') {
			var res = value.split("/");
			var toValidate = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
			var param = data.toString().split("/");
			var toCompare = new Date(Math.abs(param[1])+'/'+Math.abs(param[0])+'/'+Math.abs(param[2]));
			if (uguale == 'eq') {
				if (toValidate.getTime() <= toCompare.getTime()) {
					return true;
				}
			}
			else {
				if (toValidate.getTime() < toCompare.getTime()) {
					return true;
				}
			}
			return false;
		}
		return true;		
	}
});

VeeValidate.Validator.extend('lt_oggi', {
	getMessage: field => '',
	validate: (value, uguale) => {
		var res = value.split("/");
		var toValidate = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
		var oggi = new Date();
		oggi.setHours(0, 0, 0, 0);
		if (uguale == 'eq') {
			if (toValidate.getTime() <= oggi.getTime()) {
				return true;
			}
		}
		else {
			if (toValidate.getTime() < oggi.getTime()) {
				return true;
			}
		}
		return false;
	}
});

VeeValidate.Validator.extend('check_cf', {
	getMessage: field => '',
	validate: (value) => {
		var i, s, set1, set2, setpari, setdispari;
		var cf = value.toUpperCase();
		set1 = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		set2 = "ABCDEFGHIJABCDEFGHIJKLMNOPQRSTUVWXYZ";
		setpari = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		setdispari = "BAKPLCQDREVOSFTGUHMINJWZYX";
		s = 0;
		for (var i = 1; i <= 13; i += 2) {
			s += setpari.indexOf(set2.charAt(set1.indexOf(cf.charAt(i))));
		}
		for (var i = 0; i <= 14; i += 2) {
			s += setdispari.indexOf(set2.charAt(set1.indexOf(cf.charAt(i))));
		}
		if (s % 26 != cf.charCodeAt(15)-'A'.charCodeAt(0)) {
			return false;
		}
		return true;
	}
});

VeeValidate.Validator.extend('min_3', {
	getMessage: field => '',
	validate: (value) => {
		if (value.length < 3) {
			return false;
		}
		return true;
	}
});
