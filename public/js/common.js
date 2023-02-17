document.addEventListener('click', function(event) {
//document.addEventListener('click', event => {
	let element = event.target;
	let elementParent = null;
	if( element.parentNode ) elementParent = element.parentNode;
	if( element.tagName == 'I' || element.tagName == 'SPAN' || element.tagName == 'IMG' || element.tagName == 'svg' || element.tagName == 'path' )	{
		if( element.parentNode.tagName == 'A' || element.parentNode.tagName == 'BUTTON' ) 
			element = element.parentNode;
		else 
			if( element.parentNode.parentNode.tagName == 'A' || element.parentNode.parentNode.tagName == 'BUTTON' ) 
				element = element.parentNode.parentNode;
	}
	
	/*********************************
	 *	anchor with .ajax class
	 *	
	 *
	 *********************************/
	if( element.classList.contains('ajax') ) {
		event.preventDefault();
		
		ajaxRequest(element.href, (response)=>{
			let etarget = null;
			
			if( element.dataset.target === undefined )
				etarget = mainContent;
			else
				etarget = document.querySelector(element.dataset.target);
			
			etarget.innerHTML = response.data.data;
			if( element.dataset.executeAfter === undefined ) {
				// nothing to document
			}
			else {
				let sfn = element.dataset.executeAfter;
				return executeDataSetScript(sfn.substr(0, sfn.length - 1) + ',\'' + element.href + '\')', element);
			}

		});
	}
	
	/*********************************
	 *	button with btn-action (should has dataset-( rowHref, [rowTarget, rowMethod])
	 *	
	 *
	 *********************************/
	if( element.classList.contains('btn-action') ) {
		let href = element.dataset.rowHref;
		let target = mainContent;
		
		if( element.hasAttribute('data-row-target') ) {
			if( element.dataset.rowTarget == 'modal' ) 
				target = crudModal.querySelector('.modal-content');
			else
				target = document.querySelector(element.dataset.rowTarget);
		}
		
		
		if( element.hasAttribute('data-execute-before') ) {
			executeDataSetScript( element.dataset.executeBefore, element );
		}
		const method = (element.dataset.rowMethod === undefined ? 'get' : element.dataset.rowMethod);
		
		if( method=='delete' && !element.hasAttribute('data-confirmed') ) {
			//element.closest('.card').style.cssText='background-color: #FFD5D5;border-color: #ff0000;';
			let crd = element.closest('.card');
			crd.classList.add('card-danger');
			//element.parentElement.childNodes.forEach(btn=>{
			crd.querySelectorAll('button').forEach(btn=>{
				btn.classList.add('d-none', 'd-none-temporary');
			});
			//Object.assign(document.createElement("button"), 
			let cnt = document.createElement("div");
				cnt.id='iconfirmation_container';
				cnt.className='d-flex justify-content-between';
			let emsg = document.createElement("h5");
				emsg.innerHTML  = 'Are you sure you want to delete this record'; //"{{ __('messages.confirm_delete') }}";
			
			let btnYes = document.createElement("button");
				btnYes.innerHTML='Yes';
				btnYes.className='btn btn-outline-danger btn-action btn-yes';
				btnYes.setAttribute('data-row-method', element.dataset.rowMethod);
				btnYes.setAttribute('data-row-href', element.dataset.rowHref);
				if( element.hasAttribute('data-execute-after') ) btnYes.setAttribute('data-execute-after', element.dataset.executeAfter);
				if( element.hasAttribute('data-execute-before') ) btnYes.setAttribute('data-execute-before', element.dataset.executeBefore);
				btnYes.setAttribute('data-confirmed', 'true');
			
			let btnNo = document.createElement("button");
				btnNo.className='btn btn-outline-success btn-no';
				btnNo.innerHTML = 'No';
				btnNo.setAttribute('onclick', "const pe=this.closest('.card');pe.querySelectorAll('.d-none-temporary').forEach(ebtn=>{ebtn.classList.remove('d-none','d-none-temporary');});pe.classList.remove('card-danger');document.getElementById('iconfirmation_container').remove();");
			
			
			crd.querySelector('.card-footer').appendChild(cnt);
			//element.parentNode.appendChild(cnt);
			
			cnt.appendChild(emsg);
			cnt.appendChild(btnYes);
			cnt.appendChild(btnNo);
			return false;
		}
		ajaxRequest(href, function(res) {
			target.innerHTML = res.data;
			if( element.hasAttribute('data-execute-after') ) {
				executeDataSetScript( element.dataset.executeAfter, element )
			}
		
		}, method);
	}

	if( elementParent && element.parentNode.classList.contains('delete-child-on-click') ) {
		const eparent = element.parentNode;
		const href = eparent.dataset.href + '/' + element.innerText;
		const method = eparent.dataset.method ?? 'GET';
		const target = document.getElementById(eparent.dataset.target);

		ajaxRequest(href, function(res) {
			//console.log( res.data );
			target.innerHTML = res.data;
		}, method);
	}
	
	/*********************************
	 *	anchor with .ajax class
	 *	
	 *
	 *********************************/
	if( element.tagName=='TD' ) {
		const tbl = element.closest('table');
		if (tbl.classList.contains('datatable') && tbl.hasAttribute('aria-clickable')) {
			if( tbl.getAttribute('aria-clickable') == 'true' )
			{
				const TR = element.parentNode;
			//console.log( DTable.dataset.dtUrl + '/' + TR.id.substr(4) );
				ajaxRequest(tbl.dataset.dtUrl + '/' + TR.id.substr(4), 
					function(response) {
						crudModal.querySelector('.modal-content').innerHTML = response.data;
						showModal();
				});
			}
		}
	}
	
	/*********************************
	 *	all contents are to be used as ajax action
	 *	
	 *
	 *********************************/
	if (element.closest('.use-ajax-event')) {
		event.preventDefault();
		//console.log( event.target.tagName );
	}

	if( element.hasAttribute('data-execute-function') ) {
		//console.log( element.dataset.executeFunction );
		return executeDataSetScript(element.dataset.executeFunction, element);
	}
	
	/*********************************
	 *	label that has data-label-toggle
	 *	toggle element selector in FOR visible/hidden
	 *
	 *********************************/
	if( element.hasAttribute('data-label-toggle') ) {
		document.getElementById(element.getAttribute('for')).classList.toggle('d-none')
	}
	
	/*********************************
	 *	data-action attribute
	 *	execute element action
	 *	require data-source, data-target along with data-action
	 *********************************/
	if( element.hasAttribute('data-action') ) {
		event.preventDefault();
		event.stopPropagation();
		
		executeDataSetScript(element.dataset.action, element);
		//if (element.dataset.action == 'filter')
			//filter(element.dataset.source, element.dataset.target);
	}

});


