[
@foreach ($sermons as $index => $sermon)
	{
		"title": "{!! $sermon->title->rendered !!}",
	  	"date": "{{ date('l, F j, Y', strtotime($sermon->date)) }}",
	  	"byline": "{{ $sermon->_embedded->author[0]->name }}",
	  	"text": "{{ $sermon->acf->text }}",
	  	"url": "{{ $sermon->link }}",
	  	"cover": "{{ $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url }}",
	  	"slug": "{{ $sermon->slug }}",
	  	"sku": "1"
	}
	@unless ($index+1 == count($sermons))
	,
	@endunless
@endforeach
]
