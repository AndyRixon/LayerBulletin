// checkall - check all or uncheck all checkboxes

function checkUncheckAll(theElement) {
     var theForm = theElement.form, z = 0;
	 for(z=0; z<theForm.length;z++){
      if(theForm[z].type == 'checkbox' && theForm[z].name != 'checkall'){
	  theForm[z].checked = theElement.checked;
	  }
     }
    }
	
function checkUncheckSome(controller,theElements) {
	
     var formElements = theElements.split(',');
	 var theController = document.getElementById(controller);
	 for(var z=0; z<formElements.length;z++){
	  theItem = document.getElementById(formElements[z]);
	  if(theItem){
	  if(theItem.type){
        if(theItem.type == 'checkbox' && theItem.id != theController.id){
	     theItem.checked = theController.checked;
	    }
	  } else {

	    var nextArray = '';
	     for(var x=0;x <theItem.childNodes.length;x++){
	      if(theItem.childNodes[x]){
	        if (theItem.childNodes[x].id){
	          nextArray += theItem.childNodes[x].id+',';
		    }
	      }
	     }
	     checkUncheckSome(controller,nextArray);
	   
	   }
	  
	  }
     }
    }

// check info - make sure entered info is a valid.

function validate_info() {
    if(-1 == document.register.email.value.indexOf("@")) { 
       document.register.email.focus(); 
       alert("Your email must have a '@'."); 
       return false; 
       }
    if(-1 != document.register.email.value.indexOf(",")) { 
       document.register.email.focus(); 
       alert("Your email must not have a ',' in it"); 
       return false; 
       }
    if(-1 != document.register.email.value.indexOf("#")) { 
       document.register.email.focus(); 
       alert("Your email must not have an '#' in it." ); 
       return false; 
       }
    if(-1 != document.register.email.value.indexOf("!")) { 
       document.register.email.focus(); 
       alert("Your email must not have a '!' in it." ); 
       return false; 
       }
    if(-1 != document.register.email.value.indexOf(" ")) { 
       document.register.email.focus(); 
       alert("Your email must not have a space in it." ); 
       return false; 
       }
    if(document.register.email.value.length ==
         (document.register.email.value.indexOf("@")+1) ) {
       document.register.email.focus();
       alert("Your email must have a domain name after the '@'.");
       return false;
       }

    if(document.register.email.value.length == 0) { 
      document.register.email.focus(); 
      alert("Please enter your email."); 
      return false; 
      }

    if (document.getElementById('pass').value != document.getElementById('check_pass').value) {
      alert('Passwords don\'t match!');
      return false;
      }

    return true;
}

// clearform - clears a form of default content

function ClearForm() {
  document.searchform.search.value= "";
}

// collapse - collapses forums, forum stats, quick reply & quick edit

function showhide(id, visible)
{
	if (visible == undefined)
		visible = 'block';
	
	if (document.getElementById)
	{
		if (document.getElementById(id).style.display == 'none')
			document.getElementById(id).style.display = visible;
		else
			document.getElementById(id).style.display = 'none';
	}
	else
	{
		if (document.layers)
		{
			if (document.id.display == 'none')
				document.id.display = visible;
			else
				document.id.display = 'none';
		}
		else
		{
			if (document.all.id.style.display == 'none')
				document.all.id.style.display = visible;
			else
				document.all.id.style.display = 'none';
		}
	}
}

function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=")
  if (c_start!=-1)
    { 
    c_start=c_start + c_name.length+1 
    c_end=document.cookie.indexOf(";",c_start)
    if (c_end==-1) c_end=document.cookie.length
    return unescape(document.cookie.substring(c_start,c_end))
    } 
  }
return ""
}

function setstate(layer_ref) {

var exdate=new Date();
if (getCookie(layer_ref).length>0){

var state = 'none';

	exdate.setDate(exdate.getDate()-1800);
}
else{

var state = '';

	exdate.setDate(exdate.getDate()+1800);
}
document.cookie=layer_ref+ "=0;expires="+exdate.toGMTString();

if (state == '') {
state = 'none';
}
else {
state = '';
}
if (document.all) { //IS IE 4 or 5 (or 6 beta)
eval( "document.all." + layer_ref + ".style.display = state");
}
if (document.layers) { //IS NETSCAPE 4 or below
document.layers[layer_ref].display = state;
}
if (document.getElementById &&!document.all) {
hza = document.getElementById(layer_ref);
hza.style.display = state;
}
}

// quote - remembers post clicked for quoting in reply

