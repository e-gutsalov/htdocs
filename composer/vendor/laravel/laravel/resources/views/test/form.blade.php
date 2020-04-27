<form action="" method="POST">
{{ csrf_field() }}
	<input type="text" name="text" value="{{ old('text') }}">
	<input type="submit">
</form>
		<p>Первая переменная: </p>