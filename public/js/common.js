$(document).ready(function(){


	$body = $("body");
	$(document).on('click','#msg',function(){
		$(this).html("");
		$( "#msg" ).fadeOut( 3000, function(){});
	});

	$(document).on({
	    ajaxStart: function() { $body.addClass("loading");    },
	    ajaxStop: function() { $body.removeClass("loading"); }
	});
	$('.dynatable-per-page-select').addClass('form-control');
	$('.dynatable-search').find('input').addClass('form-control');
	$('.dynatable-search').find('input').attr('placeholder', "Search Term");
});

// Common Functions


function encodeMe(string, quote_style, charset, double_encode) {
var optTemp = 0,
	i = 0,
	noquotes = false;
if (typeof quote_style === 'undefined' || quote_style === null) {
	quote_style = 2;
}
string = string.toString();
if (double_encode !== false) { // Put this first to avoid double-encoding
	string = string.replace(/&/g, '&amp;');
}
string = string.replace(/</g, '&lt;')
	.replace(/>/g, '&gt;').replace(/ /g, '%2031');

var OPTS = {
	'ENT_NOQUOTES': 0,
	'ENT_HTML_QUOTE_SINGLE': 1,
	'ENT_HTML_QUOTE_DOUBLE': 2,
	'ENT_COMPAT': 2,
	'ENT_QUOTES': 3,
	'ENT_IGNORE': 4
};
if (quote_style === 0) {
	noquotes = true;
}
if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
	quote_style = [].concat(quote_style);
	for (i = 0; i < quote_style.length; i++) {
	// Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
	if (OPTS[quote_style[i]] === 0) {
		noquotes = true;
	} else if (OPTS[quote_style[i]]) {
		optTemp = optTemp | OPTS[quote_style[i]];
	}
	}
	quote_style = optTemp;
}
if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
	string = string.replace(/'/g, '&#039;');
}
if (!noquotes) {
	string = string.replace(/"/g, '&quot;');
}

return string;
}

function decodeMe(string, quote_style) {
var optTemp = 0,
	i = 0,
	noquotes = false;
if (typeof quote_style === 'undefined') {
	quote_style = 2;
}
string = string.toString()
	.replace(/&lt;/g, '<')
	.replace(/&gt;/g, '>')
	.replace(/%2031/g,' ');
var OPTS = {
	'ENT_NOQUOTES': 0,
	'ENT_HTML_QUOTE_SINGLE': 1,
	'ENT_HTML_QUOTE_DOUBLE': 2,
	'ENT_COMPAT': 2,
	'ENT_QUOTES': 3,
	'ENT_IGNORE': 4
};
if (quote_style === 0) {
	noquotes = true;
}
if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
	quote_style = [].concat(quote_style);
	for (i = 0; i < quote_style.length; i++) {
	// Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
	if (OPTS[quote_style[i]] === 0) {
		noquotes = true;
	} else if (OPTS[quote_style[i]]) {
		optTemp = optTemp | OPTS[quote_style[i]];
	}
	}
	quote_style = optTemp;
}
if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
	string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
	// string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
}
if (!noquotes) {
	string = string.replace(/&quot;/g, '"');
}
// Put this in last place to avoid escape being double-decoded
string = string.replace(/&amp;/g, '&');

return string;
}