function lb_cookie(name){
	cname = name + '=';
	cpos  = document.cookie.indexOf( cname );
	if ( cpos != -1 )	{
	cstart = cpos + cname.length;
	cend   = document.cookie.indexOf(";", cstart);
	if (cend == -1)		{
	cend = document.cookie.length;
	}
	return unescape( document.cookie.substring(cstart, cend) );
	}
	return null;
}
	
function lbquote(id){
	saved = new Array();
	clean = new Array();
	add   = 1;
	if ( tmp = lb_cookie('mqpid') )	{
		saved = tmp.split(",");
	}
	for(
	i = 0 ; i < saved.length; i++ )	
	{
	if ( saved[i] != "" )
	{
	if ( saved[i] == id )
	{
	add = 0;
	}
	else
	{
	clean[clean.length] = saved[i];
	}
	}
	}
	if ( add )
	{	
		clean[ clean.length ] = id;
		eval("document.getElementById('mad_"+id+"').className=removequotebutton");
	}
	else
	{	
	eval("document.getElementById('mad_"+id+"').className=addquotebutton");
	}

	lb_setcookie( 'mqpid', clean.join(','));
	return false;
	}
	
function lb_setcookie( name, value){
	document.cookie = name + "=" + value + "; path=/";
}

function lb_delcookie() {
	document.cookie = "mqpid=0; expires=Fri, 27 Jul 2001 02:47:11 UTC; path=/";
}

// smilies - enter smilies into textarea

function smilies(myField, myValue) {
	//IE support
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
		myField.focus();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var scrollTop = myField.scrollTop;
		myField.value = myField.value.substring(0, startPos)
		              + myValue 
                      + myField.value.substring(endPos, myField.value.length);
		myField.focus();
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = startPos + myValue.length;
		myField.scrollTop = scrollTop;
	} else {
		myField.value += myValue;
		myField.focus();
	}
}

// suggest - suggest names or email addresses as user types into input

if (typeof(bsn) == "undefined")
	_b = bsn = {};

if (typeof(_b.Autosuggest) == "undefined")
	_b.Autosuggest = {};
else
	alert("Autosuggest is already set!");

_b.AutoSuggest = function (id, param)
{
	if (!document.getElementById)
		return 0;
	
	this.fld = _b.DOM.gE(id);

	if (!this.fld)
		return 0;
	
	this.sInp 	= "";
	this.nInpC 	= 0;
	this.aSug 	= [];
	this.iHigh 	= 0;
	this.oP = param ? param : {};

	var k, def = {minchars:1, meth:"get", varname:"input", className:"autosuggest", timeout:2500, delay:50, offsety:-5, shownoresults: true, noresults: "No results!", maxheight: 250, cache: true, maxentries: 25};
	for (k in def)
	{
		if (typeof(this.oP[k]) != typeof(def[k]))
			this.oP[k] = def[k];
	}
	
	var p = this;
	
	this.fld.onkeypress 	= function(ev){ return p.onKeyPress(ev); };
	this.fld.onkeyup 		= function(ev){ return p.onKeyUp(ev); };
	this.fld.setAttribute("autocomplete","off");
};


_b.AutoSuggest.prototype.onKeyPress = function(ev)
{
	
	var key = (window.event) ? window.event.keyCode : ev.keyCode;
	var RETURN = 13;
	var TAB = 9;
	var ESC = 27;
	var bubble = 1;

	switch(key)
	{
		case RETURN:
			this.setHighlightedValue();
			bubble = 0;
			break;

		case ESC:
			this.clearSuggestions();
			break;
	}

	return bubble;
};


_b.AutoSuggest.prototype.onKeyUp = function(ev)
{
	var key = (window.event) ? window.event.keyCode : ev.keyCode;
	var ARRUP = 38;
	var ARRDN = 40;
	var bubble = 1;
	
	switch(key)
	{
		case ARRUP:
			this.changeHighlight(key);
			bubble = 0;
			break;

		case ARRDN:
			this.changeHighlight(key);
			bubble = 0;
			break;
			
		default:
			this.getSuggestions(this.fld.value);
	}

	return bubble;
	

};



