<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
</head>

<body>
    </head>
    <!-- Navigation Bar -->
    <!-- Navigation Bar -->
    <nav class="bg-red-700 p-2 mt-0 w-full">
        <div class="container mx-auto flex flex-wrap items-center">
            <div class="flex w-full md:w-1/2 justify-center md:justify-start text-white font-extrabold">
                <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                    <span class="text-2xl pl-2">Blood Bank Management System</span>
                </a>
            </div>
            <div class="flex w-full md:w-1/2 justify-center md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block py-2 px-4 text-white font-bold no-underline" href="index.html">HOME</a>
                    </li>
                   
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="AdminLogin.php">ADMIN</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="index.html#learn">LEARN</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="contact.php">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="box">
            <h1>Contact Details</h1>
            <p><strong>Admins: </strong>20BCE191 Drashti Panseriya, 20BCE231 Riddhi Prajapati, 20BCE241 Rana Jay </p>
            <p><strong>Institute name:</strong> Nirma University</p>
            <p><strong>Email:</strong>cse_students@nirmauni.ac.in</p>
            <p><strong>Phone Number:</strong>9876543210</p>
            <p><strong>Address :</strong>Sarkhej - Gandhinagar Hwy, Gota, Ahmedabad, Gujarat 382481</p>

        </div>
    </div>
    <div class="container">
        <div class="box">
            <h1>Please Provide your valuable Feedback</h1>
            <form method='post'>
                <b>Email:</b> <input type='text' name='email'><br><br>
                <textarea name='feedback'> </textarea>
                <br>
                <button type='submit'>Submit</button>
                <br>
            </form>

        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //store feedback in database
        $email = $_POST['email'];
        $feedback = $_POST['feedback'];
        $sql = "INSERT INTO `feedback` (`email`,`feedback`) VALUES  ('$email','$feedback')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>



</body>

</html>