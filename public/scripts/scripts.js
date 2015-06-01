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
})