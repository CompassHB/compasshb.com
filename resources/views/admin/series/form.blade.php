<div class="form-group">
	{!! Form::label('title', 'Title:') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('body', 'Body:') !!}
	{!! Form::textarea('body', null, ['class' => 'form-control compasshb-editor']) !!}
</div>

<div class="form-group">
	{!! Form::label('image', 'Image:') !!}
	{!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('ministry', 'Ministry:') !!}
	{!! Form::select('ministryId', array('youth' => 'The United (Youth)', 'sundayschool' => 'Sunday School', null => 'Main Service'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
