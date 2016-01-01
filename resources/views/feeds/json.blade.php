[
@foreach ($sermons as $index => $sermon)
	{
		"title": "{!! $sermon->title !!}",
	  	"date": "{{ $sermon->date }}",
	  	"byline": "{{ $sermon->teacher }}",
	  	"text": "{{ $sermon->text }}",
	  	"url": "{{ $sermon->video }}",
	  	"cover": "{{ $sermon->othumbnail }}",
	  	"slug": "{{ $sermon->alias }}",
	  	"sku": "{{ $sermon->sku }}"
	}
	@unless ($index+1 == count($sermons))
	,
	@endunless
@endforeach
]
