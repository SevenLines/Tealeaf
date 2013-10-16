$(document).ready(function() {
	
	$('.price').find('.data').hide().end().find('span').click(function() {
		$(this).next().slideToggle('fast');
	});
	
	$('.lab').find('.info').hide().end().find('.title').click(function() {
		$(this).next().slideToggle();
	});
	
    $('.nav>ul>li').hover(
		function () {
			//show its submenu
			$('ul', this).stop().slideDown(100);

		}, 
		function () {
			//hide its submenu
			$('ul', this).stop().slideUp(100);			
		}
	);

	$('.login .enter').click(function() {	
		$(".loginModal_overlay").fadeToggle('fast');
		$(".loginModal_overlay_bg").fadeToggle('fast');
		return false;
	});
	
	
	
	

});

// save content values
// and check values for changing before submitting
submit_only_changed = function(objHTMLFormElement) {
	var form = objHTMLFormElement;
	var inputs = [];
	for (var i=0;i<form.childNodes.length;++i) {
		var child = form.childNodes[i];
		if (child.tagName) {
			var tag = child.tagName.toLowerCase();
			if (tag == 'input' || tag == 'textarea' || tag == 'select') {
				var struct = {
					'object': child,
					'initialValue': child.value || child.checked,
					'toString' : function() {return this.initialValue;},
				};
				function setOnChange(child, struct) {
					child.onchange = function() {
						var value = this.value || this.checked;
						if ( value !==  struct.initialValue) {
							if (!child.className.match(/\bedited\b/)) {
								child.className += 'edited';
							}
						} else {
							child.className = child.className.replace(/\bedited\b/,'');
						}
					};
				};
				setOnChange(child, struct);
				inputs.push(struct);
			}
		}
	}
	
	// on submit disable not changed inputs
	form.addEventListener("submit", function() {
		for(var i=0;i<inputs.length; ++i) {
			if (inputs[i].object.value === inputs[i].initialValue) {
				inputs[i].object.disabled = true;
			}
		}
	}, false);
};

String.prototype.pEncode = function(d1, d2, d3) {
	document.write(this+ d3 +"-"+ d2 +"-"+ d1);
};

String.prototype.contact = 
function (_hamper,_prefix,_postfix,_face)
{
  _prefix = _prefix.split("").reverse().join("");
  _hamper=
  _prefix+
  "@"+
  this+
  (_postfix || '');
  document.write((_face||_hamper).link("mailto:"+_hamper));
};
	