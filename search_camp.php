<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" />
  
  <link rel="stylesheet" href="search_camp.css" />
  <title>Search Camp</title>
 
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
  <h1>Blood Camp Search</h1>

  <form method="post">
    Camp Name:<input type='text' name='camp'>
    <br>
    District:<input type='text' name='district'> <br>
    <label for="state">State:</label>
    <select id="state" name="state"> <!-- the name attribute is used as a reference when the data is submitted. -->
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
    <br>
    <button type="submit" name="search"> Search</button>
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

    $camp_name = $_POST['camp'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    // // Build the SQL query based on user inputs
    $sql = "SELECT * FROM camp WHERE ";

    // Check for all combinations of 3 values
    if (!empty($state) && !empty($district) && !empty($camp_name)) {
      $sql .= "state = '$state' AND district = '$district' AND Camp_Name = '$camp_name'";
    } 
    // 2 of them are non empty 
    elseif (!empty($state) && !empty($district) && empty($camp_name)) {
      $sql .= "state = '$state' AND district = '$district'";
    } elseif (!empty($state) && empty($district) && !empty($camp_name)) {
      $sql .= "state = '$state' AND Camp_Name = '$camp_name'";
    } elseif (empty($state) && !empty($district) && !empty($camp_name)) {
      $sql .= "district = '$district' AND Camp_Name = '$camp_name'";
    }
    // 1 of them is non-empty
    elseif (!empty($state) && empty($district) && empty($camp_name)) {
      $sql .= "state = '$state'";
    } elseif (empty($state) && !empty($district) && empty($camp_name)) {
      $sql .= "district = '$district'";
    } elseif (empty($state) && empty($district) && !empty($camp_name)) {
      $sql .= "Camp_Name = '$camp_name'";
    } else {
      echo "<p>";
      echo "No result Found</p>";
      exit();
    }

    // Execute the query
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {

      // Display the results in a table
      echo "<table>";
      echo "<tr><th>Organization Type</th><th>Organization Name</th><th>Organizer Name</th><th>Organizer Mobile No.</th><th>Organizer Email Id</th><th>Camp Name</th><th>Camp Address</th><th>Date</th></th><th>state</th></th><th>district</th></tr>";

      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Organization_Type"] . "</td><td>" . $row["Organization_Name"] . "</td><td>" . $row["Organizer_Name"] . "</td><td>" . $row["Organizer_Mobile_No"] . "</td><td>" . $row["Organizer_Email_Id"] . "</td><td>" . $row["Camp_Name"] . "</td><td>" . $row["Camp_Address"] . "</td><td>" . $row["date"] . "</td><td>" . $row["state"] . "</td><td>" . $row["district"] . "</td>";
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