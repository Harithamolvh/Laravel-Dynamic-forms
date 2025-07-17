<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Form Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #1a202c;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Form Created!</h1>

        <p>Dear Admin,</p>

        <p>A new form has been successfully created on your application.</p>

        <p><strong>Form Details:</strong></p>
        <ul>
            <li><strong>ID:</strong> {{ $form->id }}</li>
            <li><strong>Name:</strong> {{ $form->name }}</li>
            <li><strong>Description:</strong> {{ $form->description }}</li>
            <li><strong>Created At:</strong> {{ $form->created_at->format('M d, Y H:i A') }}</li>
        </ul>

        <p>You can view or manage this form by logging into the admin panel.</p>

        <p>Thanks,<br>{{ config('app.name') }}</p>
    </div>
</body>
</html>