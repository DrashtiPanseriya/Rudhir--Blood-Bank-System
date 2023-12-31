<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" />
  <link rel="stylesheet" href="common.css" />
  <link rel="stylesheet" href="search_blood.css" />
  <title>Blood Availability Search</title>
  
</head>

<body>
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
  <h1>Blood Availability Search</h1>

  <form method="post">
    <label for="blood_group">Blood Group:</label>
    <select name="blood_group" id="blood_group">
      <option value="">Select a blood group</option>
      <option value="A+">A+</option>
      <option value="A-">A-</option>
      <option value="B+">B+</option>
      <option value="B-">B-</option>
      <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
      <option value="O+">O+</option>
      <option value="O-">O-</option>
    </select>


    <label for="state">State:</label>
    <select id="state" name="state">
      <option value="">Select a state</option>
      <option value="Andhra Pradesh">Andhra Pradesh</option>
      <option value="Arunachal Pradesh">Arunachal Pradesh</option>
      <option value="Assam">Assam</option>
      <option value="Bihar">Bihar</option>
      <option value="Chhattisgarh">Chhattisgarh</option>
      <option value="Goa">Goa</option>
      <option value="Gujarat">Gujarat</option>
      <option value="Haryana">Haryana</option>
      <option value="Himachal Pradesh">Himachal Pradesh</option>
      <option value="Jammu and Kashmir">Jammu and Kashmir</option>
      <option value="Jharkhand">Jharkhand</option>
      <option value="Karnataka">Karnataka</option>
      <option value="Kerala">Kerala</option>
      <option value="Madhya Pradesh">Madhya Pradesh</option>
      <option value="Maharashtra">Maharashtra</option>
      <option value="Manipur">Manipur</option>
      <option value="Meghalaya">Meghalaya</option>
      <option value="Mizoram">Mizoram</option>
      <option value="Nagaland">Nagaland</option>
      <option value="Odisha">Odisha</option>
      <option value="Punjab">Punjab</option>
      <option value="Rajasthan">Rajasthan</option>
      <option value="Sikkim">Sikkim</option>
      <option value="Tamil Nadu">Tamil Nadu</option>
      <option value="Telangana">Telangana</option>
      <option value="Tripura">Tripura</option>
      <option value="Uttar Pradesh">Uttar Pradesh</option>
      <option value="Uttarakhand">Uttarakhand</option>
      <option value="West Bengal">West Bengal</option>
    </select>

    <button type='submit' name='submit'>Search</button>
  </form>
  <?php
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

  // Check if form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $blood_group = $_POST['blood_group'];
    $state = $_POST['state'];

    // Build the SQL query based on user inputs
    $sql = "SELECT * FROM tb WHERE ";

    if (!empty($blood_group) && !empty($state)) {
      $sql .= "bloodgroup = '$blood_group' AND state = '$state'";
    } else if (!empty($blood_group)) {
      $sql .= "bloodgroup = '$blood_group'";
    } else if (!empty($state)) {
      $sql .= "state = '$state'";
    } else {
      echo "<p>No results found.</p>";
      exit;
    }

    // Execute the SQL query and store the result set
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {

      // Display the results in a table
      echo "<table>";
      echo "<tr><th>Name</th><th>email</th><th>gender</th><th>age</th><th>address</th><th>state</th><th>pincode</th><th>mobileno</th><th>BloodGroup</th></tr>";

      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["age"] . "</td><td>" . $row["address"] . "</td><td>" . $row["state"] . "</td><td>" . $row["pincode"] . "</td><td>" . $row["mobileno"] . "</td><td>" . $row["bloodgroup"] . "</td></tr>";
      }

      echo "</table>";

    } else {
      echo "<p>No results found.</p>";
    }

    // Close the database connection
    $conn->close();
  }
  ?>

</body>

</html>