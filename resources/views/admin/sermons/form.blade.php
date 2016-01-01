<div class="form-group">
	{!! Form::label('ministry', 'Category:') !!}
	{!! Form::select('ministryId', array('women' => 'Women', 'men' => 'Men', 'sundayschool' => 'Sunday School', null => 'Main Service', 'youth' => 'The United'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('title', 'Title:') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('worksheet', 'Worksheet:') !!}
	{!! Form::file('worksheet', ['class' => 'form-control']) !!}
	<p><a href="{{ $sermon->worksheet }}">{{ $sermon->worksheet }}</a></p>
</div>

<div class="form-group">
	{!! Form::label('bulletin', 'Bulletin:') !!}
	{!! Form::file('bulletin', ['class' => 'form-control']) !!}
	<p><a href="{{ $sermon->bulletin }}">{{ $sermon->bulletin }}</a></p>
</div>

<div class="form-group">
	{!! Form::label('exceprt', 'Excerpt:') !!}
	{!! Form::text('excerpt', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('body', 'Body:') !!}
	{!! Form::textarea('body', null, ['class' => 'form-control compasshb-editor']) !!}
</div>

<div class="form-group">
	{!! Form::label('teacher', 'Teacher:') !!}
	{!! Form::text('teacher', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('text', 'Text:') !!}
	{!! Form::text('text', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('video', 'Video:') !!}
	{!! Form::text('video', null, ['class' => 'form-control']) !!}<br/>
	<p class="alert alert-info">Paste in the URL to the vimeo video page above. The video will be converted into an MP3 automatically when it is saved for the first time. If you change the video URL after saving the MP3 will need to manually be updated.</p>
</div>

<div class="form-group">
	{!! Form::label('series', 'Series:') !!}
	{!! Form::select('series_id', $series, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('published_at', 'Publish On:') !!}
	{!! Form::input('date', 'published_at', $sermon->published_at->format('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
