@extends('layouts.home')

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

                <h4 class="mb-4">How to remove a Pattern Day Trader status?</h4>
                <ul class="pl-2">
                    <li>Deposit funds to increase the account’s equity up to the SEC required minimum of $25,000.</li>
                    <li>Wait for 90 days before initiating any new position.</li>
                    <li>Ask your broker for a PDT account reset. Some brokers may honor this request as a once in a lifetime type deal, while others will do nothing to remove the status. Its best to avoid being flagged all together.</li>
                </ul>

                <hr/>

                <p>The Pattern Day Trading rule regulates the use of margin and is defined only for margin accounts. Cash accounts, by definition, do not borrow on margin, so day trading is subject to separate rules regarding Cash Accounts. Cash account holders may still engage in certain day trades, as long as the activity does not result in free riding, which is the sale of securities bought with unsettled funds. An instance of free-riding will cause a cash account to be restricted for 90 days to purchasing securities with cash up front. </p>
            </div>

            <div class="col-sm-4 mt-4">
                <h4 class="mb-4">Trading Tools</h4>

                <ul class="pl-3">
                    <li class="pb-2"><a target="_blank" href="https://wallstreetodds.com/">wallstreetodds.com</a></li>
                    <li class="pb-2"><a target="_blank" href="https://www.highshortinterest.com/">highshortinterest.com</a></li>
                    <li class="pb-2"><a target="_blank" href="https://www.barchart.com/options/unusual-activity/stocks?orderBy=volume&orderDir=desc&page=1">barchart.com/options/unusual-activity</a></li>
                    <li class="pb-2"><a target="_blank" href="https://unusualwhales.com/">unusualwhales.com</a></li>
                    <li class="pb-2"><a target="_blank" href="https://holdingschannel.com/">holdingschannel.com</a></li>
                    <li class="pb-2"><a target="_blank" href="https://www.etf.com/">etf.com</a></li>
                    <li class="pb-2"><a target="_blank" href="https://cathiesark.com/">cathiesark.com</a></li>

                </ul>
            </div>
        </div>
    </div>

    @include('shared.footer')

   
 @endsection
