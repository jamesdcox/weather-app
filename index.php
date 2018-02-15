<? 

    $city="";

    $weather="";

    $error="";

    if (array_key_exists('city', $_GET)) {
        
        
        $city = str_replace(' ', '', $_GET['city']);
        
        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    
            $error="This is not a valid city!"; 

        } else {
        
        $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        
        $pageArray = explode('Weather Today </h2>(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);
        
            
        if (sizeof($pageArray) > 1) {
        
        
            $secondPageArray = explode("</span></p></td>", $pageArray[1]);
            
            if (sizeof($secondPageArray) > 1) {
                
                $weather = $secondPageArray[0];
                
            } else {
                
                $error="This is not a valid city!";
                
            }

            
        
        
            } else {
            
            
            $error="This is not a valid city!";
            
        }
        
        
        }
        
    }

?>


<!doctype html>

<html lang="en">
    
  
    <head>
    
        <title>Weather Scraper</title>
    
        <!-- Required meta tags -->
    
        <meta charset="utf-8">
    
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
        <!-- Bootstrap CSS -->
    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        
        <!-- My CSS -->
        <link rel="stylesheet" type="text/css" href="styles.css">
  
    </head>
  
    <body>
    
        <div class="container-fluid">
            
            <div class="container main">
        
        
            <h1>What's the weather?</h1>
            
            <p>Enter the name of a city.</p>
            
            <form method="get">
  
                <div class="form-group">
    
                    <input type="text" class="form-control" id="city" name="city" placeholder="e.g. London, Tokyo" value="<? if (array_key_exists('city', $_GET)) { echo $_GET['city'];}?>">
    
  
                </div>
  
  
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
            
            <div id="weatherBox">
                
                <? if ($weather) {
    
                    echo '<div class="alert alert-warning" role="alert">
                            
                            '.$weather.'

                    </div>';
                
    
                } else if ($error) {
    
                    echo '<div class="alert alert-danger" role="alert">
                            
                            '.$error.'

                    </div>';
    
                }
                
                ?>
                
            </div>
                
        </div>
        
        
        </div>

    
        <!-- Optional JavaScript -->
    
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
 
    </body>

</html>