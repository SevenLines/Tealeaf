$(document).click(function(e) {
	if(e.target.className==="loginModal_overlay") {
		$(e.target).fadeToggle('fast');
		$(".loginModal_overlay_bg").fadeToggle('fast');
	}
})

$(document).ready(function() {
	
	$('.price').find('.data').hide().end().find('span').click(function() {
		$(this).next().slideToggle('fast');
		//$(this).find('span').toggleClass('colorNiceBlue');
	})
	
    $('.menu li').hover(
		function () {
			//show its submenu
			$('ul', this).stop().slideDown(100);

		}, 
		function () {
			//hide its submenu
			$('ul', this).stop().slideUp(100);			
		}
	);
	
	$('.photo a').click(function() {	
		//return false;
	})
	
	$('.login .enter').click(function() {	
		$(".loginModal_overlay").fadeToggle('fast');
		$(".loginModal_overlay_bg").fadeToggle('fast');
		return false;
	})

});

String.prototype.pEncode = function(d1, d2, d3) {
	document.write(this+ d3 +"-"+ d2 +"-"+ d1);
}

String.prototype.contact = 
function (_hamper,_prefix,_postfix,_face)
{
  _prefix = _prefix.split("").reverse().join("")
  _hamper=
  _prefix+
  "@"+
  this+
  (_postfix || '')
  document.write((_face||_hamper).link("mailto:"+_hamper));
}
	