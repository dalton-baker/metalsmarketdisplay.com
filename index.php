<!DOCTYPE html>
<html>
<style>
  <?php include 'main.css'; ?>
</style>

<?php
$metalsMarketFile = fopen("metals_market_data.json", "r") or die("Unable to open file!");
$metalsMarketData = json_decode(fread($metalsMarketFile, filesize("metals_market_data.json")));
fclose($myfile);

$miscMarketFile = fopen("misc_market_data.json", "r") or die("Unable to open file!");
$miscMarketData = json_decode(fread($miscMarketFile, filesize("misc_market_data.json")));
fclose($myfile);

foreach ($metalsMarketData->market as $market) {
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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- https://material.io/resources/icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
  <?php include './components/header.php'; ?>
  <?php include './components/sidebar.php'; ?>

  <div style="padding-top: 64px">
    <div class="div-section" style="display: flex; flex-wrap: wrap;">
      <div class="top-info-section card" style="flex-direction: column;">

        <div class="top-info-card">
          <div class="top-info-card-title">Market Status</div>
          <?php if ($metalsMarketData->marketStatus == 'OPEN') : ?>
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

      <div class="top-info-section card" style="flex: 1; min-width: 75%;">
        <?php foreach ($miscMarketData->market as $market) : ?>
          <div class="top-info-card">
            <div class="top-info-card-title"><?= $market->name; ?></div>
            <div class="top-info-card-prices">
              <div style="padding-right: 10px;"><?= $market->price ?></div>
              <?php if (floatval($market->percent) < 0) : ?>
                <div class="down-color">&#x25BC;<?= number_format(abs(floatval($market->percent)), 2, '.', '') ?>%</div>
              <?php else : ?>
                <div class="up-color">&#x25B2;<?= number_format(abs(floatval($market->percent)), 2, '.', '') ?>%</div>
              <?php endif ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="div-section">
      <div class="info-div card">
        <div class="felx-table">
          <div class="title-row">
            <div class="title-cell metal"></div>
            <div class="colapse-name">
              <div class="colapse-row">
                <div class="title-cell bid">Bid</div>
                <div class="title-cell ask">Ask</div>
              </div>
              <div class="colapse-row">
                <div class="title-cell change">24hr Change</div>
                <div class="title-cell change-p"></div>
              </div>
              <div class="colapse-row">
                <div class="title-cell low">24hr Low</div>
                <div class="title-cell high">24hr High</div>
              </div>
            </div>
          </div>
          <?php foreach ($metalsMarketData->market as $market) : ?>
            <div class="metal-row">

              <div class="cell metal"><?= $market->name; ?></div>
              <div class="colapse-name">
                <div class="colapse-row">
                  <div class="cell bid">$<?= $market->bid; ?></div>
                  <div class="cell ask">$<?= $market->ask; ?></div>
                </div>

                <div class="colapse-row">
                  <?php if (floatval($market->change) < 0) : ?>
                    <div class="cell change down-color">&#x25BC;$<?= number_format(abs(floatval($market->change)), 2, '.', '') ?></div>
                  <?php else : ?>
                    <div class="cell change up-color">&#x25B2;$<?= number_format(abs(floatval($market->change)), 2, '.', '') ?></div>
                  <?php endif ?>

                  <?php if (floatval($market->percent) < 0) : ?>
                    <div class="cell change-p down-color">&#x25BC;<?= number_format(abs(floatval($market->percent)), 2, '.', '') ?>%</div>
                  <?php else : ?>
                    <div class="cell change-p up-color">&#x25B2;<?= number_format(abs(floatval($market->percent)), 2, '.', '') ?>%</div>
                  <?php endif ?>
                </div>
                <div class="colapse-row">
                  <div class="cell low">$<?= $market->low; ?></div>
                  <div class="cell high">$<?= $market->high; ?></div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="last-update-row" id="lastUpdate"></div>
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
      var phpDate = "<?= $metalsMarketData->updateTime ?>";
    </script>
    <script type="text/javascript" src="main.js"></script>

</body>

</html>