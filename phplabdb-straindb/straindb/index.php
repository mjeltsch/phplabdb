<?php
 ob_start("ob_gzhandler");
 session_start();
 include_once '../includes/login.inc';
 if (!isset($_SESSION['status'])) {
  header('Location: ' . $base_url);
  exit;
 };
 $lev=error_reporting(8);
 $status=$_SESSION['status'];
 header_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
  <head>
    <title>
      ..:: phpLabDB::StrainDB ::..
    </title>
    <meta http-equiv="Content-Type" content="text/html">
    <link rel="stylesheet" type="text/css" media="print" href="<?php print $base_url; ?>css/print.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php print $base_url; ?>css/screen.css">
    <style type="text/css">
.strain { background: url('images/strain.png') no-repeat right top; }
    </style>
    <script type="text/javascript">
    //<![CDATA[
function chkFormulaire() {
 if(document.forms(0).data.value == "") {
  alert("<?php textdomain('straindb'); print _("Search is empty!"); textdomain('phplabdb'); ?>");
  return false;
 };
};
    //]]>
    </script>
  </head>
  <body>
  <body>
    <div id="header">
      <div id="header-logo">
        <?php print "<a href=\"$organisation[1]\"><img src=\"$organisation[2]\" alt=\"$organisation[0]\"></a>"; ?> 
      </div>
      <div id="header-items">
        <span class="header-icon"><?php print '<a href="' . $base_url .'about/lang.php"><img src="' . $base_url . 'images/header-langs.png" alt="">' . _("Language") . '</a> <a href="' . $base_url . 'logout.php"><img src="' . $base_url  . 'images/header-logout.png" alt="">' . _("Logout") . '</a>'; ?></span>
      </div>
    </div>
    <div id="nav">
    </div>
    <div id="side-left">
      <div id="side-nav-label">
        <?php print _("Navigation"); ?>:
      </div>
      <ul id="side-nav">
        <li>
          <?php print '<a href="' . $base_url . '">' . _("Home") . '</a>'; ?> 
        </li>
        <li>
          <?php print '<strong><a href="' . $base_url . 'database.php">' . _("Databases") . '</a></strong>'; ?> 
          <ul>
<?php
 foreach($plugin_title as $key => $value) {
  if ($key=='straindb') {
   print "          <li>\n            <strong><a href=\"" . $base_url . $plugin_dir[$key] . "\">$value</a></strong>\n          </li>\n";
   $plugin=$plugin_dir[$key];
  } else {
   print "          <li>\n            <a href=\"" . $base_url . $plugin_dir[$key] . "\">$value</a>\n          </li>\n";
  };
 };
?>
          </ul>
        </li>
<?php
 if (isset($mods_name)) {
  foreach($mods_title as $key => $value) {
   print "        <li>\n          <a href=\"" . $base_url . $mods_dir[$key] . "\">$value</a>\n        </li>\n";
  };
 };
 if ($status & pow(2,30)) {
?>
        <li>
          <?php print '<a href="' . $base_url . 'admin/">' . _("Administration") . '</a>'; ?> 
        </li>
<?php }; ?>
        <li>
          <?php print '<a href="' . $base_url . 'about/">' . _("About") . '</a>'; ?> 
        </li>
      </ul>
    </div>
    <div id="middle-three">
      <div class="corner-tr">
        &nbsp;
      </div>
      <div class="corner-tl">
        &nbsp;
      </div>
      <div id="content" class="strain">
        <div id="page-main">
<?php  textdomain('straindb'); ?>
          <h1>
            StrainDB plug-in
          </h1>
          <h3>
            <?php print _("New"); ?>
          </h3>
          <p>
            <?php print _("To add new strain click") . ' <a href="' . $base_url . $plugin . 'new_strain.php"><strong>' . _("here") . '</strong></a>'; ?>.
          </p>
<?php if ($status & pow(2,$plugin_level['straindb'])) { ?>
          <h3>
            <?php print _("Administration"); ?>
          </h3>
          <p>
            <?php print _("To access to the administration interface click") . ' <a href="' . $base_url . $plugin . 'admin/"><strong>' . _("here") . '</strong></a>'; ?>.
          </p>
<?php }; ?>
          <h3>
            <?php print _("Search"); ?> 
          </h3>
          <p>
            <?php print _("Enter the name of the searched strain:"); ?> 
          </p>
          <form action="<?php echo $base_url . $plugin; ?>search.php" method="post" onsubmit="return chkFormulaire()">
            <table summary="">
              <tr>
                <td>
                  <select name="type">
                    <option value="name">
                      <?php print _("Name"); ?> 
                    </option>
                    <option value="species">
                      <?php print _("Species"); ?> 
                    </option>
                    <option value="box">
                      <?php print _("Box"); ?> 
                    </option>
                    <option value="strain_origine">
                      <?php print _("Strain origine"); ?> 
                    </option>
                    <option value="plasmid">
                      <?php print _("Plasmid"); ?> 
                    </option>
                    <option value="released">
                      <?php print _("Date"); ?> 
                    </option>
                    <option value="notes">
                      <?php print _("Notes"); ?> 
                    </option>
                    <option value="barcode">
                      <?php print _("ID"); ?> 
                    </option>
                  </select>
                </td>
                <td>
                  <input type="text" size="20" maxlength="100" name="data">
                </td>
              </tr>
              <tr>
                <td>
                </td>
                <td>
                  <input type="submit" name="submit" value="<?php print _("Search"); ?>">
                </td>
              </tr>
            </table>
          </form>
<?php  textdomain('phplabdb'); ?>
        </div>
      </div>
      <div class="corner-br">
        &nbsp;
      </div>
      <div class="corner-bl">
        &nbsp;
      </div>
    </div>
    <div id="footer">
      - <?php print "<a href=\"$organisation[1]\">$organisation[0]</a> " . _("powered by"); ?> <a href="http://sourceforge.net/projects/phplabdb/">phpLabDB</a> -<br>
       &nbsp;<br>
    </div>
  </body>
</html>
