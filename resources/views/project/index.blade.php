<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Projects</h1>

    <ul>

        @forelse ($projects as $project)
            <li>
                <a href="{{$project->path()}}">{{$project->title}}</a>
            </li>
        @empty
            <p>No Projects Yet</p>
        @endforelse


    </ul>

</body>
</html>
