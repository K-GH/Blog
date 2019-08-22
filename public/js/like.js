//alert('test');

$(".like").on('click',function(){

//alert('test');
	var like_s = $(this).attr('data-like'); // get from html 
	var post_id = $(this).attr('data-postid'); // get from html
	post_id=post_id.slice(0,-2);
	//alert(like_s);
	//alert(post_id);

	$.ajax({

		//sent all var with value to controller (PHP) before success 
		//three var in left side and three value in right side
		type: 'POST',
		url : url, // have a value form masterPage.blade.php
		data : { like_s : like_s , post_id : post_id , _token: token}, //array with value , token for security 

		success: function(data){

			//alert(data.is_like);
			//alert(data.postID);

			if (data.is_like == 1)
			 {
			 	$('*[data-postid="'+ post_id +'_l"]').removeClass('btn-secondry').addClass('btn-success');

			 	$('*[data-postid="'+ post_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry');

			 	var current_like_count =$('*[data-postid="'+ post_id +'_l"]').find('.like_count').text();
			 	var new_like= parseInt(current_like_count)+1;
			 	$('*[data-postid="'+ post_id +'_l"]').find('.like_count').text(new_like);

			 	if (data.count_dislike == 1) 
			 	{
				 	var current_dislike_count =$('*[data-postid="'+ post_id +'_d"]').find('.dislike_count').text();
				 	var remove_dislike= parseInt(current_dislike_count)-1;
				 	$('*[data-postid="'+ post_id +'_d"]').find('.dislike_count').text(remove_dislike);

			 	}
			 }

			 if (data.is_like == 0)
			 {
			 	$('*[data-postid="'+ post_id +'_l"]').removeClass('btn-success').addClass('btn-secondry');

			 	var current_like_count =$('*[data-postid="'+ post_id +'_l"]').find('.like_count').text();
			 	var remove_like= parseInt(current_like_count)-1;
			 	$('*[data-postid="'+ post_id +'_l"]').find('.like_count').text(remove_like);
			 }

		}

	});

});



$(".dislike").on('click',function(){

//alert('test');
	var like_s = $(this).attr('data-like'); // get from html 
	var post_id = $(this).attr('data-postid'); // get from html
	post_id=post_id.slice(0,-2);
	//alert(like_s);
	//alert(post_id);

	$.ajax({

		//sent all var with value to controller (PHP) before success 
		//three var in left side and three value in right side
		type: 'POST',
		url : url_dis, // have a value form masterPage.blade.php
		data : { like_s : like_s , post_id : post_id , _token: token}, //array with value , token for security 

		success: function(data){

			//alert(data.is_like);
			//alert(data.postID);
			//action to html

			if (data.is_dislike == 1)
			 {
			 	$('*[data-postid="'+ post_id +'_d"]').removeClass('btn-secondry').addClass('btn-danger');
			 	$('*[data-postid="'+ post_id +'_l"]').removeClass('btn-success').addClass('btn-secondry');

			 	var current_dislike_count =$('*[data-postid="'+ post_id +'_d"]').find('.dislike_count').text();
			 	var new_dislike= parseInt(current_dislike_count)+1;
			 	$('*[data-postid="'+ post_id +'_d"]').find('.dislike_count').text(new_dislike);

			 	if (data.count_like == 1)
			 	 {

				 	var current_like_count =$('*[data-postid="'+ post_id +'_l"]').find('.like_count').text();
				 	var remove_like= parseInt(current_like_count)-1;
				 	$('*[data-postid="'+ post_id +'_l"]').find('.like_count').text(remove_like);
			 	 }
			 
			 }

			 if (data.is_dislike == 0)
			 {
			 	$('*[data-postid="'+ post_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry');

			 	var current_dislike_count =$('*[data-postid="'+ post_id +'_d"]').find('.dislike_count').text();
			 	var remove_dislike= parseInt(current_dislike_count)-1;
			 	$('*[data-postid="'+ post_id +'_d"]').find('.dislike_count').text(remove_dislike);
			 }

		}

	});

});

