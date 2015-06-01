$('document').ready(function()
{
	$('.add_commentaire').click(function(){
		$('.mce_hide').toggle(500);
	})
	$('.signup, .fermer_add_user').click(function(){
		$('.inscription').toggle(500);
	})
	$('.signin, .fermer_add_user').click(function(){
		alert("aaa");
		$('.connection').toggle(500);
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















})