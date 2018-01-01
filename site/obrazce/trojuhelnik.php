<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $beta = $_POST['beta'];
    $gama = $_POST['gama'];


    $err = $obrazec->testTrojuhelnik($a, $b, $c, $beta, $gama);

    if (empty($err)) {
        $trojuhelnik = $obrazec->trojuhelnik($a, $b, $c, $beta, $gama);

        $a = $trojuhelnik['a'];
        $b = $trojuhelnik['b'];
        $c = $trojuhelnik['c'];
        $beta = $trojuhelnik['beta'];
        $gama = $trojuhelnik['gama'];
        $o = $trojuhelnik['o'];
        $S = $trojuhelnik['S'];
    }
}
?>

<div class="solo-container">
    <article class="article-border">
  <h1>Trojúhelník</h1>
  <img src="pictures\trojuhelnik.png" alt="Trojúhelník">
  <?php if (isset($err)) {
    echo '<p>' . htmlspecialchars($err) . '</p>';
} ?>
  <form class="" action="" method="post">
    <table class="ultimate-center">
      <tr>
        <td>Strana A [a]:</td>
        <td><input type="number" step="any" min="0" name="a" value="<?php if (isset($a)) {
    echo htmlspecialchars($a);
} ?>"></td>
        <td>cm</td>
      </tr>
      <tr>
        <td>Strana B [b]:</td>
        <td><input type="number" step="any" min="0" name="b" value="<?php if (isset($b)) {
    echo htmlspecialchars($b);
} ?>"></td>
        <td>cm</td>
      </tr>
      <tr>
        <td>Strana C [c]:</td>
        <td><input type="number" step="any" min="0" name="c" value="<?php if (isset($c)) {
    echo htmlspecialchars($c);
} ?>"></td>
        <td>cm</td>
      </tr>
      <tr>
        <td>Úhel Beta [β]:</td>
        <td><input type="number" step="any" min="0" name="beta" value="<?php if (isset($beta)) {
    echo htmlspecialchars($beta);
} ?>"></td>
        <td>°</td>
      </tr>
      <tr>
        <td>Úhel Gama [γ]:</td>
        <td><input type="number" step="any" min="0" name="gama" value="<?php if (isset($gama)) {
    echo htmlspecialchars($gama);
} ?>"></td>
        <td>°</td>
      </tr>
      <?php if (isset($o)) {
    echo "<tr> <td> Obvod: </td><td>" . htmlspecialchars($o) . "</td><td>cm</td></tr>";
}
      if (isset($S)) {
          echo "<tr> <td> Obsah: </td><td>" . htmlspecialchars($S) . "</td><td>cm<sup>2</sup></td></tr>";
      } ?>
      <tr>
        <td><input class="" type="submit" name="" value="Dopočítat"></td>
        <td> <input type="reset" name="" value="Smazat hodnoty"> </td>
      </tr>
    </table>
  </form>
  </article>

</div>
