<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content=" width=device-width, initial-scale=1.0">
  <title>Genre specific</title>
  <link rel="stylesheet" type="text/css" href="../all_CSS/stylingUser.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
  <div class="container">
    <header class="header">
      <div class="div-logo">
        <div class="dropdown">
          <i class="fas fa-user" style="font-size: 30px; color: white;"></i>
          <div class="dropdown-content">
            <a href="./history.php">History</a>
            <a href="./profile.php">Profile</a>
            <form action="./index.php" method="post">
              <button type="submit" name="logout">Logout</button>
            </form>
          </div>
        </div>
      </div>
      <nav class="user-nav">
        <ul>
          <li><a href="./userhome.php"><i class="fas fa-home" style="font-size: 20px; color: white;"></i></a></li>
          <li><a href="./about.php" style="font-size: 15px; color: white;">About</a></li>

        </ul>
        <form action="./all_search.php" method="post">
          <input type="text" id="searchInput" placeholder="Search by Author" name="search">
          <button type="submit" class="search-button">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </nav>
    </header>
    </header>
    <div id="back-to-top">
      <a href="#top"><i class="fas fa-arrow-up"></i></a>
    </div>
    <div class="site-content">
      <h1><span class="attractive-text">Discover Books</span></h1>
      <div class="book-container">
        <?php

        $connect = new mysqli('localhost', 'root', '', 'Library');
        if (!$connect) {
          die(mysqli_error($connect));
        }
        $genre = $_GET['genre'];
        if ($genre == "All") {
          $by_genre = "SELECT * FROM `Books` ORDER BY RAND()";
          $by_genre_result = mysqli_query($connect, $by_genre);
          if (mysqli_num_rows($by_genre_result) > 0) {
            while ($book_details_row = mysqli_fetch_assoc($by_genre_result)) {
              echo '<div class="book-box">
                      <img src="./book_images/' . $book_details_row["book_image"] . '" alt="' . $book_details_row["book_name"] . '">
                        <div class="book-details">
                          <p class="text-css">' . $book_details_row["book_name"] . '</p>
                          <p >by <span class="text-css">' . $book_details_row["book_author"] . '</span></p>
                          <p class="text-css">' . $book_details_row["book_genre"] . '</p>
                          <p><span class="text-css">' . $book_details_row["num_copies"] . '</span> copies available</p>
                        </div>
                    </div>';
            }
          } else {
            echo "No books found";
          }
        } else {
          $by_genre = "SELECT * FROM `Books` WHERE book_genre='$genre' ORDER BY RAND()";
          $by_genre_result = mysqli_query($connect, $by_genre);
          if (mysqli_num_rows($by_genre_result) > 0) {
            while ($book_details_row = mysqli_fetch_assoc($by_genre_result)) {
              echo '<div class="book-box">
                      <img src="./book_images/' . $book_details_row["book_image"] . '" alt="' . $book_details_row["book_name"] . '">
                      <div class="book-details">
                        <p class="text-css">' . $book_details_row["book_name"] . '</p>
                        <p >by <span class="text-css">' . $book_details_row["book_author"] . '</span></p>
                        <p class="text-css">' . $book_details_row["book_genre"] . '</p>
                        <p><span class="text-css">' . $book_details_row["num_copies"] . '</span> copies available</p>
                      </div>
                    </div>';
            }
          } else {
            echo "No books found";
          }
        }
        ?>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var userIcon = document.getElementById('user-icon');
        var dropdownContent = document.querySelector('.dropdown-content');

        userIcon.addEventListener('click', function() {
          dropdownContent.classList.toggle('show');
        });

        userIcon.addEventListener('mouseenter', function() {
          dropdownContent.classList.add('show');
        });

        dropdownContent.addEventListener('mouseenter', function() {
          dropdownContent.classList.add('show');
        });

        userIcon.addEventListener('mouseleave', function() {
          dropdownContent.classList.remove('show');
        });

        dropdownContent.addEventListener('mouseleave', function() {
          dropdownContent.classList.remove('show');
        });
      });

      window.addEventListener("scroll", function() {
        var backToTop = document.getElementById("back-to-top");
        if (window.pageYOffset > 100) {
          backToTop.style.opacity = "1";
        } else {
          backToTop.style.opacity = "0";
        }
      });

      const searchInput = document.getElementById("searchInput");
      const placeholders = ["Author", "Genre", "Book"];
      let currentIndex = 0;

      function updatePlaceholder() {
        searchInput.placeholder = `Search by ${placeholders[currentIndex]}`;
        currentIndex = (currentIndex + 1) % placeholders.length;
      }

      setInterval(updatePlaceholder, 1500);
    </script>
  </div>
</body>

</html>