_b.AutoSuggest.prototype.getSuggestions = function (val)
{
	if (val == this.sInp)
		return 0;

	_b.DOM.remE(this.idAs);
	
	this.sInp = val;

	if (val.length < this.oP.minchars)
	{
		this.aSug = [];
		this.nInpC = val.length;
		return 0;
	}
	
	var ol = this.nInpC;
	this.nInpC = val.length ? val.length : 0;
	
	var l = this.aSug.length;
	if (this.nInpC > ol && l && l<this.oP.maxentries && this.oP.cache)
	{
		var arr = [];
		for (var i=0;i<l;i++)
		{
			if (this.aSug[i].value.substr(0,val.length).toLowerCase() == val.toLowerCase())
				arr.push( this.aSug[i] );
		}
		this.aSug = arr;
		
		this.createList(this.aSug);		
		
		return false;
	}
	else

	{
		var pointer = this;
		var input = this.sInp;
		clearTimeout(this.ajID);
		this.ajID = setTimeout( function() { pointer.doAjaxRequest(input) }, this.oP.delay );
	}

	return false;
};


_b.AutoSuggest.prototype.doAjaxRequest = function (input)
{

	if (input != this.fld.value)
		return false;
	
	var pointer = this;

	if (typeof(this.oP.script) == "function")
		var url = this.oP.script(encodeURIComponent(this.sInp));
	else
		var url = this.oP.script+this.oP.varname+"="+encodeURIComponent(this.sInp);
	
	if (!url)
		return false;
	
	var meth = this.oP.meth;
	var input = this.sInp;
	var onSuccessFunc = function (req) { pointer.setSuggestions(req, input) };
	var onErrorFunc = function (status) { alert("AJAX error: "+status); };
	var myAjax = new _b.Ajax();
	myAjax.makeRequest( url, meth, onSuccessFunc, onErrorFunc );
};

_b.AutoSuggest.prototype.setSuggestions = function (req, input)
{

	if (input != this.fld.value)
		return false;
	
	this.aSug = [];
	
	if (this.oP.json)
	{
		var jsondata = eval('(' + req.responseText + ')');
		
		for (var i=0;i<jsondata.results.length;i++)
		{
			this.aSug.push(  { 'id':jsondata.results[i].id, 'value':jsondata.results[i].value, 'info':jsondata.results[i].info }  );
		}
	}
	else
	{

		var xml = req.responseXML;
	
		var results = xml.getElementsByTagName('results')[0].childNodes;

		for (var i=0;i<results.length;i++)
		{
			if (results[i].hasChildNodes())
				this.aSug.push(  { 'id':results[i].getAttribute('id'), 'value':results[i].childNodes[0].nodeValue, 'info':results[i].getAttribute('info') }  );
		}
	
	}
	
	this.idAs = "as_"+this.fld.id;
	this.createList(this.aSug);

};

_b.AutoSuggest.prototype.createList = function(arr)
{
	var pointer = this;
	
	_b.DOM.remE(this.idAs);
	this.killTimeout();
	
	if (arr.length == 0 && !this.oP.shownoresults)
		return false;

	var div = _b.DOM.cE("div", {id:this.idAs, className:this.oP.className});	
	var hcorner = _b.DOM.cE("div", {className:"as_corner"});
	var hbar = _b.DOM.cE("div", {className:"as_bar"});
	var header = _b.DOM.cE("div", {className:"as_header"});
	header.appendChild(hcorner);
	header.appendChild(hbar);
	div.appendChild(header);

	var ul = _b.DOM.cE("ul", {id:"as_ul"});

	for (var i=0;i<arr.length;i++)
	{
		var val = arr[i].value;
		var st = val.toLowerCase().indexOf( this.sInp.toLowerCase() );
		var output = val.substring(0,st) + "<em>" + val.substring(st, st+this.sInp.length) + "</em>" + val.substring(st+this.sInp.length);
		var span 		= _b.DOM.cE("span", {}, output, true);
		if (arr[i].info != "")
		{
			var br			= _b.DOM.cE("br", {});
			span.appendChild(br);
			var small		= _b.DOM.cE("small", {}, arr[i].info);
			span.appendChild(small);
		}
		
		var a 			= _b.DOM.cE("a", { href:"#" });
		var tl 		= _b.DOM.cE("span", {className:"tl"}, " ");
		var tr 		= _b.DOM.cE("span", {className:"tr"}, " ");
		a.appendChild(tl);
		a.appendChild(tr);
		a.appendChild(span);
		a.name = i+1;
		a.onclick = function () { pointer.setHighlightedValue(); return false; };
		a.onmouseover = function () { pointer.setHighlight(this.name); };
		
		var li = _b.DOM.cE(  "li", {}, a  );
		
		ul.appendChild( li );
	}
	
	if (arr.length == 0 && this.oP.shownoresults)
	{
		var li = _b.DOM.cE(  "li", {className:"as_warning"}, this.oP.noresults  );
		ul.appendChild( li );
	}
	
	div.appendChild( ul );
	
	var fcorner = _b.DOM.cE("div", {className:"as_corner"});
	var fbar = _b.DOM.cE("div", {className:"as_bar"});
	var footer = _b.DOM.cE("div", {className:"as_footer"});
	footer.appendChild(fcorner);
	footer.appendChild(fbar);
	div.appendChild(footer);
	
	var pos = _b.DOM.getPos(this.fld);
	
	div.style.left 		= pos.x + "px";
	div.style.top 		= ( pos.y + this.fld.offsetHeight + this.oP.offsety ) + "px";
	div.style.width 	= this.fld.offsetWidth + "px";
	div.onmouseover 	= function(){ pointer.killTimeout() };
	div.onmouseout 		= function(){ pointer.resetTimeout() };

	document.getElementsByTagName("body")[0].appendChild(div);

	this.iHigh = 0;
	
	var pointer = this;
	this.toID = setTimeout(function () { pointer.clearSuggestions() }, this.oP.timeout);
};

