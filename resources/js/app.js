require('./bootstrap');


var APP = {
	init:function(){
		$('.search').on('keyup', this.search);
		$('.search_results').on('click', 'a', this.select_stock);
		$('.add_trade').on('submit', this.add_trade);
		$('.trade_type').on('click', this.show_trade_type_form);
		$('.edit_trade').on('click', this.edit_trade);
		$('.delete_trade').on('click', this.delete_trade);
		$('.update_profile').on('submit', this.update_profile);
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
			trade_type = $('.trade_type:checked').val(),
			purchase_price = $('.purchase_price').val(),
			brokerage=''
		;

		if($('.brokerage').length){
			brokerage = $('.brokerage').val();
		}

		if(trade_type=='shares'){
			var numb_shares = $('.numb_shares').val();
		}else{
			var option_type = $('.option_type:checked').val(),
				expiration_date = $('.expiration_date').val(),
				strike_price = $('.strike_price').val()
			;
		}

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
        		trade_type:trade_type,
        		date_purchased:date_purchased,
        		purchase_price:purchase_price,
        		numb_shares:numb_shares,
        		option_type:option_type,
        		expiration_date:expiration_date,
        		strike_price:strike_price,
        		brokerage:brokerage
        	},
        	success:function(response){
        		console.log(response);
        		$('.search_results').empty().hide();
        		$('.add_trade')[0].reset();
        	}
        })
	},

	show_trade_type_form:function(){
		$('.trade_type_form').hide();
		$('.'+$(this).val()).show();
	},

	delete_trade:function(){
		var trade_id = $(this).parent().parent().data('trade_id');
		var trade_ticker = $('.trade_history_table').find('[data-trade_id='+trade_id+']').find('.trade_ticker').text();
		var trade_company_name = $('.trade_history_table').find('[data-trade_id='+trade_id+']').find('.trade_company_name').text();

		$('#delete_trade_modal').find('.modal-body p span').text(trade_ticker +' '+ trade_company_name);
		console.log(trade_ticker +' '+ trade_company_name);
	},

	update_profile:function(e){
		e.preventDefault();
		var name = $('.update_profile #name').val()
			email = $('.update_profile #email').val(),
			phone = $('.update_profile #phone').val()
		;

		var brokerages = [];
        $('.update_profile #brokerage option:selected').each(function () {
            brokerages.push($(this).val());
        });


		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
        	url:'update_profile',
        	type:'POST',
        	dataType:'json',
        	data:{
        		_token:token,
        		name:name,
        		email:email,
        		phone:phone,
        		brokerage:brokerages
        	},
        	success:function(response){
        		console.log(response);
        		$('.update_profile')[0].reset();
        		location.reload();			
        	}
        });
	}
}

$(document).ready(function(){
	APP.init();
	document.getElementById("purchase_price").onblur =function (){    

	    //number-format the user input
	    this.value = parseFloat(this.value.replace(/,/g, ""))
	                    .toFixed(2)
	                    .toString()
	                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

	    // //set the numeric value to a number input
	    this.value = this.value.replace(/,/g, "")

	}
});