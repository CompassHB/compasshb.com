@extends('layouts.master')

@section('side')
    @include('layouts.side.ministries')
@endsection

@section('content')
    <img src="https://compasshb.smugmug.com/photos/i-Z6gVmwc/0/X3/i-Z6gVmwc-X3.jpg" width="75" style="float: right"/>
    <h1 class="tk-seravek-web">The United Student Ministry</h1>
    <p>Jr. High and High School students meets Sundays at 11am and Thursdays at 6:30PM.</p>

    <div class="col-sm-9" style="text-align: center">
        <a class="clickable latestsermon" href="/youth/sermons/{{ $sermon->slug }}" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url }}); background-position: center;  min-height: 300px; padding-top: 60px; margin-bottom: 40px;">
            <p>Latest Sermon</p>
            <h1 class="tk-seravek-web">{{ $sermon->title->rendered }}</h1>
            <p>{{{ $sermon->acf->series->name or '' }}}</p>
            <p><i class="material-icons" style="font-size: 3em">play_circle_outline</i></p>
        </a>
    </div>

    <div class="col-sm-7">
        <h3 class="tk-seravek-web">The United exists to Make Disciples of Jesus Christ.</h3>
        <p>We do this in two ways...</p>
        <h4>Reaching teens with the Gospel</h4>
        <p>Every Sunday morning we gather during the 11 A.M. service to hear preaching from the Bible. We teach God’s word in a way that is understandable and applicable for teenagers to live out in their everyday life. Join us for our "Salvation Assurance" series as we study through the book of 1 John!</p>
        <p>Meets at church: 5082 Argosy Avenue, Huntington Beach, CA</p>
        <h4>Teaching Teens to live like Jesus</h4>
        <p>Every Thursday Night we have a time of small groups here at the church from 6:30-8:30 with trained leaders who are ready to disciple every student and teach them how to live out God’s word on a day to day basis.</p>
	</div>

        		<div class="col-sm-5">

                <p><img width="400" height="400" src="https://compasshb.smugmug.com/photos/i-QbkhPFf/0/M/i-QbkhPFf-M.jpg" alt="Shane Rouland"/></p>
                <h3 class="tk-seravek-web">Shane Rouland is the Student Ministry Director</h3>
                <p>Shane has a desire to reach out onto the school campuses in Huntington Beach and watch teenagers get saved through the Gospel of Jesus Christ. He is pursuing a Bible degree from The Master’s College and previously worked with Pastor Bobby for two years as an intern. Shane was saved by Jesus in high school where he led a Bible club and preached the gospel through campus lunches.</p>
                <ul>
                    <li><a href="mailto:shane@compasshb.com" title="E-Mail" target="_self">E-Mail</a></li>
                    <li><a href="https://twitter.com/ShaneRouland" title="@ShaneRouland" target="_blank">@ShaneRouland on Twitter</a></li>
                    <li><a href="https://www.facebook.com/shane.rouland" title="Shane on Facebook" target="_blank">Shane on Facebook</a></li>
                    <li><a href="http://www.sendoutyourlight.com/category/shanes-posts/" title="Send Out Your Light Blog" target="_blank">Send Out Your Light Blog</a></li>
                </ul>


        		</div>

<style>
    .col-md-4 img
    {
        border: 6px solid #FFF;
    }
    .col-md-4
    {
        color: #fff;
    }
</style>
@endsection