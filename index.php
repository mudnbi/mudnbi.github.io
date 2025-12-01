<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>کتێبخانە</title>
    <style>
        @font-face {
            font-family: 'Rabar43';
            src: url('fonts/Rabar_043.ttf');
        }
        @font-face {
            font-family: 'Rabar21';
            src: url('fonts/Rabar_021.ttf');
        }

        * {
            font-family: 'Rabar21';
        }

        h1, h2, h3, th {
            font-family: 'Rabar43';
        }

        table {
            font-family: 'Rabar21';
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            direction: rtl;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .message {
            font-family: 'Rabar21';
            text-align: center; 
            direction: rtl;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success { color: green; background-color: #e6fffa; border: 1px solid green; }
        .error { color: red; background-color: #ffe6e6; border: 1px solid red; }
    </style>
</head>
<body>

<?php
    $connect = mysqli_connect("localhost", "root", "", "ktebxanadb");
    
    if (!$connect) {
        die("<div class='message error'>پەیوەندیکردن بە داتابەیسەوە سەرکەوتوونەبوو.</div>");
    }

if (isset($_POST['submit']))    
{
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $language = $_POST['language'];
    $publisher = $_POST['publisher'];
    $publication_year = $_POST['publication_year'];
    $edition = $_POST['edition'];
    $no_of_pages = $_POST['no_of_pages'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $query = "insert into ktebxanatb (title, author, genre, language, publisher, publication_year, edition, no_of_pages, description, quantity, price) values ('$title', '$author', '$genre', '$language', '$publisher', '$publication_year', '$edition', '$no_of_pages', '$description', '$quantity', '$price')";

    $run = mysqli_query($connect, $query);

    if ($run) 
    {
        echo "<div class='message success'>بەسەرکەوتووی زیادکرا.</div>";
    }
    else
    {
        echo "<div class='message error'>زیادکردن سەرکەوتوونەبوو.</div>";
    }
}

if (isset($_POST['show']))    
{
    $query = "SELECT * FROM ktebxanatb";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) 
    {
        echo '<h2 style="text-align:center;"><br>لیستی کتێبەکان</h2>';

        echo "<table>";
        
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>ناونیشان</th>";
                echo "<th>نووسەر</th>";
                echo "<th>ژانەر</th>";
                echo "<th>زمان</th>";
                echo "<th>بڵاوکار</th>";
                echo "<th>ساڵی چاپ</th>";
                echo "<th>نۆرەی چاپ</th>";
                echo "<th>ژ.لاپەڕە</th>";
                echo "<th>دەربارە</th>";
                echo "<th>دانە</th>";
                echo "<th>نرخ</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['author'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . $row['language'] . "</td>";
                    echo "<td>" . $row['publisher'] . "</td>";
                    echo "<td>" . $row['publication_year'] . "</td>";
                    echo "<td>" . $row['edition'] . "</td>";
                    echo "<td>" . $row['no_of_pages'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                echo "</tr>";
            }

        echo "</table>";
    } 
    else 
    {
        echo "<div class='message error'>هیچ کتێبێک لە داتابەیسدا تۆمارنەکراوە.</div>";
    }
}
?>

</body>
</html>