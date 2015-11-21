{!! '<?xml version = "1.0" encoding = "utf-8"?>' !!}

<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
		 xmlns:atom="http://www.w3.org/2005/Atom"
		 xml:lang='en-US'
		 version="2.0">
	<channel>
		<title>Compass HB Sermons</title>
		<itunes:subtitle>The gospel rings out...</itunes:subtitle>
		<itunes:summary>Reaching, teaching, and training people for Christ</itunes:summary>
		<description>Reaching, teaching, and training people for Christ</description>
		<language>en-us</language>
		<copyright>&#x2117; &amp; &#xA9; 2015 Compass HB</copyright>
		<link>{{ URL::to('/') }}/feed/sermons</link>
		<pubDate>{{ Carbon\Carbon::now()->toRfc2822String() }}</pubDate>
		<itunes:image href="http://compasshb.smugmug.com/photos/i-kMfffrR/0/X3/i-kMfffrR-X3.jpg" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:owner>
  		<itunes:name>CompassHB</itunes:name>
  		<itunes:email>info@compasshb.com</itunes:email>
		</itunes:owner>
		<itunes:author>Compass HB</itunes:author>
		<itunes:category text="Religion &amp; Spirituality">
			<itunes:category text="Christianity"/>
		</itunes:category>
		<itunes:category text="Education"/>
		<atom:link href="https://www.compasshb.com/feed/sermons/" rel="self" type="application/rss+xml" />

		@foreach ($sermons as $sermon)
			<item>
				<title>{{ $sermon->title }}</title>
				<link>{{ route('sermons.show', $sermon->slug) }}</link>
				<itunes:subtitle>{{ $sermon->byline }} {{ $sermon->text }}</itunes:subtitle>
				<itunes:summary>{{ $sermon->byline }} {{ $sermon->text }}</itunes:summary>
				<enclosure url="http://www.compasshb.com/sermons/{{ $sermon->slug }}/download.mp4" length="160000000" type="video/mp4" />
				<description>{{ $sermon->byline }} {{ $sermon->text }}</description>
				<pubDate>{{ $sermon->published_at->toRfc2822String() }}</pubDate>
				<guid>{{ route('sermons.show', $sermon->slug) }}</guid>
			</item>
		@endforeach
	</channel>
</rss>
