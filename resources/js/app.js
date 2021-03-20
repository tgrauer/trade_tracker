require('./bootstrap');


var APP = {
	init:function(){
		$('.search').on('keyup', this.search);
		$('.search_results').on('click', 'a', this.add_trade);
	},

	search:function(e){
		e.preventDefault();
		var search_term = $(this).val();

		if(!search_term.length){
			console.log('should hide');
			$('.search_results').empty().hide();
			search_term='';
		}

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var token = $('meta[name="csrf-token"]').attr('content');

        if(search_term.length){
        	$.ajax({
        		url:'/search/'+search_term,
        		type:'POST',
        		dataType:'json',
        		data:{
        			_token:token,
        			search_term:search_term
        		},
        		success:function(response){
        			console.log(response);

        			var results ='';
        			for(var i=0;i<response.length;i++){
        				results+= '<a class="list-group-item list-group-item-action" data-ticker="'+response[i].symbol+'" href="#"><span class="company_name">'+response[i].symbol +' | ' + response[i].securityName+'</span>' + ' (' +response[i].exchange+')</a>';
        			}

        			$('.search_results').append(results).show();				
        		}
        	});
        }
	},

	add_trade:function(e){
		e.preventDefault();
		var ticker = $(this).data('ticker');
		$('.search_results').empty().hide();
		$('input.search').val('');

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
        	url:'/add_trade/'+ticker,
        	type:'POST',
        	dataType:'json',
        	data:{
        		_token:token,
        		ticker:ticker
        	},
        	success:function(response){
        		console.log(response);
        		
        	}
        })
	}
}

$(document).ready(function(){
	APP.init();

});