_b.AutoSuggest.prototype.changeHighlight = function(key)
{	
	var list = _b.DOM.gE("as_ul");
	if (!list)
		return false;
	
	var n;

	if (key == 40)
		n = this.iHigh + 1;
	else if (key == 38)
		n = this.iHigh - 1;
	
	
	if (n > list.childNodes.length)
		n = list.childNodes.length;
	if (n < 1)
		n = 1;
	
	this.setHighlight(n);
};



_b.AutoSuggest.prototype.setHighlight = function(n)
{
	var list = _b.DOM.gE("as_ul");
	if (!list)
		return false;
	
	if (this.iHigh > 0)
		this.clearHighlight();
	
	this.iHigh = Number(n);
	
	list.childNodes[this.iHigh-1].className = "as_highlight";
	
	this.killTimeout();
};


_b.AutoSuggest.prototype.clearHighlight = function()
{
	var list = _b.DOM.gE("as_ul");
	if (!list)
		return false;
	
	if (this.iHigh > 0)
	{
		list.childNodes[this.iHigh-1].className = "";
		this.iHigh = 0;
	}
};


_b.AutoSuggest.prototype.setHighlightedValue = function ()
{
	if (this.iHigh)
	{
		this.sInp = this.fld.value = this.aSug[ this.iHigh-1 ].value;
		
		this.fld.focus();
		if (this.fld.selectionStart)
			this.fld.setSelectionRange(this.sInp.length, this.sInp.length);
		
		this.clearSuggestions();

		if (typeof(this.oP.callback) == "function")
			this.oP.callback( this.aSug[this.iHigh-1] );
	}
};

_b.AutoSuggest.prototype.killTimeout = function()
{
	clearTimeout(this.toID);
};

_b.AutoSuggest.prototype.resetTimeout = function()
{
	clearTimeout(this.toID);
	var pointer = this;
	this.toID = setTimeout(function () { pointer.clearSuggestions() }, 1000);
};

_b.AutoSuggest.prototype.clearSuggestions = function ()
{
	
	this.killTimeout();
	
	var ele = _b.DOM.gE(this.idAs);
	var pointer = this;
	if (ele)
	{
		var fade = new _b.Fader(ele,1,0,250,function () { _b.DOM.remE(pointer.idAs) });
	}
};

if (typeof(_b.Ajax) == "undefined")
	_b.Ajax = {};

_b.Ajax = function ()
{
	this.req = {};
	this.isIE = false;
};

_b.Ajax.prototype.makeRequest = function (url, meth, onComp, onErr)
{
	
	if (meth != "POST")
		meth = "GET";
	
	this.onComplete = onComp;
	this.onError = onErr;
	
	var pointer = this;
	
	if (window.XMLHttpRequest)
	{
		this.req = new XMLHttpRequest();
		this.req.onreadystatechange = function () { pointer.processReqChange() };
		this.req.open("GET", url, true); //
		this.req.send(null);

	}
	else if (window.ActiveXObject)
	{
		this.req = new ActiveXObject("Microsoft.XMLHTTP");
		if (this.req)
		{
			this.req.onreadystatechange = function () { pointer.processReqChange() };
			this.req.open(meth, url, true);
			this.req.send();
		}
	}
};


_b.Ajax.prototype.processReqChange = function()
{
	
	if (this.req.readyState == 4) {

		if (this.req.status == 200)
		{
			this.onComplete( this.req );
		} else {
			this.onError( this.req.status );
		}
	}
};

if (typeof(_b.DOM) == "undefined")
	_b.DOM = {};

