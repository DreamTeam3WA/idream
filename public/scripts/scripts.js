$('document').ready(function()
{
	$('.add_commentaire').click(function(){
		$('.mce_hide').toggle(500);
	})
	$('.signup, .fermer_add_user').click(function(){
		$('.inscription').toggle(500);
		$('.connection').css('display',"none");
		$('.panier_maj').css('display',"none");
	})
	$('.signin, .fermer_connect').click(function(){
		$('.connection').toggle(500);
		$('.panier_maj').css('display',"none");
		$('.inscription').css('display',"none");
	})
	$('.panier, .fermer_panier').click(function(){
		$('.panier_maj').toggle(500);
		$('.inscription').css('display',"none");
		$('.connection').css('display',"none");
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

	$('#uc').submit(function(info)
		{
		info.preventDefault();
		email = $(this).find('#uc_email').val();
		password = $(this).find('#uc_password').val();
		action =$(this).find('#uc_connect').val();

		$.post($(this).attr('action'),
			{"action": action,
			 "email": email,
			 "pass": password
			}, function(data)
			 {
			 	if (data != ""){
			 		$('#uc_message').html(data);}
			 	else{
			 		window.location.reload();
			 	}
			 	
			 }); 
		return false;
	});
	i=1;
	$('#image_add').click(function(){
		newlabelimage= $('<label for="lien'+i+'">Lien image :</label>');
		newinputimage= $('<input id="lien'+i+'" name="lien'+i+'" type="text" placeholder="./images/">');
		$('.div_image_add').append(newlabelimage, newinputimage);
		i++;
	});

	$('#autosearch').keyup(function(){
		search=$('#autosearch').val();
		category= $('#produit_select').find('#category').val();
		action = $('#produit_select').find('#produit_search').val();
		$.post($(this).parents('form').attr('action'),
			{"action":action,
			  "category":category,
			  "nom":search
			}, function(data)
			{
				$('#result_search').empty();
				if (data != ""){
					$('#result_search').append(data);
					$('.resultat_search p').click(function(){
							var id = $(this).data('id');
							var id_category = $(this).data('category');
							$.get("index.php?ajax=produit_modif&id_produit="+id, function(data)
							{
								if (data != ""){

								$('.actualisation_produit').html(data);
								$('#category_modif option[value="'+id_category+'"]').prop('selected', true);
								j=0;
								$('#image_modif').click(function(){
								newlabelimage= $('<label for="id_img'+j+'">Lien image :</label>');
								newinputimage= $('<input id="id_img'+j+'" name="id_img'+j+'" type="text" placeholder="./images/">');
								$('.div_image_modif').append(newlabelimage, newinputimage);
								j++;
							});
							}
							})
					})
				}
			})
	});
	$('#autosearch2').keyup(function(){
		search=$('#autosearch2').val();
		category= $('#produit_select').find('#category').val();
		action = $('#produit_select').find('#produit_search').val();
		$.post($(this).parents('form').attr('action'),
			{"action":action,
			  "category":category,
			  "nom":search
			}, function(data)
			{
				$('#result_search').empty();
				if (data != ""){
					$('#result_search').append(data);
					$('.resultat_search p').click(function(){
							var id = $(this).data('id');
							var id_category = $(this).data('category');
							$.get("index.php?ajax=produit_suppr&id_produit="+id, function(data)
							{
								if (data != ""){
								$('.suppr').html(data);
								$('.suppr').css('display','block');
								}
							})
					})
				}
			})
	});



})