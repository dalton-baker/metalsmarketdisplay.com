<?php
# curl.php

class KitcoData
{
    public $marketStatus;
    public $changeTime;
    public $metalsMarket = array();
    public $usdMarket;
    public $djiaMarket;
    public $btcMarket;
}

class SmallMarketData
{
    public $price;
    public $change;
    public $percent;
}

class MarketData
{
    public $name;
    public $ask;
    public $bid;
    public $change;
    public $percent;
    public $low;
    public $high;

    public function __construct($name, $ask, $bid, $change, $percent, $low, $high)
    {
        $this->name = $name;
        $this->ask = $ask;
        $this->bid = $bid;
        $this->change = $change;
        $this->percent = $percent;
        $this->low = $low;
        $this->high = $high;
    }
}

if ($_GET["auth"] != "3832d15f-8e27-4eea-a24a-0b9712fd1bc1") {
    http_response_code(401);
    echo 'You are not authorised!';
}
else{
    // Initialize a connection with cURL (ch = cURL handle, or "channel")
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.kitco.com/market/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $kitcoResponse = curl_exec($ch);

        curl_setopt($ch, CURLOPT_URL, 'https://www.marketwatch.com/investing/index/dxy');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $usdResponse = curl_exec($ch);

        curl_setopt($ch, CURLOPT_URL, 'https://www.marketwatch.com/investing/index/djia');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $djiaResponse = curl_exec($ch);

        curl_setopt($ch, CURLOPT_URL, 'https://www.marketwatch.com/investing/index/spx');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $spxResponse = curl_exec($ch);

        curl_setopt($ch, CURLOPT_URL, 'https://www.marketwatch.com/investing/index/comp');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $compResponse = curl_exec($ch);

        curl_setopt($ch, CURLOPT_URL, 'https://www.marketwatch.com/investing/cryptocurrency/btcusd');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $btcResponse = curl_exec($ch);

        curl_setopt($ch, CURLOPT_URL, 'https://www.marketwatch.com/investing/cryptocurrency/ethusd');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ethResponse = curl_exec($ch);

        curl_setopt($ch, CURLOPT_URL, 'https://www.marketwatch.com/investing/cryptocurrency/ltcusd');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ltcResponse = curl_exec($ch);
        curl_close($ch);

        preg_match('/market_status_wsp.*(OPEN|CLOSED)/', $kitcoResponse, $marketStatus);

        preg_match('/wsp-AG-ask.>(\d+\.\d+)/', $kitcoResponse, $askAGmatch);
        preg_match('/wsp-AG-bid.>(\d+\.\d+)/', $kitcoResponse, $bidAGmatch);
        preg_match('/wsp-AG-change.*>([\-\+]?\d+\.\d+)/', $kitcoResponse, $changeAGmatch);
        preg_match('/wsp-AG-change-percent.*>([\-\+]?\d+\.\d+)/', $kitcoResponse, $percentAGmatch);
        preg_match('/wsp-AG-low.>(\d+\.\d+)/', $kitcoResponse, $lowAGmatch);
        preg_match('/wsp-AG-high.>(\d+\.\d+)/', $kitcoResponse, $highAGmatch);

        preg_match('/wsp-AU-ask.>(\d+\.\d+)/', $kitcoResponse, $askAUmatch);
        preg_match('/wsp-AU-bid.>(\d+\.\d+)/', $kitcoResponse, $bidAUmatch);
        preg_match('/wsp-AU-change.*>([\-\+]?\d+\.\d+)/', $kitcoResponse, $changeAUmatch);
        preg_match('/wsp-AU-change-percent.*>([\-\+]?\d+\.\d+)/', $kitcoResponse, $percentAUmatch);
        preg_match('/wsp-AU-low.>(\d+\.\d+)/', $kitcoResponse, $lowAUmatch);
        preg_match('/wsp-AU-high.>(\d+\.\d+)/', $kitcoResponse, $highAUmatch);

        preg_match('/wsp-PT-ask.>(\d+\.\d+)/', $kitcoResponse, $askPTmatch);
        preg_match('/wsp-PT-bid.>(\d+\.\d+)/', $kitcoResponse, $bidPTmatch);
        preg_match('/wsp-PT-change.*>([\-\+]?\d+\.\d+)/', $kitcoResponse, $changePTmatch);
        preg_match('/wsp-PT-change-percent.*>([\-\+]?\d+\.\d+)/', $kitcoResponse, $percentPTmatch);
        preg_match('/wsp-PT-low.>(\d+\.\d+)/', $kitcoResponse, $lowPTmatch);
        preg_match('/wsp-PT-high.>(\d+\.\d+)/', $kitcoResponse, $highPTmatch);

        preg_match('/wsp-PD-ask.>(\d+\.\d+)/', $kitcoResponse, $askPDmatch);
        preg_match('/wsp-PD-bid.>(\d+\.\d+)/', $kitcoResponse, $bidPDmatch);
        preg_match('/wsp-PD-change.*>([\-\+]?\d+\.\d+)/', $kitcoResponse, $changePDmatch);
        preg_match('/wsp-PD-change-percent.*>([\-\+]?\d+\.\d+)/', $kitcoResponse, $percentPDmatch);
        preg_match('/wsp-PD-low.>(\d+\.\d+)/', $kitcoResponse, $lowPDmatch);
        preg_match('/wsp-PD-high.>(\d+\.\d+)/', $kitcoResponse, $highPDmatch);

        preg_match('/price" content="(.*)".*\s.*priceChange" content="(.*)".*\s.*priceChangePercent" content="(.*)%/', $usdResponse, $usdMatches);
        preg_match('/price" content="(.*)".*\s.*priceChange" content="(.*)".*\s.*priceChangePercent" content="(.*)%/', $djiaResponse, $djiaMatches);
        preg_match('/price" content="(.*)".*\s.*priceChange" content="(.*)".*\s.*priceChangePercent" content="(.*)%/', $spxResponse, $spxMatches);
        preg_match('/price" content="(.*)".*\s.*priceChange" content="(.*)".*\s.*priceChangePercent" content="(.*)%/', $compResponse, $compMatches);
        preg_match('/price" content="\$(.*)".*\s.*priceChange" content="(.*)".*\s.*priceChangePercent" content="(.*)%/', $btcResponse, $btcMatches);
        preg_match('/price" content="\$(.*)".*\s.*priceChange" content="(.*)".*\s.*priceChangePercent" content="(.*)%/', $ethResponse, $ethMatches);
        preg_match('/price" content="\$(.*)".*\s.*priceChange" content="(.*)".*\s.*priceChangePercent" content="(.*)%/', $ltcResponse, $ltcMatches);

        $returnData = new KitcoData;
        $returnData->marketStatus = $marketStatus[1];
        $returnData->changeTime = gmdate("m/d/Y H:i:s") . " UTC";
        array_push($returnData->metalsMarket, new MarketData("Silver", $askAGmatch[1], $bidAGmatch[1], $changeAGmatch[1], $percentAGmatch[1], $lowAGmatch[1], $highAGmatch[1]));
        array_push($returnData->metalsMarket, new MarketData("Gold", $askAUmatch[1], $bidAUmatch[1], $changeAUmatch[1], $percentAUmatch[1], $lowAUmatch[1], $highAUmatch[1]));
        array_push($returnData->metalsMarket, new MarketData("Platinum", $askPTmatch[1], $bidPTmatch[1], $changePTmatch[1], $percentPTmatch[1], $lowPTmatch[1], $highPTmatch[1]));
        array_push($returnData->metalsMarket, new MarketData("Palladium", $askPDmatch[1], $bidPDmatch[1], $changePDmatch[1], $percentPDmatch[1], $lowPDmatch[1], $highPDmatch[1]));

        $returnData->usdMarket = new SmallMarketData;
        $returnData->usdMarket->price = $usdMatches[1];
        $returnData->usdMarket->change = $usdMatches[2];
        $returnData->usdMarket->percent = $usdMatches[3];

        $returnData->djiaMarket = new SmallMarketData;
        $returnData->djiaMarket->price = $djiaMatches[1];
        $returnData->djiaMarket->change = $djiaMatches[2];
        $returnData->djiaMarket->percent = $djiaMatches[3];

        $returnData->spxMarket = new SmallMarketData;
        $returnData->spxMarket->price = $spxMatches[1];
        $returnData->spxMarket->change = $spxMatches[2];
        $returnData->spxMarket->percent = $spxMatches[3];

        $returnData->compMarket = new SmallMarketData;
        $returnData->compMarket->price = $compMatches[1];
        $returnData->compMarket->change = $compMatches[2];
        $returnData->compMarket->percent = $compMatches[3];

        $returnData->btcMarket = new SmallMarketData;
        $returnData->btcMarket->price = $btcMatches[1] . ".00";
        $returnData->btcMarket->change = $btcMatches[2];
        $returnData->btcMarket->percent = $btcMatches[3];

        $returnData->ethMarket = new SmallMarketData;
        $returnData->ethMarket->price = $ethMatches[1];
        $returnData->ethMarket->change = $ethMatches[2];
        $returnData->ethMarket->percent = $ethMatches[3];

        $returnData->ltcMarket = new SmallMarketData;
        $returnData->ltcMarket->price = $ltcMatches[1];
        $returnData->ltcMarket->change = $ltcMatches[2];
        $returnData->ltcMarket->percent = $ltcMatches[3];

        if ($btcMatches[2] == 'n') {
            $returnData->btcMarket->percent = '-' . $returnData->btcMarket->percent;
        }

        $myfile = fopen("../marketData.json", "w") or die("Unable to open file!");
        fwrite($myfile, json_encode($returnData));
        fclose($myfile);

        echo 'Data was updated successfully at ' . $returnData->changeTime;
    } catch (Exception $e) {
        http_response_code(500);
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
