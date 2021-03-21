require('./bootstrap');


var APP = {
	init:function(){
		$('.search').on('keyup', this.search);
		$('.search_results').on('click', 'a', this.select_stock);
		$('.search_ticker').on('submit', this.add_trade);
	},

	search:function(e){
		e.preventDefault();
		var search_term = $(this).val();

		if(!search_term.length){
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
        			// console.log(response);

        			var results ='';
        			for(var i=0;i<response.length;i++){
        				results+= '<a class="list-group-item list-group-item-action" data-ticker="'+response[i].symbol+'" href="#"><span class="ticker">'+response[i].symbol +'</span> - <span class="company_name">' + response[i].securityName+'</span>' + ' (' +response[i].exchange+')</a>';
        			}

        			$('.search_results').append(results).show();				
        		}
        	});
        }
	},

	select_stock:function(e){
		e.preventDefault();
		var ticker = $(this).data('ticker');
		var company_name = $(this).find('.company_name').text();
		$('.search').val(ticker +' - '+ company_name);
		$('.ticker').val(ticker);
		$('.company_name').val(company_name);
		$('.search_results').empty().hide();
	},

	add_trade:function(e){
		e.preventDefault();
		var ticker = $('.ticker').val(),
			company_name = $('.company_name').val(),
			date_purchased = $('.date_purchased').val(),
			purchase_price = $('.purchase_price').val(),
			numb_shares = $('.numb_shares').val()
		;

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
        	url:'add_trade/'+ticker,
        	type:'POST',
        	dataType:'json',
        	data:{
        		_token:token,
        		ticker:ticker,
        		company_name:company_name,
        		date_purchased:date_purchased,
        		purchase_price:purchase_price,
        		numb_shares:numb_shares
        	},
        	success:function(response){
        		$('.search_results').empty().hide();
        		$('input.search').val('');
        	}
        })
	}
}

$(document).ready(function(){
	APP.init();

});