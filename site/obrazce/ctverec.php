<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST['a'];
    $u = $_POST['u'];
    $S = $_POST['S'];
    $o = $_POST['o'];

    $err = $obrazec->testCtverec($a, $u, $o, $S);

    if (empty($err)) {
        $ctverec = $obrazec->ctverec($a, $u, $o, $S);

        $a = $ctverec['a'];
        $u = $ctverec['u'];
        $o = $ctverec['o'];
        $S = $ctverec['S'];
    }
}
 ?>
<div class="solo-container">
    <article id="article">
      <div class="article-border">

    <h1>Čtverec</h1>
    <div>

      <img src="pictures/ctverec.png" alt="čtverec">
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
            <td>cm<sup>2</sup> </td>
          </tr>
          <tr>
          </tr>
        </table>
        <input class="" type="submit" name="" value="Dopočítat">
        <input type="reset" name="" value="Smazat hodnoty">

  </form>
</div>

</div>
  </article>
</div>
