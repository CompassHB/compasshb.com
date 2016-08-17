@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')
    <h1 class="tk-seravek-web">Give to Compass HB</h1>

    <div class="well">
        <h4 class="tk-seravek-web"><i class="material-icons">loop</i> Recurring Giving</h4>
        <p>Access our online system to schedule a recurring gift or to make a one-time gift using your checking account or credit card.</p>
        <p>
            - <a href="https://compassbiblechurch.ccbchurch.com">Login Here (manage existing account)</a><br/>
            - <a href="https://compassbiblechurch.ccbchurch.com/form_response.php?id=1286">Register Here (first-time users - select Compass HB)</a>
        </p><br/>

        <h4 class="tk-seravek-web"><i class="material-icons">card_giftcard</i> One Time Gift</h4>
        <p>You can make a one-time gift using a credit card without registering in the system.</p>
        <p><a href="https://compassbiblechurch.ccbchurch.com/trx_submit.php?type=public_gift&#038;campus_id=3">Give now without registering</a></p><br/>

        <h4 class="tk-seravek-web"><i class="material-icons">account_balance</i> Other Ways to Support</h4>

        <p>For more information on other creative tax-wise charitable gift and estate planning strategies,
            please contact <a href="mailto:info@compasshb.com">info@compasshb.com</a>.</p>
        <p>In addition to cash gifts, there are a number of other ways to support the ministry of Compass
            HB and leave an eternal legacy with the assets God has entrusted to you. They include some of
            the following assets and gifting plans:</p>
        <ul>
            <li>Appreciated Securities (publicly traded stock, closely-held stock, mutual funds, bonds)</li>
            <li>Real Estate (residential, commercial, income property, leasehold, vacation home, life estate, remainder interest)</li>
            <li>Life Insurance Policy (paid-up or non-paid up policies)</li>
            <li>Personal Property (artwork, collectables, gemstones)</li>
            <li>Intellectual Property (patents, royalties, copyrights)</li>
            <li>Bequests (remember CBC in your will or living revocable trust)</li>
            <li>Beneficiary Designations (name CBC as a testamentary of your IRA, 401k, 403b, or qualified retirement plan)</li>
        </ul>
    </div>

@endsection
