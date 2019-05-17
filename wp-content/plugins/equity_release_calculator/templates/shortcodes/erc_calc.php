<?php if (!isset($calc) && $calc && !isset($_GET['partner_id'])) : ?>
	<strong><?php _e('Error, not the correct parameters.', ER_Calculator()->plugin->get_text_domain()); ?></strong>
	<?php return; ?>
<?php endif; ?>

<?php
global $wpdb;

$searchCalcField = isset($_GET['partner_id']) ? 'partner_id' : 'id';
$searchCalcId = isset($_GET['partner_id']) ? $_GET['partner_id'] :  $calc;

$sql = "SELECT * FROM " . $wpdb->prefix . "erc_calculator WHERE {$searchCalcField} = '{$searchCalcId}' ORDER BY id ASC LIMIT 1;";
$calc = $wpdb->get_row($sql, ARRAY_A);
?>

<?php if (empty($calc) || !$calc['is_active']) : ?>
    <strong><?php echo _('Sorry, a calculator is not found or is not active.', ER_Calculator()->plugin->get_text_domain()); ?></strong>
    <?php return; ?>
<?php endif; ?>

<?php
$percentages = $wpdb->get_results("
      SELECT
        p.id as id,
        p.standard,
        p.enhanced,
        p.interest_only,
        a.age as age
      FROM
        {$wpdb->prefix}erc_age_percentage as p,
        {$wpdb->prefix}erc_age as a
      WHERE
        a.id = p.age_key
      ORDER BY age ASC;
      ", ARRAY_A);

$ages = array();
foreach ($percentages as $percentage) {
	$ages[$percentage['age']] = $percentage['age'];
}

$percentagesHr = array();
if ($calc['home_reversion']) {
	$percentagesHr = $wpdb->get_results("
            SELECT
                p.id as id,
                p.male,
                p.female,
                p.joint,
                a.age as age
            FROM "
                . $wpdb->prefix . "erc_age_percentage_hr as p,"
                . $wpdb->prefix . "erc_age as a
            WHERE
                 a.id = p.age_key
            ORDER BY age ASC;", ARRAY_A);
	foreach ($percentagesHr as $percentageHr) {
		$agesHr[$percentageHr['age']] = $percentageHr['age'];
	}

	$ages = array_intersect_key($agesHr, $ages);
}

sort($ages);
//    remove_filter( 'the_content', 'wpautop' );

?>

<?php
	/**
	 * @var $type string  Type of calculator
	 */
	switch ($type){
		case 'mini':
			ER_Calculator()->functions->get_template(
				'calculator/erc_calc_mini.php',
				array(
					'calc'          => $calc,
					'percentages'   => $percentages,
					'percentagesHr' => $percentagesHr,
					'ages'          => $ages
				)
			);
			break;
		case 'standard':
		default:
		ER_Calculator()->functions->get_template(
			'calculator/erc_calc_standard.php',
			array(
				'calc'          => $calc,
				'percentages'   => $percentages,
				'percentagesHr' => $percentagesHr,
				'ages'          => $ages
			)
		);
			break;
	};
?>