// DECLARATION DES FONCTIONS


function modif_adresse(){
	//---------------------------------------
	//AJAX MODIFICATION ADRESSES
	//---------------------------------------

	$('.modif_adresse_link').click(function(info)
		{
		info.preventDefault();
		var id_adresse = $(this).data('id');
		var id_user = $(this).data('user');
		$.get('index.php?ajax=user_adresse_modif&id_user='+id_user+'&id_adresse='+id_adresse, function(data){
			 $('#modif_adresse'+id_adresse).html(data);

			$('#form_adresse_modif'+id_adresse).submit(function(info)
			{
				info.preventDefault();
				nom_adresse = $(this).find('.am_nom_adresse').val();
				prenom_adresse = $(this).find('.am_prenom_adresse').val();
				action = $(this).find('.am_action').val();
				ligne1 = $(this).find('.am_ligne1').val();
				ligne2 = $(this).find('.am_ligne2').val();
				code = $(this).find('.am_code').val();
				ville = $(this).find('.am_ville').val();
				pays = $(this).find('.am_pays').val();
				
					
				$.post($(this).attr('action'),
					{"action": action,
					 "nom_adresse": nom_adresse,
					 "prenom_adresse": prenom_adresse,
					 "ligne1" : ligne1,
					 "ligne2" : ligne2,
					 "code" : code,
					 "ville" : ville,
					 "pays" : pays,
					}, function(data)
					 {					 	
					 	$('#modif_adresse').html(data);
						modif_adresse();		 	
					 	}); 
			return false;
			});
		});	  
		return false;
	});
}


// EXECUTION DU SCRIPT QUAND LE DOCUMENT HTML/PHP EST PRET

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

	//---------------------------------------
	//AJAX MODIFICATION USER
	//---------------------------------------
	
	$('#modif_user_link').click(function(info)
		{
		info.preventDefault();
		var id_user = $(this).data('id');
		$.get('index.php?ajax=user_modif&id_user='+id_user , function(data){
			 $('#modif_user').html(data);

			$('#form_user_modif').submit(function(info)
			{
				info.preventDefault();
				nom = $(this).find('#um_nom').val();
				prenom = $(this).find('#um_prenom').val();
				action = $(this).find('#um_action').val();
				email = $(this).find('#um_email').val();
				telephone = $(this).find('#um_telephone').val();
					
				$.post($(this).attr('action'),
					{"action": action,
					 "nom": nom,
					 "prenom": prenom,
					 "email" : email,
					 "telephone" : telephone
					}, function(data)
					 {
					 	
					 		$('#modif_user').html(data);
					 	
					 	

					 	
					 	
				}); 
			return false;
			});
		});	  
		return false;
	});

	//---------------------------------------
	//AJAX MODIFICATION ADRESSES
	//---------------------------------------

	modif_adresse();	




})