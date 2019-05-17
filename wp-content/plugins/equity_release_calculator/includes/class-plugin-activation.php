<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'ER_Calculator_Plugin_Activation' ) ):
	class ER_Calculator_Plugin_Activation{
		static function install() {
			global $wpdb;
			$installedVer = get_option("equity_release_calculator");

			if ($installedVer) {
				$tableAgePercentage = $wpdb->prefix . "erc_age_percentage";
				$sql = "CREATE TABLE " . $tableAgePercentage . " (
	                  id int(11) NOT NULL AUTO_INCREMENT,
	                  age_key int(11) UNIQUE NOT NULL,
	                  standard float(4,2) NOT NULL,
	                  enhanced float(4,2) NOT NULL,
	                  interest_only float(4,2) NOT NULL,
	                  PRIMARY KEY  (id),
	                  KEY name (standard, enhanced, interest_only)
	                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
				$result = dbDelta($sql);

				$rows_affected = $wpdb->query(
					"INSERT INTO {$tableAgePercentage} (id, age_key, standard, enhanced, interest_only) VALUES
	            (NULL, 1,  20.5,	37.4,	20),
	            (NULL, 2,  21.5,	38.5,	21),
	            (NULL, 3,  22.5,	39.6,	22),
	            (NULL, 4,  23.5,	40.7,	23),
	            (NULL, 5,  24.5,	41.8,	24),
	            (NULL, 6,  25.75,	42.4,	25),
	            (NULL, 7,  26.75,	44,     26),
	            (NULL, 8,  27.75,	46.2,	27),
	            (NULL, 9,  28.75,	47.3,	28),
	            (NULL, 10, 29.75,	48.4,	29),
	            (NULL, 11, 30.75,	49.5,	30),
	            (NULL, 12, 31.75,	50, 	31),
	            (NULL, 13, 32.75,	50, 	32),
	            (NULL, 14, 33.75,	50, 	33),
	            (NULL, 15, 34.75,	50, 	34),
	            (NULL, 16, 36.75,	50, 	35),
	            (NULL, 17, 37.75,	50, 	36),
	            (NULL, 18, 38.75,	50, 	37),
	            (NULL, 19, 39.75,	50, 	38),
	            (NULL, 20, 40.75,	50, 	39),
	            (NULL, 21, 41.75,	50, 	40),
	            (NULL, 22, 42.75,	50, 	41),
	            (NULL, 23, 44,	    50, 	42),
	            (NULL, 24, 45,	    50, 	43),
	            (NULL, 25, 46,	    50, 	44),
	            (NULL, 26, 47,	    50, 	44),
	            (NULL, 27, 48,	    50, 	44),
	            (NULL, 28, 49,	    51, 	44),
	            (NULL, 29, 50,	    52, 	44),
	            (NULL, 30, 51,	    53, 	44),
	            (NULL, 31, 52,	    54, 	44),
	            (NULL, 32, 52,	    55, 	44),
	            (NULL, 33, 52,	    55, 	44),
	            (NULL, 34, 52,	    55, 	44),
	            (NULL, 35, 52,	    55, 	44),
	            (NULL, 36, 52,	    55, 	44);"
				);

				$tableAgePercentageHr = $wpdb->prefix . "erc_age_percentage_hr";
				$sql = "CREATE TABLE " . $tableAgePercentageHr . " (
	                  id int(11) NOT NULL AUTO_INCREMENT,
	                  age_key int(11) UNIQUE NOT NULL,
	                  male float(4,2) NOT NULL,
	                  female float(4,2) NOT NULL,
	                  joint float(4,2) NOT NULL,
	                  PRIMARY KEY  (id),
	                  KEY name (male, female, joint)
	                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
				$result = dbDelta($sql);

				$rows_affected = $wpdb->query(
					"INSERT INTO {$tableAgePercentageHr} (id, age_key, male, female, joint) VALUES
	                (NULL,  11,	37,	33,	32),
	                (NULL,  12,	38,	35,	33),
	                (NULL,  13,	39,	36,	34),
	                (NULL,  14,	40,	37,	35),
	                (NULL,  15,	41,	38,	36),
	                (NULL,  16,	43,	40,	37),
	                (NULL,  17,	45,	41,	38),
	                (NULL,  18,	46,	43,	40),
	                (NULL,  19,	47,	44,	41),
	                (NULL,  20,	49,	46,	43),
	                (NULL,  21,	50,	48,	45),
	                (NULL,  22,	52,	49,	46),
	                (NULL,  23,	53,	50,	47),
	                (NULL,  24,	54,	51,	48),
	                (NULL,  25,	56,	52,	49),
	                (NULL,  26,	57,	53,	50),
	                (NULL,  27,	58,	54,	51),
	                (NULL,  28,	59,	55,	52),
	                (NULL,  29,	60,	56,	53),
	                (NULL,  30,	61,	57,	54),
	                (NULL,  31,	62,	58,	55),
	                (NULL,  32,	63,	59,	56),
	                (NULL,  33,	64,	60,	57),
	                (NULL,  34,	65,	61,	58),
	                (NULL,  35,	66,	62,	59),
	                (NULL,  36,	67,	63,	60);"
				);

				$tableCalculator = $wpdb->prefix . "erc_calculator";
				$sql = "CREATE TABLE " . $tableCalculator . " (
	                  id int(11) NOT NULL AUTO_INCREMENT,
	                  standard int(1) NOT NULL,
	                  enhanced int(1) NOT NULL,
	                  interest_only int(1) NOT NULL,
	                  home_reversion int(1) NOT NULL,
	                  text_area_one text NOT NULL,
	                  text_area_two text NOT NULL,
	                  result_text_area_one text NOT NULL,
	                  result_text_area_two text NOT NULL,
	                  title text NOT NULL,
	                  PRIMARY KEY  (id),
	                  KEY name (standard, enhanced, interest_only, home_reversion)
	                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
				$result = dbDelta($sql);

				$tableAge = $wpdb->prefix . "erc_age";
				$sql = "CREATE TABLE " . $tableAge . " (
	                  id int(11) NOT NULL AUTO_INCREMENT,
	                  age int(2) UNIQUE NOT NULL,
	                  PRIMARY KEY  (id)
	                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
				$result = dbDelta($sql);
				$rows_affected = $wpdb->query(
					"INSERT INTO {$tableAge} (id, age) VALUES
	            (1, 55),
	            (2, 56),
	            (3, 57),
	            (4, 58),
	            (5, 59),
	            (6, 60),
	            (7, 61),
	            (8, 62),
	            (9, 63),
	            (10, 64),
	            (11, 65),
	            (12, 66),
	            (13, 67),
	            (14, 68),
	            (15, 69),
	            (16, 70),
	            (17, 71),
	            (18, 72),
	            (19, 73),
	            (20, 74),
	            (21, 75),
	            (22, 76),
	            (23, 77),
	            (24, 78),
	            (25, 79),
	            (26, 80),
	            (27, 81),
	            (28, 82),
	            (29, 83),
	            (30, 84),
	            (31, 85),
	            (32, 86),
	            (33, 87),
	            (34, 88),
	            (35, 89),
	            (36, 90);"
				);

				$rows_affected = $wpdb->query("ALTER TABLE {$tableAgePercentage} ADD FOREIGN KEY ( age_key ) REFERENCES {$tableAge} (id) ON DELETE CASCADE ON UPDATE CASCADE;");
				$rows_affected = $wpdb->query("ALTER TABLE {$tableAgePercentageHr} ADD FOREIGN KEY ( age_key ) REFERENCES {$tableAge} (id) ON DELETE CASCADE ON UPDATE CASCADE;");

				update_option("equity_release_calculator", 2.0);
			}

			if ($installedVer < 2.0) {//fix version numeration
				update_option("equity_release_calculator", 2.0);
			}

			if ($installedVer < 3.0) {//iframe version
				$tableErcCalcs = $wpdb->prefix . "erc_calculator";
				$rows_affected = $wpdb->query("ALTER TABLE {$tableErcCalcs} ADD is_active BOOLEAN NOT NULL DEFAULT TRUE , ADD partner_id VARCHAR(255) NULL , ADD partner_full_name VARCHAR(255) NULL;");
				$rows_affected = $wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (is_active);");
				$rows_affected = $wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (partner_id);");
				$rows_affected = $wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (partner_full_name);");

				update_option("equity_release_calculator", 3.0);
			}

			if ($installedVer < 3.1) {//iframe version
				$tableErcCalcs = $wpdb->prefix . "erc_calculator";
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD introducer VARCHAR(255) NOT NULL DEFAULT '';");
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (introducer);");

				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD introducers_full_name VARCHAR(255) NOT NULL DEFAULT '';");
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (introducers_full_name);");

				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD introducers_email_address VARCHAR(255) NOT NULL DEFAULT '';");
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (introducers_email_address);");

				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD introducers_telephone_no VARCHAR(255) NOT NULL DEFAULT '';");
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (introducers_telephone_no);");

				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD introducers_lead_source VARCHAR(255) NOT NULL DEFAULT '';");
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (introducers_lead_source);");

				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD partner_account VARCHAR(255) NOT NULL DEFAULT '';");
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (partner_account);");

				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD partner_sub_account VARCHAR(255) NOT NULL DEFAULT '';");
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (partner_sub_account);");

				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD partner_user_id VARCHAR(255) NOT NULL DEFAULT '';");
				$wpdb->query("ALTER TABLE {$tableErcCalcs} ADD INDEX (partner_user_id);");

				update_option("equity_release_calculator", 3.1);
			}

			if ($installedVer < 4.0) {//fix version numeration
				update_option("equity_release_calculator", 4.0);
			}
		}
	}
endif;