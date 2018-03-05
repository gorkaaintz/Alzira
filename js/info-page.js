
;(function($) {

	$('.alzira-tab-nav a').on('click',function (e) {
		e.preventDefault();
		$(this).addClass('active').siblings().removeClass('active');
	});

	$('.alzira-tab-nav .begin').on('click',function (e) {		
		$('.alzira-tab-wrapper .begin').addClass('show').siblings().removeClass('show');
	});	
	$('.alzira-tab-nav .actions, .alzira-tab .actions').on('click',function (e) {		
		e.preventDefault();
		$('.alzira-tab-wrapper .actions').addClass('show').siblings().removeClass('show');

		$('.alzira-tab-nav a.actions').addClass('active').siblings().removeClass('active');

	});	
	$('.alzira-tab-nav .support').on('click',function (e) {		
		$('.alzira-tab-wrapper .support').addClass('show').siblings().removeClass('show');
	});	
	$('.alzira-tab-nav .table').on('click',function (e) {		
		$('.alzira-tab-wrapper .table').addClass('show').siblings().removeClass('show');
	});	


	$('.alzira-tab-wrapper .install-now').on('click',function (e) {	
		$(this).replaceWith('<p style="color:#23d423;font-style:italic;font-size:14px;">Plugin installed and active!</p>');
	});	
	$('.alzira-tab-wrapper .install-now.importer-install').on('click',function (e) {	
		$('.importer-button').show();
	});	


})(jQuery);
