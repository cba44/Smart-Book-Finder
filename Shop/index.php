
  <?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);

    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    $sql = 'SELECT * FROM mybooks';
    mysql_select_db('books');
    $retval = mysql_query( $sql, $conn );

    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }

    $array = array();

    while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
    {
         $array[] = $row;
    }

    $length = sizeof($array);

    mysql_close($conn);
  ?>

<!doctype html>
<head>
  <meta charset="utf-8">

  <title>Shop Owner's Page</title>
  <meta name="description" content="My Parse App">
  <meta name="viewport" content="width=device-width"><!--
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/styles.css"> -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://www.parsecdn.com/js/parse-1.4.2.min.js"></script>
</head>

<body>

  <!--
  <div id="main">
    <h1>You're ready to use Parse!</h1>

    <p>Read the documentation and start building your JavaScript app:</p>

    <ul>
      <li><a href="https://www.parse.com/docs/js_guide">Parse JavaScript Guide</a></li>
      <li><a href="https://www.parse.com/docs/js">Parse JavaScript API Documentation</a></li>
    </ul>

    <div style="display:none" class="error">
      Looks like there was a problem saving the test object. Make sure you've set your application ID and javascript key correctly in the call to <code>Parse.initialize</code> in this file.
    </div>

    <div style="display:none" class="success">
      <p>We've also just created your first object using the following code:</p>
      
        <code>
          var TestObject = Parse.Object.extend("TestObject");<br/>
          var testObject = new TestObject();<br/>
          testObject.save({foo: "bar"});
        </code>
    </div>
  </div>
  -->
  <div name='registration' method="post" ><!--
    Book Name:<br>
    <input type="text" name="bookname" id="bookname">
    <br>
    Bookshop:<br>
    <input type="text" name="bookshop" id="bookshop">
    <br>
    Latitude:<br>
    <input type="text" name="latitude" id="latitude">
    <br>
    Longitude:<br>
    <input type="text" name="longitude" id="longitude">
    <br><br>-->
    <input type="button" value="Update online database" onclick="addBook()">
    <input type="button" value="Log Out" onclick="logout1()">
  </div>

  <script type="text/javascript">
    //Parse.initialize("APPLICATION_ID", "JAVASCRIPT_KEY");    

    function addBook(){

      Parse.initialize("cDjCcIaSJQxY7pQY2tdeP6odtYqHhZLmonAzxTGn", "8KDvQuKiDonuv2LqZ1FEviCq0K3A5C6GCm3fWCio");

      var Books = Parse.Object.extend("Books");
      

      var jArray= <?php echo json_encode($array ); ?>;
      var jlength = "<?php echo $length; ?>"

      for(var i=0 ; i < jlength ; i++){
          //alert(i);
          var books = new Books();

          var bookName = jArray[i].bookName;
          var bookShop = jArray[i].bookShop;
          var longitude = jArray[i].longitude;
          var latitude = jArray[i].latitude;
          //alert(bookName+' '+bookShop+' '+latitude+' '+longitude);

          books.set("BookName", bookName);
          books.set("BookShop", bookShop);
          books.set("Longitude", longitude);
          books.set("Latitude", latitude);

          books.save(null, {
            success: function(books) {
              // Execute any logic that should take place after the object is saved.
              //alert('Successfully added ' + bookName + ' to the database');
            },
            error: function(books, error) {
              // Execute any logic that should take place if the save fails.
              // error is a Parse.Error with an error code and message.
              alert('Failed to create new object, with error code: ' + error.message);
            }
          }); 

               

      }alert("Books added Successfully");  
      
    }

    function logout1(){

      Parse.initialize("cDjCcIaSJQxY7pQY2tdeP6odtYqHhZLmonAzxTGn", "8KDvQuKiDonuv2LqZ1FEviCq0K3A5C6GCm3fWCio");

      Parse.User.enableRevocableSession();
      Parse.Session.isCurrentSessionRevocable();
      Parse.User.logOut();
      alert("Logout Successfully");

      window.open("blank.html","_self")

    }

  </script>

</body>

</html>