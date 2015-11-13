$(document).ready(function () {
	console.log("jQuery");
	voteAction();
});

function voteAction(){
	$("#vote-button").click(function(){
		$(this).removeClass();
		$(this).addClass('btn btn-primary');
		console.log("Sii");
	});
}