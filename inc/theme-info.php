<?php
/**
 * Theme info page
 *
 * @package Alzira
 */

//Add the theme page
add_action('admin_menu', 'alzira_add_theme_info');
function alzira_add_theme_info(){

	if ( !current_user_can('install_plugins') ) {
		return;
	}

	$theme_info = add_theme_page( __('Alzira Info','alzira'), __('Alzira Info','alzira'), 'manage_options', 'alzira-info.php', 'alzira_info_page' );
	add_action( 'load-' . $theme_info, 'alzira_info_hook_styles' );
}

//Callback
function alzira_info_page() {
	$user = wp_get_current_user();
?>
	<div class="info-container">
		<p class="hello-user"><?php echo sprintf( __( 'Hola, %s,', 'alzira' ), '<span>' . esc_html( ucfirst( $user->display_name ) ) . '</span>' ); ?></p>
		<h1 class="info-title"><?php echo sprintf( __( 'Bienvenido a Alzira version %s', 'alzira' ), esc_html( wp_get_theme()->version ) ); ?></h1>
		<p class="welcome-desc"><?php esc_html_e( 'Alzira está instalado y listo para empezar. Para ayudarte con los próximos pasos, reunimos en esta página todos los recursos que puedas necesitar. Esperamos que disfrutes usando Alzira. ', 'alzira' ); ?>
	

		<div class="alzira-theme-tabs">

			<div class="alzira-tab-nav nav-tab-wrapper">
				<a href="#begin" data-target="begin" class="nav-button nav-tab begin active"><?php esc_html_e( 'Empezando', 'alzira' ); ?></a>
				<a href="#actions" data-target="actions" class="nav-button actions nav-tab"><?php esc_html_e( 'Acciones recomendadas', 'alzira' ); ?></a>
				<a href="#support" data-target="support" class="nav-button support nav-tab"><?php esc_html_e( 'Soporte', 'alzira' ); ?></a>
			
			</div>

			<div class="alzira-tab-wrapper">

				<div id="#begin" class="alzira-tab begin show">
					<h3><?php esc_html_e( 'Paso 1 - Implementar las acciones recomendadas', 'alzira' ); ?></h3>
					<p><?php esc_html_e( 'Hemos realizado una lista con los pasos a seguir para sacar lo mejor de Alzira.', 'alzira' ); ?></p>
					<p><a class="actions" href="#actions"><?php esc_html_e( 'Seguir las acciones recomendadas', 'alzira' ); ?></a></p>
					<hr>
					<h3><?php esc_html_e( 'Paso 2 - Leer la documentación', 'alzira' ); ?></h3>
					<p><?php esc_html_e( 'Con la documentación, tu web correrá en pocos minutose.', 'alzira' ); ?></p>
					<p><a href="http://docs.athemes.com/category/8-alzira" target="_blank"><?php esc_html_e( 'Documentation', 'alzira' ); ?></a></p>
					<hr>
					<h3><?php esc_html_e( 'Paso 3 - Customizar', 'alzira' ); ?></h3>
					<p><?php esc_html_e( 'Usa el Customizador para hacer Alzira propia.', 'alzira' ); ?></p>
					<p><a class="button button-primary button-large" href="<?php echo admin_url( 'customize.php' ); ?>"><?php esc_html_e( 'Ir al Customizador', 'alzira' ); ?></a></p>
				</div>

				<div id="#actions" class="alzira-tab actions">
					<h3><?php esc_html_e( 'Instalar: Page Builder de SiteOrigin', 'alzira' ); ?></h3>
					<p><?php esc_html_e( 'Es altamente recomendable que instales Page Builder. Te permitirá crear páginas añadiendo widgets y usar el drag and drop.', 'alzira' ); ?></p>
					
					<?php if ( !defined( 'SITEORIGIN_PANELS_VERSION' ) ) : ?>
					<?php $so_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=siteorigin-panels'), 'install-plugin_siteorigin-panels'); ?>
					<p>
						<a target="_blank" class="install-now button" href="<?php echo esc_url( $so_url ); ?>"><?php esc_html_e( 'Instalar y Activar', 'alzira' ); ?></a>
					</p>
					<?php else : ?>
						<p style="color:#23d423;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin instalado y activado', 'alzira' ); ?></p>
					<?php endif; ?>

					<hr>
					<h3><?php esc_html_e( 'Instalar: Alzira Toolbox', 'alzira' ); ?></h3>
					<p><?php esc_html_e( 'Instala Alzira Toolbox. Para crear tipos de publicaciones personalizadas, como servicios y empleados, para que las utilices en su sitio web.', 'alzira' ); ?></p>
					<?php if ( !class_exists('Alzira_Toolbox') ) : ?>
					<?php $st_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=alzira-toolbox'), 'install-plugin_alzira-toolbox'); ?>
					<p>
						<a target="_blank" class="install-now button" href="<?php echo esc_url( $st_url ); ?>"><?php esc_html_e( 'Instalar y Activar', 'alzira' ); ?></a>
					</p>
					<?php else : ?>
						<p style="color:#23d423;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin instalado y activada!', 'alzira' ); ?></p>
					<?php endif; ?>
					<hr>					
					<h3><?php esc_html_e( 'Contenido de prueba', 'alzira' ); ?></h3>
					
					<div class="column-wrapper">
						<div class="tab-column">
						<h4><?php esc_html_e( 'Opcion 1 - automatic', 'alzira' ); ?></h4>
						<p><?php esc_html_e( 'Instala el siguiente complemento y luego regresa aquí para acceder al importador. Con él, puedes importar todo el contenido de demostración y cambiar tu página de inicio y página de blog a las de nuestro sitio de demostración, automáticamente. También asignará un menú.', 'alzira' ); ?></p>
						

						<?php if ( !class_exists('OCDI_Plugin') ) : ?>
						<?php $odi_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=one-click-demo-import'), 'install-plugin_one-click-demo-import'); ?>
						<p>
							<a target="_blank" class="install-now button importer-install" href="<?php echo esc_url( $odi_url ); ?>"><?php esc_html_e( 'Instalar y Activar', 'alzira' ); ?></a>
							<a style="display:none;" class="button button-primary button-large importer-button" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Ir al importador', 'alzira' ); ?></a>						
						</p>
						<?php else : ?>
							<p style="color:#23d423;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin instalado y activado!', 'alzira' ); ?></p>
							<a class="button button-primary button-large" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Ir al importador automático', 'alzira' ); ?></a>
						<?php endif; ?>
						</div>
						<div class="tab-column">
						<h4><?php esc_html_e( 'Opcion 2 - manual', 'alzira' ); ?></h4>
						<p><?php esc_html_e( 'Descargua el siguiente archivo de contenido de demostración y luego haz clic en el botón para ir al importador predeterminado de WordPress.', 'alzira' ); ?></p>
							<a class="button" href="//athemes.com/?wpdmdl=17783"><?php esc_html_e( 'Descarga contenido demostración', 'alzira' ); ?></a>
							<a class="button button-primary" href="<?php echo admin_url( 'import.php' ); ?>"><?php esc_html_e( 'Ir al importador manual', 'alzira' ); ?></a>
						</div>

					</div>
				</div>

				<div id="#support" class="alzira-tab support">
					<div class="column-wrapper">
						<!-- <div class="tab-column">
						<span class="dashicons dashicons-sos"></span>
						<h3><?php esc_html_e( 'Visit our forums', 'alzira' ); ?></h3>
						<p><?php esc_html_e( 'Need help? Go ahead and visit our support forums and we\'ll be happy to assist you with any theme related questions you might have', 'alzira' ); ?></p>
							<a href="https://athemes.com/forums/" target="_blank"><?php esc_html_e( 'Visit the forums', 'alzira' ); ?></a>				
							</div> -->
						<div class="tab-column">
						<span class="dashicons dashicons-book-alt"></span>
						<h3><?php esc_html_e( 'Documentacion', 'alzira' ); ?></h3>
						<p><?php esc_html_e( 'Nuestra documentacion puede enseñarte como usar el tema y resolver posibles dudas.', 'alzira' ); ?></p>
						<a href="http://docs.athemes.com/category/8-alzira" target="_blank"><?php esc_html_e( 'Ver la documentación', 'alzira' ); ?></a>
						</div>
					</div>
				</div>
						
			</div>
		</div>
	</div>
<?php
}

//Styles
function alzira_info_hook_styles(){
	add_action( 'admin_enqueue_scripts', 'alzira_info_page_styles' );
}
function alzira_info_page_styles() {
	wp_enqueue_style( 'alzira-info-style', get_template_directory_uri() . '/css/info-page.css', array(), true );

	wp_enqueue_script( 'alzira-info-script', get_template_directory_uri() . '/js/info-page.js', array('jquery'),'', true );

}