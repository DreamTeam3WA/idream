$('document').ready(function()
{
	$('.add_commentaire').click(function(){
		$('.mce_hide').toggle(500);
	})
	$('.signup, .fermer_add_user').click(function(){
		$('.inscription').toggle(500);
	})
	$('.signin, .fermer_add_user').click(function(){
		// aler	t("aaa");
		$('.connection').toggle(500);
	})
})