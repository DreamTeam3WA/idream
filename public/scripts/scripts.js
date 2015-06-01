$('document').ready(function()
{
	$('.add_commentaire').click(function(){
		$('.mce_hide').toggle(500);
	})
	$('.signup, .fermer_add_user').click(function(){
		$('.inscription').toggle(500);
		$('.connection').css('display',"none");
	})
	$('.signin, .fermer_add_user').click(function(){
		$('.connection').toggle(500);
		$('.inscription').css('display',"none");
	})

	$('ps_commentaire').submit(function(info)
	{
		info.preventDefault();
		$note = $(this).find('#note').val();
		$commentaire_add = $(this).find('#commentaire_add').val();
		$id_produit = $(this).find('#ps_id_produit').val();
		$commentaire = $(this).find('#ps_comm').val();
		$message = $(this).find('#contact-message').val();
		$.post($(this).attr('action'),
			{"note":$note ,
			 "action":$commentaire_add,
			 "nom" : $nom,
			 "id_produit" : $id_produit,
			 "commentaires" :$commentaire
			}); 

		$.get('index.php?ajax=produit_commentaire_liste',function(data)
		{
			$('#contact-content').html(data);
		});
		// function(data)
		// {
		// 	$('body').html(data);
		// });
		return false;
	});















})