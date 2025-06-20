
   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family: arial;
        }
        img{
            border: solid;
            padding: 10px;
            border-radius: 5px;
            width: 80px;
            position: absolute;
            bottom:10px;
            right:10px
        }
    </style>
   </head>
   <body>
    <h1>{{ $task->title }}</h1>
    <hr>
     <p>{{ $task->description }}</p>
    <ul >
        <li><strong>Completed: </strong> {{ $task->completed ? "Yes" : "No"}}</li>
        <li><strong>Due Date: </strong> {{ $task->due_date }}</li>
        <li><strong>Author: </strong> {{ $task->user->name }}</li>
        <li><strong>Category: </strong> {{ $task->category  ? $task->category->category[app()->getLocale()] ?? $task->category->category['en'] : '' }}</li>
    </ul>
    <hr>
    <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
   </body>
   </html>            
                    
               


