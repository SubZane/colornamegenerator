<?php
require('functions.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Color Name Generator</title>
  </head>
  <body>
    <form class="" action="index.php" method="get">
      <input type="text" name="color" value="" maxlength="7">
      <button type="submit">Post</button>
    </form>
  </body>
</html>
<?php
if (isset($_GET['color'])) {
  $input_color = $_GET['color'];

  if ( preg_match('/^#[a-f0-9]{6}$/i', $input_color) || preg_match('/^[a-f0-9]{6}$/i', $input_color)) {
    if (substr($input_color, 0, 1) !== '#') {
      $input_color = '#'.$input_color;
    }

    $colors = file_get_contents('colors.json');
    $adjectives = file_get_contents('adjectives.json');
    $json_adjectives = json_decode($adjectives, false);
    $json_colors = json_decode($colors, true);

    $distances = array();
    $val = hex2rgb($input_color);
    foreach ($COLOR_NAMES as $name => $c) {
        $distances[$name] = distancel2($c, $val);
    }

    $mincolor = "";
    $minval = pow(2, 30); /*big value*/
    foreach ($distances as $k => $v) {
        if ($v < $minval) {
            $minval = $v;
            $mincolor = $k;
        }
    }

    echo "Closest color: $mincolor\n";

  } else {
    echo 'Invalid color. You suck.';
  }
}
?>
