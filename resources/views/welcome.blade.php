<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Businesses</h1>
<ul>
    @if($businesses)
    @foreach($businesses as $item)
        <li><a href="{{route('business.show', $item)}}">{{$item['title']}} {{$item['description']}}</a></li>
    @endforeach
    @else
    <p>No records found</p>
    @endif
</ul>
</body>
</html>
