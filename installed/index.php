<?php
/**
 * Installs the PHP Login & User Management database
 *
 * LICENSE:
 *
 * This source file is subject to the licensing terms that
 * is available through the world-wide-web at the following URI:
 * http://codecanyon.net/wiki/support/legal-terms/licensing-terms/.
 *
 * @author       BLiveInHack <bliveinhack@gmail.com>
 * @copyright    Copyright © 2014 icanstudioz.com
 * @license      http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @link         http://codecanyon.net/item/8817787
 */
include_once("header.php");

$install = new Install();

class Install {

    private $error;
    private $link;
    private $options = array();
    public static $dbh;

    function __construct() {

        $this->checkInstall($hideError = true);

        if (!empty($_POST)) :

            foreach ($_POST as $key => $value)
                $this->options[$key] = $value;

            $this->validate();

        endif;

        if (!empty($this->error))
            echo $this->error;
    }

    // Run any ol' query passed into this function
    public function query($query, $params = array()) {

        $stmt = self::$dbh->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    // Check for all form fields to be filled out
    private function validate() {

        if (strlen($this->options['adminPass']) < 5)
            $this->error = '<div class="alert alert-error">' . _('Password must be at least 5 characters.') . '</div>';
        else
            $this->options['adminPass'] = md5($this->options['adminPass']);

        if (empty($this->options['dbHost']) || empty($this->options['dbUser']) || empty($this->options['dbName']) || empty($this->options['google_key']) || empty($this->options['email']) || empty($this->options['adminUser']) || empty($this->options['adminPass']))
            $this->error = '<div class="alert alert-error">' . _('Fill out all the details please') . '</div>';


        // Check the database connection
        $this->dbLink();
    }

    // See if I can connect to the mysql server
    private function dbLink() {

        if (!empty($this->error))
            return false;

        try {
            self::$dbh = new PDO("mysql:host=" . $this->options['dbHost'] . ";dbname=" . $this->options['dbName'], $this->options['dbUser'], $this->options['dbPass']);
            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->error = '<div class="alert alert-error">' . _('Database error: ') . $e->getMessage() . '</div>';
        }

        $this->existingTables();
    }

    // Check for an existing install
    private function existingTables() {

        if (empty($this->error)) :

            $this->insertSQL();
            $this->writeFile();
            $this->checkInstall();

        endif;
    }

    // Begin inserting our SQL goodies
    private function insertSQL() {

        if (empty($this->error)) {

            $this->query("SET NAMES utf8;");

            $this->query("
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;
");



            $this->query("CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(35) NOT NULL,
  `is_active` char(1) NOT NULL DEFAULT '1',
  `cat_desc` varchar(100) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
");
            $this->query("
			
CREATE TABLE IF NOT EXISTS `notifications` (
  `nid` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `message` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `emotion` varchar(15) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;


			");

            $this->query("

CREATE TABLE IF NOT EXISTS `reports` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `nid` varchar(10) NOT NULL,
  `status` varchar(15) NOT NULL,
  `passed` varchar(10) NOT NULL,
  `failed` varchar(10) NOT NULL,
  `updated` varchar(10) NOT NULL,
  `removed` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;
			");

            $this->query("
			
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(35) NOT NULL,
  `gcm_id` varchar(300) NOT NULL,
  `app_type` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

			");

	    $this->query("
	    
ALTER TABLE `users` ADD `categories` TEXT NULL ;	    
	    
	    ");


            $params = array(
                ':username' => $this->options['adminUser'],
                ':email' => $this->options['email'],
                ':password' => $this->options['adminPass']
            );
            $this->query("
				INSERT INTO `admin` (`username`, `email`, `password`) VALUES ( :username, :email, :password);
			", $params);
        } else
            $this->error = 'Your tables already exist! I won\'t insert anything.';
    }

    private function writeFile() {

        if ($this->error == '') {

            /** Write config.php if it doesn't exist */
            $fp = @fopen("../config.php", "w");

            if (!$fp) :
                echo '<div class="alert alert-warning">' . _('Could not create <code>/classes/config.php</code>, please confirm you have permission to create the file.') . '</div>';
                return false;
            endif;


            fwrite($fp, '<?php

////////////////////
// Important ! These must be filled in correctly.
// Database details are required to use this script.

$HOST = "' . $this->options['dbHost'] . '"; // If you don\'t know what your host is, it\'s safe to leave it localhost
$USERNAME = "' . $this->options['dbUser'] . '"; // Database name
$PASSWORD = "' . $this->options['dbPass'] . '"; // Username
$DB = "' . $this->options['dbName'] . '"; // Password

define("GOOGLE_API_KEY", "' . $this->options['google_key'] . '"); // Google API key

?>');
            fclose($fp);
        }
    }

    private function checkInstall($hideError = false) {

        if (file_exists('../config.php')) :
            ?>

            <div class="row">
                <div class="span6 offset5" style="margin-top: 20%">
                    <div class="alert alert-success"><?php echo ('Hooray ! Installation is all done :)'); ?></div>
                    <div style="clear: both"></div>
                    <p><span class='label label-important'><?php echo ('Important'); ?></span> <?php echo ('Please delete or rename the install folder to prevent intrustion'); ?></p>
                </div>
                <div class="span6 offset5">
                    <h5><?php echo ('What to do now?'); ?></h5>
                    <p><?php echo ('Check out your'); ?> <a href="../index.php"><?php echo ('Dashbord'); ?></a> <?php echo ('page.'); ?></p>
                </div>
            </div> <?php
            exit();
        else :
            if (!$hideError)
                $this->error = '<div class="alert alert-error">' . _('Installation is not complete.') . '</div>';
        endif;
    }

}
?>
<div class="row-fluid">
    <div class="span6 offset4">
        <form class="form-horizontal" method="post" action="index.php">

            <fieldset>
                <legend><?php echo ('Database Info'); ?></legend>
                <div class="control-group">
                    <label class="control-label" for="dbHost"><?php echo ('Host'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="dbHost" name="dbHost" value="<?php if (isset($_POST['dbHost'])) echo $_POST['dbHost']; ?>" placeholder="localhost">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dbName"><?php echo ('Database name'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="dbName" name="dbName" value="<?php if (isset($_POST['dbName'])) echo $_POST['dbName']; ?>" placeholder="<?php echo ('database_name'); ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dbUser"><?php echo ('Username'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="dbUser" name="dbUser" value="<?php if (isset($_POST['dbUser'])) echo $_POST['dbUser']; ?>" placeholder="<?php echo ('db username'); ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dbPass"><?php echo ('Password'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="dbPass" name="dbPass" value="<?php if (isset($_POST['dbPass'])) echo $_POST['dbPass']; ?>" placeholder="<?php echo ('db password'); ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?php echo ('Notification Settings'); ?></legend>
                <div class="control-group">
                    <label class="control-label" for="google_key"><?php echo ('GCM API KEY'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="google_key" name="google_key" value="<?php if (isset($_POST['google_key'])) echo $_POST['google_key']; ?>" placeholder="">
                        <p class="help-block"><?php echo ('You can get it from <a href="https://code.google.com/apis/console/">https://code.google.com/apis/console/</a> '); ?>
						<br/>Check out our FAQ : How to get API key from google console<br/><a href="http://codecanyon.net/item/push-notificationgcm-admin-panel/8817787/faqs/21783">http://codecanyon.net/item/push-notificationgcm-admin-panel/8817787/faqs/21783</a>
						</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email"><?php echo ('Admin email'); ?></label>
                    <div class="controls row-fluid">
                        <input type="email" class="input-xlarge span6" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="<?php echo 'no-reply@' . $_SERVER['HTTP_HOST']; ?>">
                        <p class="help-block"><?php echo ('This email address of admin'); ?></p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?php echo ('Admin Account'); ?></legend>
                <div class="control-group">
                    <label class="control-label" for="adminUser"><?php echo ('Username'); ?></label>
                    <div class="controls row-fluid">
                        <input type="text" class="input-xlarge span6" id="adminUser" name="adminUser" value="<?php if (isset($_POST['adminUser'])) echo $_POST['adminUser']; ?>" placeholder="<?php echo ('admin'); ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="adminPass"><?php echo ('Password'); ?></label>
                    <div class="controls row-fluid">
                        <input type="password" class="input-xlarge span6" id="adminPass" name="adminPass" value="<?php if (isset($_POST['adminPass'])) echo $_POST['adminPass']; ?>" placeholder="<?php echo ('admin password'); ?>">
                    </div>
                </div>
            </fieldset>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo ('Install'); ?></button>
            </div>

        </form>

    </div>
</div>

<?php include_once("footer.php"); ?>