_b.DOM.cE = function ( type, attr, cont, html )
{
	var ne = document.createElement( type );
	if (!ne)
		return 0;
		
	for (var a in attr)
		ne[a] = attr[a];
	
	var t = typeof(cont);
	
	if (t == "string" && !html)
		ne.appendChild( document.createTextNode(cont) );
	else if (t == "string" && html)
		ne.innerHTML = cont;
	else if (t == "object")
		ne.appendChild( cont );

	return ne;
};

_b.DOM.gE = function ( e )
{
	var t=typeof(e);
	if (t == "undefined")
		return 0;
	else if (t == "string")
	{
		var re = document.getElementById( e );
		if (!re)
			return 0;
		else if (typeof(re.appendChild) != "undefined" )
			return re;
		else
			return 0;
	}
	else if (typeof(e.appendChild) != "undefined")
		return e;
	else
		return 0;
};

_b.DOM.remE = function ( ele )
{
	var e = this.gE(ele);
	
	if (!e)
		return 0;
	else if (e.parentNode.removeChild(e))
		return true;
	else
		return 0;
};

_b.DOM.getPos = function ( e )
{
	var e = this.gE(e);

	var obj = e;

	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curleft += obj.offsetLeft;
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
	
	var obj = e;
	
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop;
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		curtop += obj.y;

	return {x:curleft, y:curtop};
};

if (typeof(_b.Fader) == "undefined")
	_b.Fader = {};

_b.Fader = function (ele, from, to, fadetime, callback)
{	
	if (!ele)
		return 0;
	
	this.e = ele;
	this.from = from;
	this.to = to;
	this.cb = callback;
	this.nDur = fadetime;	
	this.nInt = 50;
	this.nTime = 0;
	var p = this;
	this.nID = setInterval(function() { p._fade() }, this.nInt);
};

_b.Fader.prototype._fade = function()
{
	this.nTime += this.nInt;
	
	var ieop = Math.round( this._tween(this.nTime, this.from, this.to, this.nDur) * 100 );
	var op = ieop / 100;
	
	if (this.e.filters)
	{
		try
		{
			this.e.filters.item("DXImageTransform.Microsoft.Alpha").opacity = ieop;
		} catch (e) { 
			this.e.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity='+ieop+')';
		}
	}
	else
	{
		this.e.style.opacity = op;
	}
	
	if (this.nTime == this.nDur)
	{
		clearInterval( this.nID );
		if (this.cb != undefined)
			this.cb();
	}
};

_b.Fader.prototype._tween = function(t,b,c,d)
{
	return b + ( (c-b) * (t/d) );
};

// validate - validate entered text is numeric

function checkit(_obj)
{
var regexp = /^\d*$/
if (!(regexp.test(_obj.value)))
   {
   alert("Please enter only valid numbers 0-9")

   if (_obj.value.length > 0)
      {
      _obj.value = _obj.value.substr(0,_obj.value.search(/\D/))
      }
   }
}

// resize large images...

function imageResize(image)
			{
				var maxwidth = 600;
				var maxheight = 600;				

				if (image.className == "posted_image")
				{
					w = image.width;
					h = image.height;

					if( w == 0 || h == 0 )
					{
						image.width = maxwidth;
						image.height = maxheight;
					}
					else if (w > h)
					{
						if (w > maxwidth) image.width = maxwidth;
					}
					else
					{
						if (h > maxheight) image.height = maxheight;
					}

					if( w > maxwidth || h > maxheight )
					{
						image.style.cursor = "pointer";
						image.className = "resized_image";
					}
				}
			}
			
// show hide private messages

			function toggletrmessage(messageid) {
				var togglebuttonstatus = document.getElementById('trmessagetogglebutton_' + messageid);
				var trmessage = document.getElementById('tr_message_' + messageid);
				var trfooteroptions = document.getElementById('tr_messagefooter_options_' + messageid);
				if(trmessage.style.display == 'none') {
					trmessage.style.display = '';
					trfooteroptions.style.display = '';
					togglebuttonstatus.innerHTML = '-';
				} else {
					trmessage.style.display = 'none';
					trfooteroptions.style.display = 'none';
					togglebuttonstatus.innerHTML = '+';
				}
			}

// check user agreement to the Above Terms & Conditions

			function check_agreement(warn_msg) {

				if (document.getElementById('user_agree').checked == false) {
					alert(warn_msg);
                                        return false;
				}
			}

// show / hide redirection input

			function showhide_redirect() {

				if (document.getElementById('redirect_url_checkbox').checked == false) {
                                        document.getElementById('redirect').style.display = 'none';
                                        document.getElementById('redirect_url_input').value = '';
				}
                                else {
                                        document.getElementById('redirect').style.display = 'block';
                                }
			}
