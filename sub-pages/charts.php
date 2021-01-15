<!DOCTYPE html>
<html>
<style>
    <?php include '../main.css'; ?>
</style>

<?php
$marketfile = fopen("../marketData.json", "r") or die("Unable to open file!");
$kitcoData = json_decode(fread($marketfile, filesize("../marketData.json")));
fclose($myfile);
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

    <div>
        <div class="div-section">
            <div class="info-div card">
                <section class="navbar-section">
                    <table id="market-status" class="card">
                        <tr>
                            <th>Market Status</th>
                        </tr>
                        <tr>
                            <?php if ($kitcoData->marketStatus == 'OPEN') : ?>
                                <td class="up-color">OPEN</td>
                            <?php else : ?>
                                <td class="down-color">CLOSED</td>
                            <?php endif ?>
                        </tr>
                    </table>
                </section>

                <section class="navbar-section">
                    <table id="market-status" class="card">
                        <tr>
                            <th>Gold/Silver Ratio</th>
                        </tr>
                        <tr>
                            <?php
                            foreach ($kitcoData->metalsMarket as $market) {
                                if ($market->name == "Silver") {
                                    $currSilver = floatval($market->ask);
                                }
                                if ($market->name == "Gold") {
                                    $currGold = floatval($market->ask);
                                }
                            }
                            ?>
                            <td><?= number_format($currGold / $currSilver, 2, '.', '') ?></td>
                        </tr>
                    </table>
                </section>

                <section class="navbar-section">
                    <table id="market-status" class="card">
                        <tr>
                            <th colspan="2">USD</th>
                        </tr>
                        <tr>
                            <td><?= $kitcoData->usdMarket->price ?></td>

                            <?php if (floatval($kitcoData->usdMarket->percent) < 0) : ?>
                                <td class="down-color">&#x25BC;<?= abs(floatval($kitcoData->usdMarket->percent)) ?>%</td>
                            <?php else : ?>
                                <td class="up-color">&#x25B2;<?= floatval($kitcoData->usdMarket->percent) ?>%</td>
                            <?php endif ?>
                        </tr>
                    </table>
                </section>

                <section class="navbar-section">
                    <table id="market-status" class="card">
                        <tr>
                            <th colspan="2">Dow Jones</th>
                        </tr>
                        <tr>
                            <td><?= $kitcoData->djiaMarket->price ?></td>
                            <?php if (floatval($kitcoData->djiaMarket->percent) < 0) : ?>
                                <td class="down-color">&#x25BC;<?= abs(floatval($kitcoData->djiaMarket->percent)) ?>%</td>
                            <?php else : ?>
                                <td class="up-color">&#x25B2;<?= floatval($kitcoData->djiaMarket->percent) ?>%</td>
                            <?php endif ?>
                        </tr>
                    </table>
                </section>

                <section class="navbar-section">
                    <table id="market-status" class="card">
                        <tr>
                            <th colspan="2">Bitcoin</th>
                        </tr>
                        <tr>
                            <td><?= $kitcoData->btcMarket->price ?></td>

                            <?php if (floatval($kitcoData->btcMarket->percent) < 0) : ?>
                                <td class="down-color">&#x25BC;<?= abs(floatval($kitcoData->btcMarket->percent)) ?>%</td>
                            <?php else : ?>
                                <td class="up-color">&#x25B2;<?= floatval($kitcoData->btcMarket->percent) ?>%</td>
                            <?php endif ?>
                        </tr>
                    </table>
                </section>
            </div>
        </div>


        <div class="div-section">
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
                        <td>$<?= $market->bid; ?></td>

                        <?php if (preg_match('/-/', $market->change)) : ?>
                            <td class="down-color">&#x25BC;$<?= substr($market->change, 1) ?> </td>
                        <?php else : ?>
                            <td class="up-color">&#x25B2;$<?= substr($market->change, 1) ?> </td>
                        <?php endif ?>

                        <?php if (preg_match('/-/', $market->percent)) : ?>
                            <td class="down-color">&#x25BC;<?= substr($market->percent, 1) ?>%</td>
                        <?php else : ?>
                            <td class="up-color">&#x25B2;<?= substr($market->percent, 1) ?>%</td>
                        <?php endif ?>

                        <td>$<?= $market->low; ?></td>
                        <td>$<?= $market->high; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="div-section">
            <a href="https://www.kitco.com/charts/livegold.html">
                <img asp-append-version="true" class="image-dimensions" src="https://www.kitco.com/images/live/nygold.gif" />
            </a>

            <a href="https://www.kitco.com/charts/livesilver.html">
                <img asp-append-version="true" class="image-dimensions" src="https://www.kitco.com/images/live/nysilver.gif" style="float: right;" />
            </a>
        </div>
    </div>
    <script type="text/javascript" src="main.js"></script>
</body>

<html>