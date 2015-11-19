$(document).ready(function() {
    if(window.location.href.indexOf("user") > 0){
        $("li.user").addClass("active");
    } else if (window.location.href.indexOf("skill") > 0) {
    	$("li.skills").addClass("active");
    } else if (window.location.href.indexOf("position") > 0){
    	$("li.positions").addClass("active");
    } else if (window.location.href.indexOf("account") > 0){
    	$("li.account").addClass("active");
    } else if(window.location.href.indexOf("equip") > 0){
    	$("li.equip").addClass("active");
    } else {
    	$('.second-top').find('li').removeClass('.active')
    }
});