<?php
/**
 * @var ER_Calculator_Table_Percentages_HR_List_Table $erc_percentages_hr_list_table
 * @var array $erc_percentage
 * @var array $ages
 */
$erc_percentages_hr_list_table->prepare_items();
?>

<style type="text/css">
    .wp-list-table .column-id {
        width: 3%;
    }
</style>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo __('Percentages Home Reversion', ER_Calculator()->plugin->get_text_domain()); ?></h1>
    <a href="<?php echo esc_url(
	    add_query_arg(
		    array(
			    'page' => ER_Calculator_Admin_Menu::$percentages_hr_page,
			    'action' => 'add',
		    ),
		    admin_url( 'admin.php')
	    )); ?>" class="page-title-action"><?php echo  __('Add New', ER_Calculator()->plugin->get_text_domain()); ?></a>

    <hr class="wp-header-end">

	<?php echo ER_Calculator_Admin_Notices::get_notices_html(); ?>

	<?php if(isset($_GET['action'])): ?>
        <?php
		ER_Calculator()->functions->get_template(
			'admin/form/percentage_hr.php',
			array(
				'erc_percentage_hr' => isset( $erc_percentage_hr ) ? $erc_percentage_hr : array(),
				'ages' => isset( $ages ) ? $ages : array(),
				'action' => esc_attr($_GET['action'])
			)
		);
        ?>
    <?php endif; ?>

    <?php if(!isset($_GET['action'])): ?>
        <form method="get">
            <input type="hidden" name="page" value="<?php echo isset($_REQUEST['page']) ? $_REQUEST['page'] : ''; ?>" />
            <?php echo $erc_percentages_hr_list_table->search_box( 'Search', 'er_calculator_percentages_hr_table_list_search' ); ?>
        </form>

        <?php $erc_percentages_hr_list_table->views(); ?>

        <form method="post">
		    <?php
		    $page  = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
		    $paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );
		    ?>

            <input type="hidden" name="page" value="<?php echo $page; ?>" />
            <input type="hidden" name="paged" value="<?php echo $paged; ?>" />

            <?php
            $erc_percentages_hr_list_table->display();
            ?>
        </form>
    <?php endif; ?>
</div>