/***************************
 *	[form submit using ajax] 
 *	[Parameters]	string( response ) 
 *	[Description]	make sure response is json object
 **************************/
document.addEventListener('submit', function(event) {
	
	if( event.target.hasAttribute('data-ajax-form') ) {
		event.preventDefault();
        event.stopPropagation()
		
		const sfrm = event.target;
		
		if( sfrm.hasAttribute('data-execute-before') ) {
			if (executeDataSetScript( sfrm.dataset.executeBefore, sfrm ) == false ) return false;
		}
		
		const fd= new FormData( sfrm );
		const fnSubmit = function(res) {
			console.log(sfrm.dataset.rowTarget, res.status);
			if (res.status===200) {
				if( sfrm.hasAttribute('data-row-target') ) {
					console.log(sfrm.dataset.rowTarget);
					document.querySelector(sfrm.dataset.rowTarget).innerHTML = res.data.data;
				}
				
				if( sfrm.hasAttribute('data-execute-after') ) {
					executeDataSetScript( sfrm.dataset.executeAfter, sfrm );
				}

			}
			
			if (res.status===422) {	// The given data was invalid.
				const errors = Object.keys(res.errors);

				for(key in errors) {
					//console.log( 'i' + errors[key] );
					let e = document.getElementById('i'+errors[key]); // selector can also be by name
					if( e ) {
						e.classList.add('is-invalid');
						e.parentNode.querySelector('.invalid-feedback').innerHTML = res.errors[errors[key]];
					}
				}
			}
		}
		
		//console.log(...fd)
		
		// JSON.stringify(fd)
		ajaxRequest(sfrm.action, fnSubmit, sfrm.method, fd);
	}

})


/***************************
 *	[show specific modal] 
 *	[Parameters]	string( response ) 
 *	[Description]	make sure response is json object
 **************************/
function showModal(modal=null, backdrop='', keyboard='' ) {
	if(null==modal) modal = crudModal;
	if( backdrop )
		$(modal).modal._config.backdrop = backdrop; // or true
	
	if( keyboard )
		$(modal).modal._config.keyboard = keyboard; // or true

	$(modal).modal('show');
}
	
/***************************
 *	[hide modal] 
 *	[Description]	make sure response is json object
 **************************/
function hideModal(modal=null) {
	if(null==modal) 
		modal=crudModal;
	
	$(modal).modal('hide');
}

/***************************
 *	ajaxRequest
 *	[Parameters]	string( response ) 
 *	[Description]	make sure response is json object
 **************************/
