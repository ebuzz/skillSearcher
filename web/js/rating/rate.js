$(document).ready(function () {
	console.log("jQuery");
	voteAction();
});

function voteAction(){
	$("#vote-button").click(function(){
		$(this).removeClass();
		$(this).addClass('btn btn-danger');
		console.log("Sii");
	});
}