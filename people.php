<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));

if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            people_fullname, people_isactor, people_isdirector
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $people_fullname = '';
    $people_isactor = 0;
    $people_isdirector = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> People</title>
  <style type="text/css">
<!--
#error { background-color: #600; border: 1px solid #FF0; color: #FFF;
 text-align: center; margin: 10px; padding: 10px; }
-->
  </style>
 </head>
 <body>
 <?php
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
     <td>People Name</td>
     <td><input type="text" name="people_fullname"
      value="<?php echo $people_fullname; ?>"/></td>
    </tr><tr>
     <td>Actor</td>
     <?php                                                              //si es actor lo marcamos en el checkbox
        if($people_isactor==0){
            echo "<td>
                    <input type='checkbox' value='1' name='people_isactor'>
                </td>";
        } 
        else{
            echo "<td>
                    <input type='checkbox' value='1' checked name='people_isactor'>
                </td>";
        }
     ?>
    </tr><tr>
     <td>Director</td>
     <?php                                                              //si es director lo marcamos en el checkbox
        if($people_isdirector==0){
            echo "<td>
                    <input type='checkbox' value='1' name='people_isdirector'>
                </td>";
        }
        else{
            echo "<td>
                    <input type='checkbox' value='1' checked name='people_isdirector'>
                </td>";
        }
     ?>
    </tr>
    <tr>
        <td>
            EMAIL (solo cuentas gmail)
        </td>
        <td>
            <input type="email" name="email">
        </td>
    </tr>
    <tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>
