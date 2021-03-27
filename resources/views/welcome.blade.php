@extends('layouts.app')

{{-- <?php  
echo '<pre>';
dd($day_trades);
echo '</pre>';
?> --}}
@section('content')

    @include('shared.navbar')

    <!-- FUTURES -->
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container fixed-top">
      <div class="tradingview-widget-container__widget"></div>
      <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Ticker Tape</span></a> by TradingView</div>
      <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
      {
      "symbols": [
        {
          "description": "DOW",
          "proName": "CBOT_MINI:YM1!"
        },
        {
          "description": "S&P",
          "proName": "CME_MINI:ES1!"
        },
        {
          "description": "NASDAQ",
          "proName": "CME_MINI:NQ1!"
        },
        {
          "description": "GOLD",
          "proName": "COMEX:GC1!"
        },
        {
          "description": "SLV",
          "proName": "COMEX:SI1!"
        },
        {
          "description": "OIL",
          "proName": "USI:DWTI.IV"
        },
        {
          "description": "BTC/USD",
          "proName": "BITSTAMP:BTCUSD"
        }
      ],
      "colorTheme": "dark",
      "isTransparent": false,
      "displayMode": "adaptive",
      "locale": "en"
    }
      </script>
    </div>

    {{-- ///hero billboard --}}
    <div class="jumbotron jumbotron-fluid hero">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-7 mt-4">
                    <h1 class="display-4 tagline mt-5"><span>FREE</span> Day Trade Tracker</h1>
                    <p class="lead">Avoid getting flagged as a pattern day trader by logging your trades. If you use multiple brokerages to trade, we've got you covered. MyDayTradeTracker provides <b>support for multiple brokerages</b> at a time.</p>

                    <a href="{{route('register')}}" class="btn btn-secondary btn-lg mt-3">Register for FREE</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-8 mt-4">
                <h4 class="mb-4">What is Pattern Day Trader?</h4> 
                <p>A PDT or pattern day trader is a regulatory designation set for the traders/investors who execute four or more trades in the span of five days, while using a margin account.</p>   

                <p>Lorem ipsum, dolor sit amet consectetur, adipisicing elit. Aperiam eum accusantium minima consequuntur sequi eaque nesciunt rerum est nemo soluta ipsam recusandae corrupti incidunt quis rem explicabo quo, ducimus numquam!</p>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, aliquam mollitia repellendus a cumque possimus et quas quae, cum reiciendis corrupti quibusdam? Accusamus aliquid cumque velit officiis, ipsa corporis ullam!</p>
            </div>

            <div class="col-sm-4 mt-4">
                <h4 class="mb-4">Trading Tools</h4>

                <ul class="pl-3">
                    <li class="pb-2"><a href="https://wallstreetodds.com/">wallstreetodds.com</a></li>
                    <li class="pb-2"><a href="https://www.highshortinterest.com/">highshortinterest.com</a></li>
                    <li class="pb-2"><a href="https://www.barchart.com/options/unusual-activity/stocks?orderBy=volume&orderDir=desc&page=1">barchart.com/options/unusual-activity</a></li>
                    <li class="pb-2"><a href="https://unusualwhales.com/">unusualwhales.com</a></li>
                    <li class="pb-2"><a href="https://m.holdingschannel.com/">m.holdingschannel.com</a></li>
                    <li class="pb-2"><a href="https://www.etf.com/">etf.com</a></li>
                    <li class="pb-2"><a href="https://cathiesark.com/arkg-holdings-of-abbv">cathiesark.com</a></li>

                </ul>
            </div>
        </div>
    </div>

   
 @endsection
