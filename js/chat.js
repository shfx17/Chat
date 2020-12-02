let from = null;
let start = 0;
let url = "http://localhost/SimpleChat/chat.php";
			
$(document).ready(function(){
	from = prompt("Podaj imię: ");
	load();
				
	$('form').submit(function(e){
	const date = new Date();
					
	var getMessage = $('#message').val();
					
	$.post(url, {
		message: getMessage,
		from: from,
		getHours: date.getHours(),
		getMinutes: date.getMinutes()
	});
						
		$('#message').val('');
		return false;
	});
});
			
function load(){
	$.get(url + '?start=' + start, function(result){
		if(result.items){
			result.items.forEach(item => {
				start = item.id;
				$('#messages').append(renderMessage(item));
			});
			$('#messages').animate({ scrollTop: $('#messages')[0].scrollHeight}); 
		}
	load();
	});
}	
			
function renderMessage(item){
	return `<div style='text-align: left;' class='container'><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/Calico_tabby_cat_-_Savannah.jpg/1200px-Calico_tabby_cat_-_Savannah.jpg" alt="Avatar"><p><b>${item.name}</b></p>${item.message}<span class="time-right">${item.hours}:${item.minutes}</span></div>`;
}