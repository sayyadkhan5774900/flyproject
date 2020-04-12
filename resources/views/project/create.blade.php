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

    <form action="/projects" method="post">

        @csrf

       <div>
           <input type="text" name="title" id="title">
       </div>

       <div>
           <input type="text" name="description" id="description">
       </div>

       <div>
           <button type="submit">Submit</button>
       </div>



    </form>

</body>
</html>
