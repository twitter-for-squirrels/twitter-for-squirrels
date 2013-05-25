<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * posts table
 */
class Migration_App_20130525114656 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database $db Database connection
	 */
	public function up(Kohana_Database $db)
	{
		$db->query(NULL, '
CREATE TABLE `posts` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(11) unsigned NOT NULL,
 `message` varchar(140) NOT NULL,
 PRIMARY KEY (`id`),
 KEY user_id (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		');
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database $db Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$db->query(NULL, 'DROP TABLE `posts`');
	}

}
