
	$('.menu-item').hover(function(e){

		if ($('ul',this).css('display') == 'none'){
			$('ul',this).slideDown(200);
		}else{
			$('ul',this).slideUp(200);		}
	})
	$('.plus').click(function(){
		$(this).parent().prev().val(Number($(this).parent().prev().val())+1)
	});
	$('.minus').click(function(){
		if(Number($(this).parent().prev().val())>1){
			$(this).parent().prev().val(Number($(this).parent().prev().val())-1)
		}
		
	});
	$('.itm_btn').click(function(e){
		e.preventDefault();
		$form=$(this).parent();
		$id=$("input[name='item']").val();
		$count=$form.children('input').next().val();
		
		$size=$(".size").val();
		var $data=[$id,$count];
		$.ajax({
	    url: 'cart.php',             // указываем URL и
	    type: 'GET',
	   	data:{
                  id:$id,
                  size:$size,
                  count:$count
                },
	    success: function (data) { // вешаем свой обработчик на функцию success
	    	dat=JSON.parse(data);
	        $('.count').html(dat.count);
	        $('.price').html(dat.price);
	        alert('Товар добавлен в корзину')
	    } 
		});
	})
$(function(){
	$(".phone").mask("8(999) 999-99-99");
});
 	function delete_cookie ( cookie_name )
	{
	  var cookie_date = new Date ( );  // Текущая дата и время
	  cookie_date.setTime ( cookie_date.getTime() - 1 );
	  document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
	}
 	function get_cookie ( cookie_name )
		{
		  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]+)(;|$)' );
		  if ( results )
		    return ( unescape ( results[2] ) );
		  else
		    return null;
		}

