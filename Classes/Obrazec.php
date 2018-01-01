<?php
/**
 *Slouží k výpčtům a validaci základních obrazců
 */
class Obrazec
{
private function pythagorovaVeta($a, $b, $c, $return)
{
  switch ($return) {
    case 'a':
      $a = sqrt($b**2 + $c**2);
      break;
    case 'b':
      $b = sqrt($a**2 - $c**2);
      break;
    case 'c':
      $c = sqrt($a**2 - $b**2);
      break;
  }
  return $$return;
}

private function sinus($sin, $proti, $pre, $return)
{
  switch ($return) {
    case 'sin':
      $sin = rad2deg(asin($proti/$pre));
      break;
    case 'proti':
      $proti = sin(deg2rad($sin))*$pre;
      break;
    case 'pre':
      $pre = $proti/sin(deg2rad($sin));
      break;

  }
  return $$return;
}

private function cosinus($cos, $prileh, $pre, $return)
{
  switch ($return) {
    case 'cos':
      $cos = rad2deg(acos($prileh/$pre));

      break;

    case 'prileh':
      $prileh = cos(deg2rad($cos))*$pre;
      break;

    case 'pre':
      $pre = $prileh/cos(deg2rad($cos));
      break;
  }
  return $$return;
}

public function tangens($tan, $proti, $prileh, $return)
{
  switch ($return) {
    case 'tan':
      $tan = rad2deg(atan($proti/$prileh));
      break;

    case 'proti':
      $proti = tan(deg2rad($tan))*$prileh;
      break;

    case 'prileh':
      $prileh = $proti/tan(dag2rad($tan));
      break;
  }
  return $$return;
}

public function trojuhelnik($a = NULL, $b = NULL, $c = NULL, $beta = NULL, $gama = NULL)
{
  $o = NULL;
  $S= NULL;

  while (empty($a) || empty($b) || empty($c) || empty($beta) || empty($gama) || empty($o) || empty($S)) {

    if (!empty($b) && !empty($c) && empty($a)) {
      $a = $this->pythagorovaVeta(NULL, $b, $c, 'a');
      if (empty($beta)) {
        $beta = $this->tangens(NULL, $b, $c, 'tan');
      }
    }elseif (empty($b) && !empty($c) && !empty($a)) {
      $b = $this->pythagorovaVeta($a, NULL, $c, 'b');
      if (empty($beta)) {
        $beta = $this->cosinus(NULL, $c, $a, 'cos');
      }
    }elseif (!empty($b) && empty($c) && !empty($a)) {
      $c = $this->pythagorovaVeta($a, $b, NULL, 'c');
      if (empty($beta)) {
        $beta = $this->sinus(NULL, $b, $a, 'sin');
      }
    }elseif (!empty($beta) && empty($gama)) {
      $gama = 90-$beta;
    }elseif (!empty($gama) && empty($beta)) {
      $beta = 90-$gama;
    }elseif (!empty($b) && empty($a)) {
      $a = $this->sinus($beta, $b, NULL, 'pre');
    }elseif (!empty($a) && empty($b)) {
      $b = $this->sinus($beta, NUll, $a, 'proti');
    }elseif (!empty($c) && empty($a)) {
      $a = $this->cosinus($beta, $c, NULL, 'pre');
    }else {
      die('Someting went wrong BRO');
    }
    if (!empty($a) && !empty($b) && !empty($c)) {
      $o = $a + $b + $c;
    }
    if (!empty($b) && !empty($c)) {
      $S = ($b*$c)/2;
    }

  }
$final = array(
  'a' => $a,
  'b' => $b,
  'c' => $c,
  'beta' => $beta,
  'gama' => $gama,
  'o' => $o,
  'S' => $S
);
return $final;

}

public function testTrojuhelnik($a = NULL, $b = NULL, $c = NULL, $beta = NULL, $gama = NULL)
{
  $variables = array('a', 'b', 'c', 'beta', 'gama');
  $empty = 0;
  $err = '';
  foreach ($variables as $key) {
    if (empty($$key)) {
     $empty++;
    }
  }
  if ($empty > 3) {
    $err = 'Nedostatečný počet zadaných hodnot';
  }
  if (!empty($a) && (($a <= $b) || ($a <= $c))) {
    $err = "Přepona [a] musí být nejdelší strana";
  }
  if ((!empty($beta) || !empty($gama)) && ($beta >= 90 || $gama >= 90)) {
    $err = 'Úhel nemůže být větší nebo roven 90°';
  }
  if ((!empty($beta) && !empty($gama)) && $empty == 3) {
    $err = 'Pouze z úhlů se nedají dopočítat strany';
  }
  if ((!empty($beta) && !empty($gama)) && ($beta + $gama) != 90) {
    $err = 'Součet úhlů musí být 180°';
  }
  if (!empty($a) && !empty($b) && !empty($c)) {
    if ($this->pythagorovaVeta(NULL, $b, $c, 'a') != $a) {
      $err = "Zadaná přepona nemůže být výsledkem √$b" . "² + $c" . "²";
    }
    if ($this->pythagorovaVeta($a, NULL, $c, 'b') != $a) {
      $err = "Zadaná odvěsna [b] nemůže být výsledkem √$a" . "² - $c" . "²";
    }
    if ($this->pythagorovaVeta($a, $b, NULL, 'c') != $a) {
      $err = "Zadaná odvěsna [c] nemůže být výsledkem √$a" . "² - $b" . "²";
    }
  }
  return $err;
}

public function ctverec($a = NULL, $u= NULL, $o= NULL, $S= NULL)
{
  while (empty($a) || empty($u) || empty($S) || empty($o)) {
    if (!empty($a) && (empty($u) || empty($S) || empty($o))) {
      $o = $a*4;
      $S = $a**2;
      $u = $this->trojuhelnik(NULL,$a,$a);
      $u = $u['a'];
    }elseif (!empty($u) && empty($a)) {
      $a = $this->trojuhelnik($u, NULL, NULL, 45);
      $a = $a['b'];
    }elseif (!empty($S) && empty($a)) {
      $a = sqrt($S);
    }elseif (!empty($o) && empty($a)) {
      $a = $o/4;
    }
  }
$final = array(
  'a' => $a,
  'u' => $u,
  'S' => $S,
  'o' => $o
);
return $final;
}

public function testCtverec($a = NULL, $u= NULL, $o= NULL, $S= NULL)
{
$err = '';
  if ((!empty($S) && !empty($a)) && (sqrt($S) != $a) ) {
    $err = 'Zadaný obsah [S] neodpovídá straně [a]';
  }
  if ((!empty($o) && !empty($a)) && ($o/4 != $a)) {
    $err = 'Zadaný obvod [o] neodpovídá straně [a]';
  }
  if (!empty($u) && !empty($a)) {
    $testA = $this->trojuhelnik($u, NULL, NULL, 45);
    if ($testA['a'] != $a) {
      $err = 'Zadaná úhlopříčka [u] neodpovídá straně [a]';
    }
  }
  if (!empty($o) && !empty($u)) {
    $testA = $o/4;
    if ($this->pythagorovaVeta($testA, $testA, NULL, 'c') != $u) {
      $err = 'Zadaná úhlopříčka nesouhlasí se zadaným obvodem';
    }
  }
  if (empty($a) && empty($u) && empty($o) && empty($S)) {
    $err = 'Nedostatečný počet zadaných hodnot';
  }
  return $err;
}

public function obdelnik($a = NULL, $b = NULL, $u = NULL, $o = NULL, $S = NULL, $alfa = NULL, $beta = NULL)
{
  while (empty($a) || empty($b) || empty($u) || empty($o) || empty($S) || empty($alfa) || empty($beta)) {

    $err = $this->testTrojuhelnik($u, $b, $a, $alfa, $beta);
    if (empty($err)) {
      $trojuhelnik = $this->trojuhelnik($u, $b, $a, $alfa, $beta);
      $u = $trojuhelnik['a'];
      $b = $trojuhelnik['b'];
      $a = $trojuhelnik['c'];
      $alfa = $trojuhelnik['beta'];
      $beta = $trojuhelnik['gama'];
    }elseif (!empty($a) && !empty($b) && (empty($S) || empty($o))) {
      $S = $a * $b;
      $o = (2*$a)+(2*$b);
    }elseif (!empty($o) && !empty($a) && empty($b)) {
      $b =  ($o-(2*$a))/2;
    }elseif (!empty($o) && !empty($b) && empty($a)) {
      $a =  ($o-(2*$b))/2;
    }elseif (!empty($S) && !empty($a) && empty($b)) {
      $b =  $S/$a;
    }elseif (!empty($S) && !empty($b) && empty($a)) {
      $a =  $S/$b;
    }else {
      die('Someting went wrong BRO');
    }
  }
  $final = array(
    'a' => $a,
    'b' => $b,
    'u' => $u,
    'o' => $o,
    'S' => $S,
    'alfa' => $alfa,
    'beta' => $beta
  );

  return $final;
}

public function testObdelnik($a = NULL, $b = NULL, $u = NULL, $o = NULL, $S = NULL, $alfa = NULL, $beta = NULL)
{
  $variables = array('a', 'b', 'u', 'o', 'S', 'alfa', 'beta');
  $empty = 0;
  $err = '';
  foreach ($variables as $key) {
    if (empty($$key)) {
     $empty++;
    }
  }
    $err = $this->testTrojuhelnik($u, $b, $a, $alfa, $beta);
    $err = str_replace('Přepona [a]','Úhlopříčka [u]',$err);
    $err = str_replace('odvěsna [b]','strana [b]',$err);
    $err = str_replace('odvěsna [c]','strana [a]',$err);
    $err = str_replace('Nedostatečný počet zadaných hodnot', '', $err);
    $err = str_replace('Součet úhlů musí být 180°', 'Součet úhlů [α,β] musí být 90°', $err);
  if ((!empty($S) && !empty($a) && !empty($b)) && ($S != $a * $b)) {
    $err = 'Zadaný obsah [S] neodpovídá stranám [a,b]';
  }
  if ((!empty($o) && !empty($a) && !empty($b)) && ($o != (2*$a)+(2*$b))) {
    $err = 'Zadaný obvod [o] neodpovídá stranám [a,b]';
  }
  if ((!empty($o) && !empty($a) && !empty($b)) && ($b != ($o-(2*$a))/2)) {
    $err = 'Zadaná strana [b] neodpovídá zadanému obvodu [o] zároveň se stranou [a]';
  }
  if ((!empty($o) && !empty($a) && !empty($b)) && ($a != ($o-(2*$b))/2)) {
    $err = 'Zadaná strana [a] neodpovídá zadanému obvodu [o] zároveň se stranou [b]';
  }
  if ((!empty($S) && !empty($a) && !empty($b)) && ($b != $S/$a)) {
    $err = 'Zadaná strana [b] neodpovídá zadanému obsahu [S] zároveň se stranou [a]';
  }
  if ((!empty($S) && !empty($a) && !empty($b)) && ($a != $S/$b)) {
    $err = 'Zadaná strana [a] neodpovídá zadanému obsahu [S] zároveň se stranou [b]';
  }
  if (($empty == 5 || $empty == 4) && (!empty($alfa) || !empty($beta)) && !empty($o)) {
    $err = 'Pouze z těchto údajů se nedají dopočítat zbývající hodnoty';
  }
  if ($empty > 5 && (!empty($alfa) or !empty($beta)) && !empty($S)) {
    $err = 'Pouze z těchto údajů se nedají dopočítat zbývající hodnoty';
  }
  if ((!empty($a) && !empty($b) && !empty($alfa) && !empty($beta)) && ($alfa == $beta) && ($a != $b)) {
    $err = 'Pokud jsou úhly 45° musí být stejné strany [a,b]';
  }
  if (!empty($o) && !empty($a)) {
    if ($a*2 >= $o) {
      $err = 'Obvod musí být delší než dvojnásobek jakékoli strany';
    }
  }
  if (!empty($o) && !empty($b)) {
    if ($b*2 >= $o) {
      $err = 'Obvod musí být delší než dvojnásobek jakékoli strany';
    }
  }
  if (!empty($o) && !empty($u) && $empty == 5) {
    $err = 'Pouze z těchto údajů se nedají dopočítat zbývající hodnoty';
  }
  if ($empty > 5) {
    $err = 'Nedostatečný počet zadaných hodnot';
  }
return $err;
}
}
