<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auth System</title>
    <style>
        /* Global Styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 420px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .container:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
        }

        h2 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #333;
            font-weight: 600;
        }

        /* Input Styling */
        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #6e8efb;
            outline: none;
        }

        /* Checkbox Styling */
        .checkbox-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            align-items: center;
            margin: 15px 0;
            font-size: 16px;
            font-weight: 500;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            font-size: 16px;
            color: #444;
            cursor: pointer;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(110, 142, 251, 0.1);
        }

        .checkbox-group label:hover {
            background: rgba(110, 142, 251, 0.2);
            transform: scale(1.05);
        }

        .checkbox-group input {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #6e8efb;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            position: relative;
        }

        .checkbox-group input:checked {
            background: #6e8efb;
            border-color: #6e8efb;
        }

        .checkbox-group input:checked::before {
            content: '✔';
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Button Styling */
        button {
            width: 100%;
            background: linear-gradient(90deg, #6e8efb, #5a7ce2);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(90deg, #5a7ce2, #4c66e4);
            transform: translateY(-2px);
        }

        .link {
            margin-top: 12px;
            font-size: 14px;
        }

        .link a {
            color: #6e8efb;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .link a:hover {
            color: #4c66e4;
        }

    </style>
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
