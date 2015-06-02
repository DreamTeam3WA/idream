$('document').ready(function()
{
	$('.add_commentaire').click(function(){
		$('.mce_hide').toggle(500);
	})
	$('.signup, .fermer_add_user').click(function(){
		$('.inscription').toggle(500);
		$('.connection').css('display',"none");
	})
	$('.signin, .fermer_connect').click(function(){
		$('.connection').toggle(500);
		$('.inscription').css('display',"none");
	})

	$('#ps_commentaire').submit(function(info)
	{
		info.preventDefault();
		note = $(this).find('#note').val();
		commentaire_add = $(this).find('#commentaire_add').val();
		id_produit = $(this).find('#ps_id_produit').val();
		commentaire = tinyMCE.get('ps_comm').getContent();
		$.post($(this).attr('action'),
			{"note":note ,
			 "action": commentaire_add,
			 "id_produit" : id_produit,
			 "commentaire" : commentaire
			}, function()
			{
				$.get('index.php?ajax=produit_single&id_produit='+id_produit,function(data)
				{
					$('#container-main section').html(data);
					$('.caroussel').bxSlider({
					mode: "fade"
					// startSlide
				});
				});
			}); 
		return false;
	});

	$('#user_add').submit(function(info)
		{
		info.preventDefault();
		nom = $(this).find('#ua_name').val();
		prenom = $(this).find('#ua_username').val();
		action = $(this).find('#ua_action').val();
		email = $(this).find('#ua_email').val();
		telephone = $(this).find('#ua_telephone').val();
		date = $(this).find('#ua_date').val();
		password = $(this).find('#ua_password').val();
		password2 = $(this).find('#ua_password2').val();
		
		$.post($(this).attr('action'),
			{"action": action,
			 "nom": nom,
			 "prenom": prenom,
			 "email" : email,
			 "telephone" : telephone,
			 "date_naissance" : date,
			 "password" : password,
			 "password2" : password2
			}, function(data)
			 {
			 	if (data != ""){
			 		$('#ua_message').html(data);}
			 	else{
			 		document.getElementById('user_add').reset();
			 		$('.connection').toggle(500);
					$('.inscription').css('display',"none");
					$('#ua_ok').css('display',"block");

			 	}
			 	
			 }); 
		return false;
	});














})