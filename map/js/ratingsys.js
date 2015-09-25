var sMax;	// Isthe maximum number of stars
var holder; // Is the holding pattern for clicked state
var preSet; // Is the PreSet value onces a selection has been made
var rated = 0;
var prev_id = [];
var ids = -1;

// Rollover for image Stars //
function rating(num, provider_id){
	sMax = 0;	// Isthe maximum number of stars
	for(n=0; n<num.parentNode.childNodes.length; n++){
		if(num.parentNode.childNodes[n].nodeName == "A"){
			sMax++;	
		}
	}
	
	if(!rated){
		s = num.id.replace("_", ''); // Get the selected star
		a = 0;
		for(i=1; i<=sMax; i++){		
			if(i<=s){
				document.getElementById("_"+i).className = "on";
				document.getElementById("rateStatus").innerHTML = num.title;	
				holder = a+1;
				a++;
			}else{
				document.getElementById("_"+i).className = "";
			}
		}
	}
	
	else {
		ids = prev_id.indexOf(provider_id);
		if(ids == -1){
			s = num.id.replace("_", ''); // Get the selected star
			a = 0;
			for(i=1; i<=sMax; i++){		
				if(i<=s){
					document.getElementById("_"+i).className = "on";
					document.getElementById("rateStatus").innerHTML = num.title;	
					holder = a+1;
					a++;
				}else{
					document.getElementById("_"+i).className = "";
				}
			}
		}
	}
}

// For when you roll out of the the whole thing //
function off(me, provider_id){
	if(!rated){
		if(!preSet){	
			for(i=1; i<=sMax; i++){		
				document.getElementById("_"+i).className = "";
				document.getElementById("rateStatus").innerHTML = me.parentNode.title;
			}
		}else{
			rating(preSet,provider_id);
			document.getElementById("rateStatus").innerHTML = document.getElementById("ratingSaved").innerHTML;
		}
	}
	
	else {
		ids = prev_id.indexOf(provider_id);
		if(ids == -1){
			if(preSet){
				for(i=1; i<=sMax; i++){		
					document.getElementById("_"+i).className = "";
					document.getElementById("rateStatus").innerHTML = me.parentNode.title;
				}
			}else{
				rating(preSet,provider_id);
				document.getElementById("rateStatus").innerHTML = document.getElementById("ratingSaved").innerHTML;
			}
		}
	}
}

// When you actually rate something //
function rateIt(me, provider_id){
	if(!rated){
		document.getElementById("rateStatus").innerHTML = document.getElementById("ratingSaved").innerHTML + " :: "+me.title;
		preSet = me;
		rated=1;
		prev_id.push(provider_id);
		sendRate(me, provider_id);
		rating(me, provider_id);
	}
	
	else {
		ids = prev_id.indexOf(provider_id);
		if(ids == -1){
			document.getElementById("rateStatus").innerHTML = document.getElementById("ratingSaved").innerHTML + " :: "+me.title;
			preSet = me;
			prev_id.push(provider_id);
			sendRate(me, provider_id);
			rating(me, provider_id);
		}
	}
}

// Send the rating information somewhere using Ajax or something like that.
function sendRate(sel, provider_id){
	var rating = sel.title;
	send(rating, provider_id);
}

function send(rating, provider_id) {
	if (rating == "Hmmm...") {
		rating = 1;
	}
	
	else if (rating == "Not bad...") {
		rating = 2;
	}
	
	else if (rating == "Pretty good...") {
		rating = 3;
	}
	
	else if (rating == "Excellent!") {
		rating = 4;
	}
	
	else if (rating == "Pretty awesome!!!") {
		rating = 5;
	}
	
	var url = "php/process3.php?provider_id=" +provider_id+ "&status=" +rating;

	$.ajax({
		url: url,
		type: "POST",
		dataType: 'json',
		success: function(){}
	});
}