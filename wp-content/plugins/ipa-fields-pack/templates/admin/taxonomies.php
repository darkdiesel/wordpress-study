<?php
/**
 * @var IPA_Fields_Pack_Table_Taxonomies_List_Table $taxonomies_list_table
 * @var array $taxonomy
 */
$taxonomies_list_table->prepare_items();
?>

<style type="text/css">
    .wp-list-table .column-id {
        width: 3%;
    }
</style>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('List of Taxonomies', IPA_Fields_Pack()->plugin->get_txt_domain()); ?></h1>
    <a href="<?php echo esc_url(
		add_query_arg(
			array(
				'page' => IPA_Fields_Pack_Admin_Menus::$ipa_fields_pack_taxonomies_page,
				'action' => 'add',
			),
			admin_url( 'admin.php')
		)); ?>" class="page-title-action"><?php echo  __('Add New', IPA_Fields_Pack()->plugin->get_txt_domain()); ?></a>
    <hr class="wp-header-end">

	<?php echo IPA_Fields_Pack_Admin_Notices::get_notices_html(); ?>

	<?php if(isset($_GET['action'])): ?>
		<?php
		IPA_Fields_Pack()->functions->get_template(
			'admin/form/taxonomy.php',
			array(
				'taxonomy' => isset( $taxonomy ) ? $taxonomy : array(),
				'action' => esc_attr($_GET['action'])
			)
		);
		?>
	<?php endif; ?>

	<?php if(!isset($_GET['action'])): ?>
        <form method="get">
            <input type="hidden" name="page" value="<?php echo isset($_REQUEST['page']) ? $_REQUEST['page'] : ''; ?>" />
			<?php echo $taxonomies_list_table->search_box( 'Search', 'ipa_fields_pack_taxonomies_table_list_search' ); ?>
        </form>

		<?php $taxonomies_list_table->views(); ?>

        <form method="post">
			<?php
			$page  = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
			$paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );
			?>

            <input type="hidden" name="page" value="<?php echo $page; ?>" />
            <input type="hidden" name="paged" value="<?php echo $paged; ?>" />

			<?php
			$taxonomies_list_table->display();
			?>
        </form>
	<?php endif; ?>
</div>