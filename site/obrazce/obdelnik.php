<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $u = $_POST['u'];
    $alfa = $_POST['alfa'];
    $beta = $_POST['beta'];
    $o = $_POST['o'];
    $S = $_POST['S'];

    $err = $obrazec->testObdelnik($a, $b, $u, $o, $S, $alfa, $beta);

    if (empty($err)) {
        $obdelnik = $obrazec->obdelnik($a, $b, $u, $o, $S, $alfa, $beta);

        $a = $obdelnik['a'];
        $b = $obdelnik['b'];
        $u = $obdelnik['u'];
        $alfa = $obdelnik['alfa'];
        $beta = $obdelnik['beta'];
        $o = $obdelnik['o'];
        $S = $obdelnik['S'];
    }
}
 ?>

<div class="solo-container">
    <article class="article-border">
    <h1>Obdelník</h1>
    <img src="pictures\obdelnik.png" alt="Obdelník">
    <?php if (isset($err)) {
     echo '<p>' . htmlspecialchars($err) . '</p>';
 } ?>
  <form action="" method="post">
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
          <td>Úhlopříčka [u]:</td>
          <td><input type="number" step="any" min="0" name="u" value="<?php if (isset($u)) {
     echo htmlspecialchars($u);
 } ?>"></td>
          <td>cm</td>
        </tr>
        <tr>
          <td>Obvod [o]:</td>
          <td><input type="number" step="any" min="0" name="o" value="<?php if (isset($o)) {
     echo htmlspecialchars($o);
 } ?>"></td>
          <td>cm</td>
        </tr>
        <tr>
          <td>Obsah [S]:</td>
          <td><input type="number" step="any" min="0" name="S" value="<?php if (isset($S)) {
     echo htmlspecialchars($S);
 } ?>"></td>
          <td>cm<sup>2</sup></td>
        </tr>
        <tr>
          <td>Úhel Alfa [&alpha;]:</td>
          <td><input type="number" step="any" min="0" name="alfa" value="<?php if (isset($alfa)) {
     echo htmlspecialchars($alfa);
 } ?>"></td>
          <td>°</td>
        </tr>
        <tr>
          <td>Úhel Beta [&beta;]:</td>
          <td><input type="number" step="any" min="0" name="beta" value="<?php if (isset($beta)) {
     echo htmlspecialchars($beta);
 } ?>"></td>
          <td>°</td>
        </tr>
        <tr>
          <td><input class="" type="submit" name="" value="Dopočítat"></td>
          <td> <input type="reset" name="" value="Smazat hodnoty"> </td>
        </tr>
    </table>
  </form>
  </article>
</div>
