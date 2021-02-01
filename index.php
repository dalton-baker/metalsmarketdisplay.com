<!DOCTYPE html>
<html>
<style>
  <?php include 'main.css'; ?>
</style>

<?php
$marketfile = fopen("marketData.json", "r") or die("Unable to open file!");
$kitcoData = json_decode(fread($marketfile, filesize("marketData.json")));
fclose($myfile);

foreach ($kitcoData->metalsMarket as $market) {
  if ($market->name == "Silver") {
    $currSilver = floatval($market->ask);
  }
  if ($market->name == "Gold") {
    $currGold = floatval($market->ask);
  }
}
?>


<head>
  <title>Metals Market Display</title>
  <meta http-equiv="refresh" content="300">
  <!-- https://material.io/resources/icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
  <?php include './components/header.php'; ?>
  <?php include './components/sidebar.php'; ?>

  <div style="padding-top: 64px">
    <div class="div-section" style="display: flex;">
      <div class="top-info-section card" style="flex-direction: column;">

        <div class="top-info-card">
          <div class="top-info-card-title">Market Status</div>
          <?php if ($kitcoData->marketStatus == 'OPEN') : ?>
            <div class="top-info-card-prices up-color">OPEN</div>
          <?php else : ?>
            <div class="top-info-card-prices down-color">CLOSED</div>
          <?php endif ?>
        </div>

        <div class="top-info-card">
          <div class="top-info-card-title">Gold/Silver Ratio</div>
          <div class="top-info-card-prices" style="text-align: center;">
            <?= number_format($currGold / $currSilver, 2, '.', '') ?>
          </div>
        </div>
      </div>

      <div class="top-info-section card" style="flex: 1;">
        <div class="top-info-card">
          <div class="top-info-card-title">USD</div>
          <div class="top-info-card-prices">
            <div style="padding-right: 10px;"><?= $kitcoData->usdMarket->price ?></div>
            <?php if (floatval($kitcoData->usdMarket->percent) < 0) : ?>
              <div class="down-color">&#x25BC;<?= number_format(abs(floatval($kitcoData->usdMarket->percent)), 2, '.', '') ?>%</div>
            <?php else : ?>
              <div class="up-color">&#x25B2;<?= number_format(abs(floatval($kitcoData->usdMarket->percent)), 2, '.', '') ?>%</div>
            <?php endif ?>
          </div>
        </div>

        <div class="top-info-card">
          <div class="top-info-card-title">Dow Jones</div>
          <div class="top-info-card-prices">
            <div style="padding-right: 10px;">$<?= $kitcoData->djiaMarket->price ?></div>
            <?php if (floatval($kitcoData->djiaMarket->percent) < 0) : ?>
              <div class="down-color">&#x25BC;<?= number_format(abs(floatval($kitcoData->djiaMarket->percent)), 2, '.', '') ?>%</div>
            <?php else : ?>
              <div class="up-color">&#x25B2;<?= number_format(abs(floatval($kitcoData->djiaMarket->percent)), 2, '.', '') ?>%</div>
            <?php endif ?>
          </div>
        </div>

        <div class="top-info-card">
          <div class="top-info-card-title">S&P 500</div>
          <div class="top-info-card-prices">
            <div style="padding-right: 10px;">$<?= $kitcoData->spxMarket->price ?></div>
            <?php if (floatval($kitcoData->spxMarket->percent) < 0) : ?>
              <div class="down-color">&#x25BC;<?= number_format(abs(floatval($kitcoData->spxMarket->percent)), 2, '.', '') ?>%</div>
            <?php else : ?>
              <div class="up-color">&#x25B2;<?= number_format(abs(floatval($kitcoData->spxMarket->percent)), 2, '.', '') ?>%</div>
            <?php endif ?>
          </div>
        </div>

        <div class="top-info-card">
          <div class="top-info-card-title">NASDAQ</div>
          <div class="top-info-card-prices">
            <div style="padding-right: 10px;">$<?= $kitcoData->compMarket->price ?></div>
            <?php if (floatval($kitcoData->compMarket->percent) < 0) : ?>
              <div class="down-color">&#x25BC;<?= number_format(abs(floatval($kitcoData->compMarket->percent)), 2, '.', '') ?>%</div>
            <?php else : ?>
              <div class="up-color">&#x25B2;<?= number_format(abs(floatval($kitcoData->compMarket->percent)), 2, '.', '') ?>%</div>
            <?php endif ?>
          </div>
        </div>

        <div class="top-info-card">
          <div class="top-info-card-title">Bitcoin</div>
          <div class="top-info-card-prices">
            <div style="padding-right: 10px;">$<?= $kitcoData->btcMarket->price ?></div>
            <?php if (floatval($kitcoData->btcMarket->percent) < 0) : ?>
              <div class="down-color">&#x25BC;<?= number_format(abs(floatval($kitcoData->btcMarket->percent)), 2, '.', '') ?>%</div>
            <?php else : ?>
              <div class="up-color">&#x25B2;<?= number_format(abs(floatval($kitcoData->btcMarket->percent)), 2, '.', '') ?>%</div>
            <?php endif ?>
          </div>
        </div>

        <div class="top-info-card">
          <div class="top-info-card-title">Ethereum</div>
          <div class="top-info-card-prices">
            <div style="padding-right: 10px;">$<?= $kitcoData->ethMarket->price ?></div>
            <?php if (floatval($kitcoData->ethMarket->percent) < 0) : ?>
              <div class="down-color">&#x25BC;<?= number_format(abs(floatval($kitcoData->ethMarket->percent)), 2, '.', '') ?>%</div>
            <?php else : ?>
              <div class="up-color">&#x25B2;<?= number_format(abs(floatval($kitcoData->ethMarket->percent)), 2, '.', '') ?>%</div>
            <?php endif ?>
          </div>
        </div>

        <div class="top-info-card">
          <div class="top-info-card-title">Litecoin</div>
          <div class="top-info-card-prices">
            <div style="padding-right: 10px;">$<?= $kitcoData->ltcMarket->price ?></div>
            <?php if (floatval($kitcoData->ltcMarket->percent) < 0) : ?>
              <div class="down-color">&#x25BC;<?= number_format(abs(floatval($kitcoData->ltcMarket->percent)), 2, '.', '') ?>%</div>
            <?php else : ?>
              <div class="up-color">&#x25B2;<?= number_format(abs(floatval($kitcoData->ltcMarket->percent)), 2, '.', '') ?>%</div>
            <?php endif ?>
          </div>
        </div>

      </div>
    </div>


    <div class="div-section">
      <div class="info-div card">
        <table id="metal-market" class="card">
          <tr>
            <th>Metal</th>
            <th>Bid</th>
            <th>Ask</th>
            <th colspan="2">24hr Change</th>
            <th>24hr Low</th>
            <th>24hr High</th>
          </tr>

          <?php foreach ($kitcoData->metalsMarket as $market) : ?>
            <tr>
              <td><?= $market->name; ?></td>
              <td>$<?= $market->bid; ?></td>
              <td>$<?= $market->ask; ?></td>

              <?php if (floatval($market->change) < 0) : ?>
                <td class="down-color">&#x25BC;$<?= number_format(abs(floatval($market->change)), 2, '.', '') ?></td>
              <?php else : ?>
                <td class="up-color">&#x25B2;$<?= number_format(abs(floatval($market->change)), 2, '.', '') ?></td>
              <?php endif ?>

              <?php if (floatval($market->percent) < 0) : ?>
                <td class="down-color">&#x25BC;<?= number_format(abs(floatval($market->percent)), 2, '.', '') ?>%</td>
              <?php else : ?>
                <td class="up-color">&#x25B2;<?= number_format(abs(floatval($market->percent)), 2, '.', '') ?>%</td>
              <?php endif ?>

              <td>$<?= $market->low; ?></td>
              <td>$<?= $market->high; ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>

    <div class="image-section">
      <a href="https://www.kitco.com/charts/livegold.html" class="image-link-dimensions">
        <img asp-append-version="true" class="image-dimensions" src="https://www.kitco.com/images/live/nygold.gif" />
      </a>

      <a href="https://www.kitco.com/charts/livesilver.html" class="image-link-dimensions">
        <img asp-append-version="true" class="image-dimensions" src="https://www.kitco.com/images/live/nysilver.gif" />
      </a>
    </div>

    <script type="text/javascript">
      var phpDate = "<?= $kitcoData->changeTime ?>";
    </script>
    <script type="text/javascript" src="main.js"></script>

</body>

</html>