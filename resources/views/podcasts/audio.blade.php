{!! '<?xml version = "1.0" encoding = "utf-8"?>' !!}

<rss xmlns:itunes="https://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
	<channel>
		<title>Compass HB Audio</title>
		<itunes:subtitle>Audio Podcast</itunes:subtitle>
		<itunes:summary>Reaching, teaching, and training people for Christ</itunes:summary>
		<description>Reaching, teaching, and training people for Christ</description>
		<language>en-us</language>
		<copyright>&#x2117; &amp; &#xA9; 2015 Compass HB</copyright>
		<link>{{ URL::to('/') }}/feed/sermonaudio</link>
		<pubDate>{{ Carbon\Carbon::now()->toRfc2822String() }}</pubDate>
		<itunes:image href="https://compasshb.smugmug.com/photos/i-kMfffrR/0/X3/i-kMfffrR-X3.jpg" />
		<itunes:category text="Religion &amp; Spirituality">
			<itunes:category text="Christianity"/>
		</itunes:category>
		<itunes:category text="Education"/>

		@foreach ($sermons as $sermon)
			<item>
				<title>{{ $sermon->title->rendered }}</title>
				<link>{{ route('sermons.show', $sermon->slug) }}</link>
				<itunes:subtitle>{{ $sermon->title->rendered }} {{ $sermon->acf->text }}</itunes:subtitle>
				<enclosure url="{{ $sermon->slug }}" length="160000000" type="audio/x-mp4" />
				<description>{{ $sermon->_embedded->author[0]->name }} {{ $sermon->acf->text }}</description>
				<pubDate>{{ date('D, d M Y H:i:s O', strtotime($sermon->date)) }}</pubDate>
				<guid>{{ route('sermons.show', $sermon->slug) }}</guid>
			</item>
		@endforeach
	</channel>
</rss>