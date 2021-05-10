<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
	<center>
	<h1>Movie List</h1>
	<form action="{{url('search')}}" method="get">
		<input type="text" name="title" placeholder="Search movie...">
		<button type="submit">search</button>
	</form>
	</center>
	Search for : {{ $title }}
	@if($movies['Response'] == 'True')
	
	<table border="1" cellspacing="0">
		<tr>
			<td>ID</td>
			<td>Poster</td>
			<td>Title</td>
			<td>Year</td>
		</tr>

		@foreach($movies['Search'] as $mov)
		<tr>
			<td>{{ $mov['imdbID']}}</td>
			<td width="10%" style="text-align: center;"><img src="{{ $mov['Poster']}}" width="20%"></td>
			<td>{{ $mov['Title']}}</td>
			<td>{{ $mov['Year']}}</td>
		</tr>
		@endforeach
	</table>
	

	@else 
		<h2>{{ $movies['Error']}}</h2>
	@endif
	

	<center>
		@if($current != 0)
			@for ($i = 1; $i <= $page; $i++)			
				@if($i == $current)
					<a>{{ $i }}</a>
				@else
					<a href="/search?title={{$title}}&page={{$i}}">{{ $i }}</a>
				@endif
			@endfor
		@endif
	</center>
</body>
</html>