function ajaxRequest(url, fnResult, method='get', data, extra) {
	let header = {'X-Requested-With': 'XMLHttpRequest'};
	
	if( typeof method == 'undefined' ) method='get';
	
	if( method != 'get' )	{
		//if( data.has('_method') )	{
		//	method=data.get('_method');
		//}
		if( typeof data=='undefined' ) data={'_token':csrf};
		if( typeof data._token=='undefined' ) data._token = csrf;
	}
	//console.log( 'from within ajaRequest', data );
	if( extra != null )  {
		if( extra.hasFiles != undefined )
			header.contentType='multipart/form-data';
	}
	if (header.contentType == undefined ) {
		//header.contentType='application/x-www-form-urlencoded';
		header.contentType='application/json';
	}
	
	if( axios ) {
	
		axios({
		  method: method,
		  url: url,
		  headers: header,
		  //headers: { 'Content-Type': 'multipart/form-data' },

		  data: data
		})
		.then(response => {
			fnResult( response );
		})
		.catch(function (error) {
			if (error.response) {
				switch(error.response.status) {
					case 422:
						let result = {
							"errors": error.response.data.errors,
							"message": error.response.data.message,
							"status": error.response.status,
							"headers": error.response.headers,
							"data": false
						};

						fnResult( result );
						break;

					case 207:	//ERR_INTERNET_DISCONNECTED
						alert('Error: You are not connected to internet\n ' + ( error.response.data.message ? error.response.data.message : '')  );
						break;

					case 401:
					case 419:
						location.reload();
						break;

					case 403:
						alert('Error: (403) Not allowed!\n ' + ( error.response.data.message ? error.response.data.message : '')  );
						break;
						
					case 500:
						alert('Error: (501) Something went wrong!\n ' + ( error.response.data.message ? error.response.data.message : '')  );
						break;

				}
			  // console.log(error.response.data);
			  // console.log(error.response.data.message);
			  // console.log(error.response.data.errors);
			  // console.log(error.response.status);
			  // console.log(error.response.headers);
			}

		});
	} else {
		console.log('axios is not working')
		ajaxRequestxhr(url, fn,method, data, extra)
	}
	
		
	//ajaxRequestPromise(url, fnResult, method, data, extra);
	
}


function ajaxRequestxhr(url, fnResult, method = 'get', data = '', extra = null) {
	const csrf = document.querySelector('meta[name="csrf-token"]').content;
	
    let xhr = new XMLHttpRequest();
    xhr.open(method, url);

	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
    xhr.send(data);

    xhr.onload = function() {
        if (xhr.status != 200) { // analyze HTTP status of the response
            console.log('Error ${xhr.status}: ${xhr.statusText}'); // e.g. 404: Not Found
        } else { // show the result
            //console.log('Done, got ${xhr.response.length} bytes'); // response is the server response
            const responseObj = JSON.parse(xhr.response);
            //const responseObj = JSON.parse(xhr.responseText);
            fnResult(responseObj);
        }
    };
	
    xhr.onprogress = function(event) {
        if (event.lengthComputable) {
            console.log('Received ' + event.loaded + ' of ' + event.total + ' bytes');
        } else {
            console.log('Received ' + event.loaded + ' bytes'); // no Content-Length
        }

    };

    xhr.onerror = function() {
        console.log('Request error');
        alert("Request failed");
    };
}

/***************************
 *	[has_json] 
 *	[Parameters]	string( response ) 
 *	[Description]	make sure response is json object
 **************************/
function assignDT(elementID) {
	//console.log(elementID.constructor.name);
	DTable = null;
	const exceptions=['country_id', 'city_id'];
	const eTable = document.getElementById(elementID);
	if( ! 	eTable ) return;
	const dtcols = eTable.querySelectorAll('th');
	var cols = [];
	$col = {
		  data: 'DT_RowIndex',
		  name: 'DT_RowIndex',
		  orderable: false,
		  searchable: false
	  };
	
	dtcols.forEach(th => {
		if( th.hasAttribute('data-column-name') ) {
		//if( th.dataset.hasOwnProperty('column-name') ) {
			const col = th.dataset.columnName;
			var dcol = {"name": col};
			if( col.substring(col.length -3) == '_id' && ! exceptions.in_array(col) ) {
				if( th.hasAttribute('data-column-data') )
					dcol.data=th.dataset.columnData;
				else
					dcol.data=col.substring(0, col.length -3)+'.title';
				
				dcol.searchable=false;
				//dcol.className="related";
			} else {
				if( th.hasAttribute('data-column-data') )
					dcol.data=th.dataset.columnData;
				else
					dcol.data=col;
				
				if (th.hasAttribute('data-column-disable-sort') ) {
					dcol.orderable=false;
				}
				if (th.hasAttribute('data-column-disable-search')) {
					dcol.searchable=false;
				}
			}
			
			if (th.hasAttribute('data-column-class') ) {
				dcol.className=th.dataset.columnClass;
			}
			
			if (th.hasAttribute('data-column-render') ) {
				dcol.render= parseFunction(th.dataset.columnRender);
			}
			
			cols.push( dcol );
		}
	});
	
	var dtoptions = {
		responsive: true,
		processing: true,
		///deferRender: true,
		serverSide: true,
		//dataSrc: 'settings',
		//bLengthChange: false,
		searchDelay: 900,
		pageLength: 10,
		//scrollY: 400,
		order: [],
		ajax: {
			url: eTable.dataset.dtUrl + '/browse',
			//type: '',
		},
		language: {
			url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/'+currentLanguageName+'.json'
		},

		columns: cols,
	};
	
	$(eTable).DataTable(dtoptions);
	DTable=eTable;
}


/***************************
 *	[execute] 
 *	[Parameters]	string( response ) 
 *	[Description]	execute functions in txt
 **************************/
function executeDataSetScript(txt, element=null) {

	let cFN = function(elm, script) { // creating dynamic function to execute method script
		this.element = elm; // to get to send element parameter to dynamic const function fn
		const fn = new Function( script );
		return fn();
	}
	return cFN(element, txt); // return executed function result
}


